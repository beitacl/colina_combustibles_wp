<?php
// header logos
function indsro_header_logo() {
    ?>
    <?php
        $indsro_site_logo = cs_get_option( 'indsro_logo', get_template_directory_uri() . '/assets/img/logo/logo-white.webp');
        if(isset($indsro_site_logo['url'])) {
            $logo_url = $indsro_site_logo['url'];
        } else {
            $logo_url = get_template_directory_uri() . '/assets/img/logo/logo-white.webp';
        }
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                ?>
                <a class="tx-logo fti-header-3-logo" href="<?php print esc_url( home_url( '/' ) );?>">
                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text($logo_url); } ?>" />
                </a>
                <?php
            }
        ?>
    <?php
}


// side info logo
function indsro_side_info_logo() {
    $tx_sideInfo_logo = cs_get_option( 'tx_sideInfo_logo', get_template_directory_uri() . '/assets/img/logo/logo-2.webp');
    if(isset($tx_sideInfo_logo['url'])) {
        $logo_url = $tx_sideInfo_logo['url'];
    } else {
        $logo_url = get_template_directory_uri() . '/assets/img/logo/logo-2.webp';
    }

    ?>
    <a class="mobile-menu-logo d-block tx-logo" aria-label="brand-logo" href="<?php print esc_url( home_url( '/' ) );?>">
        <img src="<?php print esc_url( $logo_url );?>" alt="<?php if(function_exists('logo_url')) { echo indsro_img_alt_text($logo_url); } ?>" />
    </a>


<?php }