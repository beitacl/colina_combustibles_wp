<?php $rand = rand( 1, 1000 ); ?>
<div class="fti-question-3-faq">
    <div class="accordion accordion-flush" id="accordionExample_<?php echo esc_attr($rand); ?>">
        <?php
            foreach ( $settings['faq_lists'] as $id => $list ):
            $is_active = $list['is_active'] == 'yes' ? 'active-block' : '';
            $active = $list['is_active'] == 'yes' ? 'active' : '';
            $show = $list['is_active'] == 'yes' ? 'show' : '';
            $aria_expanded = $list['is_active'] == 'yes' ? 'true' : 'false';
            $collapsed = $list['is_active'] == 'yes' ? '' : 'collapsed';
        ?>
        <div class="accordion-item fti_right_slide_1">
            <h2 class="accordion-header" id="heading-<?php echo esc_attr($rand . '-' . $id); ?>">
                <button class="accordion-button fti-para-3 <?php echo esc_attr($collapsed); ?>"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapse-<?php echo esc_attr($rand . '-' . $id); ?>"
                aria-expanded="<?php echo esc_attr($aria_expanded); ?>"
                aria-controls="collapse-<?php echo esc_attr($rand . '-' . $id); ?>">
                    <span><?php echo elh_element_kses_intermediate($list['title']); ?></span>
                </button>
            </h2>
            <div
            id="collapse-<?php echo esc_attr($rand . '-' . $id); ?>"
            class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
            aria-labelledby="heading-<?php echo esc_attr($rand . '-' . $id); ?>"
            data-bs-parent="#accordionExample_<?php echo esc_attr($rand); ?>">
                <div class="accordion-body ">
                    <p class="fti-para-3-small">
                        <?php echo elh_element_kses_intermediate($list['content']); ?>
                    </p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>