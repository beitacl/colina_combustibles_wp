<div class="fti-footer-3-wrap d-block">
    <div class="footer-item-wrap">

        <!-- item  -->
        <?php foreach( $settings['footer_widgets'] as $list ) : ?>
        <div class="footer-item">
            <?php if(!empty( $list['footer_widget_title'] )) : ?>
            <h5 class="footer-item-title">
                <?php echo elh_element_kses_intermediate( $list['footer_widget_title'] ); ?>
            </h5>
            <?php endif; ?>

            <?php
                if(isset($list['footer_widget_menu']) && $list['footer_widget_menu']) {
                    $menu_args = [
                        'menu'        => $list['footer_widget_menu'],
                        'menu_class'  => 'footer-item-link-wrap list-unstyled',
                        'walker'      => class_exists('Tx_Mega_Menu_Walker') ? new Tx_Mega_Menu_Walker : '',
                        'fallback_cb' => ['Navwalker_Class', 'fallback'],
                        'echo'        => false,
                    ];
                    $menu = wp_nav_menu($menu_args);
                    echo wp_kses_post($menu);
                }
            ?>
        </div>
        <?php endforeach; ?>

        <!-- item  -->
        <div class="footer-item">
            <?php if(!empty( $settings['footer_app_widget_title'] )) : ?>
            <h5 class="footer-item-title">
                <?php echo elh_element_kses_intermediate( $settings['footer_app_widget_title'] ); ?>
            </h5>
            <?php endif; ?>

            <div class="footer-store-wrap">
                <?php foreach( $settings['footer_app_widgets'] as $list ) : ?>
                <a href="<?php echo esc_url($list['footer_app_link']['url']); ?>" class="store-link">
                    <img src="<?php echo esc_url($list['footer_app_image']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['footer_app_image']['url'] ); } ?>">
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>