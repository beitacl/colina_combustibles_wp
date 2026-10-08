<div class="blta-team-2-area fix pt-140 pb-130 tx-section">

    <div class="container blta-container-1">
        <!-- section-title -->
        <div class="blta-services-2-section-title mb-35 text-center">
            <?php if( $settings['enable_sub_title_icon'] === 'yes' ) : ?>
            <div class="icon blta-scale-plus mb-25">
                <?php \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] );?>
            </div>
            <?php endif; ?>

            <?php if(!empty( $settings['sub_title'] )) : ?>
            <h5 class="blta-subtitle-1 font-700 text-uppercase pr-font tx-subTitle">
                <?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?>
            </h5>
            <?php endif; ?>

            <?php
                if($settings['enable_title'] === 'yes') {
                $this->add_render_attribute( 'title', 'class', 'tx-title blta-section-title-1 blta-split-text split-in-left' );
                    printf('<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        elh_element_kses_basic( $settings['title'] )
                    );
                }
            ?>
        </div>

        <!-- team content -->
        <div class="blta-team-single-page-1-item-wrap">

            <!-- single-item -->
            <?php foreach($settings['team_lists'] as $list ) : ?>
                <div class="blta-team-2-item">
                    <?php if(!empty( $list['team_image']['url'] )) : ?>
                    <div class="item-img fix">
                        <img
                        src="<?php echo esc_url($list['team_image']['url']); ?>"
                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['team_image']['url'] ); } ?>">
                    </div>
                    <?php endif; ?>
                    <div class="tx-content">
                        <?php if(!empty( $list['name'] )) : ?>
                        <h3 class="item-name blta-heading-1 font-700">
                            <a
                            href="<?php echo esc_url($list['link']['url']); ?>"
                            target="<?php echo esc_attr($list['link']['is_external'] ? '_blank' : '_self'); ?>"
                            rel="<?php echo esc_attr($list['link']['nofollow'] ? 'nofollow' : ''); ?>"
                            >
                                <?php echo elh_element_kses_intermediate( $list['name'] ); ?>
                            </a>
                        </h3>
                        <?php endif; ?>

                        <?php if(!empty( $list['designation'] )) : ?>
                        <p class="item-disc blta-para-1">
                            <?php echo elh_element_kses_intermediate( $list['designation'] ); ?>
                        </p>
                        <?php endif; ?>

                        <?php if( $list['enable_social_links'] === 'yes' && !empty($list['social_links']) ) : ?>
                        <div class="blta-social-link-2 d-flex flex-wrap align-items-center">
                            <?php foreach($list['social_links'] as $s_list ) : ?>
                            <a
                            href="<?php echo esc_url($s_list['social_link']['url']); ?>"
                            target="<?php echo esc_attr($s_list['social_link']['is_external'] ? '_blank' : '_self'); ?>"
                            rel="<?php echo esc_attr($s_list['social_link']['nofollow'] ? 'nofollow' : ''); ?>"
                            aria-label="name"
                                class="link">
                                <?php \Elementor\Icons_Manager::render_icon( $s_list['social_icon'], [ 'aria-hidden' => 'true' ] );?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>