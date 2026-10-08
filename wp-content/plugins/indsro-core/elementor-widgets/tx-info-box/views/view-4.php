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
<div class="fti-feature-5-item <?php echo esc_attr($wow_animation) ?>"
data-wow-delay="<?php echo esc_attr($wow_delay); ?>"
data-wow-duration="<?php echo esc_attr($wow_duration); ?>">
    <?php if(!empty( $settings['info_image']['url'] )) : ?>
    <div class="main-img img-cover">
        <img src="<?php echo esc_url( $settings['info_image']['url'] ); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['info_image']['url'] ); } ?>" />
    </div>
    <?php endif; ?>
    <?php if(!empty( $settings['title'] )) : ?>
    <div class="title-wrap">
        <h5 class="fti-heading-3 title">
            <a
                href="<?php echo esc_url($settings['button_link']['url']); ?>"
                target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                rel= "<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                aria-label="<?php echo esc_attr( $settings['title'] ); ?>">
                <?php echo elh_element_kses_intermediate( $settings['title'] ); ?>
            </a>
        </h5>
    </div>
    <?php endif; ?>
</div>