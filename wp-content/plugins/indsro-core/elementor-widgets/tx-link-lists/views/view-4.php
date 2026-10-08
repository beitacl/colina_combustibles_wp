<div class="fti-footer-1-link-wrap tx-listItems">
    <div class="contact-wrap">
        <?php foreach( $settings['list_items'] as $list ) :
        if($list['link_type'] === 'email') {
            $link_url = 'mailto:' . $list['list_link']['url'];
        } elseif( $list['link_type'] === 'phone' ) {
            $link_url = 'tel:' . $list['list_link']['url'];
        } else {
            $link_url = $list['list_link']['url'];
        }
        ?>
        <a class="contact-link" href="<?php echo esc_url( $link_url ); ?>">
            <?php if( $list['enable_icon'] === 'yes' ) : ?>
                <?php if( $list['type'] === 'icon' ) : ?>
                    <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <?php else : ?>
                    <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
                <?php endif; ?>
            <?php endif; ?>
            <span class="fti-para-1-small"><?php echo elh_element_kses_intermediate( $list['info_label'] ); ?></span>
        </a>
        <?php endforeach; ?>
    </div>
</div>