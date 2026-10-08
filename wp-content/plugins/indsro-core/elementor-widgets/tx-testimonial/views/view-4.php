<div class="fti-testimonial-inner-item wow fadeInUp">
    <?php if(!empty( $settings['author_image']['url'] )) : ?>
    <div class="img-wrap">
        <img src="<?php echo esc_url( $settings['author_image']['url'] ); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['author_image']['url'] ); } ?>">
    </div>
    <?php endif; ?>
    <div class="content">
        <?php if( $settings['enable_quote_icon'] === 'yes' ) : ?>
        <span class="quote-icon">
            <?php if( $settings['type'] === 'quote' ) : ?>
                <?php \Elementor\Icons_Manager::render_icon( $settings['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            <?php else : ?>
                <img src="<?php echo esc_url( $settings['quote_image']['url'] ); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['quote_image']['url'] ); } ?>">
            <?php endif; ?>
        </span>
        <?php endif; ?>

        <?php if(!empty( $settings['comment'] )) : ?>
        <p class="disc"><?php echo elh_element_kses_intermediate($settings['comment']); ?></p>
        <?php endif; ?>

        <?php if(!empty( $settings['name'] )) : ?>
        <h6 class="name"><?php echo elh_element_kses_intermediate($settings['name']); ?></h6>
        <?php endif; ?>

        <?php if(!empty( $settings['designation'] )) : ?>
        <span class="designation"><?php echo elh_element_kses_intermediate($settings['designation']); ?></span>
        <?php endif; ?>
    </div>
</div>