<div class="chy-project-4-area pt-65 pb-110 fix">
    <?php if(!empty($settings['image']['url'])):?>
    <div class="bg-img img-cover">
        <img src="<?php echo esc_url($settings['image']['url']);?>" alt="">
    </div>
    <?php endif;?>

    <span class="bg-color"></span>

    <div class="container chy-container-2">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="chy-project-4-content">
                    <?php if(!empty($settings['title'])):?>
                    <h2 class="chy-title-4 chy-split-in-right chy-split-text"><?php echo wp_kses($settings['title'], true)?></h2>
                    <?php endif;?>
                    <?php if(!empty($settings['title'])):?>
                    <a href="<?php echo esc_url($settings['btn_link']['url']); ?>" aria-label="hero btn" class="chy-pr-btn-5">
                        <span class="text">
                            <?php echo esc_html($settings['btn_label'])?>
                        </span>
                        <span class="icon">
                            <i class="fa-solid fa-right-long"></i>
                        </span>
                    </a>
                    <?php endif;?>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="chy-project-4-feature-wrap">
                    <?php foreach($settings['conuntes'] as $item):?>
                        <div class="chy-project-4-feature <?php if(!empty($item['custom_class'])){ echo esc_attr($item['custom_class']);}?>">
                            <?php if($item['enable_icon'] === 'yes'):?>
                            <div class="icon">
                                <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </div>
                            <?php endif;?>
                            <h6 class="chy-heading-2 number"><span class="txCounterActive" ><?php echo esc_html($item['count_number']);?></span><?php if(!empty($item['sign'])){ echo esc_html($item['sign']);}?></h6>
                            <p class="chy-para-4 text"><?php echo esc_html($item['count_title']);?></p>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>