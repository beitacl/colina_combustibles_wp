<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Indsro Demo WXR Parser.
 *
 * Memory-efficient XMLReader-based parser for WordPress WXR export files.
 * Extracts authors, terms, posts (with full postmeta), and menu items.
 */
class Indsro_Demo_Wxr_Parser {

    /** @var string WP XML namespace URI */
    private $wp_ns = 'http://wordpress.org/export/1.2/';

    /**
     * Parse a WXR file and return structured data.
     *
     * @param string $file Absolute path to the XML file.
     * @return array { authors, terms, posts, menu_items, base_url }
     * @throws \RuntimeException If file is unreadable.
     */
    public function parse( string $file ): array {
        if ( ! is_readable( $file ) ) {
            throw new \RuntimeException( "Cannot read WXR file: {$file}" );
        }

        $reader = new \XMLReader();
        $reader->open( $file );

        libxml_use_internal_errors( true );

        $data = [
            'authors'    => [],
            'categories' => [],
            'tags'       => [],
            'terms'      => [],
            'posts'      => [],
            'menu_items' => [],
            'base_url'   => '',
        ];

        while ( $reader->read() ) {
            if ( \XMLReader::ELEMENT !== $reader->nodeType ) {
                continue;
            }

            $tag = $reader->localName;

            switch ( $tag ) {
                case 'base_site_url':
                case 'base_blog_url':
                    if ( empty( $data['base_url'] ) ) {
                        $data['base_url'] = $reader->readString();
                    }
                    break;

                case 'author':
                    $author = $this->parse_author( $reader );
                    if ( $author ) {
                        $data['authors'][] = $author;
                    }
                    break;

                // wp:category — standard WP categories.
                case 'category':
                    // Only parse wp:category (namespaced), not RSS <category> inside items.
                    if ( $reader->namespaceURI === $this->wp_ns ) {
                        $cat = $this->parse_category( $reader );
                        if ( $cat ) {
                            $data['categories'][] = $cat;
                        }
                    }
                    break;

                // wp:tag — standard WP tags.
                case 'tag':
                    $parsed_tag = $this->parse_tag( $reader );
                    if ( $parsed_tag ) {
                        $data['tags'][] = $parsed_tag;
                    }
                    break;

                // wp:term — all other taxonomies (WooCommerce, Elementor, nav_menu, etc.)
                case 'term':
                    $term = $this->parse_term( $reader );
                    if ( $term ) {
                        $data['terms'][] = $term;
                    }
                    break;

                case 'item':
                    $item = $this->parse_item( $reader );
                    if ( $item ) {
                        if ( 'nav_menu_item' === $item['post_type'] ) {
                            $data['menu_items'][] = $item;
                        } else {
                            $data['posts'][] = $item;
                        }
                    }
                    break;
            }
        }

        $reader->close();
        libxml_clear_errors();

        return $data;
    }

    /**
     * Parse a wp:author element.
     */
    private function parse_author( \XMLReader $reader ): ?array {
        $author = [
            'author_id'           => 0,
            'author_login'        => '',
            'author_email'        => '',
            'author_display_name' => '',
            'author_first_name'   => '',
            'author_last_name'    => '',
        ];

        $depth = $reader->depth;

        while ( $reader->read() ) {
            if ( \XMLReader::END_ELEMENT === $reader->nodeType && $reader->depth === $depth ) {
                break;
            }

            if ( \XMLReader::ELEMENT !== $reader->nodeType ) {
                continue;
            }

            $tag = $reader->localName;

            switch ( $tag ) {
                case 'author_id':
                    $author['author_id'] = (int) $reader->readString();
                    break;
                case 'author_login':
                    $author['author_login'] = $reader->readString();
                    break;
                case 'author_email':
                    $author['author_email'] = $reader->readString();
                    break;
                case 'author_display_name':
                    $author['author_display_name'] = $reader->readString();
                    break;
                case 'author_first_name':
                    $author['author_first_name'] = $reader->readString();
                    break;
                case 'author_last_name':
                    $author['author_last_name'] = $reader->readString();
                    break;
            }
        }

        return $author;
    }

