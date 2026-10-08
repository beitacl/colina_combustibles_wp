<?php

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

<div class="gly-portfolio-1-content <?php echo esc_attr($title_animation); ?>">
    <?php if(!empty( $settings['title'] )) : ?>
    <h5 class="title gly-heading-1 gly-font-900 tx-subTitle"><?php echo elh_element_kses_intermediate($settings['title']); ?></h5>
    <?php endif; ?>

    <?php \Elementor\Icons_Manager::render_icon( $settings['title_icon'], [ 'aria-hidden' => 'true' ] ); ?>

    <?php if( $settings['enable_description'] === 'yes' ) : ?>
    <p class="disc gly-para-1 tx-description">
        <?php echo elh_element_kses_intermediate($settings['description']); ?>
    </p>
    <?php endif; ?>
</div>