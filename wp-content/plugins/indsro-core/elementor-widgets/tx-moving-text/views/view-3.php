<div class="chy-marquee-5-area">
    <div class="chy-marquee-5-wrap">
    <?php foreach( $settings['list_items'] as $list ) : ?>
        <?php if( $list['enable_icon'] === 'yes' ) : ?>
            <?php if( $list['type'] === 'icon' ) : ?>
                <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            <?php else : ?>
                <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="">
            <?php endif; ?>
        <?php endif; ?>
        <h5 class="chy-heading-2 <?php if(!empty($list['custom_cls'])){ echo esc_attr($list['custom_cls']);}?>"><?php echo esc_html( $list['info_label'] ); ?></h5>
        <?php endforeach;?>
    </div>
</div>