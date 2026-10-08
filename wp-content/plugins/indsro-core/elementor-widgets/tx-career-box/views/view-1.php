<div class="feh-career-card">
    <div class="designation">
        <?php if(!empty( $settings['title'] )) : ?>
        <h5 class="fti-heading-3 designation-title"><?php echo elh_element_kses_intermediate( $settings['title'] ); ?></h5>
        <?php endif; ?>

        <div class="job-type">
            <?php if(!empty( $settings['location'] )) : ?>
            <span class="job-ext ftc-para-1">
                <?php \Elementor\Icons_Manager::render_icon( $settings['location_icon'], [ 'class' => 'blta-position-meta-icon', 'aria-hidden' => 'true'] );?>
                <?php echo esc_html($settings['location']); ?>
            </span>
            <?php endif; ?>

            <?php if(!empty( $settings['job_type_name'] )) : ?>
            <span class="job-time ftc-para-1">
                <?php \Elementor\Icons_Manager::render_icon( $settings['job_type_icon'], [ 'class' => 'blta-position-meta-icon', 'aria-hidden' => 'true'] );?>
                <?php echo esc_html($settings['job_type_name']); ?>
            </span>
            <?php endif; ?>
        </div>
    </div>

    <?php if(!empty( $settings['deadline_label'] || $settings['deadline_text'] )) : ?>
    <div class="exper">
        <?php if(!empty( $settings['experience_label'] )) : ?>
        <span class="exper-text ftc-para-1"><?php echo elh_element_kses_intermediate( $settings['experience_label'] ); ?></span>
        <?php endif; ?>

        <?php if(!empty( $settings['experience_text'] )) : ?>
        <span class="exper-year ftc-para-1"><?php echo elh_element_kses_intermediate( $settings['experience_text'] ); ?></span>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['deadline_label'] || $settings['deadline_text'] )) : ?>
    <div class="deadline">
        <?php if(!empty( $settings['deadline_label'] )) : ?>
        <span class="deadline-text ftc-para-1"><?php echo elh_element_kses_intermediate( $settings['deadline_label'] ); ?></span>
        <?php endif; ?>

        <?php if(!empty( $settings['deadline_text'] )) : ?>
        <span class="deadline-date ftc-para-1"><?php echo elh_element_kses_intermediate( $settings['deadline_text'] ); ?></span>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['button_text'] )) : ?>
    <div class="apply-btn-wrap">
        <a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>"
        target="<?php echo esc_attr( $settings['button_link']['is_external'] ? '_blank' : '_self' ); ?>"
        rel="<?php echo esc_attr( $settings['button_link']['nofollow'] ? 'nofollow' : '' ); ?>"
        aria-label="name"
        class="fti-heading-3 apply-btn">
            <?php echo esc_attr($settings['button_text']); ?>
        </a>
    </div>
    <?php endif; ?>
</div>