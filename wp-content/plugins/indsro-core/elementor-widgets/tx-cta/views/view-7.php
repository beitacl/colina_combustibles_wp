<div class="fti-short-video-1-area bg-default tx-section" data-background="<?php echo $settings['image_1']['url'] ? esc_url($settings['image_1']['url']) : ''; ?>">
    <div class="container">
        <div class="fti-short-video-1-wrap">
            <div class="short-video-title-wrap">

                <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                <h6 class="fti-subtitle-1 tx-subTitle"><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></h6>
                <?php
                endif;
                    if($settings['enable_title'] === 'yes') {
                    $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-1 has-color-white fti-split-text fti-split-in-right-1' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>

                <?php if( $settings['enable_description'] === 'yes' ) : ?>
                <p class="fti-para-1 has-color-white mt-25 tx-description"><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                <?php endif; ?>
            </div>

            <?php if( $settings['enable_video_box'] === 'yes' ) : ?>
            <div class="fti-short-video-1-popup-wrap">
                <a class="popup-video play-icon"
                    href="<?php echo esc_url($settings['video_link']['url']); ?>">
                    <?php if(!empty( $settings['video_icon'] )) : ?>
                    <span class="icon-1">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['video_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
                    <?php endif; ?>

                    <?php if(!empty( $settings['image_2']['url'] )) : ?>
                    <div class="icon-2">
                        <img src="<?php echo esc_url($settings['image_2']['url']) ?>"
                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
                    </div>
                    <?php endif; ?>
                </a>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>