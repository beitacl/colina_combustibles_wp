<div class="fti-team-2-membar text-center">
    <?php if(!empty( $settings['team_image']['url'] )) : ?>
    <div class="fti-team-2-membar-img-wrap mb-20">
        <div class="fti-team-2-membar-img">
            <img class="main-img"
                src="<?php echo esc_url($settings['team_image']['url']); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['team_image']['url'] ); } ?>">
        </div>
        <div class="fti-team-2-membar-img-shape">
            <?php if(!empty( $settings['image_1']['url'] )) : ?>
            <img class="img-shape-1"
                src="<?php echo esc_url($settings['image_1']['url']); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
            <?php endif; ?>

            <?php if(!empty( $settings['image_2']['url'] )) : ?>
            <img class="img-shape-2"
                src="<?php echo esc_url($settings['image_2']['url']); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['name'] )) : ?>
    <h4 class="fti-team-2-membar-name fti-heading-2">
        <a
            href="<?php echo esc_url($settings['link']['url']); ?>"
            target="<?php echo esc_attr($settings['link']['is_external'] ? '_blank' : '_self'); ?>"
            rel="<?php echo esc_attr($settings['link']['nofollow'] ? 'nofollow' : ''); ?>">
            <?php echo elh_element_kses_intermediate( $settings['name'] ); ?>
        </a>
    </h4>
    <?php endif; ?>

    <?php if(!empty( $settings['designation'] )) : ?>
    <span class="fti-para-2 fti-team-2-membar-bio"><?php echo elh_element_kses_intermediate( $settings['designation'] ); ?></span>
    <?php endif; ?>
</div>