<div class="fti-services-5-card">
    <?php if( $settings['enable_icon'] == true ) : ?>
    <div class="icon img-cover">
        <?php if ( $settings['type'] == 'icon' ): ?>
            <?php \Elementor\Icons_Manager::render_icon( $settings['info_icon'], ['aria-hidden' => 'true'] );?>
        <?php else: ?>
            <img src="<?php echo esc_url( $settings['info_image']['url'] ); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['info_image']['url'] ); } ?>" />
        <?php endif;?>
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['title'] )) : ?>
    <h4 class="fti-heading-3 title">
        <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
        target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
        rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
            <?php echo elh_element_kses_intermediate( $settings['title'] ); ?>
        </a>
    </h4>
    <?php endif; ?>

    <?php if(!empty( $settings['button_link']['url'] )) : ?>
    <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
        target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
        rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>" class="link">
        <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], ['aria-hidden' => 'true'] );?>
    </a>
    <?php endif; ?>
</div>