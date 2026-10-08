<div class="fti-choose-1-area fix tx-section">
    <div class="fti-choose-1-shape-wrap">
        <div class="shape-img-wrap">
            <?php if(!empty( $settings['image_1']['url'] )) : ?>
            <div class="shape-1">
                <img
                src="<?php echo esc_url($settings['image_1']['url']); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
            </div>
            <?php endif; ?>

            <?php if(!empty( $settings['image_2']['url'] )) : ?>
            <div class="shape-2">
                <img
                src="<?php echo esc_url($settings['image_2']['url']); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="container">
        <!-- title -->
        <div class="fti-choose-1-title-wrap">
            <div class="title-left">
                <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                <h5 class="fti-subtitle-1 tx-subTitle"><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></h5>
                <?php
                endif;
                    if($settings['enable_title'] === 'yes') {
                    $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-1 fti-split-text fti-split-in-right-1' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>
            </div>
            <?php if( $settings['enable_description'] === 'yes' ) : ?>
            <p class="fti-para-1 disc tx-description"><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
            <?php endif; ?>
        </div>
        <!-- content -->
        <div class="fti-choose-1-wrap">
            <div class="fti-choose-1-left">
                <?php if( $settings['enable_feature_lists'] === 'yes' ) :
                    foreach( $settings['feature_lists'] as $list ) :
                    $active = $list['is_active'] === 'yes' ? 'active' : '';
                ?>
                <div class="fti_left_slide_1">
                    <div class="choose-item <?php echo esc_attr($active); ?>">
                        <?php if( $list['enable_icon'] === 'yes' ) : ?>
                        <span class="icon-1">
                            <?php if( $list['type'] === 'icon' ) : ?>
                                <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
                            <?php endif; ?>
                        </span>
                        <?php endif; ?>
                        <div class="choose-item-title-wrap">
                            <?php if(!empty( $list['feature_title'] )) : ?>
                            <h5 class="fti-heading-1 title"><?php echo elh_element_kses_intermediate($list['feature_title']); ?></h5>
                            <?php endif; ?>

                            <?php if(!empty( $list['feature_description'] )) : ?>
                            <p class="fti-para-1-small"><?php echo elh_element_kses_intermediate($list['feature_description']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; endif; ?>

                <?php if( $settings['enable_button'] === 'yes' ) : ?>
                <div class="btn-wrap">
                    <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
                    target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                    rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>" class="fti-btn-pr-1 tx-button">
                        <?php
                            if($settings['enable_button_icon'] === 'yes') {
                                \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'class' => 'icon-1', 'aria-hidden' => 'true' ] );
                            }
                        ?>
                        <span class="btn-text">
                            <?php echo esc_html( $settings['button_text'] ); ?>
                        </span>
                        <?php
                            if($settings['enable_button_icon'] === 'yes') {
                                \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'class' => 'icon-2', 'aria-hidden' => 'true' ] );
                            }
                        ?>
                    </a>
                </div>
                <?php endif; ?>

            </div>

            <div class="fti-choose-1-right fti-class-add">

                <?php if(!empty( $settings['image_3']['url'] )) : ?>
                <div class="img-wrap-1 img-cover">
                    <img src="<?php echo esc_url($settings['image_3']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
                </div>
                <?php endif; ?>

                <?php if(!empty( $settings['image_4']['url'] )) : ?>
                <div class="img-wrap-2 img-cover asslideupcta">
                    <img src="<?php echo esc_url($settings['image_4']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_4']['url'] ); } ?>">
                </div>
                <?php endif; ?>

                <?php if( $settings['enable_progress_bars'] === 'yes' ) : ?>
                <div class="choose-progress">
                    <?php foreach($settings['progress_bars'] as $list) : ?>
                    <div class="choose-set-percent">
                        <?php if(!empty( $list['progress_title'] )) : ?>
                        <h6 class="fti-heading-1 title">
                            <?php echo elh_element_kses_intermediate($list['progress_title']); ?>
                        </h6>
                        <?php endif; ?>

                        <?php if(!empty( $list['progress_number'] )) : ?>
                        <div class="progress">
                            <div class="progress-bar" data-percent="<?php echo esc_attr($list['progress_number']); ?>"></div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>