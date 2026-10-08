<?php
    $wow_animation = '';
    $wow_duration = '';
    $wow_delay = '';
    if ( $settings['enable_animation'] === 'yes' ) {
        $wow_animation = 'wow ' . $settings['wow_animation'];
        $wow_duration = $settings['wow_duration'] ? $settings['wow_duration'] : '1000ms';
        $wow_delay = $settings['wow_delay'] ? $settings['wow_delay'] : '200ms';
    }
?>
 <div class="fti-team-3-item">
    <div class="team-item-left <?php echo esc_attr($wow_animation) ?>"
        data-wow-delay="<?php echo esc_attr($wow_delay); ?>"
        data-wow-duration="<?php echo esc_attr($wow_duration); ?>">
        <div class="main-img img-cover">
            <?php if(!empty( $settings['team_image']['url'] )) : ?>
            <img src="<?php echo esc_url( $settings['team_image']['url'] ); ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['team_image']['url'] ); } ?>">
            <?php endif; ?>

            <?php if( $settings['enable_social_links'] === 'yes' ) : ?>
            <div class="social-media">
                <?php foreach( $settings['social_links'] as $list ) : ?>
                <a aria-label="Social Link" class="link"
                    href="<?php echo esc_url($list['social_link']['url']); ?>"
                    target="<?php echo esc_attr( $list['social_link']['is_external'] ? '_blank' : '_self' ); ?>"
                    rel="<?php echo esc_attr( $list['social_link']['nofollow'] ? 'nofollow' : '' ); ?>">
                    <?php \Elementor\Icons_Manager::render_icon( $list['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="team-item-right wow fadeInLeft">

        <?php if(!empty( $settings['designation'] )) : ?>
        <span class="fti-para-3-small subtitle"><?php echo elh_element_kses_intermediate( $settings['designation'] ); ?></span>
        <?php endif; ?>

        <?php if(!empty( $settings['name'] )) : ?>
        <h5 class="fti-heading-3 title">
            <a
            href="<?php echo esc_url($settings['link']['url']); ?>"
            target="<?php echo esc_attr($settings['link']['is_external'] ? '_blank' : '_self'); ?>"
            rel="<?php echo esc_attr($settings['link']['nofollow'] ? 'nofollow' : ''); ?>"
            >
                <?php echo elh_element_kses_intermediate( $settings['name'] ); ?>
            </a>
        </h5>
        <?php endif; ?>

        <?php if(!empty( $settings['short_intro'] )) : ?>
        <div class="team-divider-1"></div>
        <p class="fti-para-3-small disc"><?php echo elh_element_kses_intermediate( $settings['short_intro'] ); ?></p>
        <?php endif; ?>

        <?php if(!empty( $settings['quality_services_title'] || $settings['quality_services_percent'] )) : ?>
        <div class="team-divider-2"></div>
        <div class="team-set-percent">
            <?php if(!empty( $settings['quality_services_title'] )) : ?>
            <h6 class="quatity-title"><?php echo elh_element_kses_intermediate( $settings['quality_services_title'] ); ?></h6>
            <?php endif; ?>

            <?php if(!empty( $settings['quality_services_percent'] )) : ?>
            <div class="progress">
                <div class="progress-bar" data-percent="<?php echo esc_attr($settings['quality_services_percent']); ?>"></div>
                <span><?php echo esc_attr($settings['quality_services_percent']); ?><?php echo esc_html__('%', 'indsro-core'); ?></span>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>