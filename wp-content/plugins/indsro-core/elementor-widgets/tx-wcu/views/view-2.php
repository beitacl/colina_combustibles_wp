<section class="log-why-choose-section-6 pt-70 pb-120 tx-section" data-background="<?php echo esc_url($settings['image_1']['url']) ? esc_url($settings['image_1']['url']) : '' ; ?>">
    <div class="container">
        <div class="log-section-title-5 text-center headline pera-content">
            <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
            <div class="subtitle text-uppercase wow fadeInRight tx-subTitle"  data-wow-delay="300ms" data-wow-duration="1000ms">
                <?php if( $settings['enable_sub_title_icon'] === 'yes' ) : ?>
                    <?php if( $settings['sub_title_icon_type'] === 'icon' ) : ?>
                        <?php \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url( $settings['sub_title_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['list_image']['alt'] ); ?>">
                    <?php endif; ?>
                <?php endif; ?>
                <?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?>
            </div>
            <?php endif; ?>

            <?php
                if($settings['enable_title'] === 'yes') {
                $this->add_render_attribute( 'title', 'class', 'tx-title section_title tx-split-text split-in-right' );
                    printf('<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        elh_element_kses_basic( $settings['title'] )
                    );
                }
            ?>

            <?php if( $settings['enable_description'] === 'yes' ) : ?>
            <p class="tx-description">
                <?php echo elh_element_kses_intermediate($settings['description']); ?>
            </p>
            <?php endif; ?>
        </div>
        <div class="log-why-choose-content-6 mt-50 position-relative">
            <?php if(!empty( $settings['image_2']['url'] )) : ?>
            <span class="log-why-circle-img scale_view position-absolute">
                <img
                src="<?php echo esc_url($settings['image_2']['url']); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
            </span>
            <?php endif; ?>
            <div class="row">
                <?php if( $settings['enable_feature_boxs'] === 'yes' ) : ?>
                <div class="col-md-6">
                    <div class="log-why-choose-item-content-1 justify-content-start">
                        <div class="wc-item-wrap">

                            <?php foreach($settings['feature_boxs'] as $list ) : ?>
                            <div class="log-wc-item-6 rotate_view">
                                <?php if( $list['enable_icon'] === 'yes' ) : ?>
                                <div class="item-icon">
                                    <?php if( $list['type'] === 'icon' ) : ?>
                                        <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>

                                <div class="item-text headline-2 pera-content">
                                    <?php if(!empty( $list['list_title'] )) : ?>
                                    <h3>
                                        <a href="<?php echo esc_url($list['link']['url']); ?>">
                                            <?php echo elh_element_kses_intermediate( $list['list_title'] ); ?>
                                        </a>
                                    </h3>
                                    <?php endif; ?>

                                    <?php if(!empty( $list['list_description'] )) : ?>
                                    <p><?php echo elh_element_kses_intermediate( $list['list_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if( $settings['enable_feature_boxs_2'] === 'yes' ) : ?>
                <div class="col-md-6">
                    <div class="log-why-choose-item-content-2 d-flex justify-content-end">
                        <div class="wc-item-wrap">

                            <?php foreach($settings['feature_boxs_2'] as $list ) : ?>
                            <div class="log-wc-item-6 rotate_view">
                                <?php if( $list['enable_icon'] === 'yes' ) : ?>
                                <div class="item-icon">
                                    <?php if( $list['type'] === 'icon' ) : ?>
                                        <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>

                                <div class="item-text headline-2 pera-content">
                                    <?php if(!empty( $list['list_title'] )) : ?>
                                    <h3>
                                        <a href="<?php echo esc_url($list['link']['url']); ?>">
                                            <?php echo elh_element_kses_intermediate( $list['list_title'] ); ?>
                                        </a>
                                    </h3>
                                    <?php endif; ?>

                                    <?php if(!empty( $list['list_description'] )) : ?>
                                    <p><?php echo elh_element_kses_intermediate( $list['list_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>