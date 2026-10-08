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
<div class="fti-pricing-1-card <?php echo esc_attr($wow_animation) ?>"
data-wow-delay="<?php echo esc_attr($wow_delay); ?>"
data-wow-duration="<?php echo esc_attr($wow_duration); ?>">
    <div class="card-top">
        <div class="card-title-wrap">
            <?php if(!empty( $settings['pricing_title'] )) : ?>
            <h5 class="fti-heading-1 title"><?php echo elh_element_kses_intermediate( $settings['pricing_title']); ?></h5>
            <?php endif; ?>

            <h3 class="fti-heading-1 price"><?php echo esc_html($currency . $settings['price']); ?><span class="month"><?php echo elh_element_kses_intermediate( $settings['period']); ?></span></h3>
        </div>

        <?php if(!empty( $settings['pricing_image']['url'] )) : ?>
        <div class="img-wrap">
            <img src="<?php echo esc_url($settings['pricing_image']['url']) ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['pricing_image']['url'] ); } ?>">
        </div>
        <?php endif; ?>
    </div>

    <?php if(!empty( $settings['pricing_description'] )) : ?>
    <p class="fti-para-1 disc"><?php echo elh_element_kses_intermediate( $settings['pricing_description']); ?></p>
    <?php endif; ?>

    <?php if( $settings['enable_package_feature'] === 'yes' ) : ?>
    <div class="list">
        <?php foreach($settings['package_feature_lists'] as $list ) : ?>
        <span class="list-item fti-para-1">
            <?php \Elementor\Icons_Manager::render_icon( $list['package_feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            <?php echo elh_element_kses_intermediate( $list['package_feature_title']); ?>
        </span>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if( $settings['enable_button'] === 'yes' ) : ?>
    <div class="card-btn-wrap">
        <a class="fti-pricing-1-btn tx-button"
        href="<?php echo esc_url($settings['button_link']['url']); ?>"
        target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
        rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
            <?php echo elh_element_kses_intermediate( $settings['button_text'] ); ?>
            <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </a>
    </div>
    <?php endif; ?>

</div>