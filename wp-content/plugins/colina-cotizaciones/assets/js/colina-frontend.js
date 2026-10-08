(function ($) {
	'use strict';

	function ccToggleDashboardEstaciones() {
		var modal = document.getElementById('cc-modal-dashboard-estaciones');
		if (modal) {
			modal.classList.toggle('active');
			if (modal.classList.contains('active')) {
				document.body.style.overflow = 'hidden';
			} else {
				document.body.style.overflow = '';
			}
		}
	}

	function ccCloseDashboardEstaciones(e) {
		ccToggleDashboardEstaciones();
	}

	function ccToggleModalCotizacion() {
		var modal = document.getElementById('cc-modal-cotizacion');
		if (modal) {
			modal.classList.toggle('active');
			if (modal.classList.contains('active')) {
				document.body.style.setProperty('overflow', 'hidden', 'important');
				document.documentElement.style.setProperty('overflow', 'hidden', 'important');
				window.dispatchEvent(new Event('resize'));
			} else {
				document.body.style.removeProperty('overflow');
				document.documentElement.style.removeProperty('overflow');
			}
		}
	}

	function ccCloseModalCotizacion(e) {
		ccToggleModalCotizacion();
	}

	window.ccToggleDashboardEstaciones = ccToggleDashboardEstaciones;
	window.ccCloseDashboardEstaciones = ccCloseDashboardEstaciones;
	window.ccToggleModalCotizacion = ccToggleModalCotizacion;
	window.ccCloseModalCotizacion = ccCloseModalCotizacion;

	window.toggleDashboardEstaciones = ccToggleDashboardEstaciones;
	window.closeDashboardEstaciones = ccCloseDashboardEstaciones;
	window.toggleModalCotizacion = ccToggleModalCotizacion;
	window.closeModalCotizacion = ccCloseModalCotizacion;

	$(document).on('click', 'a, button, [role="button"], .elementor-button', function (e) {
		var textoEnlace = $(this).text().trim().toLowerCase().replace(/\s+/g, ' ');
		if (textoEnlace === 'precios y saldos') {
			e.preventDefault();
			e.stopImmediatePropagation();
			ccToggleDashboardEstaciones();
			return false;
		}
		if (textoEnlace.indexOf('solicitar') !== -1 && textoEnlace.indexOf('cotizac') !== -1) {
			e.preventDefault();
			e.stopImmediatePropagation();
			ccToggleModalCotizacion();
			return false;
		}
	});

	$(document).ready(function () {
		var modales = document.querySelectorAll('.modal-estaciones-overlay');
		modales.forEach(function (modal) {
			modal.addEventListener('wheel', function (e) {
				e.stopPropagation();
			}, { passive: false });

			modal.addEventListener('mousewheel', function (e) {
				e.stopPropagation();
			}, { passive: false });

			modal.addEventListener('DOMMouseScroll', function (e) {
				e.stopPropagation();
			}, { passive: false });

			modal.addEventListener('touchmove', function (e) {
				e.stopPropagation();
			}, { passive: false });
		});
	});

	$(document).ready(function ($) {
		$(document).on('change', '#cf7-producto', function () {
			var producto = $(this).val();
			if (producto === 'Diesel ULSD' || producto === 'Gasolina') {
				$('#cf7-campos-producto').slideDown();
				if (producto === 'Diesel ULSD') {
					$('#cf7-cantidad').attr('placeholder', 'Cantidad Diesel (en litros)');
				} else {
					$('#cf7-cantidad').attr('placeholder', 'Cantidad Gasolina (en litros)');
				}
			} else {
				$('#cf7-campos-producto').slideUp();
			}
		});

		$(document).on('change', '#cf7-cisterna', function () {
			if ($(this).val() === 'Si') {
				$('#cf7-campos-destino').slideDown();
			} else {
				$('#cf7-campos-destino').slideUp();
			}
		});
	});

	document.addEventListener('DOMContentLoaded', function () {
		var swalOptions = {
			icon: 'success',
			confirmButtonText: 'Entendido',
			confirmButtonColor: '#04896A',
			background: '#032A3B',
			color: '#E6ECEF',
			returnFocus: false
		};

		document.addEventListener('wpcf7mailsent', function (event) {
			Swal.fire(Object.assign({
				title: '¡Solicitud Enviada!',
				text: 'Hemos recibido tus datos correctamente. Nuestro equipo se pondrá en contacto contigo muy pronto.'
			}, swalOptions));
		}, false);

		jQuery(document).on('submit_success', function (e, response) {
			if (response && response.data && (response.data.ticket_number || (response.data.data && response.data.data.ticket_number))) {
				return;
			}

			Swal.fire(Object.assign({
				title: '¡Mensaje Enviado!',
				text: 'Gracias por escribirnos. Hemos recibido tu mensaje y te responderemos a la brevedad posible.'
			}, swalOptions));
		});

		function ccSetButtonLoading($form, loading) {
			var $btn = $form.find('input[type="submit"], button[type="submit"]').first();
			if (!$btn.length) {
				return;
			}
			if (loading) {
				$btn.prop('disabled', true);
				$btn.css({ 'cursor': 'wait', 'pointer-events': 'none' });
			} else {
				$btn.prop('disabled', false);
				$btn.css({ 'cursor': 'pointer', 'pointer-events': 'auto' });
			}
		}

		function ccShowFormLoading() {
			if (typeof Swal === 'undefined') {
				return;
			}
			Swal.fire({
				title: 'Enviando...',
				text: 'Estamos procesando tu solicitud, por favor espera.',
				allowOutsideClick: false,
				allowEscapeKey: false,
				showConfirmButton: false,
				returnFocus: false,
				background: '#032A3B',
				color: '#E6ECEF',
				didOpen: function () {
					Swal.showLoading();
				}
			});
		}

		function ccHideFormLoading() {
			if (typeof Swal === 'undefined' || !Swal.isVisible()) {
				return;
			}
			if (Swal.isLoading() || (Swal.getTitle() && Swal.getTitle().textContent === 'Enviando...')) {
				Swal.close();
			}
		}

		function ccScrollCotizacionFormTop($form) {
			var $header = jQuery('.fti-header-3-area.tx_sticky_header');
			var headerH = $header.length ? $header.outerHeight() : 0;
			var top = Math.max(0, ($form.offset() || { top: 0 }).top - headerH);
			try {
				window.scrollTo({ top: top, behavior: 'smooth' });
			} catch (e) {
				window.scrollTo(0, top);
			}
		}

		jQuery(document).on('submit', '.elementor-form, form.wpcf7-form', function () {
			var $form = jQuery(this);
			ccSetButtonLoading($form, true);
			ccShowFormLoading();

			// Solo en la página (fuera del modal) y solo multi-step: al enviar, el form
			// vuelve al paso 1 y se encoge; el navegador clampa el scroll al final.
			// Esperamos a que el layout se asiente y llevamos la vista al inicio del form.
			if ($form.find('[data-direction]').length && !$form.closest('#cc-modal-cotizacion').length) {
				requestAnimationFrame(function () {
					requestAnimationFrame(function () {
						ccScrollCotizacionFormTop($form);
					});
				});
			}
		});

		jQuery(document).on('submit_success', '.elementor-form', function () {
			var $form = jQuery(this);
			ccHideFormLoading();
			ccSetButtonLoading($form, false);

			// Refuerzo: al confirmarse el envío, asegurar la vista al inicio del form
			// (el cierre de SweetAlert no debe devolver el foco al botón Enviar).
			if ($form.find('[data-direction]').length && !$form.closest('#cc-modal-cotizacion').length) {
				ccScrollCotizacionFormTop($form);
			}
		});

		jQuery(document).on('error', '.elementor-form', function () {
			ccHideFormLoading();
			ccSetButtonLoading(jQuery(this), false);
		});

		document.addEventListener('wpcf7submit', function (event) {
			var $form = jQuery(event.detail.container).find('form');
			if ($form.length) {
				ccHideFormLoading();
				ccSetButtonLoading($form, false);
			}
			if (event.detail.status === 'mail_sent') {
				var $f = jQuery(event.detail.container).find('form');
				if ($f.length) $f[0].reset();
			}
		}, false);
	});

	document.addEventListener('DOMContentLoaded', function () {
		function toggleFieldInfoGlobal(id, show) {
			var wrappers = document.querySelectorAll('.elementor-field-group-' + id);
			wrappers.forEach(function (wrapper) {
				wrapper.style.display = show ? 'block' : 'none';
			});
		}

		var camposEnvio = ['field_62c1fe7', 'envio_destino', 'envio_ciudad', 'envio_estado', 'delivery_address'];

		camposEnvio.forEach(function (id) { toggleFieldInfoGlobal(id, false); });

		function ocultarLocationPick() {
			document.querySelectorAll('.cc-location-picker').forEach(function(p) {
				p.style.display = 'none';
			});
		}
		ocultarLocationPick();
		setTimeout(ocultarLocationPick, 1000);
		setTimeout(ocultarLocationPick, 2500);

		document.addEventListener('change', function (e) {
			if (e.target && (e.target.id === 'form-field-prod_req_b' || e.target.name === 'form_fields[prod_req_b]')) {
				var val = e.target.value.toLowerCase().trim();
				var form = e.target.closest('form');
				if (form) {
					function toggleInForm(id, show) {
						var wrapper = form.querySelector('.elementor-field-group-' + id);
						if (wrapper) wrapper.style.display = show ? 'block' : 'none';
					}

					if (val === 'si' || val === 'sí' || val.indexOf('si') !== -1) {
						camposEnvio.forEach(function (id) { toggleInForm(id, true); });
						var picker = form.querySelector('.cc-location-picker');
						if (picker) picker.style.display = '';
					} else {
						camposEnvio.forEach(function (id) { toggleInForm(id, false); });
						var picker = form.querySelector('.cc-location-picker');
						if (picker) picker.style.display = 'none';
					}
				}
			}
		});
	});

	/* Product selector — carga opciones desde la API del backend via proxy */
	var CC_PROD_SELECTOR = 'select[name="form_fields[prod_selector]"]';
	var CC_PRODUCTS_CACHE = null;

	function ccPopulateOneSelect($sel, products) {
		if (!$sel.length || $sel.find('option').length > 1) {
			return;
		}

		$sel.empty().append($('<option>', {
			value: '',
			text: 'Seleccione un producto...'
		}));

		if (!products || products.length === 0) {
			$sel.append($('<option>', {
				value: '',
				text: 'No hay productos disponibles',
				disabled: true
			}));
			return;
		}

		$.each(products, function (i, product) {
			$sel.append($('<option>', {
				value: product.code,
				text: product.name
			}));
		});
	}

	function ccLoadProductOptions() {
		var $selects = $(CC_PROD_SELECTOR);
		if (!$selects.length) {
			return;
		}

		if (CC_PRODUCTS_CACHE) {
			$selects.each(function () {
				ccPopulateOneSelect($(this), CC_PRODUCTS_CACHE);
			});
			return;
		}

		$selects.prop('disabled', true);

		$.getJSON(cc_ajax.ajax_url, { action: 'cc_get_products' })
			.done(function (products) {
				CC_PRODUCTS_CACHE = products;
				$(CC_PROD_SELECTOR).each(function () {
					ccPopulateOneSelect($(this), CC_PRODUCTS_CACHE);
				});
			})
			.fail(function () {
				$(CC_PROD_SELECTOR).each(function () {
					$(this).empty().append($('<option>', {
						value: '',
						text: 'Error al cargar productos',
						disabled: true
					}));
				});
			})
			.always(function () {
				$(CC_PROD_SELECTOR).prop('disabled', false);
			});
	}

	function ccInitProductSelector() {
		ccLoadProductOptions();

		var observer = new MutationObserver(function () {
			var unpopulated = $(CC_PROD_SELECTOR).filter(function () {
				return $(this).find('option').length <= 1;
			});
			if (unpopulated.length) {
				ccLoadProductOptions();
			}
		});

		observer.observe(document.body, {
			childList: true,
			subtree: true
		});
	}

	$(document).ready(function () {
		ccInitProductSelector();
	});

	/* ── Customer type selector — toggle between two Elementor forms (navbar modal) ── */
	$(document).ready(function () {
		var $radioEmpresa  = $('#cc-radio-empresa');
		var $formEmpresa   = $('#cc-form-empresa');
		var $formPersona   = $('#cc-form-persona');

		if (!$radioEmpresa.length) return;

		function toggleForm() {
			var tipo = $('input[name="cc-tipo-cliente"]:checked').val();
			if (tipo === 'INDEPENDIENTE') {
				$formEmpresa.hide();
				$formPersona.show();
			} else {
				$formEmpresa.show();
				$formPersona.hide();
			}
			setTimeout(function () {
				window.dispatchEvent(new Event('resize'));
			}, 200);
		}

		toggleForm();
		$('input[name="cc-tipo-cliente"]').on('change', toggleForm);
	});

	/* ── Customer type selector — page-embedded forms (e.g., Contact page) ── */
	$(document).ready(function () {
		var $personaTpl = $('#cc-page-persona-tpl');
		if (!$personaTpl.length) return;

		$('.elementor-form').each(function () {
			var $form = $(this);
			if ($form.closest('#cc-modal-cotizacion').length) return;
			if ($form.closest('#cc-page-persona-tpl').length) return;
			if ($form.data('cc-page-injected')) return;

			var hasCotizacion = $form.find('[name="form_fields[razon_social]"]').length > 0
			                 || $form.find('[name="form_fields[prod_selector]"]').length > 0;
			if (!hasCotizacion) return;

			$form.data('cc-page-injected', true);

			var $formContainer = $form.closest('.elementor-element,.e-con,.elementor-widget-container').first();
			if (!$formContainer.length) $formContainer = $form.parent();

			var $radioDiv = $(
				'<div class="cc-tipo-cliente-wrapper" style="margin-bottom: 20px; text-align: center; padding-top: 10px;">' +
				'  <label style="display: block; margin-bottom: 12px; color: #E6ECEF; font-family: \'Hanzon\', sans-serif; font-weight: 700; font-size: 16px;">TIPO DE CLIENTE</label>' +
				'  <div style="display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">' +
				'    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-family: \'Creato\', sans-serif; font-size: 15px; font-weight: 600; color: #E6ECEF;">' +
				'      <input type="radio" name="cc-tipo-cliente-page" value="EMPRESA" checked style="accent-color: #04896A; width: 18px; height: 18px;"> Empresa' +
				'    </label>' +
				'    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-family: \'Creato\', sans-serif; font-size: 15px; font-weight: 600; color: #E6ECEF;">' +
				'      <input type="radio" name="cc-tipo-cliente-page" value="INDEPENDIENTE" style="accent-color: #04896A; width: 18px; height: 18px;"> Persona Natural' +
				'    </label>' +
				'  </div>' +
				'</div>'
			);

			var $empresaDiv = $('<div class="cc-form-empresa-page"></div>');
			var $personaDiv = $('<div class="cc-form-persona-page" style="display:none"></div>');

			$formContainer.before($radioDiv);
			$radioDiv.after($empresaDiv, $personaDiv);
			$empresaDiv.append($formContainer);

			var $personaContent = $personaTpl.children().clone(true, true);
			$personaDiv.append($personaContent);

			$personaDiv.find('.cc-location-picker').remove();

			$personaDiv.find('.elementor-form').each(function () {
				$(this).removeData('cc-done');
			});

			function togglePageForm() {
				var tipo = $('input[name="cc-tipo-cliente-page"]:checked').val();
				if (tipo === 'INDEPENDIENTE') {
					$empresaDiv.hide();
					$personaDiv.show();
				} else {
					$empresaDiv.show();
					$personaDiv.hide();
				}
				setTimeout(function () {
					window.dispatchEvent(new Event('resize'));
				}, 200);
			}

			togglePageForm();
			$('input[name="cc-tipo-cliente-page"]').on('change', togglePageForm);
		});
	});

	/* ── Date field fixes: disable autocomplete + force Spanish Flatpickr ── */
	(function () {
		var SPANISH_LOCALE = {
			weekdays: {
				shorthand: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
				longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']
			},
			months: {
				shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
				longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
			},
			firstDayOfWeek: 1,
			ordinal: function () { return 'º'; },
			rangeSeparator: ' a ',
			weekAbbreviation: 'Sem',
			scrollTitle: 'Desplazar para incrementar',
			toggleTitle: 'Hacer clic para alternar',
			amPM: ['AM', 'PM'],
			yearAriaLabel: 'Año',
			time_24hr: true
		};

		function registerSpanishLocale() {
			if (typeof flatpickr !== 'undefined') {
				flatpickr.l10ns = flatpickr.l10ns || {};
				flatpickr.l10ns.es = flatpickr.l10ns.es || SPANISH_LOCALE;
				flatpickr.localize(flatpickr.l10ns.es);
			}
		}

		function patchDateInstances() {
			document.querySelectorAll('input[type="date"]').forEach(function (input) {
				input.setAttribute('autocomplete', 'off');
				if (input._flatpickr && typeof flatpickr !== 'undefined' && flatpickr.l10ns && flatpickr.l10ns.es) {
					input._flatpickr.set('locale', flatpickr.l10ns.es);
				}
			});
		}

		function fixDateFieldsAll() {
			registerSpanishLocale();
			patchDateInstances();
		}

		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', fixDateFieldsAll);
		} else {
			fixDateFieldsAll();
		}

		var dateObserver = new MutationObserver(function (mutations) {
			var hasNewDateFields = false;
			mutations.forEach(function (mutation) {
				if (mutation.addedNodes.length) {
					mutation.addedNodes.forEach(function (node) {
						if (node.nodeType === 1 && node.querySelectorAll) {
							if (node.querySelectorAll('input[type="date"]').length) {
								hasNewDateFields = true;
							}
						}
					});
				}
			});
			if (hasNewDateFields) {
				setTimeout(fixDateFieldsAll, 150);
				setTimeout(fixDateFieldsAll, 500);
				setTimeout(fixDateFieldsAll, 1200);
			}
		});

		dateObserver.observe(document.body, { childList: true, subtree: true });
	})();

	/* ── Cantidad de litros: mínimo 5.000 y en múltiplos de 500 ── */
	(function ($) {
		var CC_CANTIDAD_SELECTOR = '[name="form_fields[prod_cantidad]"]';
		var CC_CANTIDAD_MIN = 5000;
		var CC_CANTIDAD_STEP = 500;

		function ccCantidadToast(message) {
			if (typeof Swal === 'undefined') {
				return;
			}
			Swal.fire({
				toast: true,
				position: 'bottom-end',
				icon: 'info',
				iconColor: '#04896A',
				title: message,
				showConfirmButton: false,
				returnFocus: false,
				timer: 4000,
				background: '#032A3B',
				color: '#E6ECEF'
			});
		}

		function ccRoundCantidad(val) {
			return Math.max(CC_CANTIDAD_MIN, Math.round(val / CC_CANTIDAD_STEP) * CC_CANTIDAD_STEP);
		}

		function ccFormatCantidad(val) {
			return String(val).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
		}

		function ccSetupCantidad() {
			$(CC_CANTIDAD_SELECTOR).each(function () {
				var $input = $(this);
				if ($input.data('cc-cantidad-done')) return;
				$input.data('cc-cantidad-done', true);

				// Sin step nativo: el navegador no muestra su mensaje, el feedback lo da el toast.
				$input.removeAttr('step');

				$input.on('change', function () {
					var raw = $(this).val().trim();
					if (!raw) return;
					var val = parseFloat(raw);
					if (isNaN(val)) return;

					var rounded = ccRoundCantidad(val);
					if (rounded !== val) {
						$(this).val(rounded);
						ccCantidadToast('La cantidad debe ser en múltiplos de 500. Ajustamos tu cantidad a ' + ccFormatCantidad(rounded) + ' litros.');
					}
				});
			});
		}

		$(document).ready(function () {
			ccSetupCantidad();
		});

		var cantObs = new MutationObserver(ccSetupCantidad);
		cantObs.observe(document.body, { childList: true, subtree: true });
	})(jQuery);

})(jQuery);
