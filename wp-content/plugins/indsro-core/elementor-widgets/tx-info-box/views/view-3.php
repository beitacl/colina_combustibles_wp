<div class="fti-services-4-item">
    <?php if(!empty( $settings['info_image']['url'] )) : ?>
    <div class="img-wrap">
        <img src="<?php echo esc_url( $settings['info_image']['url'] ); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['info_image']['url'] ); } ?>" />
    </div>
    <?php endif; ?>
    <div class="content">
        <?php if(!empty( $settings['count'] )) : ?>
        <span class="fti-para-4 number"><?php echo esc_html($settings['count']); ?></span>
        <?php endif; ?>

        <div class="title-wrap">
            <?php if(!empty( $settings['title'] )) : ?>
            <h5 class="title">
                <a
                    href="<?php echo esc_url($settings['button_link']['url']); ?>"
                    target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                    rel= "<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                    aria-label="<?php echo esc_attr( $settings['title'] ); ?>">
                    <?php echo elh_element_kses_intermediate( $settings['title'] ); ?>
                </a>
            </h5>
            <?php endif; ?>

            <?php if(!empty( $settings['location_label'] || $settings['location_info'] )) : ?>
            <h6 class="location">
                <?php echo elh_element_kses_intermediate( $settings['location_info'] ); ?>
                <?php if(!empty( $settings['location_label'] )) : ?>
                <span class="location-text"><?php echo elh_element_kses_intermediate( $settings['location_label'] ); ?></span>
                <?php endif; ?>
            </h6>
            <?php endif; ?>
        </div>
    </div>
    <?php if(!empty( $settings['description'] )) : ?>
    <p class="fti-para-4 disc"><?php echo elh_element_kses_intermediate( $settings['description'] ); ?></p>
    <?php endif; ?>
</div>