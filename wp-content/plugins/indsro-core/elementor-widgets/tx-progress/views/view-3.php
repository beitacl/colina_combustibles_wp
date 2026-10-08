<div class="team-details-progress-item">
    <?php if(!empty( $settings['progress_title'] )) : ?>
    <h6 class="team-details-progress-item-title"><?php echo elh_element_kses_intermediate($settings['progress_title']); ?></h6>
    <?php endif; ?>

    <?php if(!empty( $settings['progress_value']['size'] )) : ?>
    <div class="team-details-progress">
        <div class="team-details-progress-bar" data-percent="<?php echo $settings['progress_value']['size'] ? esc_attr($settings['progress_value']['size']) : ''; ?>"></div>
    </div>
    <?php endif; ?>
</div>