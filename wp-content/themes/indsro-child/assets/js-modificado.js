/**
 * INDSRO CHILD THEME — Scripts personalizados
 * Archivo: /assets/js-modificado.js
 * Versión controlada desde functions.php → INDSRO_ASSET_VERSION
 *
 * Dependencias: jQuery, SweetAlert2 (cargado via CDN en este mismo archivo)
 */

/* =============================================================================
   SWEETALERT2 — Carga desde CDN
   ============================================================================= */

(function () {
    var script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
    script.async = true;
    document.head.appendChild(script);
})();


/* =============================================================================
   CF7 — Campos condicionales por producto
   ============================================================================= */

jQuery(document).ready(function ($) {

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


/* =============================================================================
   SWEETALERT2 — Notificaciones y control del botón submit en CF7
   ============================================================================= */

document.addEventListener('DOMContentLoaded', function () {

    var swalOptions = {
        icon: 'success',
        confirmButtonText: 'Entendido',
        confirmButtonColor: '#04896A',
        background: '#032A3B',
        color: '#E6ECEF'
    };

    // Éxito: correo enviado por CF7
    document.addEventListener('wpcf7mailsent', function (event) {
        Swal.fire(Object.assign({
            title: '¡Solicitud Enviada!',
            text: 'Hemos recibido tus datos correctamente. Nuestro equipo se pondrá en contacto contigo muy pronto.'
        }, swalOptions));
    }, false);

    // Éxito: submit genérico vía jQuery
    jQuery(document).on('submit_success', function (e, response) {
        // Si el formulario contiene un ticket de cotización, no mostrar el modal genérico
        if (response && response.data && (response.data.ticket_number || (response.data.data && response.data.data.ticket_number))) {
            return;
        }

        Swal.fire(Object.assign({
            title: '¡Mensaje Enviado!',
            text: 'Gracias por escribirnos. Hemos recibido tu mensaje y te responderemos a la brevedad posible.'
        }, swalOptions));
    });

    // Deshabilitar botón submit al enviar
    jQuery(document).on('submit', 'form.wpcf7-form', function () {
        var $btn = jQuery(this).find('input[type="submit"], button[type="submit"], input.wpcf7-submit, input.wpcf7-next');
        if ($btn.length) {
            $btn.prop('disabled', true);
            $btn.css({ 'cursor': 'wait', 'pointer-events': 'none' });
        }
    });

    // Re-habilitar botón y resetear formulario tras envío
    document.addEventListener('wpcf7submit', function (event) {
        var $btn = jQuery(event.detail.container).find('input[type="submit"], button[type="submit"], input.wpcf7-submit, input.wpcf7-next');
        if ($btn.length) {
            $btn.prop('disabled', false);
            $btn.css({ 'cursor': 'pointer', 'pointer-events': 'auto' });
            if (event.detail.status === 'mail_sent') {
                var $form = jQuery(event.detail.container).find('form');
                if ($form.length) $form[0].reset();
            }
        }
    }, false);

});


/* =============================================================================
   MODAL — Dashboard de Estaciones
   ============================================================================= */

function toggleDashboardEstaciones() {
    var modal = document.getElementById('modal-dashboard-estaciones');
    if (modal) {
        modal.classList.toggle('active');
        if (modal.classList.contains('active')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    }
}

function closeDashboardEstaciones(e) {
    toggleDashboardEstaciones();
}

// Activar modal al hacer clic en enlaces
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('a').forEach(function (enlace) {
        var textoEnlace = enlace.textContent.trim().toLowerCase();

        // Para "Precios y Saldos"
        if (textoEnlace === 'precios y saldos') {
            enlace.addEventListener('click', function (e) {
                e.preventDefault();
                toggleDashboardEstaciones();
            });
        }

        // Para "Solicitar Cotización"
        if (textoEnlace === 'solicitar cotización' || textoEnlace === 'solicitar cotizacion') {
            enlace.addEventListener('click', function (e) {
                e.preventDefault();
                toggleModalCotizacion();
            });
        }
    });
});

/* =============================================================================
   MODAL — Solicitar Cotización
   ============================================================================= */

function toggleModalCotizacion() {
    var modal = document.getElementById('modal-cotizacion');
    if (modal) {
        modal.classList.toggle('active');
        if (modal.classList.contains('active')) {
            // Bloqueo total de scroll forzando CSS directo al body y html
            document.body.style.setProperty('overflow', 'hidden', 'important');
            document.documentElement.style.setProperty('overflow', 'hidden', 'important');

            // Forzar recálculo para scripts de Elementor
            window.dispatchEvent(new Event('resize'));

        } else {
            // Restaurar scroll
            document.body.style.removeProperty('overflow');
            document.documentElement.style.removeProperty('overflow');
        }
    }
}

function closeModalCotizacion(e) {
    toggleModalCotizacion();
}

/* =============================================================================
   LÓGICA CONDICIONAL GLOBAL DEL FORMULARIO (Soporta múltiples formularios)
   ============================================================================= */
document.addEventListener("DOMContentLoaded", function () {
    function toggleFieldInfoGlobal(id, show) {
        // Usa querySelectorAll para ocultar los campos en TODOS los formularios de la página (Contacto y Modal)
        let wrappers = document.querySelectorAll('.elementor-field-group-' + id);
        wrappers.forEach(function (wrapper) {
            wrapper.style.display = show ? "block" : "none";
        });
    }

    const camposComunesProducto = ['titulo_producto', 'prod_envase', 'prod_req_b'];
    const camposEnvio = ['field_62c1fe7', 'envio_destino', 'envio_ciudad', 'envio_estado'];

    // Ocultar por defecto al cargar la página
    toggleFieldInfoGlobal('prod_cantidad_diesel', false);
    toggleFieldInfoGlobal('prod_cantidad_gasolina', false);
    camposComunesProducto.forEach(id => toggleFieldInfoGlobal(id, false));
    camposEnvio.forEach(id => toggleFieldInfoGlobal(id, false));

    document.addEventListener("change", function (e) {
        // Manejador del tipo de producto
        if (e.target && e.target.name === "form_fields[prod_selector]") {
            const val = e.target.value.toLowerCase();
            let form = e.target.closest('form');
            if (form) {
                function toggleInForm(id, show) {
                    let wrapper = form.querySelector('.elementor-field-group-' + id);
                    if (wrapper) wrapper.style.display = show ? "block" : "none";
                }

                if (val.includes("diesel")) {
                    toggleInForm('prod_cantidad_diesel', true);
                    toggleInForm('prod_cantidad_gasolina', false);
                    camposComunesProducto.forEach(id => toggleInForm(id, true));
                } else if (val.includes("gasolina")) {
                    toggleInForm('prod_cantidad_diesel', false);
                    toggleInForm('prod_cantidad_gasolina', true);
                    camposComunesProducto.forEach(id => toggleInForm(id, true));
                }
            }
        }

        // Manejador de "Requiere Cisterna"
        if (e.target && (e.target.id === "form-field-prod_req_b" || e.target.name === "form_fields[prod_req_b]")) {
            const val = e.target.value.toLowerCase().trim();
            let form = e.target.closest('form');
            if (form) {
                function toggleInForm(id, show) {
                    let wrapper = form.querySelector('.elementor-field-group-' + id);
                    if (wrapper) wrapper.style.display = show ? "block" : "none";
                }

                if (val === "si" || val === "sí" || val.includes("si")) {
                    camposEnvio.forEach(id => toggleInForm(id, true));
                } else {
                    camposEnvio.forEach(id => toggleInForm(id, false));
                }
            }
        }
    });

    // Bloquear propagación de eventos de scroll desde cualquier modal
    // Esto previene que scripts externos de "Smooth Scroll" secuestren el evento 
    // cuando el mouse está sobre el modal.
    const modales = document.querySelectorAll('.modal-estaciones-overlay');
    modales.forEach(function(modal) {
        modal.addEventListener('wheel', function(e) {
            e.stopPropagation();
        }, { passive: false });
        
        modal.addEventListener('mousewheel', function(e) {
            e.stopPropagation();
        }, { passive: false });
        
        modal.addEventListener('DOMMouseScroll', function(e) {
            e.stopPropagation();
        }, { passive: false });
        
        modal.addEventListener('touchmove', function(e) {
            e.stopPropagation();
        }, { passive: false });
    });
});