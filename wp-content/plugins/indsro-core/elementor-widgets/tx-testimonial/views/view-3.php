<div class="fti-testimonial-1-area">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="main-bg">
        <img
        src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="fti-testimonial-1-wrap">
            <div class="fti-testimonial-1-slider">
                <div class="swiper-container chy_testimonial_5_active">
                    <div class="swiper-wrapper">

                        <!-- single-item -->
                        <?php foreach($settings['testimonial_lists'] as $list) : ?>
                        <div class="swiper-slide">
                            <div class="fti-testimonial-1-item">
                                <?php if(!empty( $list['author_image']['url'] )) : ?>
                                <div class="main-img">
                                    <img
                                    src="<?php echo esc_url($list['author_image']['url']); ?>"
                                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['author_image']['url'] ); } ?>">
                                </div>
                                <?php endif; ?>
                                <div class="content-wrap">
                                    <div class="comment-wrap">
                                        <?php if( $list['enable_icon'] === 'yes' ) : ?>
                                        <span class="icon-1">
                                            <?php if( $list['type'] === 'quote' ) : ?>
                                                <?php \Elementor\Icons_Manager::render_icon( $list['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            <?php else : ?>
                                                <img src="<?php echo esc_url( $list['quote_image']['url'] ); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['quote_image']['url'] ); } ?>">
                                            <?php endif; ?>
                                        </span>
                                        <?php endif; ?>

                                        <?php if(!empty( $list['comment'] )) : ?>
                                        <blockquote class="fti-para-1-large comment-text">
                                            <?php echo elh_element_kses_intermediate($list['comment']); ?>
                                        </blockquote>
                                        <?php endif; ?>

                                        <?php if( $list['enable_rating'] === 'yes' ) : ?>
                                        <div class="rating">
                                            <?php
                                                $rating = $list['rating_star'];
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i <= $rating) {
                                                        echo '<i class="flaticon-star"></i>';
                                                    } else {
                                                        echo '<i class="fa-solid fa-star-empty"></i>';
                                                    }
                                                }
                                            ?>
                                        </div>
                                        <?php endif; ?>

                                        <?php if(!empty( $list['name'] || $list['designation'] )) : ?>
                                        <span class="fti-heading-1 name">
                                            <?php echo elh_element_kses_intermediate($list['name']); ?>
                                            <?php if(!empty( $list['designation'] )) : ?>
                                            <span class="bio"><?php echo elh_element_kses_intermediate($list['designation']); ?></span>
                                            <?php endif; ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

            <div class="fti-testimonial-1-preview">
                <div class="swiper-container chy_t5_preview_active">
                    <div class="swiper-wrapper">

                        <?php foreach($settings['testimonial_lists'] as $list) : ?>
                        <div class="swiper-slide">
                            <?php if(!empty( $list['author_image']['url'] )) : ?>
                            <div class="fti-t1-preview-item">
                                <img
                                src="<?php echo esc_url($list['author_image']['url']); ?>"
                                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['author_image']['url'] ); } ?>">
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>