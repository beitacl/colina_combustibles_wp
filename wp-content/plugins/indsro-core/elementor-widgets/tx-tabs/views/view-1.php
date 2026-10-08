<?php $rand = rand(0, 9999); ?>
<div class="log-team-vision-tab">
    <div class="log-team-vision-btn tx-tab-btn ul-li">
        <ul class="nav nav-tabs" id="log-feature-tab_<?php echo esc_attr($rand); ?>" role="tablist">
            <?php
                foreach ($settings['txTab_lists'] as $id => $list):
                $is_active = $list['is_active'] == 'yes' ? 'active' : '';
                $aria_selected = $list['is_active'] == 'yes' ? 'true' : 'false';
            ?>
            <li class="nav-item" role="presentation">
                <div class="nav-link <?php echo esc_attr($is_active); ?>"
                id="projectTab-<?php echo esc_attr($id. '_' .$rand); ?>"
                data-bs-toggle="tab"
                data-bs-target="#tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                type="button"
                role="tab"
                aria-controls="tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                aria-selected="<?php echo esc_attr($aria_selected); ?>">
                    <?php echo elh_element_kses_intermediate($list['tab_title']); ?>
                </div>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
    <div class="log-feature-tab-area mt-20">
        <div class="tab-content" id="myTabContent_<?php echo esc_attr($rand); ?>">
            <?php
                foreach ($settings['txTab_lists'] as $id => $list):
                $is_active = $list['is_active'] == 'yes' ? 'show active' : '';
            ?>
            <div class="tab-pane <?php echo esc_attr($is_active); ?> animated fadeInUp"
            id="tab-<?php echo esc_attr($id. '_' .$rand); ?>"
            role="tabpanel"
            aria-labelledby="projectTab-<?php echo esc_attr($id. '_' .$rand); ?>">
                <div class="log-team-vision-text-img">
                    <?php if(!empty( $list['tab_image']['url'] )) : ?>
                    <div class="item-img">
                        <img src="<?php echo esc_url($list['tab_image']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['tab_image']['url'] ); } ?>">
                    </div>
                    <?php endif; ?>

                    <div class="item-text pera-content">
                        <?php if(!empty( $list['tab_content'] )) : ?>
                        <p><?php echo elh_element_kses_intermediate($list['tab_content']); ?></p>
                        <?php endif; ?>

                        <?php if(!empty( $list['button_text'] )) : ?>
                        <div class="log-btn-2 text-uppercase">
                            <a href="<?php echo esc_url($list['button_link']['url']); ?>"
                            target="<?php echo esc_attr($list['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                            rel="<?php echo esc_attr($list['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                                <?php echo esc_attr($list['button_text']); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>