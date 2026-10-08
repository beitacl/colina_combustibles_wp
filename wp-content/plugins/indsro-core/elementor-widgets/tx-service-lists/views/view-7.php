<div class="fti-process-2-area fix tx-section">
    <div class="fti-process-2-circel-wrap">
        <div class="circle-top">
            <?php if(!empty( $settings['image_1']['url'] )) : ?>
            <div class="circle-4">
                <img src="<?php echo esc_url($settings['image_1']['url']); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
            </div>
            <?php endif; ?>

            <?php if(!empty( $settings['image_2']['url'] )) : ?>
            <div class="circle-3">
                <img src="<?php echo esc_url($settings['image_2']['url']); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
            </div>
            <?php endif; ?>

            <?php if(!empty( $settings['image_3']['url'] )) : ?>
            <div class="circle-2">
                <img src="<?php echo esc_url($settings['image_3']['url']); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
            </div>
            <?php endif; ?>
        </div>

        <?php if(!empty( $settings['image_4']['url'] )) : ?>
        <div class="circle-1">
            <img src="<?php echo esc_url($settings['image_4']['url']); ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_4']['url'] ); } ?>">
        </div>
        <?php endif; ?>
    </div>
    <div class="container fti-container-3">
        <!-- title -->
        <div class="fti-process-2-title-wrap">

            <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
            <h6 class="fti-subtitle-3 has-both-line tx-subTitle">
                <span class="line subtitle-line-1"></span>
                <?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?>
                <span class="line-2 subtitle-line-2"></span>
            </h6>
            <?php
            endif;
                if($settings['enable_title'] === 'yes') {
                $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-3 fti-split-text fti-split-in-right-3' );
                    printf('<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        elh_element_kses_basic( $settings['title'] )
                    );
                }
            ?>
        </div>
        <div class="fti-process-2-wrap">
            <!-- single item -->
             <?php if(!empty( $settings['image_5']['url'] )) : ?>
            <div class="process-bg wow fadeInLeft" data-wow-delay="0.4s">
                <img src="<?php echo esc_url($settings['image_5']['url']); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_5']['url'] ); } ?>">
            </div>
            <?php endif; ?>

            <?php foreach($settings['service_lists'] as $list ) :
                $is_active = $list['is_active'] === 'yes' ? 'active' : '';
            ?>
            <div class="fti-process-2-item wow fadeInLeft <?php echo esc_attr($is_active); ?>">
                <?php if(!empty( $list['service_icon'] )) : ?>
                <span class="icon-1">
                    <?php \Elementor\Icons_Manager::render_icon( $list['service_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </span>
                <?php endif; ?>
                <div class="content">
                    <?php if(!empty( $list['title'] )) : ?>
                    <h4 class="fti-heading-2 title"><?php echo elh_element_kses_intermediate( $list['title'] ); ?></h4>
                    <?php endif; ?>

                    <?php if(!empty( $list['description'] )) : ?>
                    <p class="disc fti-para-2"><?php echo elh_element_kses_intermediate( $list['description'] ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>

    <?php if( $settings['enable_info_text'] === 'yes' ) : ?>
    <div class="fti-process-2-bottom">
        <span class="line-1"></span>
        <span class="bottom-text fti-para-2">
            <?php echo elh_element_kses_intermediate( $settings['info_text'] ); ?>
            <?php if(!empty( $settings['info_text_link_label'] )) : ?>
            <a href="<?php echo esc_url($settings['info_text_link']['url']); ?>" class="bottom-link"><?php echo elh_element_kses_intermediate( $settings['info_text_link_label'] ); ?></a>
            <?php endif; ?>
        </span>
        <span class="line-2"></span>
    </div>
    <?php endif; ?>
</div>