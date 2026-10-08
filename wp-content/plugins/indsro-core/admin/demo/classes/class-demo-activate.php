<?php
/**
 * Theme License Handler
 * Copy this to your theme and update the configuration values
 */
class Theme_License {

    // ========== CONFIGURATION - UPDATE THESE ==========
    private $license_server = 'https://themexriver.com/wp/indsro';  // Your server URL
    private $api_key        = '007cpypuarctBlfZc5NPqCzLJTzqRX60b4XEBlNJ';              // From LicenseX settings
    private $theme_name     = 'Indsro';                          // Your theme name
    // ===================================================

    private $option_name = 'my_theme_license';
    private $menu_slug   = 'theme-license';
    private $cron_hook   = 'my_theme_license_check';

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_menu' ) );
        add_action( 'admin_init', array( $this, 'handle_form' ) );
        add_action( 'admin_notices', array( $this, 'license_notice' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );

        // Daily license validation
        add_action( $this->cron_hook, array( $this, 'validate_license' ) );
        if ( ! wp_next_scheduled( $this->cron_hook ) ) {
            wp_schedule_event( time(), 'daily', $this->cron_hook );
        }

        // Block demo import when license is inactive.
        add_action( 'admin_enqueue_scripts', array( $this, 'block_demo_import_page' ), 999 );
        add_action( 'admin_init', array( $this, 'block_demo_import_ajax' ), 1 );
    }

    public function add_menu() {
        add_theme_page(
            $this->theme_name . ' License',
            'Theme License',
            'manage_options',
            $this->menu_slug,
            array( $this, 'render_page' )
        );
    }

    public function enqueue_styles( $hook ) {
        if ( strpos( $hook, $this->menu_slug ) === false ) return;
        wp_add_inline_style( 'wp-admin', $this->get_styles() );
    }

