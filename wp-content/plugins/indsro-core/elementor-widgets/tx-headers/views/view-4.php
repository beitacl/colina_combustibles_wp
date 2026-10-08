<?php

    $enable_custom_link = $settings['enable_custom_link'];
    if($enable_custom_link == 'yes') {
        $custom_link = $settings['custom_link']['url'];
    } else {
        $custom_link = home_url( '/' );
    }

    // enable position
    $enable_position_absolute = $settings['enable_position_absolute'];
    if($enable_position_absolute == 'yes') {
        $position_absolute = ' position-absolute';
    } else {
        $position_absolute = '';
    }

    // enable sticky header
    $enable_sticky_header = $settings['enable_sticky_header'];
    if($enable_sticky_header === 'yes') {
        $sticky_header = 'tx_sticky_header';
    } else {
        $sticky_header = '';
    }
?>

<header class="fti-header-1-area tx-header <?php echo esc_attr($sticky_header . $position_absolute); ?>">
    <?php if(!empty( $settings['shape_image']['url'] )) : ?>
    <div class="bg-img">
        <img src="<?php echo esc_url($settings['shape_image']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['shape_image']['url'] ); } ?>">
    </div>
    <?php endif; ?>
    <div class="container fti-header-1-container">
        <div class="fti-header-1-wrap">
            <div class="fti-header-1-row d-flex align-items-center justify-content-between" >

                <!-- logo -->
                <?php if(!empty( $settings['logo']['url'] )) : ?>
                <a href="<?php echo esc_url($custom_link); ?>"
                aria-label="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['logo']['url'] ); } ?>" class="fti-header-1-logo-1 d-block tx-logo">
                    <img src="<?php echo esc_url($settings['logo']['url']); ?>"
                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['logo']['url'] ); } ?>">
                </a>
                <?php endif; ?>
                <!-- menu btn -->
                <button class="fti-menu-btn-1 d-lg-none open_menu" id="menuToggle">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" x="0px" y="0px" viewBox="0 0 24 24"
                        style="enable-background:new 0 0 24 24;" xml:space="preserve">
                        <path class="svg-path" d="M1,12h22 M1,4.7h22 M8.3,19.3H23"></path>
                    </svg>
                </button>
                <!-- menu -->
                <div class="fti-header-1-navigation-bar d-none d-lg-flex">
                 <?php if ( !empty( $settings['select_menu'] ) ) : ?>
                    <nav class="main-navigation d-none d-lg-block">
                    <?php
                        $menu_args = [
                            'menu'        => '' . $settings['select_menu'] . '',
                            'menu_class'     => 'nav navbar-nav clearfix list-unstyled',
                            'menu_id'        => 'main-nav',
                            'walker'         => class_exists('Tx_Mega_Menu_Walker') ? new Tx_Mega_Menu_Walker : '',
                            'fallback_cb'    => ['Navwalker_Class', 'fallback'],
                            'echo'           => false,
                        ];

                        $menu = wp_nav_menu($menu_args);
                        $menu = str_replace('menu-item-has-children', 'dropdown', $menu);
                        $menu = str_replace('sub-menu', 'dropdown-menu', $menu);

                        echo wp_kses_post($menu);
                    ?>
                    </nav>
                    <?php endif; ?>

                    <!-- btn  -->
                    <?php if( $settings['enable_button'] === 'yes' ) : ?>
                    <div class="btn-wrap">
                        <a class="fti-header-1-btn tx-button"
                            href="<?php echo esc_url($settings['button_link']['url']) ?>"
                            aria-label="<?php echo esc_attr($settings['button_text']); ?>"
                            target="<?php echo esc_attr( $settings['button_link']['is_external'] ? '_blank' : '_self' ); ?>"
                            rel="<?php echo esc_attr( $settings['button_link']['nofollow'] ? 'nofollow' : '' ); ?>"
                            aria-label="<?php echo esc_attr($settings['button_text']); ?>">
                            <?php if(!empty( $settings['button_text'] )) : ?>
                            <span class="btn-text"><?php echo esc_html($settings['button_text']); ?></span>
                            <?php endif; ?>

                            <?php if(!empty( $settings['button_icon'] )) {
                                    \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'class' => 'icon-1', 'aria-hidden' => 'true' ] );
                                }
                            ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- actions -->
                <div class="fti-header-1-action">
                    <?php if( $settings['enable_search'] === 'yes' ) : ?>
                    <button class="fti-header-1-search-btn search_btn_toggle">
                        <i class="flaticon-magnifying-glass"></i>
                    </button>
                    <?php endif; ?>

                    <?php if( $settings['enable_phone_info'] === 'yes' ) :
                        if($settings['link_type'] === 'email') {
                            $link_url = 'mailto:' . $settings['contact_info_text'];
                        } elseif( $settings['link_type'] === 'phone' ) {
                            $link_url = 'tel:' . $settings['contact_info_text'];
                        } else {
                            $link_url = $settings['contact_info_text'];
                        }
                    ?>
                    <div class="fti-header-1-contact">
                        <?php if(!empty( $settings['contact_info_icon'] )) : ?>
                        <a class="icon-1" href="<?php echo esc_url($link_url); ?>">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['contact_info_icon'], [ 'aria-hidden' => 'true' ] );?>
                        </a>
                        <?php endif; ?>
                        <div>
                            <?php if(!empty( $settings['contact_info_label'] )) : ?>
                            <span class="fti-para-1 question"><?php echo elh_element_kses_intermediate( $settings['contact_info_label'] ); ?></span>
                            <?php endif; ?>

                            <?php if(!empty( $settings['contact_info_text'] )) : ?>
                            <h4 class="fti-heading-1 number">
                                <a href="<?php echo esc_url($link_url); ?>">
                                    <?php echo elh_element_kses_intermediate( $settings['contact_info_text'] ); ?>
                                </a>
                            </h4>
                            <?php endif; ?>

                        </div>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-end -->

