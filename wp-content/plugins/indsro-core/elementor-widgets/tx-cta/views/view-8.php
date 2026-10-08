<div class="fti-solution-2-area bg-default parallax-img fix tx-section" data-background="<?php echo $settings['image_1']['url'] ? esc_url($settings['image_1']['url']) : ''; ?>">
    <?php if(!empty( $settings['image_2']['url'] )) : ?>
    <div class="shape-1">
        <img src="<?php echo esc_url($settings['image_2']['url']) ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    </div>
    <?php endif; ?>
    <div class="container fti-container-3">
        <div class="fti-solution-2-wrap">
            <div class="item">

                <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                <h6 class="fti-subtitle-3 tx-subTitle"><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></h6>
                <?php
                endif;
                    if($settings['enable_title'] === 'yes') {
                    $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-3 has-color-white fti-split-text fti-split-in-right-3' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>

                <?php if( $settings['enable_description'] === 'yes' ) : ?>
                <p class="fti-para-2 disc tx-description"><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                <?php endif; ?>

                <?php if( $settings['enable_button'] === 'yes' ) : ?>
                <div class="btn-wrap">
                    <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
                    target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                    rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>" class="fti-btn-pr-3">

                        <?php if(!empty( $settings['button_text'] )) : ?>
                        <span class="btn-text">
                            <?php echo esc_html( $settings['button_text'] ); ?>
                        </span>
                        <?php endif; ?>

                        <?php if(!empty( $settings['button_icon'] )) : ?>
                        <span class="btn-icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );?>
                        </span>
                        <?php endif; ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>