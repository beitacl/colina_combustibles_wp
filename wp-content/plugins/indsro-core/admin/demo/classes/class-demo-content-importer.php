<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Indsro Demo Content Importer.
 *
 * Handles batch insertion of posts, pages, CPTs, attachments,
 * taxonomy terms, and all associated post meta.
 */
class Indsro_Demo_Content_Importer {

    /** @var array Old→new post ID mapping. */
    private $post_map = [];

    /** @var array Old→new term ID mapping. */
    private $term_map = [];

    /** @var array Posts needing parent resolution on second pass. */
    private $orphans = [];

    /**
     * Import all taxonomy terms from parsed WXR data.
     *
     * @param array $terms Parsed term arrays.
     * @return array Old→new term ID mapping.
     */
    public function import_terms( array $terms ): array {
        // First pass — create all terms.
        foreach ( $terms as $term ) {
            $new_id = $this->import_single_term( $term );
            if ( $new_id ) {
                $this->term_map[ $term['term_id'] ] = $new_id;
            }
        }

        // Second pass — assign parents.
        foreach ( $terms as $term ) {
            if ( empty( $term['parent'] ) ) {
                continue;
            }
            $new_id = $this->term_map[ $term['term_id'] ] ?? null;
            if ( ! $new_id ) {
                continue;
            }
            $parent_term = get_term_by( 'slug', $term['parent'], $term['taxonomy'] );
            if ( $parent_term && ! is_wp_error( $parent_term ) ) {
                wp_update_term( $new_id, $term['taxonomy'], [ 'parent' => $parent_term->term_id ] );
            }
        }

        Indsro_Demo_Progress::add_log( 'Imported ' . count( $this->term_map ) . ' taxonomy terms.' );

        return $this->term_map;
    }

    /**
     * Import a single term.
     */
    private function import_single_term( array $term ): ?int {
        $taxonomy = $term['taxonomy'] ?? 'category';

        if ( ! taxonomy_exists( $taxonomy ) ) {
            return null;
        }

        $existing = get_term_by( 'slug', $term['slug'], $taxonomy );
        if ( $existing && ! is_wp_error( $existing ) ) {
            return $existing->term_id;
        }

        $result = wp_insert_term( $term['name'], $taxonomy, [
            'slug'        => $term['slug'],
            'description' => $term['description'] ?? '',
        ] );

        if ( is_wp_error( $result ) ) {
            return null;
        }

        $new_id = $result['term_id'];

        // Import term meta.
        foreach ( $term['termmeta'] ?? [] as $meta ) {
            update_term_meta( $new_id, $meta['key'], maybe_unserialize( $meta['value'] ) );
        }

        return $new_id;
    }

    /**
     * Import a batch of posts.
     *
     * @param array $posts      All parsed post arrays.
     * @param int   $offset     Start index.
     * @param int   $batch_size Number of posts per batch.
     * @return array { done, offset, imported }
     */
    public function import_batch( array $posts, int $offset = 0, int $batch_size = 20 ): array {
        // Allow SVG tags through wp_kses during import so inline SVGs in
        // post_content are not stripped by wp_insert_post / wp_update_post.
        add_filter( 'wp_kses_allowed_html', [ $this, 'allow_svg_tags' ], 10, 2 );

        $total   = count( $posts );
        $batch   = array_slice( $posts, $offset, $batch_size );
        $count   = 0;

        foreach ( $batch as $post ) {
            $new_id = $this->import_single_post( $post );
            if ( $new_id ) {
                $this->post_map[ $post['post_id'] ] = $new_id;
                $count++;
            }
        }

        $new_offset = $offset + $batch_size;
        $done       = $new_offset >= $total;

        // If done, resolve orphan parents.
        if ( $done ) {
            $this->resolve_orphans();
        }

        // Remove SVG allowlist filter after import.
        remove_filter( 'wp_kses_allowed_html', [ $this, 'allow_svg_tags' ], 10 );

        return [
            'done'     => $done,
            'offset'   => $new_offset,
            'imported' => $count,
            'total'    => $total,
        ];
    }

