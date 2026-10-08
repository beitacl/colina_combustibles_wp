<div class="gly-project-4-area pt-120 pb-120 fix tx-section">
    <div class="container gly-container-3">

        <!-- section-title -->
        <div class="gly-project-4-scn-title mb-50">
            <div class="left">
                <?php if(!empty( $settings['enable_sub_title'] )) : ?>
                <h6 class="gly-subtitle-4 tx-subTitle"><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></h6>
                <?php endif; ?>
                <?php
                    if($settings['enable_title'] === 'yes') {
                    $this->add_render_attribute( 'title', 'class', 'tx-title gly-section-title-3 has-title-4 gly-split-in-down gly-split-text' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>
            </div>

            <?php if(!empty( $settings['button_text'] )) : ?>
            <div class="right">
                <a
                href="<?php echo esc_url($settings['button_link']['url']); ?>"
                target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                aria-label="<?php echo esc_attr($settings['button_text']); ?>"
                class="gly-pr-btn-5">
                    <span class="text">
                        <?php echo elh_element_kses_intermediate($settings['button_text']); ?>
                    </span>
                    <?php if(!empty( $settings['button_icon'] )) : ?>
                    <span class="icon">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
                    <?php endif; ?>
                </a>
            </div>
            <?php endif; ?>

        </div>

        <?php if( $settings['enable_project_box_lists_1'] === 'yes' ) : ?>
        <div class="gly-project-4-item-wrap">

            <?php foreach($settings['project_box_lists_1'] as $list) :

                if($list['choose_anim'] === 'faderight') {
                    $anim_class = 'faderight';
                } elseif($list['choose_anim'] === 'fadeleft') {
                    $anim_class = 'fadeleft';
                } else {
                    $anim_class = '';
                }

            ?>
            <div class="gly-project-4-item <?php echo esc_attr($anim_class); ?>">
                <?php if(!empty( $list['project_title'] )) : ?>
                <h4 class="item-title gly-heading-4 gly-font-700 text-uppercase">
                    <a href="<?php echo esc_url($list['project_link']['url']); ?>" aria-label="name">
                        <?php echo elh_element_kses_intermediate($list['project_title']); ?>
                    </a>
                </h4>
                <?php endif; ?>
                <div class="item-content">
                    <?php if(!empty( $list['project_date'] )) : ?>
                    <p class="item-date gly-para-3 text-uppercase"><?php echo elh_element_kses_intermediate($list['project_date']); ?></p>
                    <span class="line"></span>
                    <?php endif; ?>

                    <div class="item-list">
                        <?php if(!empty( $list['name_label'] )) : ?>
                        <p class="gly-para-3 title"><?php echo elh_element_kses_intermediate($list['name_label']); ?></p>
                        <?php endif; ?>

                        <?php if(!empty( $list['client_name'] )) : ?>
                        <span class="name gly-para-3"><?php echo elh_element_kses_intermediate($list['client_name']); ?></span>
                        <?php endif; ?>
                    </div>

                    <?php if( $list['enable_feature_lists'] === 'yes' ) : ?>
                    <span class="line"></span>
                    <div class="item-list">
                        <?php if(!empty( $list['feature_lists_label'] )) : ?>
                        <p class="gly-para-3 title"><?php echo elh_element_kses_intermediate($list['feature_lists_label']); ?></p>
                        <?php endif; ?>

                        <ul class="name gly-para-3 list-unstyled">
                            <?php
                                $list_item = $list['feature_lists'];
                                $list_item = explode("\n", ($list_item));
                                foreach($list_item as $feature_list):
                            ?>
                            <li class="chy-heading-2">
                                <?php echo wp_kses($feature_list, true)?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                </div>

                <div class="item-img img-cover">
                    <?php if(!empty( $list['project_button_text'] )) : ?>
                    <div id="magnetic-area">
                        <div class="gly-project-4-item-btn-position parallax-content magnetic-content" id="magnetic-content">
                            <a
                            href="<?php echo esc_url($list['project_link']['url']); ?>"
                            target="<?php echo esc_attr($list['project_link']['is_external'] ? '_blank' : '_self'); ?>"
                            rel="<?php echo esc_attr($list['project_link']['nofollow'] ? 'nofollow' : ''); ?>"
                             aria-label="name"
                              class="gly-project-4-item-btn">
                                <svg class="shape"  fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M130 65C130 100.899 100.899 130 65 130C29.1015 130 0 100.899 0 65C0 29.1015 29.1015 0 65 0C100.899 0 130 29.1015 130 65ZM25.9749 65C25.9749 86.5529 43.4471 104.025 65 104.025C86.5529 104.025 104.025 86.5529 104.025 65C104.025 43.4471 86.5529 25.9749 65 25.9749C43.4471 25.9749 25.9749 43.4471 25.9749 65Z" fill="url(#paint0_linear_107_2570)"/>
                                    <defs>
                                    <linearGradient id="paint0_linear_107_2570" x1="9.68576e-07" y1="65" x2="130" y2="65" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#FF4C13"/>
                                    <stop offset="1" stop-color="#FE7524"/>
                                    </linearGradient>
                                    </defs>
                                </svg>
                                <svg viewBox="0 0 200 200" class="text" >
                                    <path id="textPath" d="M 85,0 A 85,85 0 0 1 -85,0 A 85,85 0 0 1 85,0" transform="translate(100,100)" fill="none" stroke-width="0"></path>
                                    <g>
                                        <text text-anchor="start">
                                        <textPath class="round-text gly-heading-4" xlink:href="#textPath" startOffset="0%">
                                            <?php echo esc_attr($list['project_button_text']); ?>
                                        </textPath>
                                        </text>
                                    </g>
                                </svg>
                                <?php if(!empty( $list['button_icon'] )) : ?>
                                <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $list['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty( $list['project_image']['url'] )) : ?>
                    <img src="<?php echo esc_url($list['project_image']['url']); ?>"
                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['project_image']['url'] ); } ?>">
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
        <?php endif; ?>
    </div>
</div>