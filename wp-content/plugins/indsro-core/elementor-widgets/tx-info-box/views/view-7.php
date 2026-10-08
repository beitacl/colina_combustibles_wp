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
<div class="fti-project-2-item w-100 <?php echo esc_attr($wow_animation) ?>"
data-wow-delay="<?php echo esc_attr($wow_delay); ?>"
data-wow-duration="<?php echo esc_attr($wow_duration); ?>">
    <div>
        <?php if(!empty( $settings['title'] )) : ?>
        <h5 class="fti-heading-2 title">
            <a
                href="<?php echo esc_url($settings['button_link']['url']); ?>"
                target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                rel= "<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                aria-label="<?php echo esc_attr( $settings['title'] ); ?>">
                <?php echo elh_element_kses_intermediate( $settings['title'] ); ?>
            </a>
        </h5>
        <div class="divider"></div>
        <?php endif; ?>

        <?php if(!empty( $settings['description'] )) : ?>
        <p class="fti-para-2 disc"><?php echo elh_element_kses_intermediate( $settings['description'] ); ?></p>
        <?php endif; ?>
    </div>
    <div class="thumb">
        <?php if(!empty( $settings['info_image']['url'] )) : ?>
        <div class="main-img img-cover">
            <img src="<?php echo esc_url( $settings['info_image']['url'] ); ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['info_image']['url'] ); } ?>" />
        </div>
        <?php endif; ?>

        <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
            target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
            rel= "<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
            aria-label="<?php echo esc_attr( $settings['title'] ); ?>" class="link">

            <?php if(!empty( $settings['info_image_2']['url'] )) : ?>
            <div class="img-wrap">
                <img src="<?php echo esc_url( $settings['info_image_2']['url'] ); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['info_image_2']['url'] ); } ?>" />
            </div>
            <?php endif; ?>

            <?php if(!empty( $settings['button_icon'] )) : ?>
            <span class="icon">
                <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], ['aria-hidden' => 'true'] );?>
            </span>
            <?php endif; ?>
        </a>
    </div>
</div>