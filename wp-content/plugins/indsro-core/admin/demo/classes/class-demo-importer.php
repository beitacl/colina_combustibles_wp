<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Indsro Demo Importer — Step-Based Orchestrator.
 *
 * Manages the full demo import flow through discrete steps.
 * Each step is designed to be called via AJAX.
 */
class Indsro_Demo_Importer {

    /** @var string Path to the demo directory. */
    private $demo_path;

    /** @var array|null Cached parsed WXR data. */
    private static $parsed_data = null;

    public function __construct() {
        $this->demo_path = trailingslashit( INDSRO_DEMO_DIR ) . 'data/';
    }

    /**
     * Get demo configurations for the UI.
     */
    public function get_demos(): array {
        return [
            'ta_home_1' => [
                'title'       => __( 'Home 01', 'indsro-core' ),
                'page'        => 'Home',
                'screenshot'  => INDSRO_DEMO_URL . 'data/preview/home-1.webp',
                'preview_url' => 'https://themexriver.com/wp/' . strtolower( function_exists( 'tf_theme_name' ) ? tf_theme_name() : 'indsro' ) . '/',
            ],
            'ta_home_2' => [
                'title'       => __( 'Home 02', 'indsro-core' ),
                'page'        => 'Home 02',
                'screenshot'  => INDSRO_DEMO_URL . 'data/preview/home-2.webp',
                'preview_url' => 'https://themexriver.com/wp/' . strtolower( function_exists( 'tf_theme_name' ) ? tf_theme_name() : 'indsro' ) . '/home-02',
            ],
            'ta_home_3' => [
                'title'       => __( 'Home 03', 'indsro-core' ),
                'page'        => 'Home 03',
                'screenshot'  => INDSRO_DEMO_URL . 'data/preview/home-3.webp',
                'preview_url' => 'https://themexriver.com/wp/' . strtolower( function_exists( 'tf_theme_name' ) ? tf_theme_name() : 'indsro' ) . '/home-03',
            ],
            'ta_home_4' => [
                'title'       => __( 'Home 04', 'indsro-core' ),
                'page'        => 'Home 04',
                'screenshot'  => INDSRO_DEMO_URL . 'data/preview/home-4.webp',
                'preview_url' => 'https://themexriver.com/wp/' . strtolower( function_exists( 'tf_theme_name' ) ? tf_theme_name() : 'indsro' ) . '/home-04',
            ],
            'ta_home_5' => [
                'title'       => __( 'Home 05', 'indsro-core' ),
                'page'        => 'Home 05',
                'screenshot'  => INDSRO_DEMO_URL . 'data/preview/home-5.webp',
                'preview_url' => 'https://themexriver.com/wp/' . strtolower( function_exists( 'tf_theme_name' ) ? tf_theme_name() : 'indsro' ) . '/home-05',
            ],
        ];
    }

    // ─── Step Methods ────────────────────────────────────────────────

    /**
     * Step 1: Validate that all required files and extensions exist.
     */
    public function step_validate(): array {
        Indsro_Demo_Progress::set_step( 'validate', 'Validating environment...', 2 );

        $errors = [];

        // 1. Ensure Elementor is active.
        if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
            $errors[] = 'Elementor plugin is required but not active.';
        }

        // 2. Ensure XML file exists.
        if ( ! file_exists( $this->demo_path . 'content.xml' ) ) {
            $errors[] = 'content.xml not found.';
        }

        // 3. Ensure widgets file exists.
        if ( ! file_exists( $this->demo_path . 'widgets.wie' ) ) {
            $errors[] = 'widgets.wie not found.';
        }

        // 4. Ensure customizer file exists.
        if ( ! file_exists( $this->demo_path . 'customizer.dat' ) ) {
            $errors[] = 'customizer.dat not found.';
        }

        if ( ! class_exists( 'XMLReader' ) ) {
            $errors[] = 'PHP XMLReader extension is required.';
        }

        if ( ! empty( $errors ) ) {
            Indsro_Demo_Progress::set_error( implode( ' ', $errors ) );
            return [ 'done' => true, 'success' => false, 'message' => implode( ' ', $errors ) ];
        }

        Indsro_Demo_Progress::add_log( 'Environment validated. All required plugins and files present.' );

