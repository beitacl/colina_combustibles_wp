<div class="fti-work-5-content m-0 d-block">
    <div class="work-progress-wrapper">
        <div class="work-set-percent">
            <?php if(!empty( $settings['progress_title'] )) : ?>
            <h6 class="fti-heading-3 title"><?php echo elh_element_kses_intermediate($settings['progress_title']); ?></h6>
            <?php endif; ?>

            <?php if(!empty( $settings['progress_value']['size'] )) : ?>
            <div class="progress">
                <div class="progress-bar"
                    data-percent="<?php echo $settings['progress_value']['size'] ? esc_attr($settings['progress_value']['size']) : ''; ?>">
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>