<?php

$wow_animation = '';
if ( $settings['enable_animation'] === 'yes' ) {
    $wow_animation = 'wow ' . $settings['wow_animation'];
}

if(!empty( $settings['image_1']['url'] )) :
?>
<div class="main-img img-cover <?php echo esc_attr($wow_animation) ?>">
    <img
    src="<?php echo esc_url($settings['image_1']['url']); ?>"
    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
</div>
<?php endif; ?>