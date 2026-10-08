<div class="fti-company-2-wrap d-block">
    <div class="company-2-right">
        <div class="feature d-block m-0">
            <div class="feature-item-1">
                <div class="list">
                    <?php foreach( $settings['list_items'] as $list ) : ?>
                    <span class="fti-para-2 list-item">
                    <?php if( $list['enable_icon'] == true ) : ?>
                        <?php if ( $list['type'] == 'icon' ): ?>
                            <?php \Elementor\Icons_Manager::render_icon( $list['feature_icon'], ['aria-hidden' => 'true'] );?>
                        <?php else: ?>
                            <img src="<?php echo esc_url( $list['feature_image']['url'] ); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['feature_image']['url'] ); } ?>" />
                        <?php endif;?>
                    <?php endif; ?>
                        <?php echo esc_html( $list['feature_text'] ); ?>
                    </span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>