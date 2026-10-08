<div class="gly-project-3-area fix tx-section">

    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="gly-project-3-bg-img img-cover image-pllx">
        <img src="<?php echo esc_url($settings['image_1']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <div class="container gly-container-2">
        <div class="gly-project-3-section-relative">
            <!-- section-title -->
            <div class="gly-project-3-section-abs">
                <div class="row">
                    <div class="col-xl-6 offset-xl-6">
                        <div class="gly-project-3-section-title mb-40">
                            <?php if(!empty( $settings['enable_sub_title'] )) : ?>
                            <h4 class="gly-subtitle-3 add-class tx-subTitle">
                                <span class="line1"></span>
                                <?php if(!empty( $settings['sub_title_icon'] )) {
                                    \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] );
                                } ?>
                                <?php echo elh_element_kses_intermediate($settings['sub_title']); ?>
                            </h4>
                            <?php endif; ?>

                            <?php
                                if($settings['enable_title'] === 'yes') {
                                $this->add_render_attribute( 'title', 'class', 'tx-title gly-section-title-3 gly-split-in-down gly-split-text' );
                                    printf('<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['title_tag']),
                                        $this->get_render_attribute_string('title'),
                                        elh_element_kses_basic( $settings['title'] )
                                    );
                                }
                            ?>

                            <?php if( $settings['enable_description'] === 'yes' ) : ?>
                            <p class="gly-para-3 disc wow fadeIn tx-description">
                                <?php echo elh_element_kses_intermediate($settings['description']); ?>
                            </p>
                            <?php endif; ?>

                            <?php if( $settings['enable_button'] === 'yes' ) : ?>
                            <a
                            href="<?php echo esc_url($settings['button_link']['url']); ?>"
                            target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                            rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                            aria-label="<?php echo esc_attr($settings['button_text']); ?>"
                            class="gly-pr-btn-3 wow fadeInUp">
                                <span class="text">
                                    <?php echo elh_element_kses_intermediate($settings['button_text']); ?>
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if( $settings['enable_project_box_lists_1'] === 'yes' ) : ?>
    <div class="gly-project-3-item-wrap">
        <?php foreach($settings['project_box_lists_1'] as $list) : ?>
        <div class="gly-project-3-item gly-project-3-item1">
            <?php if(!empty( $list['project_image']['url'] )) : ?>
            <div class="main-img img-cover">
                <img src="<?php echo esc_url($list['project_image']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['project_image']['url'] ); } ?>">
            </div>
            <?php endif; ?>

            <?php if(!empty( $list['project_title'] )) : ?>
            <h4 class="gly-heading-2 item-title">
                <a href="<?php echo esc_url($list['project_link']['url']); ?>" aria-label="name">
                    <?php echo elh_element_kses_intermediate($list['project_title']); ?>
                </a>
            </h4>
            <?php endif; ?>

            <?php if( $list['enable_tag_lists'] === 'yes' ) : ?>
            <div class="item-tags">
                <?php foreach($list['project_tags_lists'] as $tag_list) : ?>
                <a href="<?php echo esc_url($tag_list['tag_link']['url']); ?>" aria-label="name" class="tag-link">
                    <?php echo elh_element_kses_intermediate($tag_list['tag_text']); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if( $settings['enable_project_box_lists_2'] === 'yes' ) : ?>
    <div class="gly-project-3-item-wrap-2">

        <?php foreach($settings['project_box_lists_2'] as $list) : ?>
        <div class="gly-project-3-item gly-project-3-item2">
            <?php if(!empty( $list['project_image']['url'] )) : ?>
            <div class="main-img img-cover">
                <img src="<?php echo esc_url($list['project_image']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['project_image']['url'] ); } ?>">
            </div>
            <?php endif; ?>

            <?php if(!empty( $list['project_title'] )) : ?>
            <h4 class="gly-heading-2 item-title">
                <a href="<?php echo esc_url($list['project_link']['url']); ?>" aria-label="name">
                    <?php echo elh_element_kses_intermediate($list['project_title']); ?>
                </a>
            </h4>
            <?php endif; ?>

            <?php if( $list['enable_tag_lists'] === 'yes' ) : ?>
            <div class="item-tags">
                <?php foreach($list['project_tags_lists'] as $tag_list) : ?>
                <a href="<?php echo esc_url($tag_list['tag_link']['url']); ?>" aria-label="name" class="tag-link">
                    <?php echo elh_element_kses_intermediate($tag_list['tag_text']); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>

    </div>
    <?php endif; ?>

    <?php if( $settings['enable_project_box_lists_3'] === 'yes' ) : ?>
    <div class="gly-project-3-item-wrap-3">

        <?php foreach($settings['project_box_lists_3'] as $list) : ?>
        <div class="gly-project-3-item gly-project-3-item1">
            <?php if(!empty( $list['project_image']['url'] )) : ?>
            <div class="main-img img-cover">
                <img src="<?php echo esc_url($list['project_image']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['project_image']['url'] ); } ?>">
            </div>
            <?php endif; ?>

            <?php if(!empty( $list['project_title'] )) : ?>
            <h4 class="gly-heading-2 item-title">
                <a href="<?php echo esc_url($list['project_link']['url']); ?>" aria-label="name">
                    <?php echo elh_element_kses_intermediate($list['project_title']); ?>
                </a>
            </h4>
            <?php endif; ?>

            <?php if( $list['enable_tag_lists'] === 'yes' ) : ?>
            <div class="item-tags">
                <?php foreach($list['project_tags_lists'] as $tag_list) : ?>
                <a href="<?php echo esc_url($tag_list['tag_link']['url']); ?>" aria-label="name" class="tag-link">
                    <?php echo elh_element_kses_intermediate($tag_list['tag_text']); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>

    </div>
    <?php endif; ?>
</div>