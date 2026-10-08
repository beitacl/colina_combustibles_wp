<div class="fti-client-5-content">
    <div class="item">
        <h2 class="number fti-heading-3">
            <span class="counter"><?php echo esc_html($settings['count_number']); ?></span><?php echo esc_html($settings['count_prefix']); ?>
        </h2>
        <?php if(!empty( $settings['count_title'] )) : ?>
        <h5 class="title fti-heading-3"><?php echo elh_element_kses_intermediate($settings['count_title']); ?></h5>
        <?php endif; ?>
    </div>
    <?php if( $settings['enable_bottom_shape'] === 'yes' ) : ?>
    <div class="divider"></div>
    <?php endif; ?>
</div>