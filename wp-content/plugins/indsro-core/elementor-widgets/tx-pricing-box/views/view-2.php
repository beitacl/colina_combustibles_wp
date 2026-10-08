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
<div class="tx-pricingBox home_ver_2 <?php echo esc_attr($wow_animation) ?>"
data-wow-delay="<?php echo esc_attr($wow_delay); ?>"
data-wow-duration="<?php echo esc_attr($wow_duration); ?>">
    <div class="log-pricing-item-5 m-0" data-background="<?php echo esc_url($settings['pricing_image']['url']) ? esc_url($settings['pricing_image']['url']) : ''; ?>">
        <div class="item-content d-flex">
            <div class="item-text headline-2 pera-content">
                <?php if(!empty( $settings['pricing_title'] )) : ?>
                <h3><?php echo elh_element_kses_intermediate( $settings['pricing_title']); ?></h3>
                <?php endif; ?>

                <?php if(!empty( $settings['pricing_description'] )) : ?>
                <p><?php echo elh_element_kses_intermediate( $settings['pricing_description']); ?></p>
                <?php endif; ?>

                <h2><?php echo esc_html($currency . $settings['price']); ?></h2>

                <?php if( $settings['enable_button'] === 'yes' ) : ?>
                <a class="text-uppercase text-center"
                href="<?php echo esc_url($settings['button_link']['url']); ?>"
                target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                    <?php echo elh_element_kses_intermediate( $settings['button_text'] ); ?>
                    <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </a>
                <?php endif; ?>

            </div>
            <?php if( $settings['enable_package_feature'] === 'yes' ) : ?>
            <div class="item-list ul-li-block">
                <ul>
                    <?php foreach($settings['package_feature_lists'] as $list ) : ?>
                    <li class="wow" data-splitting="">
                        <?php \Elementor\Icons_Manager::render_icon( $list['package_feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        <span><?php echo elh_element_kses_intermediate( $list['package_feature_title']); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>