    /**
     * Allow SVG and related tags through wp_kses during demo import.
     *
     * WordPress's wp_kses_post strips <svg>, <path>, etc. by default.
     * During demo import, we need to preserve inline SVGs from the demo content.
     *
     * @param array  $tags    Allowed HTML tags and attributes.
     * @param string $context The context (e.g., 'post').
     * @return array Modified allowed tags including SVG elements.
     */
    public function allow_svg_tags( array $tags, $context ): array {
        $svg_attrs = [
            'xmlns'       => true,
            'width'       => true,
            'height'      => true,
            'viewbox'     => true,
            'fill'        => true,
            'stroke'      => true,
            'stroke-width' => true,
            'stroke-linecap' => true,
            'stroke-linejoin' => true,
            'class'       => true,
            'id'          => true,
            'style'       => true,
            'aria-hidden' => true,
            'role'        => true,
            'focusable'   => true,
            'data-*'      => true,
            'xmlns:xlink' => true,
        ];

        $path_attrs = [
            'd'              => true,
            'fill'           => true,
            'fill-rule'      => true,
            'clip-rule'      => true,
            'stroke'         => true,
            'stroke-width'   => true,
            'stroke-linecap' => true,
            'stroke-linejoin' => true,
            'transform'      => true,
            'opacity'        => true,
            'class'          => true,
            'id'             => true,
            'style'          => true,
        ];

        $shape_attrs = array_merge( $path_attrs, [
            'cx' => true, 'cy' => true, 'r' => true,
            'rx' => true, 'ry' => true,
            'x'  => true, 'y'  => true,
            'x1' => true, 'y1' => true, 'x2' => true, 'y2' => true,
            'width' => true, 'height' => true,
            'points' => true,
        ] );

        $tags['svg']      = $svg_attrs;
        $tags['path']     = $path_attrs;
        $tags['circle']   = $shape_attrs;
        $tags['rect']     = $shape_attrs;
        $tags['line']     = $shape_attrs;
        $tags['polyline'] = $shape_attrs;
        $tags['polygon']  = $shape_attrs;
        $tags['ellipse']  = $shape_attrs;
        $tags['g']        = [ 'fill' => true, 'transform' => true, 'class' => true, 'id' => true, 'style' => true, 'clip-path' => true, 'opacity' => true ];
        $tags['defs']     = [];
        $tags['clippath'] = [ 'id' => true ];
        $tags['use']      = [ 'xlink:href' => true, 'href' => true, 'x' => true, 'y' => true, 'width' => true, 'height' => true ];
        $tags['symbol']   = [ 'id' => true, 'viewbox' => true ];

        return $tags;
    }

    /**
     * Import a single post.
     */
    private function import_single_post( array $post ): ?int {
        // Attachments — create placeholder.
        if ( 'attachment' === $post['post_type'] ) {
            return $this->create_attachment( $post );
        }

        // Check for duplicate by slug + type.
        $existing = get_page_by_path( $post['post_name'], OBJECT, $post['post_type'] );
        if ( $existing ) {
            // Update the existing post's content to match the demo data.
            wp_update_post( [
                'ID'             => $existing->ID,
                'post_title'     => wp_strip_all_tags( $post['post_title'] ),
                'post_content'   => $post['post_content'],
                'post_excerpt'   => $post['post_excerpt'],
                'post_status'    => $post['post_status'],
                'menu_order'     => $post['menu_order'],
                'comment_status' => $post['comment_status'],
                'ping_status'    => $post['ping_status'],
            ] );

            // Clear all existing postmeta (except core WP internals) before re-importing
            // to prevent stale meta from conflicting with demo data.
            $this->clear_post_meta_for_reimport( $existing->ID );

            // Re-import meta and terms from the demo data.
            $this->import_post_meta( $existing->ID, $post['postmeta'] ?? [] );
            $this->assign_post_terms( $existing->ID, $post['terms'] ?? [] );

            Indsro_Demo_Progress::add_log( 'Updated existing post: "' . $post['post_title'] . '" (ID: ' . $existing->ID . ')' );
            return $existing->ID;
        }

        // Resolve parent.
        $parent_id = 0;
        if ( ! empty( $post['post_parent'] ) ) {
            $parent_id = $this->post_map[ $post['post_parent'] ] ?? 0;
            if ( ! $parent_id ) {
                $this->orphans[] = $post;
            }
        }

        $post_data = [
            'post_title'     => wp_strip_all_tags( $post['post_title'] ),
            'post_name'      => $post['post_name'],
            'post_content'   => $post['post_content'],
            'post_excerpt'   => $post['post_excerpt'],
            'post_status'    => $post['post_status'],
            'post_type'      => $post['post_type'],
            'post_date'      => $post['post_date'],
            'post_date_gmt'  => $post['post_date_gmt'],
            'post_parent'    => $parent_id,
            'menu_order'     => $post['menu_order'],
            'post_password'  => $post['post_password'],
            'comment_status' => $post['comment_status'],
            'ping_status'    => $post['ping_status'],
            'post_author'    => get_current_user_id(),
        ];

        $new_id = wp_insert_post( $post_data, true );

        if ( is_wp_error( $new_id ) ) {
            Indsro_Demo_Progress::add_log( 'Failed: "' . $post['post_title'] . '" — ' . $new_id->get_error_message() );
            return null;
        }

        if ( ! empty( $post['is_sticky'] ) ) {
            stick_post( $new_id );
        }

        $this->import_post_meta( $new_id, $post['postmeta'] ?? [] );
        $this->assign_post_terms( $new_id, $post['terms'] ?? [] );

        return $new_id;
    }

