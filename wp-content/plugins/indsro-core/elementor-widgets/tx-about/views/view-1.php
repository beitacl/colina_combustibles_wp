<div class="fti-solution-3-area fti-class-add tx-section">
    <div class="container fti-container-8">
        <div class="fti-solution-3-wrap">
            <!-- main image  -->
            <?php if(!empty( $settings['image_1']['url'] )) : ?>
            <div class="main-img">
                <img
                src="<?php echo esc_url($settings['image_1']['url']); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
            </div>
            <?php endif; ?>

            <!-- content  -->
            <div class="content">
                <!-- title -->
                <div class="solution-title-wrap">
                    <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                    <h5 class="fti-subtitle-4 tx-subTitle"><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></h5>
                    <?php
                    endif;
                        if($settings['enable_title'] === 'yes') {
                        $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-4 fti-split-text fti-split-in-right-4' );
                            printf('<%1$s %2$s>%3$s</%1$s>',
                                tag_escape($settings['title_tag']),
                                $this->get_render_attribute_string('title'),
                                elh_element_kses_basic( $settings['title'] )
                            );
                        }
                    ?>
                </div>
                <div class="solution-bottom">
                    <?php if(!empty( $settings['image_2']['url'] )) : ?>
                    <div class="img-wrap">
                        <img
                        src="<?php echo esc_url($settings['image_2']['url']); ?>"
                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
                    </div>
                    <?php endif; ?>

                    <div class="info">
                        <?php if( $settings['enable_description'] === 'yes' ) : ?>
                        <p class="fti-para-3-small disc tx-description"><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                        <?php endif; ?>

                        <style>
                            .custom-indsro-btn {
                                display: inline-flex;
                                align-items: center;
                                justify-content: center;
                                background-color: #04896A; 
                                color: #ffffff !important;
                                padding: 18px 45px;
                                font-size: 16px;
                                font-weight: 700;
                                text-transform: uppercase;
                                letter-spacing: 1px;
                                border: 2px solid #04896A;
                                border-radius: 0; 
                                transition: all 0.4s ease;
                                margin-top: 20px;
                                text-decoration: none;
                                cursor: pointer;
                            }
                            .custom-indsro-btn:hover {
                                background-color: #032A3B;
                                border-color: transparent !important;
                                color: #ffffff !important;
                                transform: translateY(-3px);
                                box-shadow: 0 10px 20px rgba(243, 101, 35, 0.2);
                            }
                        </style>
                        <div class="tx-btn-wrap">
                            <a href="https://colinacombustibles.com/acerca-de-nosotros/" class="custom-indsro-btn">Conócenos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
