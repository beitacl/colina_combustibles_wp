<?php
$rand = rand(0, 9999);
?>
<div class="buil-pricing-page-2-area tx-section">
    <div class="container">
        <div class="buil-pricing-page-2-wrap">
            <div class="buil-pricing-page-2-top">
                <?php if(!empty( $settings['sub_title'] )) : ?>
                <h5 class="blta-subtitle-1 font-700 text-uppercase pr-font tx-subTitle">
                    <?php if( $settings['enable_sub_title_icon'] === 'yes' ) : ?>
                    <span class="icon">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] );?>
                    </span>
                    <?php endif; ?>
                    <?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?>
                </h5>
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

            <div class="buil-pricing-page-2-content">
                <div>
                    <div class="buil-pricing-1-title-wrap" id="nav-tab-<?php echo esc_attr($rand); ?>" role="tablist">
                        <?php
                            foreach ($settings['pricingTab_lists'] as $id => $list):
                            $is_active = $list['is_active'] == 'yes' ? 'active' : '';
                            $is_toggle = $list['is_toggle'] == 'yes' ? 'price-toggle' : 'no-toggle';
                            $aria_selected = $list['is_active'] == 'yes' ? 'true' : 'false';
                        ?>
                        <?php if( $list['is_toggle'] === 'yes' ) : ?>
                        <div class="price-toggle"></div>
                        <?php endif; ?>
                        <button
                        class="<?php echo esc_attr($is_active); ?>"
                        id="pricingTab-<?php echo esc_attr($id. '_' .$rand); ?>"
                        data-bs-toggle="tab"
                        data-bs-target="#tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                        type="button"
                        role="tab"
                        aria-controls="tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                        aria-selected="<?php echo esc_attr($aria_selected); ?>">
                            <?php echo elh_element_kses_intermediate($list['tab_title']); ?>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="tab-content" id="nav-tabContent-<?php echo esc_attr($rand); ?>">
                    <?php
                        foreach ($settings['pricingTab_lists'] as $id => $list):
                        $is_active = $list['is_active'] == 'yes' ? 'show active' : '';
                    ?>
                    <div class="tab-pane fade <?php echo esc_attr($is_active); ?>" id="tab-<?php echo esc_attr($id. '_' .$rand); ?>" role="tabpanel" aria-labelledby="pricingTab-<?php echo esc_attr($id. '_' .$rand); ?>">
                        <div class="buil-pricing-1-card-wrap">
                            <?php echo \ElementHelper::$elementor_instance->frontend->get_builder_content($list['template'], true); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>