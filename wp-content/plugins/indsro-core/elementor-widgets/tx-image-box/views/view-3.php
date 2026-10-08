<div class="fti-about-4-left">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="img-1 img-cover fti-roated-2">
        <img
        src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['image_2']['url'] )) : ?>
    <div class="img-2 fti-roated-1">
        <img
        src="<?php echo esc_url($settings['image_2']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['image_3']['url'] )) : ?>
    <div class="img-3 fti-fade-down">
        <img
        src="<?php echo esc_url($settings['image_3']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
    </div>
    <?php endif; ?>
</div>