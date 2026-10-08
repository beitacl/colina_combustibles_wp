<?php $rand = rand( 1, 1000 ); ?>
<div class="fti-question-2-area tx-section">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="fti-question-2-bg img-cover">
        <img src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <div class="container fti-container-3">
        <div class="fti-question-2-wrap">

            <!-- left  -->
            <div class="fti-question-2-left">
                <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                <h5 class="fti-subtitle-3 tx-subTitle">
                    <span class="line has-bg subtitle-line-1"></span>
                    <?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?>
                </h5>
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
                if( $settings['enable_description'] === 'yes' ) : ?>
                <p class="fti-para-2 mt-20 tx-description"><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                <?php endif; ?>
            </div>

            <!-- faq -->
            <div class="fti-question-2-right asslideupcta">
                <div class="accordion" id="accordionExample_<?php echo esc_attr($rand); ?>">
                    <?php
                        foreach ( $settings['faq_lists'] as $id => $list ):
                        $is_active = $list['is_active'] == 'yes' ? 'active-block' : '';
                        $active = $list['is_active'] == 'yes' ? 'active' : '';
                        $show = $list['is_active'] == 'yes' ? 'show' : '';
                        $aria_expanded = $list['is_active'] == 'yes' ? 'true' : 'false';
                        $collapsed = $list['is_active'] == 'yes' ? '' : 'collapsed';
                    ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-<?php echo esc_attr($rand . '-' . $id); ?>">
                            <button class="accordion-button fti-para-3 <?php echo esc_attr($collapsed); ?>"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapse-<?php echo esc_attr($rand . '-' . $id); ?>"
                            aria-expanded="<?php echo esc_attr($aria_expanded); ?>"
                            aria-controls="collapse-<?php echo esc_attr($rand . '-' . $id); ?>">
                                <span class="icon-1">
                                    <i class="fa-light fa-share-all"></i>
                                </span>
                                <span class="fti-para-2 question"><?php echo elh_element_kses_intermediate($list['title']); ?></span>
                                <div class="arrow-icon">
                                    <span class="icon-2">
                                        <span class="bar-1"></span>
                                        <span class="bar-2"></span>
                                    </span>
                                </div>
                            </button>
                        </h2>
                        <div
                        id="collapse-<?php echo esc_attr($rand . '-' . $id); ?>"
                        class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
                        aria-labelledby="heading-<?php echo esc_attr($rand . '-' . $id); ?>"
                        data-bs-parent="#accordionExample_<?php echo esc_attr($rand); ?>">
                            <div class="accordion-body ">
                                <p class="fti-para-2 disc">
                                    <?php echo elh_element_kses_intermediate($list['content']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>