    /**
     * Parse a wp:term element.
     */
    private function parse_term( \XMLReader $reader ): ?array {
        $term = [
            'term_id'     => 0,
            'taxonomy'    => '',
            'slug'        => '',
            'name'        => '',
            'parent'      => '',
            'description' => '',
            'termmeta'    => [],
        ];

        $depth = $reader->depth;

        while ( $reader->read() ) {
            if ( \XMLReader::END_ELEMENT === $reader->nodeType && $reader->depth === $depth ) {
                break;
            }

            if ( \XMLReader::ELEMENT !== $reader->nodeType ) {
                continue;
            }

            $tag = $reader->localName;

            switch ( $tag ) {
                case 'term_id':
                    $term['term_id'] = (int) $reader->readString();
                    break;
                case 'term_taxonomy':
                    $term['taxonomy'] = $reader->readString();
                    break;
                case 'term_slug':
                    $term['slug'] = $reader->readString();
                    break;
                case 'term_name':
                    $term['name'] = $reader->readString();
                    break;
                case 'term_parent':
                    $term['parent'] = $reader->readString();
                    break;
                case 'term_description':
                    $term['description'] = $reader->readString();
                    break;
                case 'termmeta':
                    $meta = $this->parse_meta( $reader );
                    if ( $meta ) {
                        $term['termmeta'][] = $meta;
                    }
                    break;
            }
        }

        return $term;
    }

    /**
     * Parse a wp:category element (standard WP categories).
     *
     * WXR categories use: category_nicename, cat_name, category_parent, category_description
     */
    private function parse_category( \XMLReader $reader ): ?array {
        $term = [
            'term_id'     => 0,
            'taxonomy'    => 'category',
            'slug'        => '',
            'name'        => '',
            'parent'      => '',
            'description' => '',
            'termmeta'    => [],
        ];

        $depth = $reader->depth;

        while ( $reader->read() ) {
            if ( \XMLReader::END_ELEMENT === $reader->nodeType && $reader->depth === $depth ) {
                break;
            }

            if ( \XMLReader::ELEMENT !== $reader->nodeType ) {
                continue;
            }

            $tag = $reader->localName;

            switch ( $tag ) {
                case 'term_id':
                    $term['term_id'] = (int) $reader->readString();
                    break;
                case 'category_nicename':
                    $term['slug'] = $this->read_cdata_value( $reader );
                    break;
                case 'cat_name':
                    $term['name'] = $this->read_cdata_value( $reader );
                    break;
                case 'category_parent':
                    $term['parent'] = $this->read_cdata_value( $reader );
                    break;
                case 'category_description':
                    $term['description'] = $this->read_cdata_value( $reader );
                    break;
            }
        }

        return $term;
    }

    /**
     * Parse a wp:tag element (standard WP tags).
     *
     * WXR tags use: tag_slug, tag_name, tag_description
     */
    private function parse_tag( \XMLReader $reader ): ?array {
        $term = [
            'term_id'     => 0,
            'taxonomy'    => 'post_tag',
            'slug'        => '',
            'name'        => '',
            'parent'      => '',
            'description' => '',
            'termmeta'    => [],
        ];

        $depth = $reader->depth;

        while ( $reader->read() ) {
            if ( \XMLReader::END_ELEMENT === $reader->nodeType && $reader->depth === $depth ) {
                break;
            }

            if ( \XMLReader::ELEMENT !== $reader->nodeType ) {
                continue;
            }

            $tag = $reader->localName;

            switch ( $tag ) {
                case 'term_id':
                    $term['term_id'] = (int) $reader->readString();
                    break;
                case 'tag_slug':
                    $term['slug'] = $this->read_cdata_value( $reader );
                    break;
                case 'tag_name':
                    $term['name'] = $this->read_cdata_value( $reader );
                    break;
                case 'tag_description':
                    $term['description'] = $this->read_cdata_value( $reader );
                    break;
            }
        }

        return $term;
    }

