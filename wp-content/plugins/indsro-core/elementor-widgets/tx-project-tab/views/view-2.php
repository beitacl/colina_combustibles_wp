<?php
$rand = rand(0, 9999);
?>
<div class="blta-categories-2-area tx-section">

    <?php if(!empty( $settings['bg_image']['url'] )) : ?>
    <div class="blta-categories-2-bg img-cover fix image-pllx">
        <img
        src="<?php echo esc_url($settings['bg_image']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['bg_image']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <div class="container blta-container-1">

        <!-- section-title -->
        <div class="blta-categories-2-section-title mb-45 tx-heading-section text-center">
            <?php if( $settings['enable_sub_title_icon'] === 'yes' ) : ?>
            <div class="icon blta-scale-plus mb-25 tx-subTitle">
                <?php \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] );?>
            </div>
            <?php endif; ?>

            <?php if(!empty( $settings['sub_title'] )) : ?>
            <h5 class="blta-subtitle-1 font-700 text-uppercase pr-font has-color-white">
                <?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?>
            </h5>
            <?php endif; ?>

            <?php
                if($settings['enable_title'] === 'yes') {
                $this->add_render_attribute( 'title', 'class', 'tx-title blta-section-title-1 blta-split-text split-in-left has-color-white' );
                    printf('<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        elh_element_kses_basic( $settings['title'] )
                    );
                }
            ?>
        </div>

        <div class="row">

            <!-- left-img -->
            <div class="col-lg-6">
                <div class="blta-categories-2-left">
                    <?php if(!empty( $settings['image_1']['url'] )) : ?>
                    <div class="blta-categories-2-img fix img-cover blta-img blta-ani-threed">
                        <img
                        src="<?php echo esc_url($settings['image_1']['url']); ?>"
                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
                    </div>
                    <?php endif; ?>

                    <?php if(!empty( $settings['info_text'] )) : ?>
                    <h4 class="blta-categories-2-pop-card blta-heading-1 font-800 blta-img-2">
                        <?php echo elh_element_kses_intermediate($settings['info_text']); ?>
                    </h4>
                    <?php endif; ?>
                </div>
            </div>

            <!-- right-content -->
            <div class="col-lg-6">
                <div class="blta-categories-2-right">

                    <!-- tabs-btn -->
                    <div class="blta-categories-2-tabs-btn d-flex flex-wrap mb-30" id="buil-constro-3-<?php echo esc_attr($rand); ?>" role="tablist">
                        <?php
                            foreach ($settings['projectTab_lists'] as $id => $list):
                            $is_active = $list['is_active'] == 'yes' ? 'active' : '';
                            $aria_selected = $list['is_active'] == 'yes' ? 'true' : 'false';
                        ?>
                        <div role="presentation">
                            <button class="tabs-btn blta-heading-1 font-700 <?php echo esc_attr($is_active); ?>"
                            id="projectTab-<?php echo esc_attr($id. '_' .$rand); ?>"
                            data-bs-toggle="tab"
                            data-bs-target="#tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                            type="button"
                            role="tab"
                            aria-controls="tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                            aria-selected="<?php echo esc_attr($aria_selected); ?>">
                            <?php echo elh_element_kses_intermediate($list['tab_title']); ?>
                            </button>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- tabs-content -->
                    <div class="tab-content blta-categories-2-tabs-content" id="buil-constro-3-<?php echo esc_attr($rand); ?>">
                        <?php
                            foreach ($settings['projectTab_lists'] as $id => $list):
                            $is_active = $list['is_active'] == 'yes' ? 'show active' : '';
                        ?>
                        <div class="tab-pane tabs-content fade <?php echo esc_attr($is_active); ?>"
                        id="tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                        role="tabpanel"
                        aria-labelledby="projectTab-<?php echo esc_attr($id. '_' .$rand); ?>">
                            <?php if(!empty( $list['tab_content_description'] )) : ?>
                            <p class="blta-para-1 item-disc">
                                <?php echo elh_element_kses_intermediate($list['tab_content_description']); ?>
                            </p>
                            <?php endif; ?>

                            <?php if( $list['enable_feature_lists'] === 'yes' ) : ?>
                            <ul class="blta-list-1 list-unstyled">
                                <?php if(!empty( $list['feature_heading'] )) : ?>
                                <li class="blta-list-1-title blta-heading-1 has-color-white font-800">
                                    <?php echo elh_element_kses_intermediate($list['feature_heading']); ?>
                                </li>
                                <?php endif; ?>

                                <?php
                                    $list_item = $list['tab_content_lists'];
                                    $list_item = explode("\n", ($list_item));
                                    foreach($list_item as $feature_list):
                                ?>
                                <li class="blta-list-1-item blta-para-1">
                                    <?php echo wp_kses($feature_list, true)?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>

                            <?php if( $list['enable_count_lists'] === 'yes' ) : ?>
                            <div class="blta-categories-2-counter-flex d-flex">
                                <?php foreach($list['tab_count_lists'] as $count_list ): ?>
                                <div class="blta-categories-2-counter-item">
                                    <?php if(!empty( $count_list['count_number'] )) : ?>
                                    <h2 class="item-title blta-heading-1 font-800" >
                                        <?php echo esc_html($count_list['count_number']); ?><?php echo esc_html($count_list['count_prefix']); ?>
                                    </h2>
                                    <?php endif; ?>
                                    <h5 class="item-para blta-heading-1 font-800 has-color-white">
                                        <?php echo elh_element_kses_intermediate($count_list['count_title']); ?>
                                    </h5>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(!empty( $settings['image_2']['url'] )) : ?>
    <div class="blta-categories-2-il fix blta-fade-down">
        <img
        src="<?php echo esc_url($settings['image_2']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    </div>
    <?php endif; ?>
</div>