<div class="gly-award-3-area fix">

    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <img src="<?php echo esc_url($settings['image_1']['url']); ?>" class="gly-award-3-bg-shape" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    <?php endif; ?>

    <div class="container gly-container-2">
        <div class="gly-award-3-row">

            <!-- left-content -->
            <div class="gly-award-3-content">
                <!-- section-title -->
                <div class="gly-award-3-section-title mb-30">
                    <?php if(!empty( $settings['enable_sub_title'] )) : ?>
                    <h4 class="gly-subtitle-3 add-class tx-subTitle">
                        <span class="line1"></span>
                        <?php echo elh_element_kses_intermediate($settings['sub_title']); ?>
                    </h4>
                    <?php endif; ?>

                    <?php
                        $this->add_render_attribute( 'title', 'class', 'tx-title gly-section-title-3 gly-split-in-down gly-split-text' );
                        if($settings['enable_title'] === 'yes') {
                            printf('<%1$s %2$s>%3$s</%1$s>',
                                tag_escape($settings['title_tag']),
                                $this->get_render_attribute_string('title'),
                                elh_element_kses_basic( $settings['title'] )
                            );
                        }
                    ?>
                </div>

                <?php if(!empty( $settings['image_2']['url'] )) : ?>
                <div class="gly-award-3-img">
                    <img src="<?php echo esc_url($settings['image_2']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
                </div>
                <?php endif; ?>

                <?php if(!empty( $settings['image_3']['url'] )) : ?>
                <img src="<?php echo esc_url($settings['image_3']['url']); ?>" class="gly-award-3-content-shape" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
                <?php endif; ?>
            </div>

            <?php if( $settings['enable_award_lists'] === 'yes' ) : ?>
            <div class="gly-award-3-item-wrap">

                <?php foreach($settings['award_lists'] as $list ) : ?>
                <div class="gly-award-3-item-single">
                    <div class="item-logo">
                        <?php if(!empty( $list['award_image']['url'] )) : ?>
                        <img src="<?php echo esc_url($list['award_image']['url']); ?>" class="logo-1"  alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['award_image']['url'] ); } ?>">
                        <?php endif; ?>

                        <?php if(!empty( $list['award_color_image']['url'] )) : ?>
                        <img src="<?php echo esc_url($list['award_color_image']['url']); ?>" class="logo-2"  alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['award_color_image']['url'] ); } ?>">
                        <?php endif; ?>
                    </div>
                    <div class="content-wrap">
                        <?php if(!empty( $list['title'] )) : ?>
                        <h4 class="gly-heading-3 item-title"><?php echo elh_element_kses_intermediate($list['title']); ?></h4>
                        <?php endif; ?>

                        <?php if(!empty( $list['description'] )) : ?>
                        <p class="gly-para-3 disc"><?php echo elh_element_kses_intermediate($list['description']); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php if(!empty( $list['award_date'] )) : ?>
                    <p class="gly-para-3 item-date"><?php echo elh_element_kses_intermediate($list['award_date']); ?></p>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
</div>