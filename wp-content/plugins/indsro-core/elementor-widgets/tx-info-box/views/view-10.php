<div class="fti-services-2-item">
    <?php if(!empty( $settings['info_image']['url'] )) : ?>
    <div class="main-img img-cover">
        <img src="<?php echo esc_url( $settings['info_image']['url'] ); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['info_image']['url'] ); } ?>" />
    </div>
    <?php endif; ?>
    <div class="content">
        <?php if(!empty( $settings['info_image_2']['url'] )) : ?>
        <div class="content-bg">
            <img src="<?php echo esc_url( $settings['info_image_2']['url'] ); ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['info_image_2']['url'] ); } ?>" />
        </div>
        <?php endif; ?>

        <?php if(!empty( $settings['service_icon'] )) : ?>
        <div class="icon-wrap">
            <span class="icon-1">
                <?php \Elementor\Icons_Manager::render_icon( $settings['service_icon'], ['aria-hidden' => 'true'] );?>
            </span>
            <div class="divider"></div>
        </div>
        <?php endif; ?>

        <div class="title-wrap">
            <?php if(!empty( $settings['title'] )) : ?>
            <h5 class="fti-heading-2 title">
                <a
                    href="<?php echo esc_url($settings['button_link']['url']); ?>"
                    target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                    rel= "<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                    aria-label="<?php echo esc_attr( $settings['title'] ); ?>">
                    <?php echo elh_element_kses_intermediate( $settings['title'] ); ?>
                </a>
            </h5>
            <?php endif; ?>
            <?php if(!empty( $settings['description'] )) : ?>
            <p class="fti-para-2 disc"><?php echo elh_element_kses_intermediate( $settings['description'] ); ?></p>
            <?php endif; ?>
        </div>

        <!-- btn  -->
        <div class="btn-wrap">
            <a class="services-2-btn"
            href="<?php echo esc_url($settings['button_link']['url']); ?>"
            target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
            rel= "<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
            aria-label="<?php echo esc_attr( $settings['title'] ); ?>">
                <?php if(!empty( $settings['button_text'] )) : ?>
                <span class="btn-text">
                    <?php echo esc_html( $settings['button_text'] ); ?>
                </span>
                <?php endif; ?>

                <?php if(!empty( $settings['button_icon'] )) : ?>
                <span class="icon">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], ['aria-hidden' => 'true'] );?>
                </span>
                <?php endif; ?>
            </a>
        </div>
    </div>
</div>