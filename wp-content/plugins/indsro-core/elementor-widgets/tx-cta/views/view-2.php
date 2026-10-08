<div class="fti-cta-4-area tx-section">
    <div class="container fti-container-9">
        <div class="fti-cta-4-wrap">
            <div class="fti-cta-4-content">

                <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                    <h5 class="fti-subtitle-5 tx-subTitle"><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></h5>
                <?php
                    endif;
                        if($settings['enable_title'] === 'yes') {
                        $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-5 fti-split-text fti-split-in-right-4' );
                            printf('<%1$s %2$s>%3$s</%1$s>',
                                tag_escape($settings['title_tag']),
                                $this->get_render_attribute_string('title'),
                                elh_element_kses_basic( $settings['title'] )
                            );
                        }
                    if( $settings['enable_description'] === 'yes' ) : ?>
                    <p class="fti-para-4 disc tx-description"><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                <?php endif; ?>

                <?php if( $settings['enable_button'] === 'yes' ) : ?>
                <div class="btn-wrap">
                    <a class="fti-btn-pr-5 tx-button"
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
            </div>

            <?php if(!empty( $settings['image_1']['url'] )) : ?>
            <div class="main-img img-cover">
                <img src="<?php echo esc_url($settings['image_1']['url']) ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
            </div>
            <?php endif; ?>
        </div>
    </div>
    </div>