<section id="log-project-3" class="log-project-section-3 pt-175 pb-90 position-relative tx-section" data-background="<?php echo $settings['image_1']['url'] ? esc_url($settings['image_1']['url']) : ''; ?>">
    <div class="background_overlay"></div>

    <div class="log-section-title-2 text-center headline pera-content">
        <?php if(!empty( $settings['enable_sub_title'] )) : ?>
        <div class="subtitle d-flex align-items-center wow fadeInRight tx-subTitle" data-wow-delay="100ms" data-wow-duration="1000ms">
            <?php if( $settings['enable_sub_title_icon'] === 'yes' ) : ?>
                <?php if( $settings['sub_title_icon_type'] === 'icon' ) : ?>
                    <?php \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <?php else : ?>
                    <img src="<?php echo esc_url( $settings['sub_title_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['sub_title_image']['alt'] ); ?>">
                <?php endif; ?>
            <?php endif; ?>
            <span><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
        </div>
        <?php endif; ?>

        <?php
            $this->add_render_attribute( 'title', 'class', 'tx-title section_title tx-split-text split-in-right' );
            if($settings['enable_title'] === 'yes') {
                printf('<%1$s %2$s>%3$s</%1$s>',
                    tag_escape($settings['title_tag']),
                    $this->get_render_attribute_string('title'),
                    elh_element_kses_basic( $settings['title'] )
                );
            }
        ?>
    </div>

    <div class="log-project-content-3 pt-50 d-flex justify-content-center">
        <?php foreach($settings['service_slide_boxs'] as $lsit ) : ?>
        <div class="log-project-item-3 position-relative wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
            <div class="item-wrap position-relative" id="more_area">
                <?php if(!empty( $lsit['service_image']['url'] )) : ?>
                <div class="item-img">
                    <img src="<?php echo esc_url($lsit['service_image']['url']); ?>"
                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['service_image']['url'] ); } ?>">
                </div>
                <?php endif; ?>
                <div class="item-text" id="more_content">
                    <a
                    href="<?php echo esc_url($lsit['button_link']['url']); ?>"
                    target="<?php echo esc_attr($lsit['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                    rel= "<?php echo esc_attr($lsit['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                    aria-label="name">
                        <?php echo elh_element_kses_intermediate( $lsit['button_text'] ); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>