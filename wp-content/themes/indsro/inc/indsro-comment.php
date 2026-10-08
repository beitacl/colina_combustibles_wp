<?php

add_filter( 'comment_form_default_fields', 'indsro_comment_form_default_fields_func' );

function indsro_comment_form_default_fields_func( $default ) {

    $default['author'] = '
            <div class="row tx-column-gap-20">
                <div class="col-xl-6">
                    <div class="contact-form-input  mt-20">
                        <input class="input-box" type="text" name="author" placeholder="' . esc_attr__( 'Full Name', 'indsro' ) . '">
                    </div>
                </div>';

    $default['email'] = '
                <div class="col-xl-6">
                    <div class="contact-form-input  mt-20">
                        <input class="input-box" type="text" name="email" placeholder="' . esc_attr__( 'Email address', 'indsro' ) . '">
                    </div>
                </div>
        ';

    $default['url'] = '
                <div class="col-xl-12 comment-from-right">
                    <div class="contact-form-input  mt-20">
                        <input class="input-box" type="text" name="url" placeholder="' . esc_attr__( 'Your Website...', 'indsro' ) . '">
                    </div>
                </div>
            </div>
        ';
    return $default;
}

add_action( 'comment_form_top', 'indsro_add_comments_textarea' );
function indsro_add_comments_textarea() {
    if ( !is_user_logged_in() && function_exists( 'is_product' ) ) {
        echo '<div class="col-xl-12 hideOn-product-details form-group mb-0"><div class="tx-input-field"><textarea id="comment" name="comment" cols="60" rows="6" placeholder="' . esc_attr__( 'Write your message here..', 'indsro' ) . '" aria-required="true"></textarea></div></div>';
    }
}

add_filter( 'comment_form_defaults', 'indsro_comment_form_defaults_func' );

function indsro_comment_form_defaults_func( $info ) {
    if ( !is_user_logged_in() ) {

        $info['comment_field'] = '';

        $info['submit_field'] = '%1$s %2$s';
    } else {
        $info['comment_field'] = '

        <div class="contact-form">
        <div class="row">
            <div class="col-xl-12 form-group">
                <div class="tx-input-field">
                    <textarea id="comment" name="comment" cols="30" rows="10" placeholder="' . esc_attr__( 'Your comments...', 'indsro' ) . '"></textarea>
                </div>
            </div>';
        $info['submit_field'] = '%1$s %2$s</div>
        </div>
        ';
    }

    $form_wrapper = 'logged-in mt-10';
    if ( !is_user_logged_in() ) {
        $form_wrapper = 'not-logged mt-20';
    }

    $info['submit_button'] = '
    <div class="col-xl-12 submit-button ' . esc_attr( $form_wrapper ) . '">
        <div class="blog-details-form-btn-wrap m-0">
            <button class="ftc-pr-font blog-details-form-btn" type="submit">
                ' . esc_attr__( 'send message', 'indsro' ) . '
            </button>
        </div>
    </div>';

    // check if number of comments is zero
    $comments_number = get_comments_number();

    if( $comments_number == 0 ) {
        $title_class = "mt-0";
    } else {
        $title_class = "mt-0";
    }


    $info['title_reply_before'] = '<h3 class="fti-heading-3 blog-details-form-title '.esc_attr($title_class).'">';
    $info['title_reply_after'] = '</h3>';
    $info['comment_notes_before'] = '';

    return $info;
}

// comment view function

if ( !function_exists( 'indsro_comment' ) ) {
    function indsro_comment( $comment, $args, $depth ) {
        $GLOBAL['comment'] = $comment;
        extract( $args, EXTR_SKIP );
        $args['reply_text'] = '<i class="fas fa-comment"></i>'  . esc_html__( ' Reply', 'indsro' ) . '';
        $replayClass = 'comment-depth-' . esc_attr( $depth );
        ?>
        <li id="comment-<?php comment_ID();?>">
            <div class="log-comment-item d-flex flex-wrap position-relative pera-content tx-comment-box">

                <?php if( get_avatar($comment, 78, null, null, ['class' => []]) == true ) : ?>
                <div class="log-comment-img">
                    <?php print get_avatar( $comment, 78, null, null, ['class' => ['blog-details-comment-card-img']] );?>
                </div>
                <?php endif; ?>

                <div class="log-comment-text">
                    <div class="author-name-date">
                        <span class="cm-name"><?php print get_comment_author_link();?></span>
                        <span class="cm-date"><?php comment_time( get_option( 'date_format' ) );?></span>
                    </div>
                    <?php comment_text();?>
                </div>
                <div class="log-like-reply position-absolute text-capitalize">
                    <?php comment_reply_link( array_merge( $args, ['depth' => $depth, 'max_depth' => $args['max_depth']] ) );?>
                </div>
            </div>

        </li>
		<?php
}
}