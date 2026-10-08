<div class="fti-company-2-wrap d-block">
    <div class="company-2-left">
        <div class="item-1">
            <?php if(!empty( $settings['image_1']['url'] )) : ?>
            <div class="main-img fti_right_slide_1">
                <img
                src="<?php echo esc_url($settings['image_1']['url']); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
            </div>
            <?php endif; ?>
            <div class="content fti_left_slide_1">
                <?php if(!empty( $settings['image_2']['url'] )) : ?>
                <span class="icon-1">
                    <img
                    src="<?php echo esc_url($settings['image_2']['url']); ?>"
                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
                </span>
                <?php endif; ?>
                <div class="title-wrap">
                    <?php if(!empty( $settings['info_heading'] )) : ?>
                    <h5 class="fti-heading-2 title">
                        <?php echo elh_element_kses_intermediate( $settings['info_heading'] ); ?>
                    </h5>
                    <?php endif; ?>

                    <?php if(!empty( $settings['info_text'] )) : ?>
                    <p class="fti-para-2-small disc"><?php echo elh_element_kses_intermediate( $settings['info_text'] ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if(!empty( $settings['image_3']['url'] )) : ?>
        <div class="item-2 asslideupcta">
            <img
            src="<?php echo esc_url($settings['image_3']['url']); ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
        </div>
        <?php endif; ?>
    </div>
</div>