<?php
    if ( $settings['enable_animation'] === 'yes' ) {
        $anim_class = $settings['element_anim_name'] ? $settings['element_anim_name'] : '';
    } else {
        $anim_class = '';
    }
?>
<div class="fti-project-4-card tx-infoBox <?php echo esc_attr($anim_class) ?>">
    <?php if(!empty( $settings['info_image']['url'] )) : ?>
    <div class="main-img img-cover">
        <img src="<?php echo esc_url( $settings['info_image']['url'] ); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['info_image']['url'] ); } ?>" />
    </div>
    <?php endif; ?>
    <div class="content">
        <?php if(!empty( $settings['title'] )) : ?>
        <h4 class="fti-heading-3 project-title">
            <a
                href="<?php echo esc_url($settings['button_link']['url']); ?>"
                target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                rel= "<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                aria-label="<?php echo esc_attr( $settings['title'] ); ?>">
                <?php echo elh_element_kses_intermediate( $settings['title'] ); ?>
            </a>
        </h4>
        <?php endif; ?>

        <?php if(!empty( $settings['description'] )) : ?>
        <p class="fti-para-4 disc tx-description"><?php echo elh_element_kses_intermediate( $settings['description'] ); ?></p>
        <?php endif; ?>
    </div>

    <?php if(!empty( $settings['button_icon'] )) : ?>
    <div class="btn-wrap">
        <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="btn">
            <span class="icon">
                <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], ['aria-hidden' => 'true'] );?>
            </span>
        </a>
    </div>
    <?php endif; ?>
</div>