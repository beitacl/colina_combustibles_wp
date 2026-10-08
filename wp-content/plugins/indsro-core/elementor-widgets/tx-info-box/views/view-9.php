<div class="fti-services-1-item fix">
    <?php if(!empty( $settings['shape_image_1']['url'] )) : ?>
    <img class="fti-services-1-shape-1"
        src="<?php echo esc_url( $settings['shape_image_1']['url'] ); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['shape_image_1']['url'] ); } ?>" />
    <?php endif; ?>

    <?php if(!empty( $settings['shape_image_2']['url'] )) : ?>
    <img class="fti-services-1-shape-2"
        src="<?php echo esc_url( $settings['shape_image_2']['url'] ); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['shape_image_2']['url'] ); } ?>" />
    <?php endif; ?>
    
    <?php if(!empty( $settings['title'] )) : ?>
    <h5 class="fti-heading-1 title">
        <a
            href="<?php echo esc_url($settings['button_link']['url']); ?>"
            target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
            rel= "<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
            aria-label="<?php echo esc_attr( $settings['title'] ); ?>">
            <?php echo elh_element_kses_intermediate( $settings['title'] ); ?>
        </a>
    </h5>
    <div class="services-1-divider"></div>
    <?php endif; ?>

    <?php if(!empty( $settings['description'] )) : ?>
    <p class="fti-para-1-small disc"><?php echo elh_element_kses_intermediate( $settings['description'] ); ?></p>
    <?php endif; ?>

    <div class="img-wrap">
        <?php if(!empty( $settings['button_icon'] )) : ?>
        <span class="icon-1">
            <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], ['aria-hidden' => 'true'] );?>
        </span>
        <?php endif; ?>

        <?php if(!empty( $settings['info_image']['url'] )) : ?>
        <img src="<?php echo esc_url( $settings['info_image']['url'] ); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['info_image']['url'] ); } ?>" />
        <?php endif; ?>
    </div>
</div>