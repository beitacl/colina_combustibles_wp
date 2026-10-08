<div class="brochure-wrap">
    <?php foreach( $settings['list_items'] as $list ) :
        if($list['link_type'] === 'email') {
            $link_url = 'mailto:' . $list['list_link']['url'];
        } elseif( $list['link_type'] === 'phone' ) {
            $link_url = 'tel:' . $list['list_link']['url'];
        } else {
            $link_url = $list['list_link']['url'];
        }
    ?>
    <a href="<?php echo esc_url( $link_url ); ?>" class="brochure-btn">
        <?php if( $list['enable_icon'] === 'yes' ) : ?>
        <div class="icon">
            <?php if( $list['type'] === 'icon' ) : ?>
                <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            <?php else : ?>
                <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <span class="btn-text"><?php echo elh_element_kses_intermediate( $list['info_label'] ); ?></span>
    </a>
    <?php endforeach; ?>
</div>