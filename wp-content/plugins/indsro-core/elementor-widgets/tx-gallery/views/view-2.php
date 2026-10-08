<div class="fti-footer-2-gallery">
    <div class="footer-gallery-wrap">
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
        <a href="<?php echo $brand_image ? esc_url($brand_image) : ''; ?>" aria-label="gallery img" class="item img-cover popup_img">
            <img src="<?php echo $brand_image ? esc_url($brand_image) : ''; ?>" alt="<?php echo esc_attr($brand_alt); ?>">
            <span class="icon-1">
                <i class="fa-regular fa-image"></i>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>