    public function render_page() {
        $msg = isset( $_GET['msg'] ) ? sanitize_text_field( $_GET['msg'] ) : '';

        // Skip real-time check right after activation/deactivation to avoid
        // race conditions that could delete the freshly saved license option.
        if ( $msg !== 'activated' && $msg !== 'deactivated' ) {
            $this->check_license_realtime();
        }

        $license   = get_option( $this->option_name, array() );
        $is_active = $this->is_active();
        ?>
        <div class="wrap txl-wrap">
            <div class="txl-container">
                <div class="txl-header">
                    <div class="txl-logo">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                            <path d="M12 2L4 6V12C4 16.5 7.4 20.7 12 22C16.6 20.7 20 16.5 20 12V6L12 2Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <h1 class="txl-title"><?php echo esc_html( $this->theme_name ); ?></h1>
                    <p class="txl-subtitle">License Activation</p>
                </div>

                <?php if ( $msg === 'activated' ) : ?>
                    <div class="txl-notice txl-notice-success"><strong>✓ Success!</strong> License activated.</div>
                <?php elseif ( $msg === 'deactivated' ) : ?>
                    <div class="txl-notice txl-notice-info">License deactivated.</div>
                <?php elseif ( $msg === 'error' ) : ?>
                    <div class="txl-notice txl-notice-error"><?php echo esc_html( get_transient( 'txl_error_msg' ) ?: 'Error occurred.' ); ?></div>
                <?php endif; ?>

                <?php if ( $is_active ) : ?>
                    <div class="txl-card txl-card-active">
                        <div class="txl-status-badge active">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            License Active
                        </div>
                        <div class="txl-info-grid">
                            <div class="txl-info-item">
                                <span class="txl-info-label">License Key</span>
                                <span class="txl-info-value"><code><?php echo esc_html( substr( $license['code'], 0, 12 ) . '••••••••' ); ?></code></span>
                            </div>
                            <div class="txl-info-item">
                                <span class="txl-info-label">Email</span>
                                <span class="txl-info-value"><?php echo esc_html( $license['email'] ?? '—' ); ?></span>
                            </div>
                            <div class="txl-info-item">
                                <span class="txl-info-label">Activated On</span>
                                <span class="txl-info-value"><?php echo esc_html( $license['activated_at'] ?? '—' ); ?></span>
                            </div>
                            <div class="txl-info-item">
                                <span class="txl-info-label">Domain</span>
                                <span class="txl-info-value"><?php echo esc_html( wp_parse_url( home_url(), PHP_URL_HOST ) ); ?></span>
                            </div>
                        </div>
                        <form method="post" class="txl-deactivate-form">
                            <?php wp_nonce_field( 'txl_deactivate' ); ?>
                            <input type="hidden" name="txl_action" value="deactivate">
                            <button type="submit" class="txl-btn txl-btn-outline" onclick="return confirm('Are you sure?');">Deactivate License</button>
                        </form>
                    </div>
                <?php else : ?>
                    <div class="txl-card">
                        <h2 class="txl-card-title">Activate Your License</h2>
                        <p class="txl-card-desc">Enter your purchase details to unlock all features.</p>
                        <form method="post" class="txl-form">
                            <?php wp_nonce_field( 'txl_activate' ); ?>
                            <input type="hidden" name="txl_action" value="activate">
                            <div class="txl-form-group">
                                <label for="txl_email">Email Address</label>
                                <input type="email" name="email" id="txl_email" placeholder="your@email.com" required value="<?php echo esc_attr( get_option( 'admin_email' ) ); ?>">
                            </div>
                            <div class="txl-form-group">
                                <label for="txl_code">Purchase Code</label>
                                <input type="text" name="purchase_code" id="txl_code" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" required>
                                <span class="txl-help">Find it in your <a href="https://themeforest.net/downloads" target="_blank">Envato Downloads</a></span>
                            </div>
                            <button type="submit" class="txl-btn txl-btn-primary">Activate License</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    public function handle_form() {
        if ( ! isset( $_POST['txl_action'] ) || ! current_user_can( 'manage_options' ) ) return;
        $action = sanitize_text_field( $_POST['txl_action'] );
        $redirect = admin_url( 'themes.php?page=' . $this->menu_slug );

        if ( $action === 'activate' ) {
            check_admin_referer( 'txl_activate' );
            $result = $this->activate( sanitize_text_field( $_POST['purchase_code'] ), sanitize_email( $_POST['email'] ) );
            if ( $result['success'] ) {
                wp_safe_redirect( $redirect . '&msg=activated' );
            } else {
                set_transient( 'txl_error_msg', $result['message'], 30 );
                wp_safe_redirect( $redirect . '&msg=error' );
            }
            exit;
        }

        if ( $action === 'deactivate' ) {
            check_admin_referer( 'txl_deactivate' );
            $this->deactivate();
            wp_safe_redirect( $redirect . '&msg=deactivated' );
            exit;
        }
    }

    public function license_notice() {
        if ( $this->is_active() ) return;
        $screen = get_current_screen();
        if ( $screen && strpos( $screen->id, $this->menu_slug ) !== false ) return;
        $url = admin_url( 'themes.php?page=' . $this->menu_slug );

        echo '<style>
            @keyframes txl-dangerPulse {
                0% { box-shadow: 0 0 0px rgba(239, 68, 68, 0.4); transform: scale(1); }
                50% { box-shadow: 0 0 20px rgba(239, 68, 68, 0.8); transform: scale(1.005); }
                100% { box-shadow: 0 0 0px rgba(239, 68, 68, 0.4); transform: scale(1); }
            }
            .txl-license-notice {
                border-left-color: #ef4444 !important;
                background: #fef2f2 !important;
                color: #b91c1c !important;
                animation: txl-dangerPulse 2s infinite !important;
                padding: 12px 15px !important;
            }
            .txl-license-notice p {
                font-weight: 700 !important;
                font-size: 15px !important;
                margin: 0 !important;
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .txl-license-notice a {
                color: #fff !important;
                background: #ef4444 !important;
                padding: 4px 12px !important;
                border-radius: 6px !important;
                text-decoration: none !important;
                transition: all 0.2s;
            }
            .txl-license-notice a:hover {
                background: #dc2626 !important;
                transform: translateY(-1px);
            }
        </style>';
        echo '<div class="notice notice-warning txl-license-notice"><p><span class="dashicons dashicons-lock"></span> <span><strong>' . esc_html( $this->theme_name ) . '</strong> — You must activate your license to unlock demo import and premium features.</span> <a href="' . esc_url( $url ) . '">Activate License Now</a></p></div>';
    }

    public function activate( $purchase_code, $email ) {
        $response = wp_remote_post( $this->license_server . '/wp-json/licensex/v1/verify', array(
            'headers' => array( 'X-LX-Key' => $this->api_key, 'Content-Type' => 'application/json' ),
            'body' => wp_json_encode( array( 'purchase_code' => $purchase_code, 'site_url' => home_url(), 'email' => $email ) ),
            'timeout' => 30,
        ));

        if ( is_wp_error( $response ) ) {
            return array( 'success' => false, 'message' => 'Connection failed: ' . $response->get_error_message() );
        }

        $code = wp_remote_retrieve_response_code( $response );
        $body = json_decode( wp_remote_retrieve_body( $response ), true );

        if ( $code === 409 && isset( $body['data']['bound_to'] ) ) {
            return array( 'success' => false, 'message' => 'License already active on: ' . $body['data']['bound_to'] );
        }

        if ( isset( $body['success'] ) && $body['success'] ) {
            update_option( $this->option_name, array(
                'code' => $purchase_code, 'email' => $email, 'status' => 'active',
                'activated_at' => current_time( 'F j, Y' ), 'data' => $body['data'] ?? array(),
            ));
            delete_option( $this->option_name . '_fail_count' );
            return array( 'success' => true );
        }

        return array( 'success' => false, 'message' => $body['error'] ?? 'Activation failed.' );
    }

    public function deactivate() {
        $license = get_option( $this->option_name );
        if ( ! empty( $license['code'] ) ) {
            wp_remote_post( $this->license_server . '/wp-json/licensex/v1/deactivate', array(
                'headers' => array( 'X-LX-Key' => $this->api_key, 'Content-Type' => 'application/json' ),
                'body' => wp_json_encode( array( 'purchase_code' => $license['code'] ) ),
                'timeout' => 15,
            ));
        }
        delete_option( $this->option_name );
        delete_option( $this->option_name . '_fail_count' );
    }

    public function validate_license() {
        $license = get_option( $this->option_name );
        if ( empty( $license['code'] ) ) return;

        $response = wp_remote_post( $this->license_server . '/wp-json/licensex/v1/check', array(
            'headers' => array( 'X-LX-Key' => $this->api_key, 'Content-Type' => 'application/json' ),
            'body' => wp_json_encode( array( 'purchase_code' => $license['code'], 'site_url' => home_url() ) ),
            'timeout' => 15,
        ));

        if ( is_wp_error( $response ) ) return;

        $code = wp_remote_retrieve_response_code( $response );
        if ( $code === 410 || $code === 409 || $code === 404 ) {
            delete_option( $this->option_name );
        }
    }

    private function check_license_realtime() {
        $license = get_option( $this->option_name );
        if ( empty( $license['code'] ) ) return;

        $cache_key = 'txl_last_check';
        if ( get_transient( $cache_key ) ) return;

        $response = wp_remote_post( $this->license_server . '/wp-json/licensex/v1/check', array(
            'headers' => array( 'X-LX-Key' => $this->api_key, 'Content-Type' => 'application/json' ),
            'body'    => wp_json_encode( array( 'purchase_code' => $license['code'], 'site_url' => home_url() ) ),
            'timeout' => 10,
        ));

        // Cache for 5 minutes regardless of outcome.
        set_transient( $cache_key, 1, 5 * MINUTE_IN_SECONDS );

        if ( is_wp_error( $response ) ) return;

        $code = wp_remote_retrieve_response_code( $response );

        if ( $code === 200 ) {
            // Success — reset any failure counter.
            delete_option( $this->option_name . '_fail_count' );
            return;
        }

        if ( $code === 410 || $code === 409 || $code === 404 ) {
            // Require 3 consecutive failures before deactivating.
            // This prevents false deactivation from server-side cache issues.
            $fails = (int) get_option( $this->option_name . '_fail_count', 0 );
            $fails++;
            update_option( $this->option_name . '_fail_count', $fails );

            if ( $fails >= 3 ) {
                delete_option( $this->option_name );
                delete_option( $this->option_name . '_fail_count' );
                delete_transient( $cache_key );
            }
        }
    }

    public function is_active() {
        return true;
    }

    /* ========================================================
     * DEMO IMPORT LICENSE GATE
     * ======================================================== */

    /**
     * Inject a full-screen blocking overlay on the demo import page.
     */
    public function block_demo_import_page( $hook ) {
        if ( $this->is_active() ) {
            return;
        }
        if ( false === strpos( $hook, 'indsro-demo-import' ) ) {
            return;
        }

        $license_url = admin_url( 'themes.php?page=' . $this->menu_slug );
        $theme       = esc_html( $this->theme_name );
        $url         = esc_url( $license_url );

        // Inline CSS + JS — full-screen overlay that hides everything underneath.
        wp_add_inline_style( 'wp-admin', '
            .txl-import-blocker {
                position: fixed;
                inset: 0;
                z-index: 999999;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(15, 23, 42, 0.95);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
            }
            .txl-import-blocker-inner {
                text-align: center;
                max-width: 560px;
                padding: 48px 40px;
                background: #fff;
                border-radius: 20px;
                box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            }
            .txl-import-blocker-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 80px;
                height: 80px;
                border-radius: 50%;
                background: linear-gradient(135deg, #ef4444, #dc2626);
                margin-bottom: 24px;
                box-shadow: 0 8px 32px rgba(239,68,68,0.3);
            }
            .txl-import-blocker-icon svg {
                color: #fff;
                width: 40px;
                height: 40px;
            }
            .txl-import-blocker h2 {
                font-size: 26px;
                font-weight: 800;
                color: #1e293b;
                margin: 0 0 12px;
                line-height: 1.3;
            }
            .txl-import-blocker p {
                font-size: 16px;
                color: #64748b;
                margin: 0 0 32px;
                line-height: 1.6;
            }
            .txl-import-blocker .txl-gate-btn {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 16px 32px;
                background: linear-gradient(135deg, #6366f1, #a855f7);
                color: #fff;
                font-size: 16px;
                font-weight: 700;
                border: none;
                border-radius: 12px;
                cursor: pointer;
                text-decoration: none;
                transition: all 0.3s ease;
                box-shadow: 0 8px 24px rgba(99,102,241,0.35);
            }
            .txl-import-blocker .txl-gate-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 12px 32px rgba(99,102,241,0.45);
                color: #fff;
            }
        ' );

        add_action( 'admin_footer', function() use ( $theme, $url ) {
            ?>
            <script>
                // SECURE BLOCK: Physically remove the demo importer UI from the DOM
                // so it cannot be recovered by deleting the overlay via DevTools.
                document.addEventListener('DOMContentLoaded', function() {
                    var container = document.querySelector('#wpbody-content');
                    if (container) {
                        // Empty the container completely
                        container.innerHTML = '';

                        // Inject the un-bypassable overlay
                        container.innerHTML = `
                            <div class="txl-import-blocker">
                                <div class="txl-import-blocker-inner">
                                    <div class="txl-import-blocker-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                    </div>
                                    <h2>License Activation Required</h2>
                                    <p>You must activate your <strong><?php echo esc_js($theme); ?></strong> license before you can import demo data. Please go to the license page and enter your purchase code to unlock this feature.</p>
                                    <a href="<?php echo esc_url($url); ?>" class="txl-gate-btn">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3"></path>
                                        </svg>
                                        Activate License
                                    </a>
                                </div>
                            </div>
                        `;
                    }
                });
            </script>
            <?php
        }, 9999 );
    }

    /**
     * Server-side guard — block AJAX import action if unlicensed.
     */
    public function block_demo_import_ajax() {
        if ( $this->is_active() ) {
            return;
        }

        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            $action = isset( $_REQUEST['action'] ) ? sanitize_text_field( $_REQUEST['action'] ) : '';
            $blocked_actions = array(
                'indsro_start_import',
                'indsro_process_step',
                'indsro_get_import_status',
            );
            if ( in_array( $action, $blocked_actions, true ) ) {
                wp_send_json_error( array(
                    'message' => 'License not activated. Demo import is disabled.',
                ), 403 );
            }
        }
    }

    private function get_styles() {
        return '.txl-wrap{background:#f0f2f5;min-height:100vh;margin-left:-20px;padding:40px 20px}.txl-container{max-width:540px;margin:0 auto}.txl-header{text-align:center;margin-bottom:32px}.txl-logo{display:inline-flex;align-items:center;justify-content:center;width:72px;height:72px;background:linear-gradient(135deg,#6366f1 0%,#a855f7 100%);border-radius:16px;color:#fff;margin-bottom:16px;box-shadow:0 10px 40px rgba(99,102,241,.3)}.txl-title{font-size:28px;font-weight:700;color:#1e293b;margin:0 0 4px}.txl-subtitle{color:#64748b;margin:0;font-size:15px}.txl-card{background:#fff;border-radius:16px;padding:32px;box-shadow:0 4px 6px -1px rgba(0,0,0,.1);margin-bottom:20px}.txl-card-active{border:2px solid #10b981}.txl-card-title{font-size:20px;font-weight:600;color:#1e293b;margin:0 0 8px}.txl-card-desc{color:#64748b;margin:0 0 24px}.txl-status-badge{display:inline-flex;align-items:center;gap:8px;padding:8px 16px;border-radius:100px;font-weight:600;font-size:14px;margin-bottom:24px}.txl-status-badge.active{background:#d1fae5;color:#059669}.txl-info-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px}.txl-info-label{display:block;font-size:12px;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;margin-bottom:4px}.txl-info-value{font-size:14px;color:#334155}.txl-info-value code{background:#f1f5f9;padding:4px 8px;border-radius:4px;font-size:13px}.txl-form-group{margin-bottom:20px}.txl-form-group label{display:block;font-weight:500;color:#334155;margin-bottom:8px;font-size:14px}.txl-form-group input{width:100%;padding:12px 16px;border:1px solid #e2e8f0;border-radius:8px;font-size:15px;box-sizing:border-box}.txl-form-group input:focus{outline:none;border-color:#6366f1;box-shadow:0 0 0 3px rgba(99,102,241,.1)}.txl-help{display:block;margin-top:6px;font-size:13px;color:#94a3b8}.txl-help a{color:#6366f1}.txl-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:14px 24px;border-radius:8px;font-size:15px;font-weight:600;cursor:pointer;transition:all .2s;border:none;width:100%}.txl-btn-primary{background:linear-gradient(135deg,#6366f1 0%,#a855f7 100%);color:#fff}.txl-btn-primary:hover{transform:translateY(-1px);box-shadow:0 10px 40px rgba(99,102,241,.3)}.txl-btn-outline{background:transparent;border:1px solid #e2e8f0;color:#64748b}.txl-btn-outline:hover{border-color:#ef4444;color:#ef4444}.txl-deactivate-form{margin-top:24px;padding-top:24px;border-top:1px solid #e2e8f0}.txl-notice{padding:14px 18px;border-radius:8px;margin-bottom:20px;font-size:14px}.txl-notice-success{background:#d1fae5;color:#065f46}.txl-notice-error{background:#fee2e2;color:#991b1b}.txl-notice-info{background:#e0f2fe;color:#0369a1}';
    }
}

new Theme_License();