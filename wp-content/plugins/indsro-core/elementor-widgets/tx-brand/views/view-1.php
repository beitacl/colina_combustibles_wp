<div class="fti-client-3-logo-wrap">
    <?php foreach ( $settings['brands_image'] as $key => $brand ) :
        if (!empty($brand['url'])) {
            $brand_image = $brand['url'];
        }

        // alt
        if (!empty($brand['alt'])) {
            $brand_alt = $brand['alt'];
        } else {
            $brand_alt = '';
        }
    ?>
    <div class="logo">
        <div class="item-one">
            <img src="<?php echo $brand_image ? esc_url($brand_image) : ''; ?>" alt="<?php echo esc_attr($brand_alt); ?>">
        </div>
        <div class="item-two">
            <img src="<?php echo $brand_image ? esc_url($brand_image) : ''; ?>" alt="<?php echo esc_attr($brand_alt); ?>">
        </div>
    </div>
    <?php endforeach; ?>
</div>