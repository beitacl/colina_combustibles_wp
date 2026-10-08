<div class="fti-client-1-area p-0">
    <div class="container">
        <div class="fti-client-1-wrap">
            <div class="logos-wrap m-0">
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
                    <img src="<?php echo $brand_image ? esc_url($brand_image) : ''; ?>" alt="<?php echo esc_attr($brand_alt); ?>">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>