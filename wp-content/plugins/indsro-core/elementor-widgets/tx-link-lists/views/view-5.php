<!-- category-menu -->
<ul class="sidebar-category">
    <?php foreach( $settings['list_items'] as $list ) :
        if($list['link_type'] === 'email') {
            $link_url = 'mailto:' . $list['list_link']['url'];
        } elseif( $list['link_type'] === 'phone' ) {
            $link_url = 'tel:' . $list['list_link']['url'];
        } else {
            $link_url = $list['list_link']['url'];
        }
    ?>
    <li class="wow fadeInUp">
        <a href="<?php echo esc_url( $link_url ); ?>">
            <span class="text">
                <?php echo elh_element_kses_intermediate( $list['info_label'] ); ?>
            </span>
            <?php if( $list['enable_icon'] === 'yes' ) : ?>
            <span class="icon-1">
                <?php if( $list['type'] === 'icon' ) : ?>
                    <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <?php else : ?>
                    <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
                <?php endif; ?>
            </span>
            <?php endif; ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>