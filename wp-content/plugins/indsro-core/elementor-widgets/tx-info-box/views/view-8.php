<div class="fti-project-inner-item">
    <?php if(!empty( $settings['info_image']['url'] )) : ?>
    <div class="main-img img-cover">
        <img src="<?php echo esc_url( $settings['info_image']['url'] ); ?>"
    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['info_image']['url'] ); } ?>" />
    </div>
    <?php endif; ?>

    <div class="project-content">
        <?php if(!empty( $settings['title'] )) : ?>
        <h3 class="fti-heading-3 title"><?php echo elh_element_kses_intermediate( $settings['title'] ); ?></h3>
        <?php endif; ?>

        <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
            target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
            rel= "<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
            aria-label="<?php echo esc_attr( $settings['title'] ); ?>" class="project-btn">
            <?php if(!empty( $settings['button_text'] )) : ?>
            <span class="btn-text"><?php echo elh_element_kses_intermediate( $settings['button_text'] ); ?></span>
            <?php endif; ?>

            <?php if(!empty( $settings['button_icon'] )) : ?>
            <span class="btn-icon">
                <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], ['aria-hidden' => 'true'] );?>
            </span>
            <?php endif; ?>
        </a>
    </div>
</div>