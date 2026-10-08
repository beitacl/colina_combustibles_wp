<div class="fti-capacity-4-item">
    <div class="fti-capacity-4-item">
        <h2 class="number"><?php echo esc_html($settings['count_prefix']); ?><span class="counter"><?php echo esc_html($settings['count_number']); ?></span><?php echo esc_html($settings['count_prefix_2']); ?></h2>
        <?php if(!empty( $settings['count_title'] )) : ?>
        <h5 class="capacity-title"><?php echo elh_element_kses_intermediate($settings['count_title']); ?></h5>
        <?php endif; ?>
    </div>
</div>