    /**
     * Create an attachment post and link it to a local file if it exists.
     */
    private function create_attachment( array $post ): ?int {
        $source_url = $post['attachment_url'] ?? $post['guid'] ?? '';

        // Check if already imported.
        if ( ! empty( $source_url ) ) {
            global $wpdb;
            $existing_id = $wpdb->get_var( $wpdb->prepare(
                "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_indsro_import_source_url' AND meta_value = %s LIMIT 1",
                $source_url
            ) );
            if ( $existing_id ) {
                $this->post_map[ $post['post_id'] ] = (int) $existing_id;
                return (int) $existing_id;
            }
        }

        // Try to find the file locally in uploads.
        $upload_dir = wp_upload_dir();
        $local_file = $this->find_local_file( $source_url, $upload_dir['basedir'] );

        $attachment_data = [
            'post_title'     => $post['post_title'] ?: 'Imported Media',
            'post_name'      => $post['post_name'],
            'post_content'   => $post['post_content'] ?? '',
            'post_status'    => 'inherit',
            'post_type'      => 'attachment',
            'post_mime_type' => '',
            'guid'           => $source_url,
        ];

        if ( $local_file ) {
            $filetype = wp_check_filetype( basename( $local_file ) );
            $mime     = $filetype['type'] ?? '';

            // Fallback: wp_check_filetype returns false for SVG and other
            // non-standard formats when they're not in the allowed MIME list.
            if ( empty( $mime ) ) {
                $mime = $this->get_mime_type_fallback( basename( $local_file ) );
            }

            $attachment_data['post_mime_type'] = $mime;
            $attachment_data['guid']          = $upload_dir['baseurl'] . '/' . ltrim( str_replace( $upload_dir['basedir'], '', $local_file ), '/\\' );
        }

        $new_id = wp_insert_attachment( $attachment_data, $local_file ?: false );

        if ( is_wp_error( $new_id ) || ! $new_id ) {
            return null;
        }

        // Store source URL for deduplication.
        update_post_meta( $new_id, '_indsro_import_source_url', $source_url );

        // Generate attachment metadata if local file exists.
        if ( $local_file && file_exists( $local_file ) ) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $meta = wp_generate_attachment_metadata( $new_id, $local_file );
            wp_update_attachment_metadata( $new_id, $meta );
        }

        // Import original post meta.
        $this->import_post_meta( $new_id, $post['postmeta'] ?? [] );

