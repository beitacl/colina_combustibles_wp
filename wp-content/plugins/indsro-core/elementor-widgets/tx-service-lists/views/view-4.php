<!-- project start  -->
<div class="fti-project-1-area fti-class-add">

    <div class="fti-project-1-shape-wrap">
        <?php if(!empty( $settings['image_1']['url'] )) : ?>
        <div class="shape-1">
            <img src="<?php echo esc_url($settings['image_1']['url']); ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
        </div>
        <?php endif; ?>

        <?php if(!empty( $settings['image_2']['url'] )) : ?>
        <div class="shape-2">
            <img src="<?php echo esc_url($settings['image_2']['url']); ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
        </div>
        <?php endif; ?>
    </div>

    <!-- title  -->
    <div class="container">
        <div class="fti-project-1-title-wrap">
            <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
            <h6 class="fti-subtitle-2 tx-subTitle"><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></h6>
            <?php
            endif;
                if($settings['enable_title'] === 'yes') {
                $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-1 has-color-white fti-split-text fti-split-in-right-1' );
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
    </div>

    <!-- bg  -->
    <?php if(!empty( $settings['image_3']['url'] )) : ?>
    <div class="fti-project-1-bg-wrap img-cover fix">
        <img src="<?php echo esc_url($settings['image_3']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <!-- slider -->
    <div class="fti-project-1-slider bg-default" data-background="<?php echo $settings['image_4']['url'] ? esc_url($settings['image_4']['url']) : ''; ?>">
        <div class="swiper-container fix fti_project_1_active">
            <div class="swiper-wrapper">

                <!-- single item -->
                <?php foreach($settings['service_lists'] as $list ) : ?>
                <div class="swiper-slide">
                    <div class="fti-project-1-item">
                        <?php if(!empty( $list['image_1']['url'] )) : ?>
                        <div class="project-img-wrap">
                            <img src="<?php echo esc_url($list['image_1']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['image_1']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>

                        <div class="project-title-wrap">
                            <?php if(!empty( $list['cat_name'] )) : ?>
                            <span class="fti-heading-1 project-subtitle">
                                <?php echo elh_element_kses_intermediate( $list['cat_name'] ); ?>
                            </span>
                            <?php endif; ?>

                            <?php if(!empty( $list['title'] )) : ?>
                            <h4 class="fti-heading-1 project-title"><?php echo elh_element_kses_intermediate( $list['title'] ); ?></h4>
                            <?php endif; ?>

                            <?php if(!empty( $list['description'] )) : ?>
                            <p class="fti-para-1 disc"><?php echo elh_element_kses_intermediate( $list['description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>

            <?php if( $settings['enable_slider_nav'] === 'yes' ) : ?>
            <div class="fti-project-1-slider-control">
                <div class="fti-project-1-navigation">
                    <div class="fti_project_1_next">
                        <i class="flaticon-left"></i>
                    </div>
                    <div class="fti_project_1_prev">
                        <i class="flaticon-left"></i>
                    </div>
                </div>
                <span class="line"></span>
                <div class="fti_project_1_pagination"></div>
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<!-- project end -->