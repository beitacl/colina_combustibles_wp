<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package indsro
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}

if ( is_page() ) {
    $commentWrapperClass = 'comment-area-wrapper mt-50 clear';
} else {
    $commentWrapperClass = 'wrapper-class';
}
?>

<?php if ( get_comments_number() >= 1 ): ?>
    <div class="post-comments-wrapper blog-details-comments-wrap mb-40 log-comment-list-wrap">
        <div class="comment-title-wrapper group-title mb-25">
            <?php
                $comment_no = number_format_i18n( get_comments_number() );
                $comment_text = ( !empty( $comment_no ) AND ( $comment_no > 1 ) ) ? esc_html__( 'Comments', 'indsro' ) : esc_html__( ' Comment ', 'indsro' );
                $comment_no = ( !empty( $comment_no ) AND ( $comment_no > 0 ) ) ? '<h3 class="fti-heading-3 blog-details-form-title">' . esc_html( $comment_no ) . ' ' . esc_html( $comment_text ) . '</h3>' : ' ';
                print sprintf( "%s", $comment_no );
            ?>
        </div>
        <div class="tx-comment-lists">
            <ul class="list-unstyled mb-0">
                <?php
                    wp_list_comments( [
                        'style'       => 'ul',
                        'callback'    => 'indsro_comment',
                        'avatar_size' => 50,
                        'short_ping'  => true,
                    ] );
                ?>
            </ul>
        </div>
    </div>
    <?php endif;?>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ): ?>
    <div class="comment-pagination mb-50">
        <nav id="comment-nav-below" class="comment-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'indsro' );?></h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="nav-previous "><?php previous_comments_link( esc_html__( '&larr; Older ', 'indsro' ) );?></div>
                </div>
                <div class="col-md-6">
                    <div class="nav-next "><?php next_comments_link( esc_html__( 'Newer &rarr;', 'indsro' ) );?></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </nav><!-- #comment-nav-below -->
    </div>
    <?php endif; // check for comment navigation ?>

    <?php if(comments_open()) : ?>

    <div class="contact-form-wrapper post-comment-form comment-form contact-form">
        <?php comment_form(); ?>
    </div>
    <?php endif; ?>