<div class="fti-gallery-5-area">
    <?php
        foreach ( $settings['brands_image'] as $key => $brand ) :
        if (!empty($brand['url'])) {
            $brand_image = $brand['url'];
        } else {
            $brand_image = '';
        }

        // alt
        if (!empty($brand['alt'])) {
            $brand_alt = $brand['alt'];
        } else {
            $brand_alt = '';
        }
    ?>
    <a aria-label="link" href="<?php echo $brand_image ? esc_url($brand_image) : ''; ?>" class="item popup_img img-cover">
        <img src="<?php echo $brand_image ? esc_url($brand_image) : ''; ?>" alt="<?php echo esc_attr($brand_alt); ?>">
    </a>
    <?php endforeach; ?>
</div>