<div class="fti-footer-1-info">
    <div class="footer-social-wrap tx-listItems">
        <?php foreach( $settings['social_links'] as $list ) : ?>
        <a class="social-link" href="<?php echo esc_url($list['social_link']['url']); ?>"
            target="<?php echo esc_attr( $list['social_link']['is_external'] ? '_blank' : '_self' ); ?>"
            rel="<?php echo esc_attr( $list['social_link']['nofollow'] ? 'nofollow' : '' ); ?>">
            <?php \Elementor\Icons_Manager::render_icon( $list['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </a>
        <?php endforeach; ?>
    </div>
</div>