    /**
     * Parse an <item> element (post / page / CPT / attachment / menu item).
     */
    private function parse_item( \XMLReader $reader ): ?array {
        $item = [
            'post_id'        => 0,
            'post_title'     => '',
            'post_name'      => '',
            'post_content'   => '',
            'post_excerpt'   => '',
            'post_status'    => 'publish',
            'post_type'      => 'post',
            'post_date'      => '',
            'post_date_gmt'  => '',
            'post_parent'    => 0,
            'menu_order'     => 0,
            'post_password'  => '',
            'comment_status' => 'open',
            'ping_status'    => 'open',
            'is_sticky'      => 0,
            'guid'           => '',
            'attachment_url' => '',
            'postmeta'       => [],
            'terms'          => [],
        ];

        $depth = $reader->depth;

        while ( $reader->read() ) {
            if ( \XMLReader::END_ELEMENT === $reader->nodeType && $reader->depth === $depth ) {
                break;
            }

            if ( \XMLReader::ELEMENT !== $reader->nodeType ) {
                continue;
            }

            $tag = $reader->localName;

            switch ( $tag ) {
                case 'title':
                    $item['post_title'] = $reader->readString();
                    break;
                case 'guid':
                    $item['guid'] = $reader->readString();
                    break;
                case 'encoded':
                    $ns = $reader->namespaceURI;
                    if ( strpos( $ns, 'content' ) !== false ) {
                        $item['post_content'] = $this->read_cdata_value( $reader );
                    } elseif ( strpos( $ns, 'excerpt' ) !== false ) {
                        $item['post_excerpt'] = $this->read_cdata_value( $reader );
                    }
                    break;
                case 'post_id':
                    $item['post_id'] = (int) $reader->readString();
                    break;
                case 'post_date':
                    $item['post_date'] = $reader->readString();
                    break;
                case 'post_date_gmt':
                    $item['post_date_gmt'] = $reader->readString();
                    break;
                case 'post_name':
                    $item['post_name'] = $reader->readString();
                    break;
                case 'status':
                    $item['post_status'] = $reader->readString();
                    break;
                case 'post_parent':
                    $item['post_parent'] = (int) $reader->readString();
                    break;
                case 'menu_order':
                    $item['menu_order'] = (int) $reader->readString();
                    break;
                case 'post_type':
                    $item['post_type'] = $reader->readString();
                    break;
                case 'post_password':
                    $item['post_password'] = $reader->readString();
                    break;
                case 'comment_status':
                    $item['comment_status'] = $reader->readString();
                    break;
                case 'ping_status':
                    $item['ping_status'] = $reader->readString();
                    break;
                case 'is_sticky':
                    $item['is_sticky'] = (int) $reader->readString();
                    break;
                case 'attachment_url':
                    $item['attachment_url'] = $reader->readString();
                    break;
                case 'postmeta':
                    $meta = $this->parse_meta( $reader );
                    if ( $meta ) {
                        $item['postmeta'][] = $meta;
                    }
                    break;
                case 'category':
                    $item['terms'][] = [
                        'taxonomy' => $reader->getAttribute( 'domain' ) ?: 'category',
                        'slug'     => $reader->getAttribute( 'nicename' ) ?: '',
                        'name'     => $reader->readString(),
                    ];
                    break;
            }
        }

        return $item;
    }

    /**
     * Parse a wp:postmeta or wp:termmeta element.
     *
     * @return array|null { key, value }
     */
    private function parse_meta( \XMLReader $reader ): ?array {
        $key   = '';
        $value = '';
        $depth = $reader->depth;

        while ( $reader->read() ) {
            if ( \XMLReader::END_ELEMENT === $reader->nodeType && $reader->depth === $depth ) {
                break;
            }

            if ( \XMLReader::ELEMENT !== $reader->nodeType ) {
                continue;
            }

            $tag = $reader->localName;

            if ( $tag === 'meta_key' ) {
                $key = $this->read_cdata_value( $reader );
            } elseif ( $tag === 'meta_value' ) {
                $value = $this->read_cdata_value( $reader );
            }
        }

        if ( '' === $key ) {
            return null;
        }

        return [ 'key' => $key, 'value' => $value ];
    }

    /**
     * Safely read text/CDATA content from the current element.
     *
     * readString() can sometimes return empty for large CDATA blocks.
     * This method uses readInnerXml() as a fallback and strips CDATA wrappers.
     */
    private function read_cdata_value( \XMLReader $reader ): string {
        // Try readString first (works for most cases).
        $value = $reader->readString();

        if ( '' !== $value ) {
            return $value;
        }

        // Fallback: use readInnerXml and strip CDATA markers.
        $inner = $reader->readInnerXml();

        if ( '' === $inner ) {
            return '';
        }

        // Strip CDATA wrapper if present.
        $inner = trim( $inner );
        if ( strpos( $inner, '<![CDATA[' ) === 0 ) {
            $inner = substr( $inner, 9 ); // Remove <![CDATA[
            if ( substr( $inner, -3 ) === ']]>' ) {
                $inner = substr( $inner, 0, -3 ); // Remove ]]>
            }
        }

        return $inner;
    }
}
