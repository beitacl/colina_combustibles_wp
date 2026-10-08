<div class="fti-feature-4-area fix">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="fti-feature-4-bg-1">
        <img
        src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['image_2']['url'] )) : ?>
    <div class="fti-feature-4-bg-2">
        <img
        src="<?php echo esc_url($settings['image_2']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    </div>
    <?php endif; ?>
    <div class="container fti-container-9">
        <div class="fti-feature-4-wrap">
            <div class="title-wrap">
                <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                <h5 class="fti-subtitle-5 has-color-white tx-subTitle"><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></h5>
                <?php
                endif;
                    if($settings['enable_title'] === 'yes') {
                    $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-5 fti-split-text fti-split-in-right-4 has-color-white' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>
                <?php if( $settings['enable_description'] === 'yes' ) : ?>
                <p class="fti-para-3-small disc tx-description"><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                <?php endif; ?>
            </div>
            <div class="fti-feature-4-card">
                <?php if(!empty( $settings['image_3']['url'] )) : ?>
                <div class="main-img img-cover fix">
                    <img
                    src="<?php echo esc_url($settings['image_3']['url']); ?>"
                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
                </div>
                <?php endif; ?>

                <?php if( $settings['enable_feature_lists'] === 'yes' ) : ?>
                <div class="feature-list">
                    <?php foreach( $settings['feature_lists'] as $list ) : ?>
                    <div class="feature-item">
                        <?php if( $list['enable_icon'] === 'yes' ) : ?>
                        <div class="icon">
                            <?php if( $list['type'] === 'icon' ) : ?>
                                <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <div class="content">
                            <?php if(!empty( $list['feature_title'] )) : ?>
                            <h4 class="title fti-heading-3"><?php echo elh_element_kses_intermediate($list['feature_title']); ?></h4>
                            <?php endif; ?>

                            <?php if(!empty( $list['feature_description'] )) : ?>
                            <span class="fti-para-4 info"><?php echo elh_element_kses_intermediate($list['feature_description']); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>