<div class="fti-hero-4-area bg-default" data-background="<?php echo $settings['image_1']['url'] ? esc_url($settings['image_1']['url']) : ''; ?>">
    <!-- top title content  -->
    <div class="container fti-container-9">
        <div class="fti-hero-4-title-wrap">
            <?php
                if($settings['enable_title'] === 'yes') {
                $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-5 has-size-60 has-color-white hero-4-title fti-split-text fti-split-in-right-4' );
                    printf('<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        elh_element_kses_basic( $settings['title'] )
                    );
                }
            ?>
            <div class="content">
                <?php if( $settings['enable_count_box'] === 'yes' ) : ?>
                <div class="counter-wrap">
                    <h2 class="number"><span class="counter"><?php echo esc_html($settings['count_number']); ?></span><?php echo esc_html($settings['count_prefix']); ?></h2>
                    <?php if(!empty( $settings['count_title'] )) : ?>
                    <h5 class="counter-title"><?php echo elh_element_kses_intermediate($settings['count_title']); ?></h5>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if( $settings['enable_description'] === 'yes' ) : ?>
                <p class="fti-para-4 disc"><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- slider -->
    <div class="fti-hero-4-slider">
        <div class="swiper-container fti_hero_4_active fix">
            <div class="swiper-wrapper">

                <?php foreach ( $settings['slides'] as $slide ) : ?>
                <div class="swiper-slide">
                    <div class="fti-hero-4-item fix">
                        <?php if( $settings['enable_overley_shape'] === 'yes' ) : ?>
                        <div class="bg-overley">
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty( $slide['image_1']['url'] )) : ?>
                        <div class="main-img img-cover">
                            <img
                            src="<?php echo esc_url($slide['image_1']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $slide['image_1']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>

                        <?php if(!empty( $slide['description'] )) : ?>
                        <span class="fti-para-4 disc">
                            <?php echo elh_element_kses_intermediate( $slide['description'] ); ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- slider pagination -->
            <?php if( $settings['enable_slider_navigation'] === 'yes' ) : ?>
            <div class="fti-hero-4-pagination-wrap">
                <div class="fti-hero-4-pagination"></div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>