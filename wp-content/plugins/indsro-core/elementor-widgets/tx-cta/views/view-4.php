<div class="fti-cta-5-area tx-section" data-background="<?php echo $settings['image_1']['url'] ? esc_url($settings['image_1']['url']) : ''; ?>">
    <?php if(!empty( $settings['video_link']['url'] )) : ?>
    <a class="popup-video play-icon" href="<?php echo esc_url($settings['video_link']['url']); ?>">
        <span class="icon">
            <?php \Elementor\Icons_Manager::render_icon( $settings['video_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </span>
    </a>
    <?php endif; ?>
</div>