<div class="buil-project-2-area tx-section">
    <!-- top  -->
    <div class="container-2">
        <div class="buil-project-2-top-wrap">
            <?php if(!empty( $settings['sub_title'] )) : ?>
            <div class="buil-2-sub">
                <div class="buil-2-subtitle-wrap tx-subTitle">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] );?>
                    <h6><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></h6>
                </div>
            </div>
            <?php endif; ?>

            <?php
                if($settings['enable_title'] === 'yes') {
                    $this->add_render_attribute( 'title', 'class', 'tx-title buil-heading-1 buil-title tx-split-text split-in-up' );
                    printf('<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        elh_element_kses_basic( $settings['title'] )
                    );
                }
            ?>
        </div>
    </div>

    <div class="project-2-slider">
        <div class="swiper-wrapper">

            <!-- slide item  -->
            <?php foreach($settings['service_lists'] as $list ) : ?>
            <div class="swiper-slide">
                <div class="buil-project-2-slide-item">
                    <?php if(!empty( $list['service_image']['url'] )) : ?>
                    <img class="buil-project-2-slide-img"
                    src="<?php echo esc_url($list['service_image']['url']); ?>"
                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['service_image']['url'] ); } ?>">
                    <?php endif; ?>
                    <div class="buil-project-2-slide-cont-wrap">
                        <div class="buil-project-2-slide-cont">
                            <?php if(!empty( $list['title'] )) : ?>
                            <h6 class="buil-heading-1"><?php echo elh_element_kses_intermediate( $list['title'] ); ?></h6>
                            <?php endif; ?>

                            <?php if(!empty( $list['description'] )) : ?>
                            <h4 class="buil-heading-1"><?php echo elh_element_kses_intermediate( $list['description'] ); ?></h4>
                            <?php endif; ?>
                        </div>

                        <a class="buil-project-2-slide-icon-wrap"
                        href="<?php echo esc_url($list['button_link']['url']); ?>"
                        target="<?php echo esc_attr($list['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                        rel="<?php echo esc_attr($list['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                            <?php \Elementor\Icons_Manager::render_icon( $list['button_icon'], [ 'class' => 'buil-service-2-icon-2','aria-hidden' => 'true' ] ); ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php  endforeach; ?>

        </div>

        <?php if( $settings['enable_slider_nav'] === 'yes' ) : ?>
        <div class="buil-project-2-navigat-handle">
            <div class="project-2-pagination swiper-pagination-fraction swiper-pagination-horizontal">
                <span class="swiper-pagination-current">1</span> / <span class="swiper-pagination-total">4</span>
            </div>

            <div class="buil-project-2-slide-divider"></div>
            <div class="buil-project-2-navigate">
                <div class="buil-project-2-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-cbc91010a9b35fd6f0">
                    <i class="flaticon_2-right-arrow buil-project-2-arrow-wrap">
                        <i class="fa-solid fa-arrow-left buil-project-2-arrow-icon"></i>
                    </i>
                </div>
                <div class="buil-project-2-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-cbc91010a9b35fd6f0">
                    <i class="flaticon_2-right-arrow buil-project-2-arrow-wrap">
                        <i class="fa-solid fa-arrow-right buil-project-2-arrow-icon"></i>
                    </i>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

</div>