<!-- mobile-menu-start -->
<div class="mobile-menu lenis lenis-smooth">
    <div class="mobile-menu-wrap">
        <div class="mobile-menu-logo-wrap mb-40">

            <?php if( $settings['enable_mobile_logo'] === 'yes' ) : ?>
            <a href="<?php echo esc_url($custom_link); ?>"
            class="mobile-menu-logo d-block tx-logo"
            aria-label="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['mobile_logo']['url'] ); } ?>">
                <img src="<?php echo esc_url($settings['mobile_logo']['url']); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['mobile_logo']['url'] ); } ?>">
            </a>
            <?php endif; ?>

            <div class="mobile-menu-close open_menu" id="menuToggle2">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>

        <?php if(!empty( $settings['info_text'] )) : ?>
        <p class="fd-para-2 mobile-menu-disc"><?php echo elh_element_kses_intermediate($settings['info_text']); ?></p>
        <?php endif; ?>

        <!-- search-form -->
        <?php if( $settings['enable_search'] === 'yes' ) : ?>
        <div class="mobile-menu-search-bar">
            <form method="get" action="<?php print esc_url(home_url('/')); ?>" class="mobile-menu-search-form-1 mb-50">
                <input type="search" name="s" aria-label="search" placeholder="<?php print esc_attr($settings['search_placeholder']); ?>" value="<?php print esc_attr( get_search_query() )?>">
                <button class="form-btn" type="submit" aria-label="name" >
                    <?php \Elementor\Icons_Manager::render_icon( $settings['search_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </button>
            </form>
        </div>
        <?php endif; ?>

        <!-- mobile-menu-list -->
        <div class="mobile-menu-navigation">
            <nav class="mobile-main-navigation clearfix ul-li">
                <?php
                    $menu_args = [
                        'menu'        => '' . $settings['select_mobile_menu'] . '',
                        'menu_class'     => 'nav navbar-nav clearfix list-unstyled',
                        'menu_id'        => 'main-nav',
                        'walker'         => class_exists('Tx_Mega_Menu_Walker') ? new Tx_Mega_Menu_Walker : '',
                        'fallback_cb'    => ['Navwalker_Class', 'fallback'],
                        'echo'           => false,
                    ];

                    $menu = wp_nav_menu($menu_args);
                    $menu = str_replace('menu-item-has-children', 'dropdown', $menu);
                    $menu = str_replace('sub-menu', 'dropdown-menu clearfix', $menu);

                    echo wp_kses_post($menu);
                ?>
            </nav>
        </div>

        <?php if( $settings['enable_contact_info'] === 'yes' ) : ?>
        <ul class="mobile-menu-contact">
            <?php
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
            <li>
                <?php if( $list['enable_icon'] === 'yes' ) : ?>
                <span class="icon">
                    <?php if( $list['type'] === 'icon' ) : ?>
                        <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
                    <?php endif; ?>
                </span>
                <?php endif; ?>
                <span class="content">
                    <?php if(!empty( $list['info_label'] )) : ?>
                    <h6 class="title fd-heading-4"> <?php echo esc_html( $list['info_label'] ); ?></h6>
                    <?php endif; ?>
                    <?php if(!empty( $list['info_text'] )) : ?>
                    <p class="disc fd-heading-4 m-0"><?php echo esc_html( $list['info_text'] ); ?></p>
                    <?php endif; ?>
                </span>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <!-- social-link -->
        <?php if( $settings['enable_social_links'] === 'yes' ) : ?>
        <div class="mobile-menu-social-1">
            <?php foreach($settings['social_links'] as $list ) : ?>
            <a aria-label="name" data-toggle="tooltip" data-placement="bottom" title="Facebook"
            href="<?php echo esc_url($list['social_link']['url']) ?>"
            target="<?php echo esc_attr( $list['social_link']['is_external'] ? '_blank' : '_self' ); ?>"
            rel="<?php echo esc_attr( $list['social_link']['nofollow'] ? 'nofollow' : '' ); ?>">
                <?php \Elementor\Icons_Manager::render_icon( $list['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="mobile_menu_overlay open_menu"></div>
</div>

<?php if( $settings['enable_search'] === 'yes' ) : ?>
<div class="popup-search-box d-none d-lg-block search_1_popup_active">
    <button class="search-close search_1_popup_close">
        <i class="fal fa-times"></i>
    </button>
    <form method="get" action="<?php print esc_url(home_url('/')); ?>">
        <input type="search" name="s" aria-label="search" placeholder="<?php print esc_attr($settings['search_placeholder']); ?>" value="<?php print esc_attr( get_search_query() )?>">
        <button type="submit">
            <?php \Elementor\Icons_Manager::render_icon( $settings['search_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </button>
    </form>
</div>
<?php endif; ?>