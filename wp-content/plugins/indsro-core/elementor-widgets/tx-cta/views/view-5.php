<div class="fti-cta-1-area">
    <div class="container">
        <div class="fti-cta-1-wrap bg-default fti-class-add m-0" data-background="<?php echo $settings['image_1']['url'] ? esc_url($settings['image_1']['url']) : ''; ?>">
            <div class="content">
                <?php
                    if($settings['enable_title'] === 'yes') {
                    $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-2 has-color-white fti-split-text fti-split-in-right-2' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>

                <div class="cta-action">
                    <?php if( $settings['enable_button'] === 'yes' ) : ?>
                    <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
                    target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                    rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>" class="fti-btn-pr-2 tx-button">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'class' => 'icon-1', 'aria-hidden' => 'true' ] );?>
                        <span class="btn-text">
                            <?php echo esc_html( $settings['button_text'] ); ?>
                        </span>
                        <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'class' => 'icon-2', 'aria-hidden' => 'true' ] );?>
                    </a>
                    <?php endif; ?>

                    <?php if( $settings['enable_contact_info'] === 'yes' ) :
                        if($settings['link_type'] === 'email') {
                            $link_url = 'mailto:' . $settings['contact_info_text'];
                        } elseif( $settings['link_type'] === 'phone' ) {
                            $link_url = 'tel:' . $settings['contact_info_text'];
                        } else {
                            $link_url = $settings['contact_info_text'];
                        }
                    ?>
                    <div class="contact-wrap">
                        <?php if(!empty( $settings['contact_info_icon'] )) : ?>
                        <span class="icon-1">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['contact_info_icon'], [ 'aria-hidden' => 'true' ] );?>
                        </span>
                        <?php endif; ?>
                        <div class="contact">
                            <?php if(!empty( $settings['contact_info_label'] )) : ?>
                            <span class="fti-heading-1 call"><?php echo elh_element_kses_intermediate( $settings['contact_info_label'] ); ?></span>
                            <?php endif; ?>

                            <?php if(!empty( $settings['contact_info_text'] )) : ?>
                            <a class="fti-heading-1 call-link" href="<?php echo esc_url($link_url); ?>">
                                <?php echo elh_element_kses_intermediate( $settings['contact_info_text'] ); ?>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if(!empty( $settings['image_2']['url'] )) : ?>
            <div class="cta-img-wrapper img-cover fix">
                <div class="main-img">
                    <img class="buil-cta-2-right-img"
                    src="<?php echo esc_url($settings['image_2']['url']); ?>"
                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>