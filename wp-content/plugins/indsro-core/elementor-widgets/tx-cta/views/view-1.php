<div class="fti-contact-3-area bg-default fti-class-add tx-section" data-background="<?php echo $settings['image_1']['url'] ? esc_url($settings['image_1']['url']) : ''; ?>">
    <div class="container fti-container-8">
        <div class="fti-contact-3-wrap">
            <!-- title -->
            <div class="fti-contact-3-title-wrap">
                <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                <h5 class="fti-subtitle-4 tx-subTitle"><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></h5>
                <?php
                endif;
                    if($settings['enable_title'] === 'yes') {
                    $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-4 has-color-white fti-split-text fti-split-in-right-4' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>

                <?php if( $settings['enable_description'] === 'yes' ) : ?>
                <p class="fti-para-3-small disc tx-description"><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                <?php endif; ?>

                <?php if( $settings['enable_button'] === 'yes' ) : ?>
                <div class="btn-wrap">
                    <a class="fti-btn-pr-4 tx-button"
                        href="<?php echo esc_url($settings['button_link']['url']); ?>"
                        target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                        rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>">

                        <?php if(!empty( $settings['button_text'] )) : ?>
                        <span class="btn-text"><?php echo esc_html($settings['button_text']); ?></span>
                        <?php endif; ?>

                        <?php if( $settings['enable_button_icon'] === 'yes' ) : ?>
                        <span class="btn-icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </span>
                        <?php endif; ?>
                    </a>
                </div>
                <?php endif; ?>

                <?php if( $settings['enable_info_box'] === 'yes' ) : ?>
                <div class="men wow fadeInLeft">
                    <?php if(!empty( $settings['info_box_image']['url'] )) : ?>
                    <div class="men-img">
                        <img src="<?php echo esc_url($settings['info_box_image']['url']) ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['info_box_image']['url'] ); } ?>">
                    </div>
                    <?php endif; ?>

                    <?php if(!empty( $settings['info_text'] )) : ?>
                    <p class="fti-para-3-small men-disc"><?php echo elh_element_kses_intermediate( $settings['info_text'] ); ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- contact form -->
            <?php if( $settings['enable_contact_form'] === 'yes' ) : ?>
            <div class="fti-contact-3-form bg-default wow fadeInUp" data-background="<?php echo $settings['image_2']['url'] ? esc_url($settings['image_2']['url']) : ''; ?>">
                <?php echo do_shortcode( $settings['contact_form_shortcode'] ); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>