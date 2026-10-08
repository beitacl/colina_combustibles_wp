<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package indsro
 */

 $author_bio_avatar_size = 40;
 $indsro_enable_social_share = cs_get_option( 'indsro_enable_social_share' );

 $has_thumb = '';
 if(has_post_thumbnail()) {
     $has_thumb = 'has-thumbnail';
 } else {
     $has_thumb = 'has-nOthumbnail';
 }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'tx-blog-box mt-30 format-quote'); ?>>
    <div class="blog-list-item <?php echo esc_attr($has_thumb); ?>">
        <div class="news-block_three-content">
            <div class="post-excerpt news-block_two-text">
                <?php the_content();?>
            </div>
        </div>
    </div>
</article>