        return [ 'done' => true, 'success' => true ];
    }

    /**
     * Step 2: Extract uploads.zip into wp-content/uploads/.
     */
    public function step_extract_uploads(): array {
        Indsro_Demo_Progress::set_step( 'extract', 'Extracting media files...', 8 );

        $result = Indsro_Demo_Zip_Handler::extract_uploads();

        if ( is_wp_error( $result ) ) {
            Indsro_Demo_Progress::set_error( $result->get_error_message() );
            return [ 'done' => true, 'success' => false, 'message' => $result->get_error_message() ];
        }

        return [ 'done' => true, 'success' => true ];
    }

    /**
     * Step 2: Import XML (All Content in One Process).
     *
     * Imports the full XML file in a single execution.
     * Includes all posts, terms, Elementor templates, and media remapping sequentially.
     */
    public function step_import_xml(): array {
        Indsro_Demo_Progress::set_step( 'import_xml', 'Importing Full XML Content...', 20 );

        // Extract uploads first to ensure media files are available locally.
        $zip_result = Indsro_Demo_Zip_Handler::extract_uploads();
        if ( is_wp_error( $zip_result ) ) {
            throw new \Exception( 'Uploads Extraction Failed: ' . $zip_result->get_error_message() );
        }

        $this->enable_performance_mode();
        $data = $this->get_parsed_data();

        $importer = new Indsro_Demo_Content_Importer();

        // 1. Import terms (categories, tags, then others).
        if ( ! empty( $data['categories'] ) ) {
            $importer->import_terms( $data['categories'] );
        }
        if ( ! empty( $data['tags'] ) ) {
            $importer->import_terms( $data['tags'] );
        }
        $importer->import_terms( $data['terms'] );

        set_transient( 'indsro_import_term_map', $importer->get_post_map(), HOUR_IN_SECONDS );
        $old_url = $data['base_url'] ?? '';
        if ( ! empty( $old_url ) ) {
            set_transient( 'indsro_import_base_url', $old_url, HOUR_IN_SECONDS );
        }

        // 2. Import ALL POSTS in a single execution.
        // We merge them all so no type separations break mappings.
        $all_posts = array_merge( $data['posts'], $data['menu_items'] );

        Indsro_Demo_Progress::add_log( 'Starting unified bulk content import for ' . count($all_posts) . ' items...' );
        // High limit to ensure everything imports in one go (no batch offset pauses).
        $importer->import_batch( $all_posts, 0, 999999 );

        set_transient( 'indsro_import_post_map', $importer->get_post_map(), HOUR_IN_SECONDS );

        // 3. Immediately Remap Media & Elementor URLs.
        Indsro_Demo_Progress::add_log( 'Remapping media and Elementor URLs...' );
        $importer->remap_featured_images();
        $importer->remap_menu_items();
        $importer->remap_elementor_urls( $old_url );
        $importer->remap_all_meta_ids();

        $this->disable_performance_mode();

        Indsro_Demo_Progress::add_log( 'XML Import and Remapping completed successfully.' );
        Indsro_Demo_Progress::update( [ 'percent' => 50, 'offset' => count($all_posts), 'total' => count($all_posts) ] );

        return [ 'done' => true, 'success' => true ];
    }

    /**
     * Step 3: Verify Elementor Templates.
     *
     * Halts execution if templates did not generate successfully.
     */
    public function step_verify_elementor(): array {
        Indsro_Demo_Progress::set_step( 'verify_elementor', 'Verifying Elementor Templates...', 55 );

        // Check if elementor_library posts were imported and published.
        $templates = get_posts( [ 'post_type' => 'elementor_library', 'post_status' => 'publish', 'posts_per_page' => 1 ] );
        if ( empty( $templates ) ) {
            throw new \Exception( 'Verification Failed: No Elementor templates (elementor_library) found.' );
        }

        // Check if _elementor_data meta exists in DB.
        global $wpdb;
        $has_data = $wpdb->get_var( "SELECT meta_id FROM {$wpdb->postmeta} WHERE meta_key = '_elementor_data' LIMIT 1" );
        if ( ! $has_data ) {
            throw new \Exception( 'Verification Failed: No Elementor JSON data (_elementor_data) found.' );
        }

        Indsro_Demo_Progress::add_log( 'Elementor templates successfully verified.' );
        return [ 'done' => true, 'success' => true ];
    }

    /**
     * Step 5: Import widgets.
     */
    public function step_import_widgets(): array {
        Indsro_Demo_Progress::set_step( 'widgets', 'Importing widgets...', 72 );

        $file = $this->demo_path . 'widgets.wie';
        if ( ! file_exists( $file ) ) {
            Indsro_Demo_Progress::add_log( 'No widgets file found. Skipping.' );
            return [ 'done' => true, 'success' => true ];
        }

        // Reset existing widgets first.
        $sidebars = get_option( 'sidebars_widgets', [] );
        unset( $sidebars['array_version'] );
        foreach ( $sidebars as $sidebar => $widgets ) {
            $sidebars[ $sidebar ] = [];
        }
        update_option( 'sidebars_widgets', $sidebars );

        $contents = file_get_contents( $file );
        $data     = json_decode( $contents, true );

        if ( ! $data || ! is_array( $data ) ) {
            Indsro_Demo_Progress::add_log( 'Invalid widget data. Skipping.' );
            return [ 'done' => true, 'success' => true ];
        }

        $sidebars  = get_option( 'sidebars_widgets', [] );
        $count     = 0;

        foreach ( $data as $sidebar_id => $widgets ) {
            if ( ! is_array( $widgets ) ) {
                continue;
            }

            $sidebars[ $sidebar_id ] = [];

            foreach ( $widgets as $widget_id => $widget_data ) {
                // Parse widget type and instance number from ID.
                $parts         = explode( '-', $widget_id );
                $instance_num  = (int) array_pop( $parts );
                $widget_type   = implode( '-', $parts );

                // Get existing instances of this widget type.
                $instances = get_option( 'widget_' . $widget_type, [] );
                $instances[ $instance_num ] = $widget_data;
                update_option( 'widget_' . $widget_type, $instances );

                $sidebars[ $sidebar_id ][] = $widget_id;
                $count++;
            }
        }

        update_option( 'sidebars_widgets', $sidebars );

        Indsro_Demo_Progress::add_log( "Imported {$count} widgets." );

        return [ 'done' => true, 'success' => true ];
    }

    /**
     * Step 5: Import Customizer Settings (.dat) & Theme Options.
     */
    public function step_import_customizer_and_options(): array {
        Indsro_Demo_Progress::set_step( 'customizer', 'Importing customizer and theme options...', 80 );

        $this->import_customizer();
        $this->import_theme_options();

        return [ 'done' => true, 'success' => true ];
    }

    private function import_customizer(): void {
        $file = $this->demo_path . 'customizer.dat';
        if ( ! file_exists( $file ) ) {
            Indsro_Demo_Progress::add_log( 'No customizer file found. Skipping.' );
            return;
        }

        $raw  = file_get_contents( $file );
        $data = maybe_unserialize( $raw );

        if ( ! is_array( $data ) ) {
            $data = maybe_unserialize( base64_decode( $raw ) );
        }

        if ( ! is_array( $data ) ) {
            Indsro_Demo_Progress::add_log( 'Invalid customizer data. Skipping.' );
            return;
        }

        // Import theme mods.
        if ( ! empty( $data['mods'] ) && is_array( $data['mods'] ) ) {
            foreach ( $data['mods'] as $key => $value ) {
                set_theme_mod( $key, $value );
            }
            Indsro_Demo_Progress::add_log( 'Imported ' . count( $data['mods'] ) . ' customizer mods.' );
        }

        // Import options.
        if ( ! empty( $data['options'] ) && is_array( $data['options'] ) ) {
            foreach ( $data['options'] as $key => $value ) {
                update_option( $key, $value );
            }
            Indsro_Demo_Progress::add_log( 'Imported ' . count( $data['options'] ) . ' customizer options.' );
        }
    }

    private function import_theme_options(): void {
        Indsro_Demo_Progress::set_step( 'theme_options', 'Importing theme options...', 88 );

        $file = $this->demo_path . 'codestar.json';
        if ( ! file_exists( $file ) ) {
            Indsro_Demo_Progress::add_log( 'No theme options file found. Skipping.' );
            return;
        }

        $contents = file_get_contents( $file );
        $data     = json_decode( $contents, true );

        if ( ! $data || ! is_array( $data ) ) {
            Indsro_Demo_Progress::add_log( 'Invalid theme options JSON. Skipping.' );
            return;
        }

        // Determine the option key.
        $option_key = 'indsro_theme_options';

        // If the JSON has option_name wrapper, use it.
        if ( isset( $data['option_name'] ) && isset( $data['option_value'] ) ) {
            $option_key = $data['option_name'];
            $data       = $data['option_value'];
        }

        // Remap post IDs in theme options (header_style, footer_style, etc.).
        $post_map = get_transient( 'indsro_import_post_map' ) ?: [];
        $id_keys  = [ 'header_style', 'footer_style', 'header_id', 'footer_id', 'featured_post' ];

        foreach ( $id_keys as $id_key ) {
            if ( ! empty( $data[ $id_key ] ) && isset( $post_map[ (int) $data[ $id_key ] ] ) ) {
                $old_val = $data[ $id_key ];
                $data[ $id_key ] = (string) $post_map[ (int) $data[ $id_key ] ];
                Indsro_Demo_Progress::add_log( "Remapped {$id_key}: {$old_val} → {$data[$id_key]}" );
            }
        }

        // Remap old URLs in the options data.
        $old_url = get_transient( 'indsro_import_base_url' ) ?: '';
        $new_url = get_site_url();
        if ( ! empty( $old_url ) && $old_url !== $new_url ) {
            $data = $this->remap_urls_recursive( $data, $old_url, $new_url );
        }

        update_option( $option_key, $data );

        Indsro_Demo_Progress::add_log( "Theme options saved to: {$option_key}" );
    }

    /**
     * Recursively replace old URLs in an array/string.
     */
    private function remap_urls_recursive( $data, string $old_url, string $new_url ) {
        if ( is_string( $data ) ) {
            return str_replace( $old_url, $new_url, $data );
        }

        if ( is_array( $data ) ) {
            foreach ( $data as $key => $value ) {
                $data[ $key ] = $this->remap_urls_recursive( $value, $old_url, $new_url );
            }
        }

        return $data;
    }

    /**
     * Step 6: Assign Menus to Theme Locations.
     */
    public function step_assign_menus(): array {
        Indsro_Demo_Progress::set_step( 'assign_menus', 'Assigning menus to theme locations...', 85 );

        $registered_locations = get_registered_nav_menus();
        $nav_menus           = wp_get_nav_menus();
        $locations           = [];

        if ( ! empty( $nav_menus ) && ! empty( $registered_locations ) ) {
            foreach ( $registered_locations as $location_slug => $location_name ) {
                // Exact slug match.
                foreach ( $nav_menus as $menu ) {
                    if ( $menu->slug === $location_slug ) {
                        $locations[ $location_slug ] = $menu->term_id;
                        Indsro_Demo_Progress::add_log( "Menu \"{$menu->name}\" assigned to \"{$location_slug}\" (slug match)." );
                        break;
                    }
                }

                // Name-to-slug match.
                if ( ! isset( $locations[ $location_slug ] ) ) {
                    foreach ( $nav_menus as $menu ) {
                        $menu_slug = sanitize_title( $menu->name );
                        if ( $menu_slug === $location_slug ) {
                            $locations[ $location_slug ] = $menu->term_id;
                            Indsro_Demo_Progress::add_log( "Menu \"{$menu->name}\" assigned to \"{$location_slug}\" (name match)." );
                            break;
                        }
                    }
                }
            }

            // Fallback: if 'main-menu' location exists but wasn't matched, assign first menu.
            if ( isset( $registered_locations['main-menu'] ) && ! isset( $locations['main-menu'] ) && ! empty( $nav_menus ) ) {
                $first_menu = reset( $nav_menus );
                $locations['main-menu'] = $first_menu->term_id;
                Indsro_Demo_Progress::add_log( "Menu \"{$first_menu->name}\" assigned to \"main-menu\" (fallback)." );
            }

            if ( ! empty( $locations ) ) {
                set_theme_mod( 'nav_menu_locations', $locations );
                Indsro_Demo_Progress::add_log( count( $locations ) . ' menu location(s) assigned.' );
            }
        }

        return [ 'done' => true, 'success' => true ];
    }

    /**
     * Step 7: Set Homepage & Blog Page.
     *
     * @param string $demo_id The selected demo key.
     */
    public function step_set_pages( string $demo_id = 'ta_home_1' ): array {
        Indsro_Demo_Progress::set_step( 'set_pages', 'Setting Homepage & Blog Page...', 90 );

        $demos = $this->get_demos();
        $demo  = $demos[ $demo_id ] ?? $demos['ta_home_1'];

        $front_page = $this->get_page_by_title_safe( $demo['page'] );
        if ( ! $front_page ) {
            $slug = sanitize_title( $demo['page'] );
            $front_page = get_page_by_path( $slug );
        }

        $blog_page = $this->get_page_by_title_safe( 'Blog' );
        if ( ! $blog_page ) {
            $blog_page = get_page_by_path( 'blog' );
        }

        update_option( 'show_on_front', 'page' );

        if ( $front_page ) {
            update_option( 'page_on_front', $front_page->ID );
            Indsro_Demo_Progress::add_log( 'Homepage set to: "' . $front_page->post_title . '"' );
        }

        if ( $blog_page ) {
            update_option( 'page_for_posts', $blog_page->ID );
            Indsro_Demo_Progress::add_log( 'Blog page set to: "' . $blog_page->post_title . '"' );
        }

        // WooCommerce shop page.
        if ( class_exists( 'WooCommerce' ) ) {
            $shop_page = $this->get_page_by_title_safe( 'Shop' );
            if ( ! $shop_page ) {
                $shop_page = get_page_by_path( 'shop' );
            }
            if ( $shop_page ) {
                update_option( 'woocommerce_shop_page_id', $shop_page->ID );
                Indsro_Demo_Progress::add_log( 'WooCommerce shop page set.' );
            }
        }

        return [ 'done' => true, 'success' => true ];
    }

    /**
     * WP 6.2+ safe replacement for get_page_by_title().
     */
    private function get_page_by_title_safe( string $title, string $post_type = 'page' ): ?\WP_Post {
        $query = new \WP_Query( [
            'post_type'              => $post_type,
            'title'                  => $title,
            'post_status'            => 'publish',
            'posts_per_page'         => 1,
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
        ] );

        return $query->have_posts() ? $query->posts[0] : null;
    }

    /**
     * Step 8: Finalize Import.
     * Flush rules, re-enable sizes, clear Elementor cache.
     */
    public function step_finalize(): array {
        Indsro_Demo_Progress::set_step( 'finalize', 'Finalizing import...', 95 );

        // ── FINAL URL REPLACEMENT PASS ──────────────────────────────────
        // The main remap_all_meta_ids() runs during step_import_xml(),
        // but Codestar theme options and customizer data are imported in
        // later steps, so their URLs are never remapped. This final pass
        // catches any remaining old URLs across the entire database.
        $old_url = get_transient( 'indsro_import_base_url' ) ?: '';
        $new_url = get_site_url();

        if ( ! empty( $old_url ) && $old_url !== $new_url ) {
            global $wpdb;

            // 1. Remap URLs in wp_options (serialization-safe)
            $option_rows = $wpdb->get_results( $wpdb->prepare(
                "SELECT option_id, option_name, option_value FROM {$wpdb->options} WHERE option_value LIKE %s",
                '%' . $wpdb->esc_like( $old_url ) . '%'
            ) );

            $options_fixed = 0;
            foreach ( $option_rows as $row ) {
                $unserialized = maybe_unserialize( $row->option_value );

                if ( is_array( $unserialized ) || is_object( $unserialized ) ) {
                    $updated = $this->remap_urls_recursive( $unserialized, $old_url, $new_url );
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
                $options_fixed++;
            }

            // 2. Remap URLs in wp_postmeta (serialization-safe, skip _elementor_data)
            $meta_rows = $wpdb->get_results( $wpdb->prepare(
                "SELECT meta_id, meta_value FROM {$wpdb->postmeta} WHERE meta_value LIKE %s AND meta_key != '_elementor_data'",
                '%' . $wpdb->esc_like( $old_url ) . '%'
            ) );

            $meta_fixed = 0;
            foreach ( $meta_rows as $row ) {
                $unserialized = maybe_unserialize( $row->meta_value );

                if ( is_array( $unserialized ) || is_object( $unserialized ) ) {
                    $updated = $this->remap_urls_recursive( $unserialized, $old_url, $new_url );
                    update_metadata_by_mid( 'post', $row->meta_id, $updated );
                } else {
                    $updated = str_replace( $old_url, $new_url, $row->meta_value );
                    $wpdb->update(
                        $wpdb->postmeta,
                        [ 'meta_value' => $updated ],
                        [ 'meta_id' => $row->meta_id ],
                        [ '%s' ],
                        [ '%d' ]
                    );
                }
                $meta_fixed++;
            }

            if ( $options_fixed > 0 || $meta_fixed > 0 ) {
                Indsro_Demo_Progress::add_log( "Final URL pass: fixed {$options_fixed} option rows and {$meta_fixed} postmeta rows." );
            }
        }

        // Force Elementor to regenerate all CSS on next page load.
        if ( ! isset( $wpdb ) ) {
            global $wpdb;
        }
        $wpdb->query( "DELETE FROM {$wpdb->postmeta} WHERE meta_key = '_elementor_css'" );
        delete_option( '_elementor_global_css' );
        delete_option( 'elementor_css_print_method' );

        if ( class_exists( '\\Elementor\\Plugin' ) ) {
            \Elementor\Plugin::$instance->files_manager->clear_cache();
        }
        Indsro_Demo_Progress::add_log( 'Elementor CSS cache cleared for regeneration.' );

        // Elementor settings.
        update_option( 'elementor_experiment-e_font_icon_svg', 'inactive' );
        update_option( 'elementor_unfiltered_files_upload', '1' );
        Indsro_Demo_Progress::add_log( 'Elementor: Enabled unfiltered file uploads.' );

        // Permalinks.
        update_option( 'permalink_structure', '/%postname%/' );
        flush_rewrite_rules();
        Indsro_Demo_Progress::add_log( 'Permalinks updated to /%postname%/ and rules flushed.' );

        // Remove hello world post.
        if ( get_post( 1 ) ) {
            wp_delete_post( 1, true );
            Indsro_Demo_Progress::add_log( 'Removed default "Hello World" post.' );
        }

        // Cleanup transients.
        delete_transient( 'indsro_import_post_map' );
        delete_transient( 'indsro_import_term_map' );
        delete_transient( 'indsro_import_parsed_data' );
        delete_transient( 'indsro_import_base_url' );

        // Mark as imported.
        update_option( 'indsro_demo_imported', true );

        // Mark done.
        Indsro_Demo_Progress::set_done();

        return [ 'done' => true, 'success' => true ];
    }

    // ─── Helpers ─────────────────────────────────────────────────────

    /**
     * Get parsed WXR data (cached via transient between AJAX calls).
     */
    private function get_parsed_data(): array {
        if ( null !== self::$parsed_data ) {
            return self::$parsed_data;
        }

        // Try transient first.
        $cached = get_transient( 'indsro_import_parsed_data' );
        if ( $cached && is_array( $cached ) ) {
            self::$parsed_data = $cached;
            return $cached;
        }

        $parser = new Indsro_Demo_Wxr_Parser();
        $data   = $parser->parse( $this->demo_path . 'content.xml' );

        // Cache for 1 hour.
        set_transient( 'indsro_import_parsed_data', $data, HOUR_IN_SECONDS );
        self::$parsed_data = $data;

        return $data;
    }

    /**
     * Enable performance optimizations during import.
     */
    private function enable_performance_mode(): void {
        add_filter( 'intermediate_image_sizes_advanced', '__return_empty_array' );
        wp_defer_term_counting( true );
        wp_defer_comment_counting( true );
    }

    /**
     * Disable performance optimizations.
     */
    private function disable_performance_mode(): void {
        remove_filter( 'intermediate_image_sizes_advanced', '__return_empty_array' );
        wp_defer_term_counting( false );
        wp_defer_comment_counting( false );
    }
}