        return $new_id;
    }

    /**
     * Fallback MIME type detection for file formats not in WordPress's
     * default allowed types (e.g., SVG, WEBP on older installs).
     */
    private function get_mime_type_fallback( string $filename ): string {
        $ext = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );

        $mime_map = [
            'svg'  => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
            'webp' => 'image/webp',
            'avif' => 'image/avif',
            'json' => 'application/json',
            'woff' => 'font/woff',
            'woff2'=> 'font/woff2',
            'ttf'  => 'font/ttf',
            'otf'  => 'font/otf',
        ];

        return $mime_map[ $ext ] ?? '';
    }

    /**
     * Try to find a local file matching the remote URL in the uploads directory.
     */
    private function find_local_file( string $url, string $base_dir ): ?string {
        if ( empty( $url ) ) {
            return null;
        }

        // Extract the path portion after /uploads/
        $parts = explode( '/uploads/', $url );
        if ( count( $parts ) < 2 ) {
            return null;
        }

        $relative = end( $parts );
        $local    = trailingslashit( $base_dir ) . $relative;

        return file_exists( $local ) ? $local : null;
    }

    /**
     * Clear post meta for reimport — removes all non-core meta keys
     * so that demo data can be cleanly re-imported without stale leftovers.
     */
    private function clear_post_meta_for_reimport( int $post_id ): void {
        // Core WP meta keys that should NEVER be deleted.
        $protected_keys = [
            '_edit_lock', '_edit_last', '_wp_old_slug',
            '_wp_page_template', '_wp_trash_meta_status', '_wp_trash_meta_time',
            '_indsro_import_source_url',
        ];

        $all_meta = get_post_meta( $post_id );

        foreach ( $all_meta as $key => $values ) {
            if ( in_array( $key, $protected_keys, true ) ) {
                continue;
            }
            delete_post_meta( $post_id, $key );
        }
    }

    /**
     * Import post meta.
     */
    private function import_post_meta( int $post_id, array $meta_list ): void {
        $skip = [ '_edit_lock', '_edit_last', '_wp_old_slug', '_encloseme', '_pingme' ];

        // Track CSF meta for logging.
        $csf_meta_keys = [ 'tx_page_meta', 'tx_post_audio_meta', 'tx_post_video_meta', 'tx_post_gallery_meta', 'tx_post_details_layout_meta', 'tx_product_meta' ];

        foreach ( $meta_list as $meta ) {
            if ( in_array( $meta['key'], $skip, true ) ) {
                continue;
            }

            // Elementor data — store raw with slashes.
            if ( '_elementor_data' === $meta['key'] && is_string( $meta['value'] ) ) {
                update_post_meta( $post_id, $meta['key'], wp_slash( $meta['value'] ) );
                continue;
            }

            // Codestar serialized data and other serialized meta.
            $value = maybe_unserialize( $meta['value'] );

            // WordPress will re-serialize arrays/objects when storing.
            update_post_meta( $post_id, $meta['key'], $value );

            // Log CSF metabox imports for debugging.
            if ( in_array( $meta['key'], $csf_meta_keys, true ) ) {
                $field_count = is_array( $value ) ? count( $value ) : 1;
                Indsro_Demo_Progress::add_log( "CSF metabox '{$meta['key']}' imported for post #{$post_id} ({$field_count} fields)." );
            }
        }
    }

    /**
     * Assign taxonomy terms to a post.
     */
    private function assign_post_terms( int $post_id, array $terms ): void {
        $grouped = [];

        foreach ( $terms as $term ) {
            $taxonomy = $term['taxonomy'] ?? 'category';
            if ( ! taxonomy_exists( $taxonomy ) ) {
                continue;
            }

            $existing = get_term_by( 'slug', $term['slug'], $taxonomy );
            if ( $existing && ! is_wp_error( $existing ) ) {
                $grouped[ $taxonomy ][] = $existing->term_id;
            } else {
                $new = wp_insert_term( $term['name'], $taxonomy, [ 'slug' => $term['slug'] ] );
                if ( ! is_wp_error( $new ) ) {
                    $grouped[ $taxonomy ][] = $new['term_id'];
                }
            }
        }

        foreach ( $grouped as $taxonomy => $term_ids ) {
            wp_set_object_terms( $post_id, $term_ids, $taxonomy );
        }
    }

    /**
     * Resolve orphan parent relationships.
     */
    private function resolve_orphans(): void {
        foreach ( $this->orphans as $post ) {
            $new_parent = $this->post_map[ $post['post_parent'] ] ?? 0;
            $new_id     = $this->post_map[ $post['post_id'] ] ?? null;

            if ( $new_parent && $new_id ) {
                wp_update_post( [
                    'ID'          => $new_id,
                    'post_parent' => $new_parent,
                ] );
            }
        }
        $this->orphans = [];
    }

    /**
     * Remap _thumbnail_id values from old to new attachment IDs.
     */
    public function remap_featured_images(): void {
        global $wpdb;

        foreach ( $this->post_map as $old_id => $new_id ) {
            // Only process attachments.
            if ( 'attachment' !== get_post_type( $new_id ) ) {
                continue;
            }

            $wpdb->query( $wpdb->prepare(
                "UPDATE {$wpdb->postmeta} SET meta_value = %s WHERE meta_key = '_thumbnail_id' AND meta_value = %s",
                (string) $new_id,
                (string) $old_id
            ) );

            // Also remap _product_image_gallery entries.
            $gallery_rows = $wpdb->get_results( $wpdb->prepare(
                "SELECT meta_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key = '_product_image_gallery' AND meta_value LIKE %s",
                '%' . $wpdb->esc_like( (string) $old_id ) . '%'
            ) );

            foreach ( $gallery_rows as $row ) {
                $ids     = explode( ',', $row->meta_value );
                $new_ids = array_map( function ( $id ) use ( $old_id, $new_id ) {
                    return (int) $id === (int) $old_id ? (string) $new_id : $id;
                }, $ids );

                $wpdb->update(
                    $wpdb->postmeta,
                    [ 'meta_value' => implode( ',', $new_ids ) ],
                    [ 'meta_id' => $row->meta_id ],
                    [ '%s' ],
                    [ '%d' ]
                );
            }
        }

        Indsro_Demo_Progress::add_log( 'Remapped featured images and product galleries.' );
    }

    /**
     * Remap menu item references from old to new post IDs.
     *
     * Menu items store:
     * - _menu_item_object_id → the post/page/term ID being linked to
     * - _menu_item_menu_item_parent → parent menu item's old post ID
     */
    public function remap_menu_items(): void {
        global $wpdb;

        $remapped = 0;

        foreach ( $this->post_map as $old_id => $new_id ) {
            // Remap _menu_item_object_id (the page/post the menu points to).
            $affected = $wpdb->query( $wpdb->prepare(
                "UPDATE {$wpdb->postmeta} SET meta_value = %s WHERE meta_key = '_menu_item_object_id' AND meta_value = %s",
                (string) $new_id,
                (string) $old_id
            ) );
            $remapped += (int) $affected;

            // Remap _menu_item_menu_item_parent (parent menu item ID).
            $wpdb->query( $wpdb->prepare(
                "UPDATE {$wpdb->postmeta} SET meta_value = %s WHERE meta_key = '_menu_item_menu_item_parent' AND meta_value = %s",
                (string) $new_id,
                (string) $old_id
            ) );
        }

        Indsro_Demo_Progress::add_log( "Remapped {$remapped} menu item references." );
    }

    /**
     * Remap any postmeta values that store old post IDs.
     * Catches _thumbnail_id-style references in Codestar and other meta.
     */
    public function remap_all_meta_ids(): void {
        global $wpdb;

        // For Codestar and other frameworks, remap old URLs in all postmeta.
        $old_url = get_transient( 'indsro_import_base_url' ) ?: '';
        $new_url = get_site_url();

        if ( ! empty( $old_url ) && $old_url !== $new_url ) {
            // IMPORTANT: Cannot use raw SQL REPLACE on serialized data because it
            // changes string lengths without updating PHP serialization length markers
            // (e.g., s:76:"..." becomes s:76:"shorter_url" which corrupts the data).
            // Instead, we unserialize → replace → re-serialize for each affected row.

            $meta_rows = $wpdb->get_results( $wpdb->prepare(
                "SELECT meta_id, meta_value FROM {$wpdb->postmeta} WHERE meta_value LIKE %s AND meta_key != '_elementor_data'",
                '%' . $wpdb->esc_like( $old_url ) . '%'
            ) );

            $meta_remapped = 0;
            foreach ( $meta_rows as $row ) {
                $unserialized = maybe_unserialize( $row->meta_value );

                if ( is_array( $unserialized ) || is_object( $unserialized ) ) {
                    // Serialized data: recursively replace URLs in the deserialized structure,
                    // then re-serialize (which auto-calculates correct string lengths).
                    $updated = $this->remap_urls_recursive_data( $unserialized, $old_url, $new_url );
                    update_metadata_by_mid( 'post', $row->meta_id, $updated );
                } else {
                    // Non-serialized (plain string): safe to do a direct string replace.
                    $updated = str_replace( $old_url, $new_url, $row->meta_value );
                    $wpdb->update(
                        $wpdb->postmeta,
                        [ 'meta_value' => $updated ],
                        [ 'meta_id' => $row->meta_id ],
                        [ '%s' ],
                        [ '%d' ]
                    );
                }
                $meta_remapped++;
            }

            // Also remap URLs in options (serialization-safe).
            $option_rows = $wpdb->get_results( $wpdb->prepare(
                "SELECT option_id, option_value FROM {$wpdb->options} WHERE option_value LIKE %s",
                '%' . $wpdb->esc_like( $old_url ) . '%'
            ) );

            $options_remapped = 0;
            foreach ( $option_rows as $row ) {
                $unserialized = maybe_unserialize( $row->option_value );

                if ( is_array( $unserialized ) || is_object( $unserialized ) ) {
                    $updated = $this->remap_urls_recursive_data( $unserialized, $old_url, $new_url );
                    $wpdb->update(
                        $wpdb->options,
                        [ 'option_value' => maybe_serialize( $updated ) ],
                        [ 'option_id' => $row->option_id ],
                        [ '%s' ],
                        [ '%d' ]
                    );
                } else {
                    $updated = str_replace( $old_url, $new_url, $row->option_value );
                    $wpdb->update(
                        $wpdb->options,
                        [ 'option_value' => $updated ],
                        [ 'option_id' => $row->option_id ],
                        [ '%s' ],
                        [ '%d' ]
                    );
                }
                $options_remapped++;
            }

            Indsro_Demo_Progress::add_log( "Remapped URLs in {$meta_remapped} meta rows and {$options_remapped} option rows (serialization-safe)." );
        }

        // Remap post IDs in serialized Codestar per-page meta (tx_page_meta).
        $this->remap_codestar_meta_post_ids();

        // Remap template_id references in Elementor data.
        $this->remap_elementor_template_ids();
    }

    /**
     * Recursively replace old URLs with new URLs in deserialized data.
     *
     * Unlike raw SQL REPLACE, this preserves PHP serialization integrity
     * because WordPress re-serializes the data with correct string lengths.
     *
     * @param mixed  $data    The deserialized data (array, object, or string).
     * @param string $old_url The old URL to replace.
     * @param string $new_url The new URL to replace with.
     * @return mixed The data with URLs replaced.
     */
    private function remap_urls_recursive_data( $data, string $old_url, string $new_url ) {
        if ( is_string( $data ) ) {
            return str_replace( $old_url, $new_url, $data );
        }

        if ( is_array( $data ) ) {
            foreach ( $data as $key => $value ) {
                $data[ $key ] = $this->remap_urls_recursive_data( $value, $old_url, $new_url );
            }
        }

        if ( is_object( $data ) ) {
            foreach ( get_object_vars( $data ) as $key => $value ) {
                $data->$key = $this->remap_urls_recursive_data( $value, $old_url, $new_url );
            }
        }

        return $data;
    }

    /**
     * Remap post IDs inside serialized Codestar per-page metabox data.
     *
     * Handles:
     * - Select fields storing post IDs (meta_header_style, meta_footer_style, etc.)
     * - Media fields storing {id, url, thumbnail} arrays (bg_img_from_page, etc.)
     */
    private function remap_codestar_meta_post_ids(): void {
        global $wpdb;

        $codestar_meta_keys = [ 'tx_page_meta' ];
        // Simple select fields that store a post ID directly
        $id_fields = [ 'meta_header_style', 'meta_footer_style', 'meta_header_id', 'meta_footer_id' ];
        // Media fields that store {id, url, thumbnail, ...} arrays
        $media_fields = [ 'bg_img_from_page', 'post_gallery_images' ];

        foreach ( $codestar_meta_keys as $meta_key ) {
            $rows = $wpdb->get_results( $wpdb->prepare(
                "SELECT meta_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key = %s",
                $meta_key
            ) );

            $remapped_count = 0;

            foreach ( $rows as $row ) {
                $data = maybe_unserialize( $row->meta_value );

                if ( ! is_array( $data ) ) {
                    continue;
                }

                $changed = false;

                // Remap simple ID fields (select dropdowns)
                foreach ( $id_fields as $field ) {
                    if ( ! empty( $data[ $field ] ) && isset( $this->post_map[ (int) $data[ $field ] ] ) ) {
                        $data[ $field ] = (string) $this->post_map[ (int) $data[ $field ] ];
                        $changed = true;
                    }
                }

                // Remap Codestar media fields: {id, url, thumbnail, ...}
                foreach ( $media_fields as $field ) {
                    if ( ! empty( $data[ $field ] ) && is_array( $data[ $field ] ) && isset( $data[ $field ]['id'] ) ) {
                        $old_media_id = (int) $data[ $field ]['id'];
                        if ( $old_media_id > 0 && isset( $this->post_map[ $old_media_id ] ) ) {
                            $new_media_id = $this->post_map[ $old_media_id ];
                            $data[ $field ]['id'] = $new_media_id;

                            $new_url = wp_get_attachment_url( $new_media_id );
                            if ( $new_url ) {
                                $data[ $field ]['url'] = $new_url;
                                // Update thumbnail too if it exists
                                if ( isset( $data[ $field ]['thumbnail'] ) ) {
                                    $data[ $field ]['thumbnail'] = $new_url;
                                }
                            }
                            $changed = true;
                        }
                    }
                }

                // Also scan all keys for any Codestar media-style arrays we might have missed
                foreach ( $data as $key => &$value ) {
                    if ( in_array( $key, $id_fields, true ) || in_array( $key, $media_fields, true ) ) {
                        continue; // Already handled above
                    }
                    // Detect media arrays: {id: int, url: string}
                    if ( is_array( $value ) && isset( $value['id'] ) && isset( $value['url'] ) && is_numeric( $value['id'] ) ) {
                        $old_mid = (int) $value['id'];
                        if ( $old_mid > 0 && isset( $this->post_map[ $old_mid ] ) ) {
                            $new_mid = $this->post_map[ $old_mid ];
                            $value['id'] = $new_mid;
                            $new_url = wp_get_attachment_url( $new_mid );
                            if ( $new_url ) {
                                $value['url'] = $new_url;
                                if ( isset( $value['thumbnail'] ) ) {
                                    $value['thumbnail'] = $new_url;
                                }
                            }
                            $changed = true;
                        }
                    }
                }
                unset( $value );

                if ( $changed ) {
                    update_metadata_by_mid( 'post', $row->meta_id, $data );
                    $remapped_count++;
                }
            }

            if ( $remapped_count > 0 ) {
                Indsro_Demo_Progress::add_log( "Remapped {$remapped_count} Codestar metabox entries (IDs + media)." );
            }
        }
    }

    /**
     * Remap template_id values inside Elementor _elementor_data JSON.
     *
     * Elementor widgets can reference other templates by post ID (e.g., section templates).
     */
    private function remap_elementor_template_ids(): void {
        global $wpdb;

        if ( empty( $this->post_map ) ) {
            return;
        }

        // Get all _elementor_data meta entries.
        $rows = $wpdb->get_results(
            "SELECT meta_id, post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key = '_elementor_data' AND meta_value LIKE '[%'"
        );

        $remapped = 0;

        foreach ( $rows as $row ) {
            $data = json_decode( $row->meta_value, true );

            if ( ! is_array( $data ) ) {
                continue;
            }

            $changed = false;
            $data = $this->remap_elementor_ids_recursive( $data, $changed );

            if ( $changed ) {
                $new_json = wp_json_encode( $data );
                // Use $wpdb->update directly — it handles SQL escaping via prepared statements.
                // Do NOT use wp_slash() here — that would double-escape the JSON and corrupt it.
                $wpdb->update(
                    $wpdb->postmeta,
                    [ 'meta_value' => $new_json ],
                    [ 'meta_id' => $row->meta_id ],
                    [ '%s' ],
                    [ '%d' ]
                );
                $remapped++;
            }
        }

        if ( $remapped > 0 ) {
            Indsro_Demo_Progress::add_log( "Remapped template IDs in {$remapped} Elementor data entries." );
        }
    }

    /**
     * Recursively walk Elementor data and remap template_id values.
     */
    private function remap_elementor_ids_recursive( array $elements, bool &$changed ): array {
        foreach ( $elements as &$element ) {
            // Remap template_id in settings (used by Elementor Template widget).
            if ( isset( $element['settings']['template_id'] ) ) {
                $old_tid = (int) $element['settings']['template_id'];
                if ( $old_tid > 0 && isset( $this->post_map[ $old_tid ] ) ) {
                    $element['settings']['template_id'] = (string) $this->post_map[ $old_tid ];
                    $changed = true;
                }
            }

            // Remap 'template' key in settings (used by custom widgets like TX Tabs).
            if ( isset( $element['settings']['template'] ) ) {
                $old_tid = (int) $element['settings']['template'];
                if ( $old_tid > 0 && isset( $this->post_map[ $old_tid ] ) ) {
                    $element['settings']['template'] = (string) $this->post_map[ $old_tid ];
                    $changed = true;
                }
            }

            // Also check for template_id at element root level (global widgets).
            if ( isset( $element['templateID'] ) ) {
                $old_tid = (int) $element['templateID'];
                if ( $old_tid > 0 && isset( $this->post_map[ $old_tid ] ) ) {
                    $element['templateID'] = (string) $this->post_map[ $old_tid ];
                    $changed = true;
                }
            }

            // Remap any repeater items that contain 'template' or 'post_id' fields.
            if ( isset( $element['settings'] ) && is_array( $element['settings'] ) ) {
                foreach ( $element['settings'] as $key => &$setting ) {

                    // Detect Elementor Media Controls (which are associative arrays with 'id' and 'url')
                    // e.g., 'mask_image' => ['id' => 55, 'url' => 'http...']
                    if ( is_array( $setting ) && isset( $setting['id'] ) && isset( $setting['url'] ) ) {
                        $old_pid = (int) $setting['id'];
                        if ( $old_pid > 0 && isset( $this->post_map[ $old_pid ] ) ) {
                            $new_pid = $this->post_map[ $old_pid ];
                            $setting['id'] = $new_pid;

                            $new_url = wp_get_attachment_url( $new_pid );
                            if ( $new_url ) {
                                $setting['url'] = $new_url;
                            }
                            $changed = true;
                        }
                    }

                    // Detect Elementor Icon Controls with uploaded SVG files.
                    // Structure: {"value": {"url": "...", "id": XXXX}, "library": "svg"}
                    if ( is_array( $setting ) && isset( $setting['library'] ) && 'svg' === $setting['library'] ) {
                        if ( isset( $setting['value']['id'] ) ) {
                            $old_pid = (int) $setting['value']['id'];
                            if ( $old_pid > 0 && isset( $this->post_map[ $old_pid ] ) ) {
                                $new_pid = $this->post_map[ $old_pid ];
                                $setting['value']['id'] = $new_pid;

                                $new_url = wp_get_attachment_url( $new_pid );
                                if ( $new_url ) {
                                    $setting['value']['url'] = $new_url;
                                }
                                $changed = true;
                            }
                        }
                    }

                    if ( is_array( $setting ) ) {
                        foreach ( $setting as &$repeater_item ) {
                            if ( is_array( $repeater_item ) ) {
                                // Section Templates.
                                if ( isset( $repeater_item['template'] ) ) {
                                    $old_tid = (int) $repeater_item['template'];
                                    if ( $old_tid > 0 && isset( $this->post_map[ $old_tid ] ) ) {
                                        $repeater_item['template'] = (string) $this->post_map[ $old_tid ];
                                        $changed = true;
                                    }
                                }
                                // Selected Posts/Pages.
                                if ( isset( $repeater_item['post_id'] ) ) {
                                    $old_pid = (int) $repeater_item['post_id'];
                                    if ( $old_pid > 0 && isset( $this->post_map[ $old_pid ] ) ) {
                                        $repeater_item['post_id'] = (string) $this->post_map[ $old_pid ];
                                        $changed = true;
                                    }
                                }

                                // Also check for Media Controls inside Repeater Items
                                foreach ( $repeater_item as $rep_key => &$rep_val ) {
                                    if ( is_array( $rep_val ) && isset( $rep_val['id'] ) && isset( $rep_val['url'] ) ) {
                                        $old_media_id = (int) $rep_val['id'];
                                        if ( $old_media_id > 0 && isset( $this->post_map[ $old_media_id ] ) ) {
                                            $new_media_id = $this->post_map[ $old_media_id ];
                                            $rep_val['id'] = $new_media_id;
                                            $new_url = wp_get_attachment_url( $new_media_id );
                                            if ( $new_url ) {
                                                $rep_val['url'] = $new_url;
                                            }
                                            $changed = true;
                                        }
                                    }

                                    // SVG Icon Controls inside Repeater Items.
                                    // {"value": {"url": "...", "id": XXXX}, "library": "svg"}
                                    if ( is_array( $rep_val ) && isset( $rep_val['library'] ) && 'svg' === $rep_val['library'] ) {
                                        if ( isset( $rep_val['value']['id'] ) ) {
                                            $old_media_id = (int) $rep_val['value']['id'];
                                            if ( $old_media_id > 0 && isset( $this->post_map[ $old_media_id ] ) ) {
                                                $new_media_id = $this->post_map[ $old_media_id ];
                                                $rep_val['value']['id'] = $new_media_id;
                                                $new_url = wp_get_attachment_url( $new_media_id );
                                                if ( $new_url ) {
                                                    $rep_val['value']['url'] = $new_url;
                                                }
                                                $changed = true;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            // Recurse into child elements.
            if ( ! empty( $element['elements'] ) && is_array( $element['elements'] ) ) {
                $element['elements'] = $this->remap_elementor_ids_recursive( $element['elements'], $changed );
            }
        }

        return $elements;
    }

    /**
     * Remap Elementor URLs from old base URL to new site URL.
     *
     * @param string $old_url
     */
    public function remap_elementor_urls( string $old_url ): void {
        if ( empty( $old_url ) ) {
            return;
        }

        global $wpdb;
        $new_url      = get_site_url();
        $escaped_from = str_replace( '/', '\\/', $old_url );
        $escaped_to   = str_replace( '/', '\\/', $new_url );

        $wpdb->query( $wpdb->prepare(
            "UPDATE {$wpdb->postmeta}
             SET meta_value = REPLACE(meta_value, %s, %s)
             WHERE meta_key = '_elementor_data' AND meta_value LIKE %s",
            $escaped_from,
            $escaped_to,
            '[%'
        ) );

        // Also replace plain URLs in elementor data.
        $wpdb->query( $wpdb->prepare(
            "UPDATE {$wpdb->postmeta}
             SET meta_value = REPLACE(meta_value, %s, %s)
             WHERE meta_key = '_elementor_data' AND meta_value LIKE %s",
            $old_url,
            $new_url,
            '[%'
        ) );

        // Clear Elementor cache and force CSS regeneration.
        if ( class_exists( '\\Elementor\\Plugin' ) ) {
            \Elementor\Plugin::$instance->files_manager->clear_cache();
        }

        // Delete all generated Elementor CSS meta to force regeneration on next load.
        $wpdb->query( "DELETE FROM {$wpdb->postmeta} WHERE meta_key = '_elementor_css'" );

        // Also clear the Elementor global CSS.
        delete_option( '_elementor_global_css' );
        delete_option( 'elementor_css_print_method' );

        Indsro_Demo_Progress::add_log( 'Remapped Elementor URLs and cleared CSS cache.' );
    }

    /**
     * Get the post ID mapping.
     */
    public function get_post_map(): array {
        return $this->post_map;
    }

    /**
     * Set post map (for restoring between AJAX calls).
     */
    public function set_post_map( array $map ): void {
        $this->post_map = $map;
    }
}
