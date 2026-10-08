<div class="fti-services-3-bottom m-0 tx-infoText">
    <div class="men wow fadeInLeft">
        <?php if(!empty( $settings['info_image_1']['url'] )) : ?>
        <div class="men-img">
            <img src="<?php echo esc_url($settings['info_image_1']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['info_image_1']['url'] ); } ?>">
        </div>
        <?php endif; ?>

        <?php if(!empty( $settings['info_text'] )) : ?>
        <p class="fti-para-3-small disc"><?php echo elh_element_kses_intermediate($settings['info_text']); ?></p>
        <?php endif; ?>
    </div>
</div>