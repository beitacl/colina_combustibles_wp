<?php
    $wow_animation = '';
    $wow_duration = '';
    $wow_delay = '';
    if ( $settings['enable_animation'] === 'yes' ) {
        $wow_animation = 'wow ' . $settings['wow_animation'];
        $wow_duration = $settings['wow_duration'] ? $settings['wow_duration'] : '1000ms';
        $wow_delay = $settings['wow_delay'] ? $settings['wow_delay'] : '200ms';
    }
?>
<div class="fti-feature-3-wrap <?php echo esc_attr($wow_animation) ?>"
    data-wow-delay="<?php echo esc_attr($wow_delay); ?>"
    data-wow-duration="<?php echo esc_attr($wow_duration); ?>">
    <div class="feature-item">
        <?php if( $settings['enable_icon'] == true ) : ?>
        <div class="icon-wrap">
            <span class="icon">
                <?php if ( $settings['type'] == 'icon' ): ?>
                    <?php \Elementor\Icons_Manager::render_icon( $settings['info_icon'], ['aria-hidden' => 'true'] );?>
                <?php else: ?>
                    <img src="<?php echo esc_url( $settings['info_image']['url'] ); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['info_image']['url'] ); } ?>" />
                <?php endif;?>
            </span>
        </div>
        <?php endif; ?>

        <?php if(!empty( $settings['title'] )) : ?>
        <h4 class="fti-heading-3 title tx-title">
            <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
            target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
            rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                <?php echo elh_element_kses_intermediate( $settings['title'] ); ?>
            </a>
        </h4>
        <?php endif; ?>

        <?php if(!empty( $settings['description'] )) : ?>
        <p class="fti-para-3-small tx-description">
            <?php echo elh_element_kses_intermediate( $settings['description'] ); ?>
        </p>
        <?php endif; ?>
    </div>
</div>