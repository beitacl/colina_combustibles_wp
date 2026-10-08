<?php

    $subtitle_animation = '';
    if( $settings['enable_sub_title'] === 'yes' ) {
        if($settings['enable_sub_title_anim'] === 'yes') {
            $subtitle_animation = 'title-ani';
        } else {
            $subtitle_animation = '';
        }
    } else {
        $subtitle_animation = '';
    }

    $title_animation = '';
    if( $settings['enable_title'] === 'yes' ) {
        if($settings['enable_title_anim'] === 'yes') {
            $title_animation = 'title-ani';
        } else {
            $title_animation = '';
        }
    } else {
        $title_animation = '';
    }
?>
<div class="gly-portfolio-1-section-title">
    <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
    <h5 class="gly-subtitle-1 tx-subTitle <?php echo esc_attr($subtitle_animation); ?>">
        <?php if(!empty( $settings['sub_title_icon'] )) {
            \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] );
        } ?>
        <?php echo elh_element_kses_intermediate($settings['sub_title']); ?>
    </h5>
    <?php endif; ?>

    <?php if( $settings['enable_title'] === 'yes' ) : ?>
    <h2 class="gly-section-title-1 has-color-2 <?php echo esc_attr($title_animation); ?>">
        <?php echo elh_element_kses_intermediate($settings['title']); ?>

        <?php if(!empty( $settings['title_icon'] )) : ?>
        <span class="gly-portfolio-1-title-btn">
            <?php \Elementor\Icons_Manager::render_icon( $settings['title_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </span>
        <?php endif; ?>

        <br>
        <?php if(!empty( $settings['title_2_image']['url'] )) : ?>
            <img
            src="<?php echo esc_url($settings['title_2_image']['url']); ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['title_2_image']['url'] ); } ?>" class="gly-portfolio-1-title-img">
        <?php endif; ?>

        <?php if(!empty( $settings['title_2'] )) : ?>
        <span class="has-stoke"><?php echo elh_element_kses_intermediate($settings['title_2']); ?></span>
        <?php endif; ?>
    </h2>
    <?php endif; ?>

    <?php if( $settings['enable_description'] === 'yes' ) : ?>
    <p class="gly-para-1 tx-description">
        <?php echo elh_element_kses_intermediate($settings['description']); ?>
    </p>
    <?php endif; ?>
</div>