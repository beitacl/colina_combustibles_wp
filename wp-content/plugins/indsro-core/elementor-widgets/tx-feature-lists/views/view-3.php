<div class="fti-about-2-wrap">
    <div class="about-2-left">
        <div class="exper">
            <span class="main-icon">
                <?php if(!empty( $settings['feature_icon'] )) : ?>
                <span class="icon-1">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </span>
                <?php endif; ?>

                <?php if(!empty( $settings['feature_image']['url'] )) : ?>
                <div class="img-wrap">
                    <img src="<?php echo esc_url($settings['feature_image']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['feature_image']['url'] ); } ?>">
                </div>
                <?php endif; ?>
            </span>
            <div class="list fti_right_slide_1">
                <?php foreach( $settings['list_items'] as $list ) : ?>
                <span class="fti-para-2 list-item">
                    <?php if( $list['enable_icon'] == true ) : ?>
                        <?php if ( $list['type'] == 'icon' ): ?>
                            <?php \Elementor\Icons_Manager::render_icon( $list['feature_icon'], ['aria-hidden' => 'true'] );?>
                        <?php else: ?>
                            <img src="<?php echo esc_url( $list['feature_image']['url'] ); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['feature_image']['url'] ); } ?>" />
                        <?php endif;?>
                    <?php endif; ?>

                    <?php
                        if(!empty( $list['feature_text'] )) :
                        echo esc_html( $list['feature_text'] );
                        endif;
                    ?>
                </span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
