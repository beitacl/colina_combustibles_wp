<div class="fti-question-1-left">
    <div class="form-wrap">
        <?php if(!empty( $settings['image_1']['url'] )) : ?>
        <div class="form-img-wrap img-cover">
            <img src="<?php echo esc_url($settings['image_1']['url']) ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
        </div>
        <?php endif; ?>

        <?php echo do_shortcode( $settings['contact_form_shortcode'] ); ?>
    </div>
</div>