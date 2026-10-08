<div class="fti-contact-us-wrap">
    <div class="action-wrap">
        <div class="action bg-default" data-background="<?php echo $settings['image_1']['url'] ? esc_url($settings['image_1']['url']) : ''; ?>">
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
            <div class="item">
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
                    <h6 class="fti-heading-3 action-title"><?php echo esc_html( $list['info_heading'] ); ?></h6>
                    <?php endif; ?>

                    <?php if(!empty( $list['info_label'] )) : ?>
                    <span class="action-text"><?php echo esc_html( $list['info_label'] ); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</div>