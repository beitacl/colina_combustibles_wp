<div class="log-client-list d-flex flex-wrap align-items-center ul-li wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
    <ul>
        <?php foreach($settings['image_boxs'] as $list) : ?>
        <li>
            <img
            class="blta-img-2"
            src="<?php echo esc_url($list['image_1']['url']); ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['image_1']['url'] ); } ?>">
        </li>
        <?php endforeach; ?>

        <?php if(!empty( $settings['client_quantity'] )) : ?>
        <li class="d-flex align-items-center justify-content-center">
            <?php echo esc_html($settings['client_quantity']); ?>
        </li>
        <?php endif; ?>
    </ul>

    <?php if(!empty( $settings['client_info_text'] )) : ?>
    <div class="client-number-text">
        <?php echo elh_element_kses_intermediate($settings['client_info_text']); ?>
    </div>
    <?php endif; ?>
</div>