<!-- trusted-start -->
<div class="chy-trusted-1-area ">
    <div class="container chy-container-1">
        <div class="chy-trusted-1-wrap">

            <div class="chy-trusted-1-item">
                <h3 class="chy-trusted-1-title chy-heading-1">
                    <?php echo elh_element_kses_intermediate($settings['title']); ?>
                    <?php if(!empty( $settings['title_image_1']['url'] )) : ?>
                    <span class="icon-1"><img src="<?php echo esc_url($settings['title_image_1']['url']); ?>" alt=""></span>
                    <?php endif; ?>

                    <?php if(!empty( $settings['title_image_2']['url'] )) : ?>
                    <span class="icon-2"><img src="<?php echo esc_url($settings['title_image_2']['url']); ?>" alt=""></span>
                    <?php endif; ?>
                    <?php echo elh_element_kses_intermediate($settings['title_2']); ?>

                    <?php if(!empty( $settings['title_image_3']['url'] )) : ?>
                    <span class="icon-1"><img src="<?php echo esc_url($settings['title_image_3']['url']); ?>" alt=""></span>
                    <?php endif; ?>

                    <?php if(!empty( $settings['title_image_4']['url'] )) : ?>
                    <span class="icon-2"><img src="<?php echo esc_url($settings['title_image_4']['url']); ?>" alt=""></span>
                    <?php endif; ?>
                </h3>
            </div>

            <div class="chy-trusted-1-item img-cover">
                <div class="chy-trusted-1-video">
                    <?php if(!empty( $settings['video_image']['url'] )) : ?>
                    <img src="<?php echo esc_url($settings['video_image']['url']); ?>" alt="">
                    <?php endif; ?>

                    <?php if( $settings['enable_video_button'] === 'yes' ) : ?>
                    <a class="chy-plybtn-1 popup-video" href="<?php echo esc_url($settings['video_link']['url']); ?>" >
                        <span class="icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['video_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="chy-trusted-1-item">
                <div class="chy-trusted-1-reating">
                    <div class="icon">
                        <?php
                            for ( $i = 0; $i < $settings['select_rating']; $i++ ) {
                                echo '<i class="fa-solid fa-star"></i>';
                            }
                        ?>
                    </div>
                    <span class="line"></span>
                    <?php if(!empty( $settings['rating_text'] )) : ?>
                    <h4 class="chy-heading-1 text">
                        <?php echo elh_element_kses_intermediate($settings['rating_text']); ?>
                    </h4>
                    <?php endif; ?>
                </div>
            </div>

            <div class="chy-trusted-1-item">
                <div class="chy-trusted-1-progress">
                    <?php if(!empty( $settings['traffic_title'] )) : ?>
                    <h4 class="chy-heading-1 title">
                        <?php echo elh_element_kses_intermediate($settings['traffic_title']); ?>
                    </h4>
                    <?php endif; ?>
                    <span class="line"></span>
                    <h3 class="chy-heading-1 number">
                       <?php if(!empty($settings['traffic_number'])) : ?> <span class="counter txCounterActive"><?php echo esc_html( $settings['traffic_number'] ); ?></span> <?php endif; ?><?php echo esc_html($settings['traffic_number_prefix']); ?>
                    </h3>
                    <div class="chy-trusted-1-progress-item chy-class-add">
                        <?php if(!empty( $settings['traffic_progress_title'] )) : ?>
                        <h5 class="chy-heading-1 title">
                            <?php echo elh_element_kses_intermediate($settings['traffic_progress_title']); ?>
                        </h5>
                        <?php endif; ?>

                        <?php if(!empty( $settings['traffic_progress_percent'] )) : ?>
                        <div class="line">
                            <span class="line-fill" data-width="<?php echo esc_attr($settings['traffic_progress_percent']); ?>"></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- trusted-end -->