<div class="fti-footer-1-top">
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
    <div class="footer-top-item">
        <?php if(!empty( $list['info_heading'] )) : ?>
        <span class="title"><?php echo esc_html( $list['info_heading'] ); ?></span>
        <?php endif; ?>
        <div class="item-link wow fadeInLeft">
            <?php if( $list['enable_icon'] === 'yes' ) : ?>
            <span class="icon-wrap">
                <span class="icon-1">
                    <?php if( $list['type'] === 'icon' ) : ?>
                        <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
                    <?php endif; ?>
                </span>
                <span class="icon-2">
                    <i class="flaticon-hexagon"></i>
                </span>
            </span>
            <?php endif; ?>
            <a href="<?php echo $info_label; ?>"><?php echo esc_html( $list['info_label'] ); ?></a>
        </div>
    </div>
    <?php endforeach; endif; ?>
</div>