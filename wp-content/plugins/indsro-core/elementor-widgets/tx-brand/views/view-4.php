<section class="log-text-scroll-section tx-section">
    <div class="log-text-scroll-content">
        <div class="log-text-scroller">
            <?php foreach ( $settings['brands_image'] as $key => $brand ) :
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
            <div class="scroll-item">
                <img src="<?php echo $brand_image ? esc_url($brand_image) : ''; ?>" alt="<?php echo esc_attr($brand_alt); ?>">
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>