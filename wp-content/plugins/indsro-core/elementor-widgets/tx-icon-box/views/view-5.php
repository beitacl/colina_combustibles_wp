<?php
    $shape = '';
    if($settings['enable_shape'] === 'yes') {
        $shape = '';
    } else {
        $shape = 'no-shape';
    }
?>
<div class="fti-about-5-left <?php echo esc_attr($shape); ?>">
    <div class="feature">
        <div class="item">
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
            <h5 class="title"><?php echo elh_element_kses_intermediate( $settings['title'] ); ?></h5>
            <?php endif; ?>
        </div>
    </div>
</div>