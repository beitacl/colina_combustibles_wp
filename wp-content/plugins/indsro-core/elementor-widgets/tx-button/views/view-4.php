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
<div class="btn-wrapper fti-blog-1-btn-wrap <?php echo esc_attr($button_class); ?>">
    <div class="fti-blog-1-btn-divider-1 subtitle-line-1"></div>
    <a class="tx-button fti-btn-se-1 <?php echo $settings['anim_name'] ? esc_attr($settings['anim_name']) : ''; ?>"
    href="<?php echo esc_url($settings['button_link']['url']); ?>"
    target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
    rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
    aria-label="name">
        <?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], ['class' => 'icon-1', 'aria-hidden' => 'true' ] );  ?>
        <?php if(!empty( $settings['button_text'] )) : ?>
        <span class="btn-text">
            <?php echo esc_attr($settings['button_text']); ?>
        </span>
        <?php endif; ?>
        <?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], ['class' => 'icon-2', 'aria-hidden' => 'true' ] );  ?>
    </a>
    <div class="fti-blog-1-btn-divider-2 subtitle-line-2"></div>
</div>
