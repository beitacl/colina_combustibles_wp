<?php
    if($settings['link_type'] === 'email') {
        $link_url = 'mailto:' . $settings['contact_info_text'];
    } elseif( $settings['link_type'] === 'phone' ) {
        $link_url = 'tel:' . $settings['contact_info_text'];
    } else {
        $link_url = $settings['contact_info_text'];
    }
?>

<div class="fti-work-5-content m-0">
    <div class="work-title-wrap">
        <div class="action m-0">
            <?php if(!empty( $settings['contact_info_icon'] )) : ?>
            <span class="icon">
                <?php \Elementor\Icons_Manager::render_icon( $settings['contact_info_icon'], [ 'aria-hidden' => 'true' ] );?>
            </span>
            <?php endif; ?>
            <div>
                <?php if(!empty( $settings['contact_info_label'] )) : ?>
                <span class="mail-text"><?php echo elh_element_kses_intermediate( $settings['contact_info_label'] ); ?></span>
                <?php endif; ?>

                <?php if(!empty( $settings['contact_info_text'] )) : ?>
                <a class="mail-link" href="<?php echo esc_url($link_url); ?>">
                    <?php echo elh_element_kses_intermediate( $settings['contact_info_text'] ); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
