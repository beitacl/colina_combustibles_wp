<div class="fti-about-4-right tx-listItems m-0">
    <div class="content d-block m-0">
        <ul class="list-unstyled">
            <?php foreach( $settings['list_items'] as $list ) : ?>
            <li>
                <?php if( $list['enable_icon'] == true ) : ?>
                    <?php if ( $list['type'] == 'icon' ): ?>
                        <?php \Elementor\Icons_Manager::render_icon( $list['feature_icon'], ['aria-hidden' => 'true'] );?>
                    <?php else: ?>
                        <img src="<?php echo esc_url( $list['feature_image']['url'] ); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['feature_image']['url'] ); } ?>" />
                    <?php endif;?>
                <?php endif; ?>
                <?php
                if(!empty( $list['feature_text'] )) : ?>
                <span><?php echo esc_html( $list['feature_text'] ); ?></span>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
