<?php
    $enable_author_box = get_user_meta( 'indsro_enable_author_box', false );
    $user_id  = get_current_user_id();
    $user_meta = get_user_meta( $user_id, 'indsro_user_option', true );
    $indsro_user_social = isset( $user_meta['indsro_user_social'] ) ? $user_meta['indsro_user_social'] : [];
    $author_avatar_size = 140;
    if ( $enable_author_box ) :
?>
 <div class="blog-details-comment-item mt-30">
    <div class="img-wrap">
        <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>">
            <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>
        </a>
    </div>
    <div class="content-wrap">
        <a class="name" href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>">
        <?php print get_the_author();?></a>
        <p class="comment-text chy-para-1"><?php the_author_meta( 'description' );?></p>
        <ul class="social-link">
        <?php foreach( $indsro_user_social as $userSocail ) : ?>
            <li>
                <a href="<?php echo esc_url($userSocail['indsro_user_social_link']); ?>"><i class="<?php echo esc_attr($userSocail['indsro_user_social_icon']); ?>"></i></a>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php
    endif;