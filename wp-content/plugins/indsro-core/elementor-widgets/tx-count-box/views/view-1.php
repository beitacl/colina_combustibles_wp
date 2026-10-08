<div class="fti-capacity-3-item tx-count">
    <h2 class="number">
        <span class="counter tx-counter">
            <?php echo esc_html($settings['count_number']); ?></span><?php echo esc_html($settings['count_prefix']); ?><span class="plus"><?php echo esc_html($settings['count_prefix_2']); ?></span>
    </h2>
    <?php if(!empty( $settings['count_title'] )) : ?>
    <div class="capacity-divideer"></div>
    <h5 class="capacity-title tx-title"><?php echo elh_element_kses_intermediate($settings['count_title']); ?></h5>
    <?php endif; ?>
</div>