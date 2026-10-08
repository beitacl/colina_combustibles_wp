<div class="buil-team-1-area tx-section">
    <div class="container-main">
        <div class="buil-team-1-title-wrap">
            <?php if(!empty( $settings['sub_title'] )) : ?>
            <div class="buil-team-1-subtitle-wrap">
                <h5 class="buil-heading-1 subtitle-2 wow fadeInUp tx-subTitle"><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></h5>
            </div>
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

        <div class="buil-team-1-content">

            <!-- team item -->
            <?php foreach($settings['team_lists'] as $list ) : ?>
            <div class="buil-team-1-item">
                <?php if(!empty( $list['button_icon'] )) : ?>
                <a
                href="<?php echo esc_url($list['link']['url']); ?>"
                target="<?php echo esc_attr($list['link']['is_external'] ? '_blank' : '_self'); ?>"
                rel="<?php echo esc_attr($list['link']['nofollow'] ? 'nofollow' : ''); ?>"
                class="buil-team-1-link">
                    <?php \Elementor\Icons_Manager::render_icon( $list['button_icon'], [ 'aria-hidden' => 'true' ] );?>
                </a>
                <?php endif; ?>
                <?php if(!empty( $list['team_image']['url'] )) : ?>
                <div class="buil-team-1-img-wrap">
                    <img class="buil-team-1-img"
                    src="<?php echo esc_url($list['team_image']['url']); ?>"
                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['team_image']['url'] ); } ?>">
                </div>
                <?php endif; ?>
                <div class="buil-team-1-item-details">
                    <?php if(!empty( $list['designation'] )) : ?>
                    <h5 class="buil-heading-1">
                        <?php echo elh_element_kses_intermediate( $list['designation'] ); ?>
                    </h5>
                    <?php endif; ?>

                    <?php if(!empty( $list['name'] )) : ?>
                    <h3 class="buil-team-1-item-title">
                        <a
                            href="<?php echo esc_url($list['link']['url']); ?>"
                            target="<?php echo esc_attr($list['link']['is_external'] ? '_blank' : '_self'); ?>"
                            rel="<?php echo esc_attr($list['link']['nofollow'] ? 'nofollow' : ''); ?>">
                            <?php echo elh_element_kses_intermediate( $list['name'] ); ?>
                        </a>
                    </h3>
                    <?php endif; ?>

                    <?php if( $list['enable_social_links'] === 'yes' ) : ?>
                    <div class="buil-team-1-item-social">
                        <?php foreach($list['social_links'] as $s_list ) : ?>
                        <a
                        class="buil-team-1-item-social-link"
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