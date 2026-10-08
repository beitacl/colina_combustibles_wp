<?php
    $wow_animation = '';
    $wow_duration = '';
    $wow_delay = '';
    if ( $settings['enable_animation'] === 'yes' ) {
        $wow_animation = 'wow ' . $settings['wow_animation'];
        $wow_duration = $settings['wow_duration'] ? $settings['wow_duration'] : '';
        $wow_delay = $settings['wow_delay'] ? $settings['wow_delay'] : '';
    }
?>
<div class="fti-services-3-item txIcon-box <?php echo esc_attr($wow_animation) ?>"
data-wow-delay="<?php echo esc_attr($wow_delay); ?>"
data-wow-duration="<?php echo esc_attr($wow_duration); ?>">
    <?php if( $settings['enable_icon'] == true ) : ?>
    <div class="icon">
        <?php if ( $settings['type'] == 'icon' ): ?>
            <?php \Elementor\Icons_Manager::render_icon( $settings['info_icon'], ['aria-hidden' => 'true'] );?>
        <?php else: ?>
            <img src="<?php echo esc_url( $settings['info_image']['url'] ); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['info_image']['url'] ); } ?>" />
        <?php endif;?>
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['title'] )) : ?>
    <h5 class="title fti-heading-3">
        <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
        target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
        rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
            <?php echo elh_element_kses_intermediate( $settings['title'] ); ?>
        </a>
    </h5>
    <?php endif; ?>

    <?php if(!empty( $settings['description'] )) : ?>
    <p class="fti-para-3-small disc"><?php echo elh_element_kses_intermediate( $settings['description'] ); ?></p>
    <?php endif; ?>
</div>