<div class="services-details-wrap">
    <div class="feature">
        <div class="item">
            <div class="item-title-wrap">
                <?php if( $settings['enable_icon'] == true ) : ?>
                <span class="icon">
                    <?php if ( $settings['type'] == 'icon' ): ?>
                        <?php \Elementor\Icons_Manager::render_icon( $settings['info_icon'], ['aria-hidden' => 'true'] );?>
                    <?php else: ?>
                        <img src="<?php echo esc_url( $settings['info_image']['url'] ); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['info_image']['url'] ); } ?>" />
                    <?php endif;?>
                </span>
                <?php endif; ?>

                <?php if(!empty( $settings['title'] )) : ?>
                <h6 class="fti-heading-3 feature-title"><?php echo elh_element_kses_intermediate( $settings['title'] ); ?></h6>
                <?php endif; ?>
            </div>

            <?php if(!empty( $settings['description'] )) : ?>
            <p class="fti-para-3-small disc"><?php echo elh_element_kses_intermediate( $settings['description'] ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
