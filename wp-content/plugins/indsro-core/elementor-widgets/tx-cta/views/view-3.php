<div class="fti-contact-5-area tx-section">
    <div class="container fti-container-8">
        <div class="fti-contact-5-wrap bg-default" data-background="<?php echo $settings['image_1']['url'] ? esc_url($settings['image_1']['url']) : ''; ?>">
            <!-- title -->
            <div class="fti-contact-5-title-wrap">

                <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                <h5 class="subtitle tx-subTitle"><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></h5>
                <?php
                endif;
                    if($settings['enable_title'] === 'yes') {
                    $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-5 has-color-white fti-split-text fti-split-in-right-4' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>

                <?php if( $settings['enable_description'] === 'yes' ) : ?>
                <p class="fti-para-4 disc tx-description"><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                <?php endif; ?>
            </div>
            <!-- contact form -->
            <div class="fti-contact-5-form asslideupcta">
                <?php if(!empty( $settings['contact_form_shortcode'] )) : ?>
                <div class="tx-contact-form">
                    <?php if(!empty( $settings['contact_sub_title'] )) : ?>
                    <h5 class="fti-heading-3 title"><?php echo elh_element_kses_intermediate($settings['contact_sub_title']); ?></h5>
                    <?php endif; ?>

                    <?php if(!empty( $settings['contact_title'] )) : ?>
                    <p class="fti-para-4 disc"><?php echo elh_element_kses_intermediate($settings['contact_title']); ?></p>
                    <?php endif; ?>
                    
                    <?php echo do_shortcode( $settings['contact_form_shortcode'] ); ?>
                </div>
                <?php endif; ?>

                <?php if(!empty( $settings['short_info'] )) : ?>
                <div class="bottom-text-wrap">
                    <span><?php echo elh_element_kses_intermediate($settings['short_info']); ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>