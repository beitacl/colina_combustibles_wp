<div class="gly-newsletter-4-area" >
    <div class="container gly-container-3">
        <div class="gly-newsletter-4-wrap bg-default" data-background="<?php echo esc_url($settings['bg_image']['url']) ? esc_url($settings['bg_image']['url']) : ''; ?>">

            <?php if(!empty( $settings['image_1']['url'] )) : ?>
            <div class="news5-img fix">
                <img src="<?php echo esc_url($settings['image_1']['url']) ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
            </div>
            <?php endif; ?>

            <div class="content-wrap">
                <?php if(!empty( $settings['title'] )) : ?>
                <h4 class="gly-heading-4 title gly-font-800"><?php echo elh_element_kses_intermediate($settings['title']); ?></h4>
                <?php endif; ?>

                <?php if(!empty( $settings['description'] )) : ?>
                <p class="gly-para-3 disc"><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                <?php endif; ?>

                <?php if(!empty( $settings['newsletter_shortcode'] )) : ?>
                <div class="gly-newsletter-4-form">
                    <?php echo do_shortcode($settings['newsletter_shortcode']); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>