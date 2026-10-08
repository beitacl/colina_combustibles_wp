<div class="log-footer-copyright-6 ul-li d-flex align-items-center justify-content-end p-0">
    <ul>
        <?php foreach( $settings['list_items'] as $list ) : ?>
            <li>
                <?php if( $list['enable_icon'] === 'yes' ) : ?>
                    <?php if( $list['type'] === 'icon' ) : ?>
                        <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
                    <?php endif; ?>
                <?php endif; ?>

                <?php
                    if( $list['enable_link'] === 'yes' ) :

                    if($list['link_type'] === 'email') {
                        $link_url = 'mailto:' . $list['list_link']['url'];
                    } elseif( $list['link_type'] === 'phone' ) {
                        $link_url = 'tel:' . $list['list_link']['url'];
                    } else {
                        $link_url = $list['list_link']['url'];
                    }
                ?>
                <a href="<?php echo esc_url( $link_url ); ?>"
                class="links"
                target="<?php echo esc_attr( $list['list_link']['is_external'] ? '_blank' : '_self' ); ?>"
                rel="<?php echo esc_attr( $list['list_link']['nofollow'] ? 'nofollow' : '' ); ?>">
                    <?php echo esc_html( $list['info_label'] ); ?>
                </a>
                <?php else : ?>
                    <?php echo esc_html( $list['info_label'] ); ?>
                <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>