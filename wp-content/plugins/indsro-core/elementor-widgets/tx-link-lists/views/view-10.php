<div class="log-side-bar-wrap">
    <div class="log-sidebar-widget headline">
        <div class="category-widget ul-li-block">
            <?php if(!empty( $settings['info_heading'] )) : ?>
            <h3 class="widget-title position-relative">
                <?php echo esc_html($settings['info_heading']); ?>
            </h3>
            <?php endif; ?>
            <ul>
                <?php foreach( $settings['list_items'] as $list ) : ?>
                <li class="wow" data-splitting>
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
    </div>
</div>