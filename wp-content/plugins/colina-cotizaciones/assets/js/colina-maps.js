(function ($) {
	'use strict';

	var baseUrl = (typeof ccSettings !== 'undefined' && ccSettings.pluginUrl) ? ccSettings.pluginUrl + 'assets/leaflet/images/' : 'https://unpkg.com/leaflet@1.9.4/dist/images/';
	delete L.Icon.Default.prototype._getIconUrl;
	L.Icon.Default.mergeOptions({
		iconRetinaUrl: baseUrl + 'marker-icon-2x.png',
		iconUrl: baseUrl + 'marker-icon.png',
		shadowUrl: baseUrl + 'marker-shadow.png',
	});

	/* =====================================================================
	 * Utilidades de datos de ubicación (departamento / provincia / municipio)
	 * =================================================================== */

	var ccUbicacionesData = null;

	function ccNorm(s) {
		s = (s || '').toString().toLowerCase();
		try { s = s.normalize('NFD').replace(/[\u0300-\u036f]/g, ''); } catch (e) {}
		s = s.replace(/ñ/g, 'n').replace(/[^a-z0-9 ]/g, ' ').replace(/\s+/g, ' ').trim();
		// Nominatim suele anteponer "Provincia/Departamento/Municipio" al nombre.
		s = s.replace(/^(provincia|departamento|municipio)\s+/, '');
		return s;
	}

	function ccLoadUbicaciones(callback) {
		if (ccUbicacionesData) { callback(ccUbicacionesData); return; }
		if (typeof ccSettings === 'undefined' || !ccSettings.pluginUrl) { callback(null); return; }
		$.getJSON(ccSettings.pluginUrl + 'assets/data/bolivia-ubicaciones.json')
			.done(function (d) { ccUbicacionesData = d; callback(d); })
			.fail(function () { ccUbicacionesData = false; callback(null); });
	}

	function ccPopulateDepartamentos($sel, data) {
		$sel.empty().append($('<option>', { value: '', text: 'Departamento' }));
		$.each(data.departamentos, function (i, d) {
			$sel.append($('<option>', { value: d.nombre, text: d.nombre }));
		});
	}

	function ccPopulateProvincias($sel, dept) {
		$sel.empty().append($('<option>', { value: '', text: 'Provincia' }));
		$.each(dept.provincias, function (i, p) {
			$sel.append($('<option>', { value: p.nombre, text: p.nombre }));
		});
	}

	function ccPopulateMunicipios($sel, prov) {
		$sel.empty().append($('<option>', { value: '', text: 'Municipio' }));
		$.each(prov.municipios, function (i, m) {
			$sel.append($('<option>', { value: m.nombre, text: m.nombre }));
		});
	}

	function ccFindDept(data, name) {
		var n = ccNorm(name);
		for (var i = 0; i < data.departamentos.length; i++) {
			if (ccNorm(data.departamentos[i].nombre) === n) { return data.departamentos[i]; }
		}
		return null;
	}

	function ccFindProv(dept, name) {
		var n = ccNorm(name);
		for (var i = 0; i < dept.provincias.length; i++) {
			if (ccNorm(dept.provincias[i].nombre) === n) { return dept.provincias[i]; }
		}
		return null;
	}

	function ccFindMun(prov, name) {
		var n = ccNorm(name);
		for (var i = 0; i < prov.municipios.length; i++) {
			if (ccNorm(prov.municipios[i].nombre) === n) { return prov.municipios[i]; }
		}
		return null;
	}

	function ccSelectCascadeOption($sel, name) {
		var n = ccNorm(name);
		$sel.find('option').each(function () {
			if (ccNorm($(this).text()) === n) {
				$sel.val($(this).val());
				return false;
			}
		});
	}

	/* =====================================================================
	 * Sincronización con los campos del formulario Elementor
	 * =================================================================== */

	function ccGetField($form, names) {
		for (var i = 0; i < names.length; i++) {
			var $f = $form.find('[name="form_fields[' + names[i] + ']"]');
			if ($f.length) { return $f; }
		}
		return null;
	}

	function ccSetField($form, names, value) {
		var $f = ccGetField($form, names);
		if ($f) { $f.val(value).trigger('change'); return; }
		var name = names[0];
		$('<input>', { type: 'hidden', name: 'form_fields[' + name + ']' }).val(value).appendTo($form);
	}

	function ccApplyLocationResult($form, d) {
		if (d && d.address) {
			ccSetField($form, ['delivery_address'], d.address);
			ccSetField($form, ['delivery_geocoded_address'], d.address);
			var $hint = $form.data('cc-delivery-hint');
			if ($hint) { $hint.show(); }
		}

		var $cascade = $form.data('cc-cascade');
		if (!$cascade || !d || !d.department) { return; }
		var dept = ccUbicacionesData ? ccFindDept(ccUbicacionesData, d.department) : null;
		if (!dept) { return; }

		var $prov = $cascade.find('.cc-sel-provincia');
		var $mun = $cascade.find('.cc-sel-municipio');
		ccPopulateProvincias($prov, dept);
		$prov.prop('disabled', false);
		ccSelectCascadeOption($prov, d.province);

		var prov = ccFindProv(dept, d.province || '');
		if (prov) {
			ccPopulateMunicipios($mun, prov);
			$mun.prop('disabled', false);
			ccSelectCascadeOption($mun, d.municipality);
		} else {
			$mun.empty().append($('<option>', { value: '', text: 'Municipio' })).prop('disabled', true);
		}
		ccSelectCascadeOption($cascade.find('.cc-sel-departamento'), d.department);
	}

	/* =====================================================================
	 * Reverse geocoding (coordenadas -> texto) vía proxy del plugin
	 * =================================================================== */

	var ccReverseTimer = null;

	function ccReverseGeocode($form, lat, lng) {
		if (typeof ccSettings === 'undefined' || !ccSettings.ajaxUrl) { return; }
		var attempts = 0;

		function doRequest() {
			attempts++;
			$.ajax({
				url: ccSettings.ajaxUrl,
				data: { action: 'cc_get_address', lat: lat, lng: lng },
				dataType: 'json',
				timeout: 10000,
				success: function (res) {
					if (res && res.success && res.data && res.data.address) {
						ccApplyLocationResult($form, res.data);
						ccShowStatus($form, '✅ Direcci&oacute;n obtenida correctamente.');
					} else if (attempts < 2) {
						setTimeout(doRequest, 1200);
						return;
					} else {
						ccShowStatus($form, '⚠️ No se pudo obtener la direcci&oacute;n para ese punto.');
					}
					ccSetMapLoading($form, false);
				},
				error: function () {
					if (attempts < 2) {
						setTimeout(doRequest, 1200);
						return;
					}
					ccShowStatus($form, '⚠️ Error al obtener la direcci&oacute;n. Intente de nuevo.');
					ccSetMapLoading($form, false);
				}
			});
		}

		doRequest();
	}

	function ccReverseGeocodeDebounced($form, lat, lng) {
		clearTimeout(ccReverseTimer);
		ccShowStatus($form, '⏳ Obteniendo direcci&oacute;n...');
		ccReverseTimer = setTimeout(function () {
			ccReverseGeocode($form, lat, lng);
		}, 450);
	}

	function ccShowStatus($form, html) {
		var $st = $form.find('.cc-status-msg');
		if ($st.length) { $st.html(html); }
	}

	function ccSetMapLoading($form, show) {
		var $mapArea = $form.find('.cc-map-area');
		if (!$mapArea.length) { return; }
		var $loading = $mapArea.find('.cc-map-loading');
		if (!$loading.length) {
			$loading = $('<div class="cc-map-loading">⏳ Calculando ubicaci&oacute;n...</div>').appendTo($mapArea);
		}
		$loading.toggle(show);
	}

	function initOnForms() {
		$('.elementor-form').each(function () {
			var $form = $(this);
			if ($form.data('cc-done')) return;
			if ($form.closest('#cc-page-persona-tpl').length) return;

			var formName = $form.find('input[name="form_name"]').val() || '';
			if (formName.indexOf('Cotización') === -1 && formName.indexOf('cotizacion') === -1 && formName.indexOf('Cotizacion') === -1) {
			}

			$form.data('cc-done', true);
			setupLocationPicker($form);
		});
	}

	function setupLocationPicker($form) {
		// Evitar duplicar el panel si el form ya tiene uno (por re-render de Elementor)
		if ($form.find('.cc-location-picker').length) { return; }

		var $latField = $form.find('input[name="form_fields[latitude]"]');
		var $lngField = $form.find('input[name="form_fields[longitude]"]');
		if (!$latField.length) {
			$latField = $('<input type="hidden" name="form_fields[latitude]" value="">');
			$form.append($latField);
		}
		if (!$lngField.length) {
			$lngField = $('<input type="hidden" name="form_fields[longitude]" value="">');
			$form.append($lngField);
		}

		var $target = $form.find('.g-recaptcha, .elementor-field-type-recaptcha, div[class*="recaptcha"]').first();

		if (!$target || !$target.length) {
			$target = $form.find('.elementor-field-type-submit, .elementor-field-submit').first();
			if (!$target.length) {
				$target = $form.find('button[type="submit"]').first().closest('.elementor-field');
			}
			if (!$target.length) {
				$target = $form.find('.elementor-form-fields-wrapper');
			}
		}

		var $wrapper = $(
			'<div class="cc-location-picker">' +
			'  <p class="cc-lp-title">Indique su ubicaci&oacute;n de entrega:</p>' +
			'  <div class="cc-lp-actions">' +
			'    <button type="button" class="cc-btn-map cc-btn-primary"><i class="fas fa-map-marked-alt" aria-hidden="true"></i> Elegir en el mapa</button>' +
			'    <button type="button" class="cc-btn-current cc-btn-secondary"><i class="fas fa-location-arrow" aria-hidden="true"></i> Usar mi ubicaci&oacute;n actual</button>' +
			'  </div>' +
			'  <div class="cc-status-msg"></div>' +
			'  <div class="cc-map-area"></div>' +
			'</div>'
		);

		if ($target && $target.length) {
			$target.before($wrapper);
		} else {
			$form.append($wrapper);
		}

		/* Filtro de 3 selectores encadenados */
		var $cascade = $(
			'<div class="cc-cascada">' +
			'  <p class="cc-cascada-title">Filtrar ubicaci&oacute;n:</p>' +
			'  <div class="cc-cascada-row">' +
			'    <select class="cc-sel cc-sel-departamento"><option value="">Departamento</option></select>' +
			'    <select class="cc-sel cc-sel-provincia" disabled><option value="">Provincia</option></select>' +
			'    <select class="cc-sel cc-sel-municipio" disabled><option value="">Municipio</option></select>' +
			'  </div>' +
			'</div>'
		);
		$wrapper.find('p').first().after($cascade);
		$form.data('cc-cascade', $cascade);

		/* Campo de dirección de entrega: reubicar antes del captcha + aviso sutil.
		 * Si el campo no existe en Elementor (ej. formulario de empresa), se inyecta
		 * un input visible y editable como respaldo para que el dato se muestre. */
		var $hint = $(
			'<div class="cc-delivery-hint">' +
			'Dirección seleccionada en el mapa. Puede revisarla o modificarla si lo desea.</div>'
		);

		var $deliveryGroup = $form.find('.elementor-field-group-delivery_address');
		if ($deliveryGroup.length) {
			if ($target && $target.length) {
				$deliveryGroup.insertBefore($target);
			}
			$deliveryGroup.append($hint);
		} else {
			var $deliveryInjected = $(
				'<div class="cc-delivery-injected">' +
				'  <label class="cc-delivery-label">Direcci&oacute;n de entrega</label>' +
				'  <input type="text" name="form_fields[delivery_address]" class="cc-delivery-input elementor-field-textual" placeholder="">' +
				'</div>'
			);
			$deliveryInjected.append($hint);
			$wrapper.append($deliveryInjected);
		}
		$form.data('cc-delivery-hint', $hint);

		var $status = $wrapper.find('.cc-status-msg');
		var $mapArea = $wrapper.find('.cc-map-area');
		var $btnCurrent = $wrapper.find('.cc-btn-current');
		var $btnMap = $wrapper.find('.cc-btn-map');
		var $selDept = $cascade.find('.cc-sel-departamento');
		var $selProv = $cascade.find('.cc-sel-provincia');
		var $selMun = $cascade.find('.cc-sel-municipio');

		function setActiveButton($btn) {
			$btnCurrent.removeClass('cc-btn-active');
			$btnMap.removeClass('cc-btn-active');
			if ($btn) {
				$btn.addClass('cc-btn-active');
			}
		}

		var map = null;
		var marker = null;
		var mapInitialized = false;

		function ccCenterView(latLng, zoom) {
			if (!map) { return; }
			map.setView([latLng[0], latLng[1]], zoom);
			if (marker) { marker.setLatLng([latLng[0], latLng[1]]); }
			setTimeout(function () { if (map) { map.invalidateSize(); } }, 150);
		}

		/* Pin clásico en verde (estilo de la plantilla). Se crea solo cuando el usuario define el punto. */
		var ccPinIcon = L.icon({
			iconUrl: ccSettings.pluginUrl + 'assets/leaflet/images/pin-green.svg',
			iconSize: [34, 48],
			iconAnchor: [17, 46],
			popupAnchor: [0, -44]
		});

		/* Coloca (o mueve) el marcador. No existe hasta que el usuario define un punto. */
		function ccPlaceMarker(lat, lng) {
			if (!map) { return; }
			if (!marker) {
				marker = L.marker([lat, lng], { draggable: true, icon: ccPinIcon }).addTo(map);
				marker.on('dragend', function () {
					var ll = marker.getLatLng();
					ccSetDeliveryPoint(ll.lat, ll.lng);
				});
			} else {
				marker.setLatLng([lat, lng]);
			}
		}

		/* Define el punto de entrega: guarda coords, coloca el pin y traduce a texto. */
		function ccSetDeliveryPoint(lat, lng) {
			$latField.val(lat.toFixed(6));
			$lngField.val(lng.toFixed(6));
			ccPlaceMarker(lat, lng);
			ccShowStatus($form, '⏳ Obteniendo direcci&oacute;n...');
			ccSetMapLoading($form, true);
			ccReverseGeocodeDebounced($form, lat, lng);
		}

		/* --- Cascada: departamento --- */
		$selDept.on('change', function () {
			var dept = ccUbicacionesData ? ccFindDept(ccUbicacionesData, $selDept.val()) : null;
			$selProv.empty().append($('<option>', { value: '', text: 'Provincia' })).prop('disabled', true);
			$selMun.empty().append($('<option>', { value: '', text: 'Municipio' })).prop('disabled', true);

			if (!dept) { return; }
			ccPopulateProvincias($selProv, dept);
			$selProv.prop('disabled', false);
			if (dept.centro) { ccCenterView(dept.centro, 8); }
		});

		/* --- Cascada: provincia --- */
		$selProv.on('change', function () {
			var dept = ccUbicacionesData ? ccFindDept(ccUbicacionesData, $selDept.val()) : null;
			var prov = dept ? ccFindProv(dept, $selProv.val()) : null;
			$selMun.empty().append($('<option>', { value: '', text: 'Municipio' })).prop('disabled', true);

			if (!prov) { return; }
			ccPopulateMunicipios($selMun, prov);
			$selMun.prop('disabled', false);
			if (prov.centro) { ccCenterView(prov.centro, 10); }
		});

		/* --- Cascada: municipio (solo navega el mapa; el punto se elige con un clic) --- */
		$selMun.on('change', function () {
			var dept = ccUbicacionesData ? ccFindDept(ccUbicacionesData, $selDept.val()) : null;
			var prov = dept ? ccFindProv(dept, $selProv.val()) : null;
			var mun = prov ? ccFindMun(prov, $selMun.val()) : null;

			if (!mun) { return; }
			if (mun.centro) {
				ccCenterView(mun.centro, 13);
				ccShowStatus($form, 'Haga clic en el mapa para colocar el punto de entrega.');
			}
		});

		/* ================================================================
		 * [DESACTIVADO POR AHORA] Buscador de lugares (Nominatim search).
		 * Se deja comentado por si se quiere reactivar; no se usa.
		 * ================================================================
		 * var $searchWrap = $(
		 * 	'<div class="cc-search-wrap" style="margin: 0 0 12px 0;">' +
		 * 	'  <label style="display:block; margin-bottom:6px; font-size:14px; font-weight:600; color:#ffffff;">Buscar ubicaci&oacute;n:</label>' +
		 * 	'  <input type="text" class="cc-search-input" placeholder="Escriba un lugar (ej. Sopocachi, La Paz)..." ' +
		 * 	'    style="width:100%; padding:8px; border-radius:4px; border:1px solid #04896A; background:#E6ECEF; color:#032A3B; box-sizing:border-box;">' +
		 * 	'  <div class="cc-search-results" style="display:none; background:#fff; border:1px solid #ccc; border-radius:4px; max-height:220px; overflow-y:auto; margin-top:4px;"></div>' +
		 * 	'</div>'
		 * );
		 * $wrapper.find('p').first().after($searchWrap);
		 *
		 * var $toggleFiltros = $(
		 * 	'<div class="cc-toggle-filtros" style="margin-bottom: 10px;">' +
		 * 	'  <a href="#" class="cc-toggle-filtros-link" style="color:#7dd3fc; font-size:13px; text-decoration:none;">o filtre por departamento, provincia y municipio</a>' +
		 * 	'</div>'
		 * );
		 * $searchWrap.after($toggleFiltros);
		 * $toggleFiltros.find('.cc-toggle-filtros-link').on('click', function (e) {
		 * 	e.preventDefault();
		 * 	$cascade.slideToggle(200);
		 * 	$(this).text($cascade.is(':visible') ? 'ocultar filtros' : 'o filtre por departamento, provincia y municipio');
		 * });
		 *
		 * var ccSearchTimer = null;
		 * $searchWrap.find('.cc-search-input').on('input', function () {
		 * 	var q = $(this).val().trim();
		 * 	var $res = $searchWrap.find('.cc-search-results');
		 * 	clearTimeout(ccSearchTimer);
		 * 	if (q.length < 2) { $res.hide().empty(); return; }
		 * 	ccSearchTimer = setTimeout(function () {
		 * 		var state = $selDept.val() || '';
		 * 		$.ajax({
		 * 			url: ccSettings.ajaxUrl,
		 * 			data: { action: 'cc_get_search', q: q, state: state },
		 * 			dataType: 'json',
		 * 			timeout: 10000,
		 * 			success: function (res) {
		 * 				if (!res || !res.success || !res.data || !res.data.length) { $res.hide().empty(); return; }
		 * 				$res.empty().show();
		 * 				$.each(res.data, function (i, item) {
		 * 					var $li = $('<div class="cc-search-result" style="padding:7px 9px; cursor:pointer; font-size:13px; color:#032A3B; border-bottom:1px solid #eee;">' + (item.display_name || '') + '</div>');
		 * 					$li.on('click', function () {
		 * 						$searchWrap.find('.cc-search-input').val(item.display_name || '');
		 * 						$res.hide().empty();
		 * 						if (item.lat && item.lon) {
		 * 							ccCenterView([item.lat, item.lon], 14);
		 * 							if (marker) { marker.setLatLng([item.lat, item.lon]); }
		 * 							ccSetDeliveryPoint(item.lat, item.lon);
		 * 							ccSetField($form, ['delivery_address'], item.display_name || '');
		 * 							ccSetField($form, ['delivery_geocoded_address'], item.display_name || '');
		 * 							var $hint = $form.data('cc-delivery-hint');
		 * 							if ($hint) { $hint.show(); }
		 * 						}
		 * 					});
		 * 					$res.append($li);
		 * 				});
		 * 			},
		 * 			error: function () { $res.hide().empty(); }
		 * 		});
		 * 	}, 400);
		 * });
		 * $(document).on('click', function (e) {
		 * 	if (!$(e.target).closest('.cc-search-wrap').length) {
		 * 		$searchWrap.find('.cc-search-results').hide().empty();
		 * 	}
		 * });
		 * ================================================================ */

		$btnCurrent.on('click', function () {
			if (!('geolocation' in navigator)) {
				$status.html('❌ Su navegador no soporta geolocalizaci&oacute;n. Use la opci&oacute;n "Elegir en el mapa".');
				return;
			}
			$status.html('⏳ Obteniendo ubicaci&oacute;n...');
			$btnCurrent.prop('disabled', true).css('opacity', '0.6');

			navigator.geolocation.getCurrentPosition(
				function (pos) {
					var lat = pos.coords.latitude;
					var lng = pos.coords.longitude;
					$btnCurrent.prop('disabled', false).css('opacity', '1');
					setActiveButton($btnCurrent);
					$mapArea.hide();
					$cascade.hide();
					if (map) { map.remove(); map = null; mapInitialized = false; }
					ccSetDeliveryPoint(lat, lng);
				},
				function (err) {
					$status.html('❌ No se pudo obtener la ubicaci&oacute;n. Intente "Elegir en el mapa".');
					$btnCurrent.prop('disabled', false).css('opacity', '1');
				},
				{ enableHighAccuracy: true, timeout: 10000 }
			);
		});

		$btnMap.on('click', function () {
			if (mapInitialized) {
				$mapArea.toggle();
				if ($mapArea.is(':visible')) {
					setTimeout(function () { if (map) map.invalidateSize(); }, 200);
				}
				return;
			}

			$cascade.show();
			$mapArea.empty();      // limpiar contenedores previos (evita duplicar el mapa)
			$mapArea.show();
			$status.html('Filtre o navegue el mapa, y haga clic para colocar el punto de entrega.');

			// El input de dirección va vacío hasta que el usuario elige su punto.
			ccSetField($form, ['delivery_address'], '');
			ccSetField($form, ['delivery_geocoded_address'], '');
			var $hint = $form.data('cc-delivery-hint');
			if ($hint) { $hint.hide(); }

			ccLoadUbicaciones(function (data) {
				if (data && $selDept.children('option').length <= 1) {
					ccPopulateDepartamentos($selDept, data);
				}
			});

			var $mapContainer = $('<div class="cc-map-container"></div>');
			$mapArea.append($mapContainer);

			try {
				map = L.map($mapContainer[0], { zoomControl: true }).setView([-17.78, -63.18], 14);
				L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap</a>',
					maxZoom: 19
				}).addTo(map);

				// Cursor de mira: indica que se hace clic para colocar el punto.
				map.getContainer().style.cursor = 'crosshair';

				// Sin marcador inicial: el pin aparece solo cuando el usuario define el punto.
				map.on('click', function (e) {
					ccSetDeliveryPoint(e.latlng.lat, e.latlng.lng);
				});

				if ('geolocation' in navigator) {
					navigator.geolocation.getCurrentPosition(
						function (pos) {
							var lat = pos.coords.latitude;
							var lng = pos.coords.longitude;
							map.setView([lat, lng], 16);
							ccSetDeliveryPoint(lat, lng);
						},
						function () {},
						{ enableHighAccuracy: true, timeout: 5000 }
					);
				}

				setTimeout(function () { map.invalidateSize(); }, 300);
				mapInitialized = true;

			} catch (e) {
				console.error('[Colina Cotizaciones] Error mapa:', e);
				$status.html('❌ Error al cargar el mapa.');
			}
			
			setActiveButton($btnMap);
		});

		$form.on('submit', function () {
			var lat = $latField.val();
			var lng = $lngField.val();

			if (!lat || !lng) {
				if (map && marker) {
					var ll = marker.getLatLng();
					lat = ll.lat.toFixed(6);
					lng = ll.lng.toFixed(6);
					$latField.val(lat);
					$lngField.val(lng);
				}
			}

			if (lat && lng) {
				return;
			}
		});

		$form.on('submit_success', function (e, response) {
			var ticketNumber = '';
			if (response && response.data) {
				if (response.data.ticket_number) {
					ticketNumber = response.data.ticket_number;
				} else if (response.data.data && response.data.data.ticket_number) {
					ticketNumber = response.data.data.ticket_number;
				}
			}

			if (ticketNumber && typeof Swal !== 'undefined') {
				$form.find('.elementor-message-success').hide();

				Swal.fire({
					icon: 'success',
					title: '¡Cotización Enviada!',
					html:
						'<p style="color:#E6ECEF; font-size:15px; margin-bottom:12px;">Tu solicitud fue recibida correctamente.<br>Tu número de ticket es:</p>' +
						'<div style="font-size:30px; font-weight:700; color:#04896A; background:#E6ECEF; padding:12px 20px; border-radius:8px; letter-spacing:2px; display:inline-block;">' +
							ticketNumber +
						'</div>' +
						'<p style="color:#a0aec0; font-size:13px; margin-top:14px;">Guarda este número para dar seguimiento a tu cotización.</p>',
					confirmButtonText: 'Aceptar',
					confirmButtonColor: '#04896A',
					allowOutsideClick: false,
					allowEscapeKey: false,
					returnFocus: false,
					background: '#032A3B',
					color: '#E6ECEF',
					customClass: {
						popup:          'cc-swal-popup',
						title:          'cc-swal-title',
						confirmButton:  'cc-swal-btn'
					},
					showClass: {
						popup: 'animate__animated animate__fadeInDown'
					},
					hideClass: {
						popup: 'animate__animated animate__fadeOutUp'
					}
				});
			} else if (ticketNumber) {
				$form.find('.elementor-message-success').hide();
				alert('¡Cotización enviada! Tu número de ticket es: ' + ticketNumber);
			}
		});
	}


	var obs = new MutationObserver(function () { initOnForms(); });
	if (document.body) obs.observe(document.body, { childList: true, subtree: true });
	else $(document).ready(function () { obs.observe(document.body, { childList: true, subtree: true }); });


	if (typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks) {
		elementorFrontend.hooks.addAction('frontend/element_ready/form.default', function () {
			setTimeout(initOnForms, 800);
		});
	}


	$(document).ready(function () { setTimeout(initOnForms, 1500); });
	$(window).on('load', function () { setTimeout(initOnForms, 1000); });

	var c = 0;
	var p = setInterval(function () { c++; initOnForms(); if (c > 20) clearInterval(p); }, 700);

})(jQuery);
