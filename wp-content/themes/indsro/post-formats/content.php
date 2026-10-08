<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package indsro
 */
    $author_bio_avatar_size = 40;
    $tx_enable_social_share = cs_get_option( 'tx_enable_social_share' );

    // enable_blog_button
    $enable_blog_button = cs_get_option( 'enable_blog_button', true );
    $enable_author_meta = cs_get_option( 'enable_author_meta', true );
    $enable_default_date = cs_get_option( 'enable_default_date', true );
    $enable_comment_meta = cs_get_option( 'enable_comment_meta', true );
    $blog_button_text = cs_get_option( 'blog_button_text', __('Read More', 'indsro') );
    $excerpt_length = cs_get_option( 'excerpt_length', 180 );

    $has_thumb = '';
    if(has_post_thumbnail()) {
        $has_thumb = 'has-thumbnail';
    } else {
        $has_thumb = 'has-nOthumbnail';
    }
    $id = get_the_ID();

    $post_author_name = get_the_author_meta('display_name');

    if ( is_single() ):
?>

    <article id="post-<?php the_ID(); ?>"  <?php post_class( 'tx-blog-box tx-blogDetails-box'); ?>>
        <div class="blog-details-page-content">
            <div class="blog-details-item <?php echo esc_attr($has_thumb); ?>">

                <?php if ( has_post_thumbnail() ): ?>
                <div class="item-img">
                    <?php the_post_thumbnail( 'full', ['class' => 'img-responsive w-100'] ); ?>
                </div>
                <?php endif; ?>

                <div class="meta-data">
                    <?php if( $enable_author_meta == true ) : ?>
                    <span class="name">
                        <i class="fa-solid fa-user-tie"></i>
                        <?php echo esc_html__('By:', 'indsro') ?>
                        <?php echo esc_html($post_author_name); ?>
                    </span>
                    <?php endif; ?>

                    <?php if( $enable_comment_meta == true ) : ?>
                    <span class="name">
                        <i class="fa-regular fa-comment"></i>
                        <?php
                            $comment_count = get_comments_number();
                            $comment_text = ($comment_count === '1') ? ' Comment ' : ' Comments ';
                            echo esc_html($comment_text, 'indsro') . '(' . $comment_count . ')';
                        ?>
                    </span>
                    <?php endif; ?>

                    <?php if( $enable_default_date == true ) : ?>
                    <span class=" name"><i class="fa-solid fa-calendar-days"></i>
                    <?php echo esc_html( get_the_date( get_option( 'date_format' ), $id ) ); ?></span>
                    <?php endif; ?>
                </div>

                <div class="tx-blogDetails-box__wrapper mt-30 <?php echo esc_attr($has_thumb); ?>">
                    <div class="post-details-content fix log-blog-details-text">
                        <?php the_content(); ?>
                    </div>

                    <?php if( INDSRO_CORE ) : ?>
                    <div class="log-blog-share-tag pt-30 pb-30 flex-wrap d-flex justify-content-between">
                        <div class="blog-details-tag-wrap">
                            <?php if(function_exists('indsro_get_tag')) {
                                    print indsro_get_tag();
                                }
                            ?>
                        </div>
                        <?php if(function_exists('indsro_social_share') && $tx_enable_social_share == true) {
                                print indsro_social_share();
                            }
                        ?>
                    </div>
                    <?php endif; ?>

                    <div class="post-page-wrapper">
                        <?php
                            wp_link_pages( [
                                'before'      => '<div class="page-links mt-40 mb-55">' . esc_html__( 'Pages:', 'indsro' ),
                                'after'       => '</div>',
                                'link_before' => '<span class="page-number">',
                                'link_after'  => '</span>',
                            ] );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <?php else: ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'tx-blog-box mt-30'); ?>>
        <div class="blog-list-item <?php echo esc_attr($has_thumb); ?>">
            <?php if ( has_post_thumbnail() ): ?>
            <div class="item-img">
                <?php the_post_thumbnail( 'full', ['class' => 'img-responsive w-100'] ); ?>
            </div>
            <?php endif; ?>

            <div class="meta-data">
                <?php if( $enable_author_meta == true ) : ?>
                <span class="name">
                    <i class="fa-solid fa-user-tie"></i>
                    <?php echo esc_html__('By:', 'indsro') ?>
                    <?php echo esc_html($post_author_name); ?>
                </span>
                <?php endif; ?>

                <?php if( $enable_comment_meta == true ) : ?>
                <span class="name">
                    <i class="fa-regular fa-comment"></i>
                    <?php
                        $comment_count = get_comments_number();
                        $comment_text = ($comment_count === '1') ? ' Comment ' : ' Comments ';
                        echo esc_html($comment_text, 'indsro') . '(' . $comment_count . ')';
                    ?>
                </span>
                <?php endif; ?>

                <?php if( $enable_default_date == true ) : ?>
                <span class=" name"><i class="fa-solid fa-calendar-days"></i> <?php echo esc_html( get_the_date( get_option( 'date_format' ), $id ) ); ?></span>
                <?php endif; ?>
            </div>
            <h3 class="fti-heading-3 title">
                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>"><?php the_title(); ?></a>
            </h3>

            <?php if(!empty( get_the_excerpt() )) : ?>
            <p class="fti-para-3-small">
                <?php
                    $excerpt = get_the_excerpt();
                    $excerpt = substr($excerpt, 0, $excerpt_length);
                    if (strlen(get_the_excerpt()) > $excerpt_length) {
                        $excerpt .= '...';
                    }
                    echo esc_html($excerpt);
                ?>
            </p>
            <?php endif; ?>

            <?php if( $enable_blog_button == true ) : ?>
            <a class="fti-btn-pr-4 bl-btn" href="<?php the_permalink(); ?>">
                <span class="btn-text"><?php echo esc_html($blog_button_text); ?></span>
                <span class="btn-icon">
                    <i class="flaticon-right-up"></i>
                </span>
            </a>
            <?php endif; ?>
        </div>
    </article>
<?php endif; ?>
