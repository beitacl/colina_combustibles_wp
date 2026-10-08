<section class="log-rq-form-sectio">
    <div class="container">
        <?php
            if( $settings['enable_tab'] === 'yes' ) :
            $rand = rand(0, 9999);
        ?>
        <div class="log-rq-form-content">
            <div class="rq-form-btn tx-tab-btn ul-li text-center">
                <ul class="nav nav-tabs" id="log-rq-tab_<?php echo esc_attr($rand); ?>" role="tablist">
                    <?php
                        foreach ($settings['tab_lists'] as $id => $list):
                        $is_active = $list['is_active'] == 'yes' ? 'active' : '';
                        $aria_selected = $list['is_active'] == 'yes' ? 'true' : 'false';
                    ?>
                    <li class="nav-item" role="presentation">
                        <div class="nav-link <?php echo esc_attr($is_active); ?>"
                        id="pricingTab-<?php echo esc_attr($id. '_' .$rand); ?>"
                        data-bs-toggle="tab"
                        data-bs-target="#tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                        type="button"
                        role="tab"
                        aria-controls="tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                        aria-selected="<?php echo esc_attr($aria_selected); ?>">
                            <?php \Elementor\Icons_Manager::render_icon( $list['tab_title_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            <span><?php echo elh_element_kses_intermediate($list['tab_title']); ?></span>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
        <div class="log-rq-form-tab">
            <div class="tab-content" id="myTabContent_<?php echo esc_attr($rand); ?>">
                <?php
                    foreach ($settings['tab_lists'] as $id => $list):
                    $is_active = $list['is_active'] == 'yes' ? 'show active' : '';
                ?>
                <div class="tab-pane <?php echo esc_attr($is_active); ?> animated fadeInUp"
                    id="tab-<?php echo esc_attr($id. '_' .$rand); ?>">
                    <div class="log-rq-form-wrap headline">
                        <h3><?php echo elh_element_kses_intermediate($list['tab_title']); ?></h3>
                        <?php echo do_shortcode($list['tab_form_shortcode']); ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>