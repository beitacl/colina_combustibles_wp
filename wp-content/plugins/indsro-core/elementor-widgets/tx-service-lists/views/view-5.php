<div class="fti-trand-1-area tx-section">
    <div class="container fti-container-3">
        <div class="fti-trand-1-wrap">

            <!-- left  -->
            <div class="fti-trand-1-left">
                <?php
                    if($settings['enable_title'] === 'yes') {
                    $this->add_render_attribute( 'title', 'class', 'tx-title fti-heading-2 title fti-split-text fti-split-in-right-3' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>
                <?php if(!empty( $settings['description'] )) : ?>
                <p class="fti-para-2-small disc"><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                <?php endif; ?>

                <?php if( $settings['enable_client_box'] === 'yes' ) : ?>
                <div class="team">
                    <?php if(!empty( $settings['brand_heading'] )) : ?>
                    <h5 class="fti-heading-2 team-title">
                        <?php echo elh_element_kses_intermediate( $settings['brand_heading'] ); ?>
                    </h5>
                    <?php endif; ?>

                    <div class="team-wrap">
                        <?php
                            foreach ( $settings['brands_image'] as $key => $brand ) :
                            if (!empty($brand['url'])) {
                                $brand_image = $brand['url'];
                            } else {
                                $brand_image = '';
                            }

                            // alt
                            if (!empty($brand['alt'])) {
                                $brand_alt = $brand['alt'];
                            } else {
                                $brand_alt = '';
                            }
                        ?>
                        <div class="img-wrap wow fadeInLeft">
                            <img src="<?php echo $brand_image ? esc_url($brand_image) : ''; ?>" alt="<?php echo esc_attr($brand_alt); ?>">
                        </div>
                        <?php endforeach; ?>

                        <div class="img-wrap team-number wow fadeInLeft">
                            <?php if(!empty( $settings['count_image']['url'] )) : ?>
                            <img src="<?php echo esc_url($settings['count_image']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['count_image']['url'] ); } ?>">
                            <?php endif; ?>

                            <?php if(!empty( $settings['count_number'] )) : ?>
                            <span class="number">
                                <?php echo elh_element_kses_intermediate( $settings['count_number'] ); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- slider   -->
            <div class="fti-trand-1-slider fix">
                <div class="swiper-container fti_trand_1_active">
                    <div class="swiper-wrapper">

                        <?php foreach($settings['service_lists'] as $list ) : ?>
                        <div class="swiper-slide">
                            <div class="fti-trand-1-item">
                                <?php if(!empty( $list['service_icon'] )) : ?>
                                <span class="icon-1">
                                    <?php \Elementor\Icons_Manager::render_icon( $list['service_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <?php endif; ?>

                                <?php if(!empty( $list['title'] )) : ?>
                                <h5 class="fti-heading-2 title"><?php echo elh_element_kses_intermediate( $list['title'] ); ?></h5>
                                <?php endif; ?>

                                <?php if(!empty( $list['description'] )) : ?>
                                <p class="fti-para-2-small disc"><?php echo elh_element_kses_intermediate( $list['description'] ); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- pagination -->
                    <?php if( $settings['enable_slider_nav'] === 'yes' ) : ?>
                    <div class="fti-trand-1-pagination"></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if( $settings['enable_bottom_border'] === 'yes' ) : ?>
        <div class="fti-trand-1-divider"></div>
        <?php endif; ?>
    </div>
</div>