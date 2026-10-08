
<div class="wrap about-wrap tx-wrap">
<h1><?php tf_theme_name(); ?> Documentations</h1>
    <div class="tx-system-stats">

        <?php if(INDSRO_CORE_PLUGIN_ACTIVED ) : ?>
            <h3 class="text-center">All Required Plugins Already Installed</h3>
        <?php else : ?>
            <h3 class="text-center">Install Required Plugins First To Import Demo</h3>
            <a class="active-btn button-primary" href="themes.php?page=tgmpa-install-plugins">Install Now!</a>
        <?php endif; ?>

        <p class="about-description">You can skip the plugins that you don't need. You must need <strong>Indsro Core</strong>, Elementor, Demo Importer, and in some cases you need contact form 7 if you chose any demo which contains forms</p>
    </div>
    <div class="tx-system-stats">
        <iframe src="https://themexriver.com/wp/indsro/indsro-doc/" frameborder="0"  style="width: 100%; height: 100vh; border: none;"></iframe>
    </div>
</div>
