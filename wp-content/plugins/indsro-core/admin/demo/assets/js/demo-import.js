/**
 * Indsro Demo Importer — AJAX Step Runner.
 *
 * Handles the sequenced AJAX import flow with real-time progress and logs.
 */
(function ($) {
    'use strict';

    const config = window.indsroDemoImport || {};
    const stepKeys = Object.keys(config.steps || {});
    const stepLabels = config.steps || {};

    let currentDemoId = '';
    let isImporting = false;

    // ─── DOM Elements ────────────────────────────────────────────
    const $grid           = $('#indsro-demo-grid');
    const $stepsWrap      = $('#indsro-steps');
    const $stepsList      = $('#indsro-steps-list');
    const $progressSection = $('#indsro-progress-section');
    const $progressFill   = $('#indsro-progress-fill');
    const $progressPercent = $('#indsro-progress-percent');
    const $progressLabel  = $('#indsro-progress-label');
    const $console        = $('#indsro-console');
    const $consoleBody    = $('#indsro-console-body');
    const $resultSuccess  = $('#indsro-result-success');
    const $resultError    = $('#indsro-result-error');
    const $errorMessage   = $('#indsro-error-message');

    // ─── Initialize ──────────────────────────────────────────────
    function init() {
        // Import button clicks.
        $grid.on('click', '.indsro-demo-card__import-btn', function (e) {
            e.preventDefault();
            if (isImporting) return;

            const demoId = $(this).data('demo-id');

            if (!confirm('This will import demo content. Continue?')) {
                return;
            }

            startImport(demoId);
        });

        // Retry button.
        $('#indsro-retry-btn').on('click', function () {
            $resultError.hide();
            $grid.show();
            $stepsWrap.hide();
            $progressSection.hide();
            $console.hide();
        });
    }

    // ─── Build Step Indicators ───────────────────────────────────
    function buildStepIndicators() {
        $stepsList.empty();

        stepKeys.forEach(function (key, i) {
            const $step = $('<div class="indsro-demo-step" data-step="' + key + '">' +
                '<span class="indsro-demo-step__icon">' + (i + 1) + '</span>' +
                '<span class="indsro-demo-step__label">' + stepLabels[key] + '</span>' +
                '</div>');
            $stepsList.append($step);

            // Add connector between steps (not after last).
            if (i < stepKeys.length - 1) {
                $stepsList.append('<span class="indsro-demo-step__connector"></span>');
            }
        });
    }

    // ─── Update Step Indicator ───────────────────────────────────
    function setActiveStep(stepKey) {
        const idx = stepKeys.indexOf(stepKey);

        $stepsList.find('.indsro-demo-step').each(function (i) {
            const $el = $(this);
            $el.removeClass('is-active is-done');

            const elStep = $el.data('step');
            const elIdx = stepKeys.indexOf(elStep);

            if (elIdx < idx) {
                $el.addClass('is-done');
            } else if (elIdx === idx) {
                $el.addClass('is-active');
            }
        });

        // Connectors.
        $stepsList.find('.indsro-demo-step__connector').each(function (i) {
            $(this).toggleClass('is-done', i < idx);
        });
    }

    // ─── Update Progress ─────────────────────────────────────────
    function updateProgress(percent, label) {
        $progressFill.css('width', percent + '%');
        $progressPercent.text(percent + '%');
        if (label) {
            $progressLabel.text(label);
        }
    }

    // ─── Append Logs ─────────────────────────────────────────────
    function appendLogs(logs) {
        if (!logs || !logs.length) return;

        // Get currently rendered count.
        const rendered = $consoleBody.children().length;

        // Only render new lines.
        for (let i = rendered; i < logs.length; i++) {
            const line = logs[i];
            let cls = 'indsro-demo-console__line';
            if (line.indexOf('✅') !== -1 || line.indexOf('success') !== -1) {
                cls += ' indsro-demo-console__line--success';
            } else if (line.indexOf('❌') !== -1 || line.indexOf('Error') !== -1) {
                cls += ' indsro-demo-console__line--error';
            }
            $consoleBody.append('<p class="' + cls + '">' + escapeHtml(line) + '</p>');
        }

        // Auto-scroll to bottom.
        $consoleBody.scrollTop($consoleBody[0].scrollHeight);
    }

    // ─── Start Import ────────────────────────────────────────────
    function startImport(demoId) {
        isImporting = true;
        currentDemoId = demoId;

        // UI updates.
        $grid.find('.indsro-demo-card').addClass('is-importing');
        $grid.find('[data-demo-id="' + demoId + '"]').removeClass('is-importing').addClass('is-active');

        buildStepIndicators();
        $stepsWrap.slideDown(300);
        $progressSection.slideDown(300);
        $console.slideDown(300);
        $resultSuccess.hide();
        $resultError.hide();
        $consoleBody.empty();

        updateProgress(0, 'Initializing...');

        // Send start request.
        $.post(config.ajaxUrl, {
            action: 'indsro_start_import',
            nonce: config.nonce,
            demo_id: demoId,
        })
        .done(function (res) {
            if (res.success) {
                processStep(res.data.next_step, 0);
            } else {
                handleError(res.data ? res.data.message : 'Failed to start import.');
            }
        })
        .fail(function () {
            handleError('Network error. Please try again.');
        });
    }

    // ─── Process Step ────────────────────────────────────────────
    function processStep(step, offset) {
        if (!step) {
            // Done!
            onComplete();
            return;
        }

        setActiveStep(step);
        updateProgress(
            getStepPercent(step),
            stepLabels[step] || step
        );

        $.post(config.ajaxUrl, {
            action: 'indsro_process_step',
            nonce: config.nonce,
            step: step,
            offset: offset || 0,
            demo_id: currentDemoId,
        })
        .done(function (res) {
            if (res.success) {
                const data = res.data;

                // Update UI.
                if (data.percent) {
                    updateProgress(data.percent, stepLabels[data.next_step] || stepLabels[step]);
                }
                if (data.log) {
                    appendLogs(data.log);
                }

                if (data.status === 'done') {
                    onComplete();
                } else if (data.next_step) {
                    processStep(data.next_step, data.offset || 0);
                } else {
                    onComplete();
                }
            } else {
                handleError(res.data ? res.data.message : 'Step failed: ' + step);
                if (res.data && res.data.log) {
                    appendLogs(res.data.log);
                }
            }
        })
        .fail(function (xhr) {
            handleError('Network error during step: ' + step + ' (HTTP ' + xhr.status + ')');
        });
    }

    function getStepPercent(step) {
        const percents = {
            validate: 2,
            import_xml: 20,
            verify_elementor: 55,
            widgets: 72,
            customizer: 80,
            assign_menus: 85,
            set_pages: 90,
            finalize: 95,
        };
        return percents[step] || 0;
    }

    // ─── Import Complete ─────────────────────────────────────────
    function onComplete() {
        isImporting = false;
        updateProgress(100, 'Import Complete!');

        // Mark all steps done.
        $stepsList.find('.indsro-demo-step').addClass('is-done').removeClass('is-active');
        $stepsList.find('.indsro-demo-step__connector').addClass('is-done');

        // Show success.
        setTimeout(function () {
            $grid.slideUp(300);
            $resultSuccess.slideDown(300);
        }, 800);
    }

    // ─── Error Handler ───────────────────────────────────────────
    function handleError(message) {
        isImporting = false;
        $errorMessage.text(message);
        $resultError.slideDown(300);

        $grid.find('.indsro-demo-card').removeClass('is-importing is-active');
    }

    // ─── Util ────────────────────────────────────────────────────
    function escapeHtml(str) {
        const div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }

    // ─── Boot ────────────────────────────────────────────────────
    $(document).ready(init);

})(jQuery);
