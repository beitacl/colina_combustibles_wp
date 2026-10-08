<div class="fti-footer-3-action wow fadeInUp mt-0">
    <?php if( $settings['enable_contact_info'] === 'yes' ) :
        foreach( $settings['list_items'] as $list ) :
        if($list['link_type'] === 'email') {
            $info_label = 'mailto:' . $list['info_label'];
        } elseif( $list['link_type'] === 'phone' ) {
            $info_label = 'tel:' . $list['info_label'];
        } else {
            $info_label = $list['info_label'];
        }
        if($list['enable_link'] === 'yes') {
            $info_label = $list['info_link'];
        }
    ?>
    <div class="action-item">
        <?php if( $list['enable_icon'] === 'yes' ) : ?>
        <span class="icon">
            <?php if( $list['type'] === 'icon' ) : ?>
                <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            <?php else : ?>
                <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
            <?php endif; ?>
        </span>
        <?php endif; ?>

        <div>
            <?php if(!empty( $list['info_heading'] )) : ?>
            <h5 class="action-title"><?php echo esc_html( $list['info_heading'] ); ?></h5>
            <?php endif; ?>

            <a href="<?php echo $info_label; ?>" class="link"><?php echo esc_html( $list['info_label'] ); ?></a>
        </div>
    </div>
    <?php endforeach; endif; ?>

    <?php if( $settings['enable_button'] === 'yes' ) : ?>
    <a class="appointment tx-button" href="<?php echo esc_url($settings['button_link']['url']); ?>"
    target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
    rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>" class="fti-btn-pr-1">
        <span class="appoin-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
        <?php
            if($settings['enable_button_icon'] === 'yes') {
                \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'class' => 'icon-2', 'aria-hidden' => 'true' ] );
            }
        ?>
    </a>
    <?php endif; ?>
</div>