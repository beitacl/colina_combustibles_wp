<div class="fti-team-2-area">
    <?php if(!empty( $settings['team_image']['url'] )) : ?>
    <div class="main-bg">
        <img
        src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>
    <div class="container fti-container-6">
        <!-- title -->
        <div class="fti-team-2-title-wrap">
            <h5 class="fti-subtitle-3 has-both-line"><span class="line subtitle-line-1"></span> our members<span class="line-2 subtitle-line-2"></span></h5>
            <h2 class="fti-section-title-3 fti-split-text fti-split-in-right-3">Meet Our Team Members</h2>
        </div>
        <div class="fti-team-2-wrap">
            <!-- slider -->
            <div class="swiper-container fix fti_team_2_active">
                <div class="swiper-wrapper">

                    <?php foreach($settings['team_lists'] as $list ) : ?>
                    <div class="swiper-slide">
                        <div class="fti-team-2-membar text-center">
                            <?php if(!empty( $list['team_image']['url'] )) : ?>
                            <div class="fti-team-2-membar-img-wrap mb-20">
                                <div class="fti-team-2-membar-img">
                                    <img class="main-img"
                                        src="<?php echo esc_url($list['team_image']['url']); ?>"
                                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['team_image']['url'] ); } ?>">
                                </div>
                                <div class="fti-team-2-membar-img-shape">
                                    <?php if(!empty( $settings['image_2']['url'] )) : ?>
                                    <img class="img-shape-1"
                                        src="<?php echo esc_url($settings['image_2']['url']); ?>"
                                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
                                    <?php endif; ?>

                                    <?php if(!empty( $settings['image_3']['url'] )) : ?>
                                    <img class="img-shape-2"
                                        src="<?php echo esc_url($settings['image_3']['url']); ?>"
                                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if(!empty( $list['name'] )) : ?>
                            <h4 class="fti-team-2-membar-name fti-heading-2">
                                <a
                                    href="<?php echo esc_url($list['link']['url']); ?>"
                                    target="<?php echo esc_attr($list['link']['is_external'] ? '_blank' : '_self'); ?>"
                                    rel="<?php echo esc_attr($list['link']['nofollow'] ? 'nofollow' : ''); ?>">
                                    <?php echo elh_element_kses_intermediate( $list['name'] ); ?>
                                </a>
                            </h4>
                            <?php endif; ?>

                            <?php if(!empty( $list['designation'] )) : ?>
                            <span class="fti-para-2 fti-team-2-membar-bio"><?php echo elh_element_kses_intermediate( $list['designation'] ); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>

            <!-- navigation -->
            <div class="fti-team-2-navigation">
                <div class="fti_team_2_prev">
                    <i class="flaticon-left"></i>
                </div>
                <div class="fti_team_2_next">
                    <i class="flaticon-left"></i>
                </div>
            </div>
        </div>
    </div>
</div>