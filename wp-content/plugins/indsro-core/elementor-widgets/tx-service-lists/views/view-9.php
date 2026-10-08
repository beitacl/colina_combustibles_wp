<div class="buil-service-2-area" data-background="<?php echo $settings['image_1']['url'] ? esc_url($settings['image_1']['url']) : '' ?>">

    <?php if(!empty( $settings['image_2']['url'] )) : ?>
    <img
    class="buil-service-2-img-1 wow fadeInRight"
    src="<?php echo esc_url($settings['image_2']['url']); ?>"
    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    <?php endif; ?>

    <div class="container-2">
        <div class="buil-service-2-top-wrap">
            <div class="buil-serive-2-left">
                <div class="buil-2-sub">
                    <?php if(!empty( $settings['sub_title'] )) : ?>
                    <div class="buil-2-subtitle-wrap tx-subTitle">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] );?>
                        <h6><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></h6>
                    </div>
                    <?php endif; ?>
                </div>

                <?php
                    if($settings['enable_title'] === 'yes') {
                        $this->add_render_attribute( 'title', 'class', 'tx-title buil-heading-1 buil-title tx-split-text split-in-right' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>
            </div>

            <?php if( $settings['enable_description'] === 'yes' ) : ?>
            <p class="buil-service-2-para">
                <?php echo elh_element_kses_intermediate( $settings['description'] ); ?>
            </p>
            <?php endif; ?>
        </div>
    </div>

    <div class="service-2-slider">
        <div class="swiper-wrapper">

            <!-- slide item  -->

            <?php
            $id = 0;

            foreach($settings['service_lists'] as $list ) :
            $id++;
            ?>
            <div class="swiper-slide">
                <div class="buil-serivce-2-slide-item">

                    <?php if(!empty( $list['service_image']['url'] )) : ?>
                    <img class="buil-service-2-slide-img buil-service-2-slide-img-<?php echo esc_attr($id); ?>"
                    src="<?php echo esc_url($list['service_image']['url']); ?>"
                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['service_image']['url'] ); } ?>">
                    <?php endif; ?>

                    <?php if(!empty( $list['title'] )) : ?>
                    <h4 class="buil-service-2-slide-title">
                        <?php echo elh_element_kses_intermediate( $list['title'] ); ?>
                    </h4>
                    <?php endif; ?>

                    <?php \Elementor\Icons_Manager::render_icon( $list['icon_2'], [ 'class' => 'buil-service-2-icon-1','aria-hidden' => 'true' ] ); ?>

                    <?php if(!empty( $list['button_icon'] )) : ?>
                    <a href="<?php echo esc_url($list['button_link']['url']); ?>"
                    target="<?php echo esc_attr($list['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                    rel="<?php echo esc_attr($list['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                        <?php \Elementor\Icons_Manager::render_icon( $list['button_icon'], [ 'class' => 'buil-service-2-icon-2','aria-hidden' => 'true' ] ); ?>
                    </a>
                    <?php endif; ?>

                    <?php if(!empty( $list['description'] )) : ?>
                    <p class="buil-service-2-slide-para"><?php echo elh_element_kses_intermediate( $list['description'] ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php  endforeach; ?>
        </div>
    </div>
    <?php if( $settings['enable_info_text'] === 'yes' ) : ?>
    <div class="buil-service-2-bottom-para">
        <?php echo wp_kses($settings['info_text'], true);?>
    </div>
    <?php endif; ?>
</div>