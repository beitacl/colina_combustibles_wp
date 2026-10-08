<div class="gly-project-2-area fix">
    <div class="gly-project-2-slider">
        <div class="swiper-container gly-p2-active fix">
            <div class="swiper-wrapper">

                <?php foreach($settings['project_lists'] as $list):?>
                <div class="swiper-slide">
                    <div class="gly-project-2-item img-cover">
                        <?php if(!empty( $list['project_img']['url'] )) : ?>
                        <img src="<?php echo esc_url($list['project_img']['url']);?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['project_img']['url'] ); } ?>">
                        <?php endif;?>

                        <div class="gly-project-2-item-content">
                            <div class="left">
                                <?php if(!empty($list['category'])): ?>
                                <h6 class="gly-heading-1 has-white gly-font-600 subtitle">
                                    <?php echo elh_element_kses_intermediate($list['category']);?>
                                </h6>
                                <?php endif;?>

                                <?php if(!empty( $list['title'] )) : ?>
                                <h5 class="gly-heading-2 gly-font-800 title" >
                                    <a
                                    href="<?php echo esc_url($list['list_link']['url']);?>"
                                    target="<?php echo esc_attr($list['list_link']['is_external'] ? '_blank' : '_self');?>"
                                    rel="<?php echo esc_attr($list['list_link']['nofollow'] ? 'nofollow' : '');?>"
                                    aria-label="name">
                                        <?php echo elh_element_kses_intermediate($list['title']);?>
                                    </a>
                                </h5>
                                <?php endif;?>
                            </div>

                            <?php if(!empty( $list['button_icon'] )) : ?>
                            <div class="right">
                                <a
                                href="<?php echo esc_url($list['list_link']['url']);?>"
                                target="<?php echo esc_attr($list['list_link']['is_external'] ? '_blank' : '_self');?>"
                                rel="<?php echo esc_attr($list['list_link']['nofollow'] ? 'nofollow' : '');?>"
                                 aria-label="name" class="gly-project-2-item-btn">
                                 <?php \Elementor\Icons_Manager::render_icon( $list['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </a>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>

        <?php if( $settings['enable_slider_nav'] === 'yes' ) : ?>
        <div class="gly-project-2-slider-btn">
            <div class="gly-slider-btn-1 gly_p2_prev">
                <i class="fa-solid fa-arrow-left-long"></i>
            </div>
            <div class="gly-slider-btn-1 gly_p2_next">
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
        <?php endif;?>

    </div>
</div>