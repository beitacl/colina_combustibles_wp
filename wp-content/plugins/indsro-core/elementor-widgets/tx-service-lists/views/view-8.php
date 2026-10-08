<div class="buil-project-1-area">.
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <img
    class="buil-project-1-bg-img"
    src="<?php echo esc_url($settings['image_1']['url']); ?>"
    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    <?php endif; ?>

    <div class="container-main">
        <div class="buil-project-1-top">
            <div class="buil-project-1-top-title-wrap">
                <?php if(!empty( $settings['sub_title'] )) : ?>
                <h5 class="buil-heading-1 subtitle-1 wow fadeInLeft tx-subTitle">
                    <?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?>
                </h5>
                <?php endif; ?>
                <?php
                    if($settings['enable_title'] === 'yes') {
                        $this->add_render_attribute( 'title', 'class', 'tx-title buil-heading-1 buil-title mt-10 wow flipInX' );
                        $this->add_render_attribute( 'title', 'data-wow-delay', '0.2s' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>
            </div>

            <?php if( $settings['enable_button'] === 'yes' ) : ?>
            <div class="buil-project-1-top-btn-wrap">
                <a
                class="button-primary buil-project-1-btn"
                href="<?php echo esc_url($settings['button_link']['url']); ?>"
                target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                    <?php if(!empty( $settings['button_text'] )) : ?>
                    <span>
                        <?php echo esc_attr($settings['button_text']); ?>
                    </span>
                    <?php endif; ?>
                    <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </a>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- project slider -->
    <div class="project-1-slider">
        <div class="swiper-wrapper">

        <?php foreach($settings['service_lists'] as $list ) : ?>
          <div class="swiper-slide project-1-slite-item">
            <div class="buil-project-1-arrow">
                <a
                href="<?php echo esc_url($list['button_link']['url']); ?>"
                target="<?php echo esc_attr($list['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                rel="<?php echo esc_attr($list['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                class="buil-project-1-arrow-link">
                    <img
                    src="<?php echo esc_url($list['cercle_image']['url']); ?>"
                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['cercle_image']['url'] ); } ?>">
                    <?php \Elementor\Icons_Manager::render_icon( $list['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </a>
            </div>

            <?php if(!empty( $list['service_image']['url'] )) : ?>
            <img class="buil-project-1-slide-img"
            src="<?php echo esc_url($list['service_image']['url']); ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['service_image']['url'] ); } ?>">
            <?php endif; ?>

            <div>
                <?php if(!empty( $list['count'] )) : ?>
                <h2 class="buil-project-1-slide-number" data-swiper-parallax="-100">
                    <?php echo esc_html($list['count']); ?>
                </h2>
                <?php endif; ?>

                <?php if(!empty( $list['title'] )) : ?>
                <h2 class="buil-project-1-slide-title" data-swiper-parallax="-200">
                    <?php echo elh_element_kses_intermediate( $list['title'] ); ?>
                </h2>
                <?php endif; ?>
                <div
                class="text"
                data-swiper-parallax="-300"
                data-swiper-parallax-duration="600"
                >
                <?php if(!empty( $list['description'] )) : ?>
                <p class="buil-project-1-slide-para"><?php echo elh_element_kses_intermediate( $list['description'] ); ?></p>
                <?php endif; ?>
                </div>
            </div>
          </div>
         <?php endforeach; ?>

        </div>
        <!-- swiper slider navigatoer  -->
        <div class="container-main">
            <div class="buil-project-1-navigat-handle">
                <!-- pagination -->
                <div class="project-1-pagination"></div>

                <div class="buil-project-1-slide-divider"></div>
                <div class="buil-project-1-navigate">
                    <div class="buil-project-1-prev">
                        <i class="flaticon_2-right-arrow project-arrow-wrap">
                            <i class="fa-solid fa-arrow-left project-arrow-icon"></i>
                        </i>
                    </div>
                    <div class="buil-project-1-next" >
                        <i class="flaticon_2-right-arrow project-arrow-wrap">
                            <i class="fa-solid fa-arrow-right project-arrow-icon"></i>
                            </i>
                    </div>
                </div>
            </div>
          </div>

      </div>
</div>