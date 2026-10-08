<div class="fti-company-5-right">
    <div class="feature">
        <div class="experience">
            <h2 class="number fti-heading-3"><span class="counter"><?php echo esc_html($settings['count_number']); ?></span><?php echo esc_html($settings['count_prefix']); ?></h2>
            <?php if(!empty( $settings['count_title'] )) : ?>
            <h5 class="fti-heading-3 title"><?php echo elh_element_kses_intermediate($settings['count_title']); ?></h5>
            <?php endif; ?>
        </div>
    </div>
</div>