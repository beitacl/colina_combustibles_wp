<?php
    $rand = rand(1000, 9999);
?>
<div class="blta-testimonial-3-area fix pt-110 pb-70">
    <?php if(!empty( $settings['bg_image']['url'] )) : ?>
    <div class="blta-testimonial-3-bg img-cover fix image-pllx">
        <img
        src="<?php echo esc_url($settings['bg_image']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['bg_image']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <div class="container blta-container-1">

        <!-- tabs-btn-&-slider-btn -->
        <div class="row align-items-center">
            <!-- section-title -->
            <div class="col-lg-6">
                <div class="blta-testimonial-3-scn-title">
                <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                    <h5 class="tx-subTitle blta-subtitle-1 font-600 text-capitalize pr-font has-color-white">
                        <?php if( $settings['enable_sub_title_icon'] === 'yes' ) : ?>
                        <span class="icon has-color-2">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] );?>
                        </span>
                        <?php endif; ?>

                        <?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?>
                    </h5>
                    <?php endif; ?>

                    <?php
                        if($settings['enable_title'] === 'yes') {
                        $this->add_render_attribute( 'title', 'class', 'tx-title blta-section-title-1  has-color-white blta-split-text split-in-left' );
                            printf('<%1$s %2$s>%3$s</%1$s>',
                                tag_escape($settings['title_tag']),
                                $this->get_render_attribute_string('title'),
                                elh_element_kses_basic( $settings['title'] )
                            );
                        }
                    ?>
                </div>
            </div>

            <!-- tabs-btn -->
            <div class="col-lg-6">
                <div class="blta-testimonial-3-tabs-and-btn d-flex align-items-center justify-content-between">
                    <!-- tabs -->
                    <div class="blta-testimonial-3-tabs-btn d-flex align-items-center flex-wrap" role="tablist">
                        <?php
                            foreach ($settings['projectTab_lists'] as $id => $list):
                            $is_active = $list['is_active'] == 'yes' ? 'active' : '';
                            $aria_selected = $list['is_active'] == 'yes' ? 'true' : 'false';
                        ?>
                        <button
                        class="nav-link <?php echo esc_attr($is_active); ?> blta-heading-1 font-600 has-color-2"
                        id="pricingTab-<?php echo esc_attr($id. '_' .$rand); ?>"
                        data-bs-toggle="tab"
                        data-bs-target="#tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                        type="button"
                        role="tab"
                        aria-controls="tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                        aria-selected="<?php echo esc_attr($aria_selected); ?>">
                        <?php echo elh_element_kses_intermediate($list['tab_title']); ?>
                        </button>
                        <?php endforeach; ?>
                    </div>

                    <!-- slider-btn -->
                    <?php if( $settings['enable_slider_nav'] === 'yes' ) : ?>
                    <div class="blta-testimonial-3-slider-btn d-flex align-items-center">
                        <div class="blta-slider-btn-1 testimonial_3_prev" >
                            <i class="far fa-long-arrow-left"></i>
                        </div>
                        <div class="blta-slider-btn-1 testimonial_3_next" >
                            <i class="far fa-long-arrow-right"></i>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- tabs-content -->
        <div class="tab-content blta-testimonial-3-tabs-content" id="nav-<?php echo esc_attr($rand); ?>">
            <?php
                foreach ($settings['projectTab_lists'] as $id => $list):
                $is_active = $list['is_active'] == 'yes' ? 'show active' : '';
            ?>
            <div class="tab-pane fade <?php echo esc_attr($is_active); ?>"
            id="tab-<?php echo esc_attr($id. '_' .$rand); ?>"
            role="tabpanel"
            aria-labelledby="pricingTab-<?php echo esc_attr($id. '_' .$rand); ?>">
                <?php echo \ElementHelper::$elementor_instance->frontend->get_builder_content($list['template'], true); ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>