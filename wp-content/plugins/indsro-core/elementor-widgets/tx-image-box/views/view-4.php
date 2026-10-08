<?php if(!empty( $settings['image_1']['url'] )) : ?>
<div class="fti-about-5-left fti-class-add">
    <div class="main-img">
        <img
        src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
</div>
<?php endif; ?>