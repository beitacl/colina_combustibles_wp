<div class="gly-about-4-area">
    <div class="gly-client-4-wrap">
        <?php foreach ( $settings['brand_images'] as $list ) : ?>
        <div class="gly-client-4-item">
            <?php if(!empty( $list['brand_image_1']['url'] )) : ?>
            <img src="<?php echo esc_url($list['brand_image_1']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['brand_image_1']['url'] ); } ?>" class="logo-1">
            <?php endif; ?>

            <?php if(!empty( $list['brand_image_2']['url'] )) : ?>
            <img src="<?php echo esc_url($list['brand_image_2']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['brand_image_2']['url'] ); } ?>" class="logo-2">
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>