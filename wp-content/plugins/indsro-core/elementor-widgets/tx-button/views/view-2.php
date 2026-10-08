<?php

    $button_class = '';
    if($settings['button_full_width'] == 'yes') {
        $button_class = 'fullWidth';
    } else {
        $button_class = '';
    }

    $button_alignment = $settings['button_alignment'];

    if($button_alignment == 'left') {
        $button_class .= ' text-left';
    } elseif($button_alignment == 'center') {
        $button_class .= ' text-center';
    } elseif($button_alignment == 'right') {
        $button_class .= ' text-right';
    }
?>
<div class="btn-wrapper <?php echo esc_attr($button_class); ?>">
    <a class="tx-button fti-btn-pr-5 <?php echo $settings['anim_name'] ? esc_attr($settings['anim_name']) : ''; ?>"
    href="<?php echo esc_url($settings['button_link']['url']); ?>"
    target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
    rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
    aria-label="name">
        <?php if(!empty( $settings['button_text'] )) : ?>
        <span class="btn-text">
            <?php echo esc_attr($settings['button_text']); ?>
        </span>
        <?php endif; ?>

        <?php if(!empty( $settings['selected_icon'] )) : ?>
        <span class="btn-icon">
            <?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );  ?>
        </span>
        <?php endif; ?>
    </a>
</div>
