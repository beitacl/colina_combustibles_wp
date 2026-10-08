<div class="log-quote-form-wrap-1 ver_2 position-relative headline appear_left">

    <?php if(!empty( $settings['quote_heading'] )) : ?>
    <h3 class="tx-split-text split-in-right">
        <?php echo elh_element_kses_intermediate( $settings['quote_heading'] ); ?>
    </h3>
    <?php endif; ?>
    <?php if(!empty( $settings['quote_form_shortcode'] )) : ?>
    <div class="quoteform-wrapper">
        <?php echo do_shortcode($settings['quote_form_shortcode']); ?>
    </div>
    <?php endif; ?>
</div>