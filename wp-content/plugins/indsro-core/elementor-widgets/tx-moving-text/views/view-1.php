<div class="chy-marquee-text-2-area fix pt-15 pb-15">
    <div class="chy-marquee-text-2-wrap">
        <?php foreach( $settings['list_items'] as $list ) : ?>
        <h3 class="chy-heading-1 title">
            <?php if( $list['enable_icon'] === 'yes' ) : ?>
                <?php if( $list['type'] === 'icon' ) : ?>
                    <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <?php else : ?>
                    <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="">
                <?php endif; ?>
            <?php endif; ?>

            <?php
                if( $list['enable_link'] === 'yes' ) :
            ?>
            <a href="<?php echo esc_url( $list['list_link']['url'] ); ?>" target="<?php echo esc_attr( $list['list_link']['is_external'] ? '_blank' : '_self' ); ?>" rel="<?php echo esc_attr( $list['list_link']['nofollow'] ? 'nofollow' : '' ); ?>">
                <?php echo esc_html( $list['info_label'] ); ?>
            </a>
            <?php else : ?>
                <?php echo esc_html( $list['info_label'] ); ?>
            <?php endif; ?>
        </h3>
        <?php endforeach; ?>
    </div>
</div>