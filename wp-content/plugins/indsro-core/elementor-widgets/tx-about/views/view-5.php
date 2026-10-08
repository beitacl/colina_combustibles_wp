<div class="fti-choose-2-area bg-default" data-background="<?php echo $settings['image_1']['url'] ? esc_url($settings['image_1']['url']) : ''; ?>">
    <?php if(!empty( $settings['image_2']['url'] )) : ?>
    <div class="fti-choose-2-shape-1">
        <img class="img-top-bottom-anim"
        src="<?php echo esc_url($settings['image_2']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['image_3']['url'] )) : ?>
    <div class="fti-choose-2-shape-2">
        <img class="img-bottom-top-anim"
        src="<?php echo esc_url($settings['image_3']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <!-- title -->
    <div class="container fti-container-3">
        <div class="fti-choose-2-title-wrap">
            <div>
                <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                <h5 class="fti-subtitle-3 tx-subTitle"><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></h5>
                <?php
                endif;
                    if($settings['enable_title'] === 'yes') {
                    $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-3 has-color-white fti-split-text fti-split-in-right-3' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>
            </div>

            <?php if( $settings['enable_description'] === 'yes' ) : ?>
            <p class="fti-para-2 disc tx-description"><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
            <?php endif; ?>
        </div>
    </div>

    <!-- content -->
    <div class="container fti-container-6">
        <div class="fti-choose-2-wrap">
            <!-- left -->
            <div class="fti-choose-2-left">
                <?php if( $settings['enable_feature_texts'] === 'yes' ) : ?>
                <ul class="list">
                    <?php foreach ( $settings['feature_texts'] as $id => $list ) : ?>
                    <li class="list-item fti-para-2">
                        <?php if( $list['enable_icon'] === 'yes' ) : ?>
                            <?php if ( $list['type'] === 'icon' ) : ?>
                                <?php \Elementor\Icons_Manager::render_icon( $list['feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( $list['feature_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['feature_image']['alt'] ); ?>">
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if(!empty( $list['feature_title'] )) : ?>
                        <span><?php echo elh_element_kses_intermediate( $list['feature_title'] ); ?></span>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <?php if( $settings['enable_button'] === 'yes' ) : ?>
                <div class="btn-wrap">
                    <a class="fti-btn-pr-3 has-pr-text tx-button"
                    href="<?php echo esc_url($settings['button_link']['url']); ?>"
                    target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                    rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                        <span class="btn-text">
                            <?php echo esc_html( $settings['button_text'] ); ?>
                        </span>
                        <?php if( $settings['enable_button_icon'] === 'yes' ) : ?>
                        <span class="btn-icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'class' => 'icon-2', 'aria-hidden' => 'true' ] ); ?>
                        </span>
                        <?php endif; ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <!-- right -->
            <?php if( $settings['enable_feature_lists'] === 'yes' ) : ?>
            <div class="fti-choose-2-right fix">
            <?php
                foreach ( $settings['feature_lists'] as $id => $list ) :

                    // Ensure $id is properly set and is a valid integer
                    $id = isset($id) && is_numeric($id) ? intval($id) : -1;

                    // Determine if the current list item is active
                    $active = $list['is_active'] === 'yes' ? 'active' : '';

                    // Determine the class based on the ID
                    $class = '';
                    if ( $id === 0 ) {
                        $class = 'down_up_right';
                    } elseif ( $id === 2 ) {
                        $class = 'down_up_left';
                    }

                    ?>
                    <div class="fti-choose-2-item <?php echo esc_attr( $class ); ?>">

                        <?php if ( $list['enable_icon'] === 'yes' ) : ?>
                            <span class="icon">
                                <?php if ( $list['type'] === 'icon' ) : ?>
                                    <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                <?php else : ?>
                                    <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
                                <?php endif; ?>
                            </span>
                        <?php endif; ?>

                        <?php if ( !empty( $list['feature_title'] ) ) : ?>
                            <h5 class="fti-heading-2 title"><?php echo elh_element_kses_intermediate( $list['feature_title'] ); ?></h5>
                        <?php endif; ?>

                        <?php if ( !empty( $list['feature_description'] ) ) : ?>
                            <p class="fti-para-2-small disc"><?php echo elh_element_kses_intermediate( $list['feature_description'] ); ?></p>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>