<section class="log-project-section-2 pt-100 tx-section">
    <div class="container">
        <div class="log-project-top-content flex-wrap d-flex align-items-center justify-content-between">
            <div class="log-section-title-1 headline">
                <?php if(!empty( $settings['sub_title'] )) : ?>
                <div class="subtitle text-uppercase wow fadeInRight tx-subTitle"  data-wow-delay="300ms" data-wow-duration="1000ms">
                    <?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?>
                </div>
                <?php endif; ?>
                <?php
                    if($settings['enable_title'] === 'yes') {
                        $this->add_render_attribute( 'title', 'class', 'tx-title section_title tx-split-text split-in-right' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>
            </div>
            <div class="log-project-filter-btn wow fadeInRight" data-wow-delay="400ms" data-wow-duration="1000ms">
                <div class="button-group clearfix">

                    <?php if(!empty( $settings['see_all'] )) : ?>
                    <button class="filter-button is-checked" data-filter="*">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['see_all_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        <?php echo esc_html($settings['see_all']); ?>
                    </button>
                    <?php endif; ?>

                    <?php foreach($settings['portfolio_filters'] as $list) : ?>
                    <button class="filter-button" data-filter=".<?php echo esc_attr($list['filter_id']); ?>">
                        <?php \Elementor\Icons_Manager::render_icon( $list['tab_title_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        <?php echo esc_html($list['tab_title']); ?>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="log-project-content-2 pt-55">
        <div class="filtr-container-area grid clearfix" data-isotope="{ &quot;masonry&quot;: { &quot;columnWidth&quot;: 0 } }">
            <div class="grid-sizer"></div>
            <?php
                foreach($settings['portfolio_items'] as $list) :
                if($list['image_sizes'] === 'grid-size-50') {
                    $image_size = 'grid-size-50';
                } else if ($list['image_sizes'] === 'grid-size-25') {
                    $image_size = 'grid-size-25';
                } else {
                    $image_size = '';
                }

                $filter_id = $list['filter_id'];
                // remove , from filter id
                $filter_id = str_replace(',', ' ', $filter_id);
            ?>
            <div class="grid-item <?php echo esc_attr($image_size); ?> <?php echo esc_attr($filter_id); ?>" data-category="<?php echo esc_attr($filter_id); ?>">
                <div class="log-project-item-2 position-relative">
                    <?php if(!empty( $list['image']['url'] )) : ?>
                    <div class="item-img">
                        <img src="<?php echo esc_url($list['image']['url']) ?>"
                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['image']['url'] ); } ?>">
                    </div>
                    <?php endif; ?>
                    <a class="log_more_btn" href="<?php echo esc_url($list['project_link']['url']); ?>">
                        <div id="hover-cursor" class="read-more-btn">
                            <?php if(!empty( $list['button_text'] )) : ?>
                            <svg viewBox="0 0 200 200" class="text">
                                <path id="textPath" d="M 85,0 A 85,85 0 0 1 -85,0 A 85,85 0 0 1 85,0" transform="translate(100,100)" fill="none" stroke-width="0"></path>
                                <g>
                                    <text text-anchor="start">
                                        <textPath class="round-text text-uppercase" xlink:href="#textPath" startOffset="0%">
                                        <?php echo esc_attr($list['button_text']); ?></textPath>
                                    </text>
                                </g>
                            </svg>
                            <?php endif; ?>

                            <?php if(!empty( $list['button_icon'] )) : ?>
                            <span class="hover-arrow">
                                <?php \Elementor\Icons_Manager::render_icon( $list['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>