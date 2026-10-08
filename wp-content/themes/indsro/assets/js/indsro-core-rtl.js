/*
	Author: themexriver
	Version: 1.0
*/

(function ($) {
	"use strict";

	gsap.config({
		nullTargetWarn: false,
	});

	const lenis = new Lenis({
		duration: 2,
	});

	// smoooth scroll activation start
	function raf(time) {
		lenis.raf(time);
		requestAnimationFrame(raf);
	}
	requestAnimationFrame(raf);

	// preloader

	$(window).on("load", function () {
		let preloader = document.querySelector("#preloader");

		if (preloader) {
			preloader.classList.add("preloaded");
			setTimeout(function () {}, 1000);
		}
	});

	// scroll to top
	if ($(".scroll-top")) {
		var scrollTopbtn = document.querySelector(".scroll-top");
		var progressPath = document.querySelector(".scroll-top path");
		var pathLength = progressPath.getTotalLength();
		progressPath.style.transition = progressPath.style.WebkitTransition =
			"none";
		progressPath.style.strokeDasharray = pathLength + " " + pathLength;
		progressPath.style.strokeDashoffset = pathLength;
		progressPath.getBoundingClientRect();
		progressPath.style.transition = progressPath.style.WebkitTransition =
			"stroke-dashoffset 10ms linear";
		var updateProgress = function () {
			var scroll = $(window).scrollTop();
			var height = $(document).height() - $(window).height();
			var progress = pathLength - (scroll * pathLength) / height;
			progressPath.style.strokeDashoffset = progress;
		};
		updateProgress();
		$(window).scroll(updateProgress);
		var offset = 50;
		var duration = 750;
		jQuery(window).on("scroll", function () {
			if (jQuery(this).scrollTop() > offset) {
				jQuery(scrollTopbtn).addClass("show");
			} else {
				jQuery(scrollTopbtn).removeClass("show");
			}
		});
		jQuery(scrollTopbtn).on("click", function (event) {
			event.preventDefault();
			jQuery("html, body").animate({ scrollTop: 0 }, duration);
			return false;
		});
	}

	/*
	search-popup
	====start====
	*/

	$(".search_btn_toggle").on("click", function () {
		$(".overlay, .search_1_popup_active").addClass("active");
	});
	$(".overlay, .search_1_popup_close").on("click", function () {
		$(".search_1_popup_active").removeClass("active");
		$(".overlay").removeClass("active");
	});
	/*
	search-popup
	====end====
	*/

	/*
 	why-choose-1-item-active-class-start
	*/
	$(".choose-item").on("mouseover", function () {
		var current_class =
			document.getElementsByClassName("choose-item active");
		current_class[0].className = current_class[0].className.replace(
			" active",
			""
		);
		this.className += " active";
	});

	/*
	why-choose-1-item-active-class-end
	*/

	/*
 	process-2-item-active-class-start
	*/
	$(".fti-process-2-item").on("mouseover", function () {
		var current_class = document.getElementsByClassName(
			"fti-process-2-item active"
		);
		current_class[0].className = current_class[0].className.replace(
			" active",
			""
		);
		this.className += " active";
	});

	/*
	process-2-item-active-class-end
	*/

	// active class added
	const boxWrap = gsap.utils.toArray(".fti-class-add");
	boxWrap.forEach((img) => {
		gsap.to(img, {
			scrollTrigger: {
				trigger: img,
				scrub: 1,
				start: "top 80%",
				end: "bottom bottom",
				toggleClass: "active",
				toggleActions: "play none none reverse",
				once: true,
			},
		});
	});

	// scroll slide left animation
	gsap.utils.toArray(".fti_left_slide_1").forEach((el, index) => {
		let ls_1 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 90%",
				end: "top 70%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		ls_1.set(el, { transformOrigin: "center center" }).from(
			el,
			{ opacity: 0, x: "-=100" },
			{ opacity: 1, x: 0, duration: 1, immediateRender: false }
		);
	});

	// scroll slide right animation
	gsap.utils.toArray(".fti_right_slide_1").forEach((el, index) => {
		let tlcta = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 90%",
				end: "top 70%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		tlcta
			.set(el, { transformOrigin: "center center" })
			.from(
				el,
				{ opacity: 0, x: "+=100" },
				{ opacity: 1, x: 0, duration: 1, immediateRender: false }
			);
	});

	// scroll slide left animation down up left
	gsap.utils.toArray(".down_up_left").forEach((el, index) => {
		let ls_1 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 90%",
				end: "top 50%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		ls_1.set(el, { transformOrigin: "center center" }).from(
			el,
			{ opacity: 1, x: "-=100", scale: 0.8 },
			{ opacity: 1, x: 0, scale: 1, duration: 1, immediateRender: false }
		);
	});

	// scroll slide right animation downUp right
	gsap.utils.toArray(".down_up_right").forEach((el, index) => {
		let ls_1 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 90%",
				end: "top 50%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		ls_1.set(el, { transformOrigin: "center center" }).from(
			el,
			{ opacity: 1, x: "+=100", scale: 0.8 },
			{ opacity: 1, x: 0, scale: 1, duration: 1, immediateRender: false }
		);
	});

	// why choose 2 top shape img 1
	gsap.utils.toArray(".img-top-bottom-anim").forEach((el, index) => {
		let ls_1 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 20%",
				end: "top 70%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		ls_1.set(el, { transformOrigin: "center center" }).from(
			el,
			{ opacity: 0, y: -100, x: -100 },
			{ opacity: 1, y: 0, x: 0, duration: 50, immediateRender: false }
		);
	});

	// why choose 2 top shape img 2
	gsap.utils.toArray(".img-bottom-top-anim").forEach((el, index) => {
		let ls_1 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 20%",
				end: "top 70%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		ls_1.set(el, { transformOrigin: "center center" }).from(
			el,
			{ opacity: 0, y: 100, x: 100 },
			{ opacity: 1, y: 0, x: 0, duration: 50, immediateRender: false }
		);
	});

	// fti-trand-1-divider animation
	gsap.utils.toArray(".fti-trand-1-divider").forEach((el, index) => {
		let ls_1 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 90%",
				end: "top 50%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		ls_1.set(el, { transformOrigin: "center center" }).from(
			el,
			{ opacity: 1, scale: 0.1 },
			{ opacity: 1, scale: 1, duration: 1, immediateRender: false }
		);
	});

	// highligt-text
	gsap.utils.toArray(".highligt-text").forEach((el, index) => {
		let ls_1 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 20%",
				end: "top 100%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		ls_1.set(el, { transformOrigin: "center center" }).from(
			el,
			{ opacity: 1, y: 200, color: "#000" },
			{ opacity: 1, y: 0, duration: 5, immediateRender: false }
		);
	});

	// subtitle-3 line-1
	gsap.utils.toArray(".subtitle-line-1").forEach((el, index) => {
		let ls_1 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 90%",
				end: "top 30%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		ls_1.set(el, { transformOrigin: "right right" }).from(
			el,
			{ opacity: 1, scale: 0.1 },
			{ opacity: 1, scale: 1, duration: 4, immediateRender: false }
		);
	});

	// subtitle-3 line-2
	gsap.utils.toArray(".subtitle-line-2").forEach((el, index) => {
		let ls_1 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 90%",
				end: "top 30%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		ls_1.set(el, { transformOrigin: "left left" }).from(
			el,
			{ opacity: 1, scale: 0.1 },
			{ opacity: 1, scale: 1, duration: 4, immediateRender: false }
		);
	});

	// scroll up-down animatino
	gsap.utils.toArray(".asslideupcta").forEach((el, index) => {
		let tlcta = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 90%",
				end: "top 50%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		tlcta
			.set(el, { transformOrigin: "center center" })
			.from(
				el,
				{ opacity: 1, y: "+=200" },
				{ opacity: 1, y: 0, duration: 1, immediateRender: false }
			);
	});

	// cta 1
	gsap.utils.toArray(".fti-cta-1-wrap").forEach((el, index) => {
		let tlcta = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 90%",
				end: "top 50%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		tlcta
			.set(el, { transformOrigin: "center center" })
			.from(
				el,
				{ opacity: 1, scale: 0.9 },
				{ opacity: 1, scale: 1, duration: 1, immediateRender: false }
			);
	});

	// short video section
	gsap.utils.toArray(".fti-short-video-1-area").forEach((el, index) => {
		let short_video_s = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 90%",
				end: "top 50%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		short_video_s
			.set(el, { transformOrigin: "center center" })
			.from(
				el,
				{ opacity: 1, scaleX: 0.9 },
				{ opacity: 1, scaleX: 1, duration: 1.5, immediateRender: false }
			);
	});

	// intro video section
	gsap.utils.toArray(".fti-intro-video-1-area").forEach((el, index) => {
		let short_video_s = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 90%",
				end: "top 20%",

				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		short_video_s
			.set(el, { transformOrigin: "center center" })
			.from(
				el,
				{ opacity: 1, scaleX: 0.7 },
				{ opacity: 1, scaleX: 1, duration: 1.5, immediateRender: false }
			);
	});

	// fade-down
	gsap.utils.toArray(".fti-fade-down img").forEach((el, index) => {
		let tl1 = gsap.timeline({
			scrollTrigger: {
				trigger: ".fti-fade-down",
				scrub: 2,
				start: "top 70%",
				end: "top 50%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		tl1.from(
			el,
			{ opacity: 1, yPercent: 100 },
			{ opacity: 1, duration: 1, immediateRender: false }
		);
	});

	// roated animation
	gsap.utils.toArray(".fti-roated-1").forEach((el, index) => {
		let tl1 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 80%",
				end: "top 50%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		tl1.from(
			el,
			{ Transform: "rotateY(-60deg) translateX(150px)" },
			{ opacity: 1, duration: 1, immediateRender: false }
		);
	});

	// roated animation 2
	gsap.utils.toArray(".fti-roated-2").forEach((el, index) => {
		let tl1 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 80%",
				end: "top 50%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		tl1.from(
			el,
			{ Transform: "rotateY(60deg) translateX(150px)" },
			{ opacity: 1, duration: 1, immediateRender: false }
		);
	});

	// scale-plus
	gsap.utils.toArray(".fti-scale-plus").forEach((el, index) => {
		let tl1 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 85%",
				end: "buttom 50%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		tl1.from(
			el,
			{ scale: 1.4 },
			{ opacity: 1, duration: 1, immediateRender: false }
		);
	});

	// team 2
	var team2 = gsap.timeline({
		scrollTrigger: {
			animation: team2,
			trigger: ".fti-team-2-membar",
			start: "top 80%",
			end: "top -50%",
			toggleActions: "play none play reverse",
			markers: false,
			stagger: 0.2,
		},
	});
	team2
		.from(".fti-team-2-membar", { opacity: 0, duration: 0.3, stagger: 0.1 })
		.from(
			".fti-team-2-membar-img-wrap",
			{
				transform: "rotate3d(1, 1, 1, 90deg)",
				duration: 0.7,
				stagger: 0.2,
			},
			"<"
		)
		.from(
			".fti-team-2-membar-img .main-img",
			{ yPercent: 100, duration: 0.7, stagger: 0.2 },
			".1"
		);

	// blog list slider start
	let feh_blog1 = new Swiper(".fti_bloglist_slide_active", {
		loop: true,
		spaceBetween: 0,
		speed: 500,
		slidesPerView: 1,
		navigation: {
			nextEl: ".feh_blog_1_next",
			prevEl: ".feh_blog_1_prev",
		},
	});

	// blog-details-slider
	let feh_blog_details = new Swiper(".blog-details-slider", {
		slidesPerView: 1,
		spaceBetween: 30,
		loop: true,
		navigation: {
			nextEl: ".blog-details-next",
			prevEl: ".blog-details-prev",
		},
		breakpoints: {
			0: {
				slidesPerView: 1,
			},
			576: {
				slidesPerView: 2,
			},
		},
	});

	// parallax-img
	if ($(".parallax-img").length) {
		$(".parallax-img").parallaxie({
			speed: 0.5,
		});
	}

	// project-details img-1
	gsap.to(".project-details-area", {
		scrollTrigger: {
			trigger: ".project-details-img-1",
			start: "top 70%",
			end: "bottom bottom",
			toggleClass: "active",
			once: true,
		},
	});

	// choose-1 progressbar-start
	if ($(".progress-bar").length) {
		var $progress_bar = $(".progress-bar");
		$progress_bar.appear();
		$(document.body).on("appear", ".progress-bar", function () {
			var current_item = $(this);
			if (!current_item.hasClass("appeared")) {
				var percent = current_item.data("percent");
				current_item
					.css("width", percent + "%")
					.addClass("appeared")
					.parent()
					.append("<span>" + percent + "%" + "</span>");
			}
		});
	}
	// choose-1 progressbar-end

	// team-details progressbar-start
	if ($(".team-details-progress-bar").length) {
		var $progress_bar = $(".team-details-progress-bar");
		$progress_bar.appear();
		$(document.body).on(
			"appear",
			".team-details-progress-bar",
			function () {
				var current_item = $(this);
				if (!current_item.hasClass("appeared")) {
					var percent = current_item.data("percent");
					current_item
						.css("width", percent + "%")
						.addClass("appeared")
						.parent()
						.append("<span>" + percent + "%" + "</span>");
				}
			}
		);
	}
	// team-details progressbar-end

	/*
	nice-selector-activiton
	====start====
	*/

	$(".nice-select select").niceSelect();
	/*
	nice-selector-activiton
	=====end====
	*/

	/*
	wow-activition
	=====start====
	*/

	new WOW().init();

	/*
	wow-activition
	=====end====
	*/

	/*
	popup-video-activition
	====start====
	*/
	$(".popup-video").magnificPopup({
		type: "iframe",
	});
	/*
	popup-video-activition
	====end====
	*/

	/*
	popup-img-activition
	====start====
	*/
	$(".popup_img").magnificPopup({
		type: "image",
		gallery: {
			enabled: true,
		},
	});
	/*
	popup-img-activition
	====end====
	*/

	/*
	counter-activition
	====start====
	*/
	$(".counter").counterUp({
		delay: 10,
		time: 3000,
	});
	/*
	counter-activition
	====end====
	*/

	/*
	data-bg-activition
	====start====
	*/
	$("[data-background]").each(function () {
		$(this).css(
			"background-image",
			"url(" + $(this).attr("data-background") + ") "
		);
	});
	/*
	data-bg-activition
	====end====
	*/

	/*
	marquee-activiton
	====start====
	*/

	$(".fti-hero-2-marquee").marquee({
		speed: 100,
		gap: 30,
		delayBeforeStart: 0,
		direction: "left",
		duplicated: true,
		pauseOnHover: true,
        
	});

	/*
	marquee-activiton
	=====end====
	*/

	$(".open_menu").on("click", function () {
		$(".mobile-menu").toggleClass("mobile_menu_on");
	});

	$(".open_menu").on("click", function () {
		$("body").toggleClass("mobile_menu_overlay_on");
	});

	if ($(".mobile_menu li.dropdown ul").length) {
		$(".mobile_menu li.dropdown").append(
			'<div class="dropdown-btn"><span class="fas fa-caret-right"></span></div>'
		);
		$(".mobile_menu li.dropdown .dropdown-btn").on("click", function () {
			$(this).prev("ul").slideToggle(500);
		});
	}

	$(".dropdown-btn").on("click", function () {
		$(this).toggleClass("toggle-open");
	});

	jQuery(".mobile-main-navigation li.dropdown").append(
		'<span class="dropdown-btn"><i class="fa-solid fa-angle-right"></i></span>'
	),
		jQuery(".mobile-main-navigation li .dropdown-btn").on(
			"click",
			function () {
				jQuery(this).hasClass("active")
					? (jQuery(this)
							.closest("ul")
							.find(".dropdown-btn.active")
							.toggleClass("active"),
					  jQuery(this)
							.closest("ul")
							.find(".dropdown-menu.active")
							.toggleClass("active")
							.slideToggle())
					: (jQuery(this)
							.closest("ul")
							.find(".dropdown-btn.active")
							.toggleClass("active"),
					  jQuery(this)
							.closest("ul")
							.find(".dropdown-menu.active")
							.toggleClass("active")
							.slideToggle(),
					  jQuery(this).toggleClass("active"),
					  jQuery(this)
							.parent()
							.find("> .dropdown-menu")
							.toggleClass("active"),
					  jQuery(this)
							.parent()
							.find("> .dropdown-menu")
							.slideToggle());
			}
		);

	// qty activation
	if ($("input.product-count").length) {
		$("input.product-count").TouchSpin({
			min: 1,
			max: 1000,
			step: 1,
			buttondown_class: "btn btn-link",
			buttonup_class: "btn btn-link",
		});
	}

	// image background
	function bgImageActive($scope, $) {
		$("[data-background]").each(function () {
			$(this).css(
				"background-image",
				"url(" + $(this).attr("data-background") + ") "
			);
		});
	}

	// hero slider
	function heroSlider($scope, $) {
		if ($(".fti_hero_3_active").length) {
			let fti_hero_3 = new Swiper(".fti_hero_3_active", {
				loop: true,
				spaceBetween: 0,
				speed: 500,
				slidesPerView: 1,
				effect: "fade",
				autoplay: {
					delay: 5000,
					disableOnInteraction: false,
				},
				fadeEffect: {
					crossFade: true,
				},
				navigation: {
					nextEl: ".fti-hero-3-next",
					prevEl: ".fti-hero-3-prev",
				},
			});
		}

		if ($(".fti_hero_4_active").length) {
			let fti_hero_4 = new Swiper(".fti_hero_4_active", {
				loop: true,
				spaceBetween: 0,
				speed: 500,
				slidesPerView: 1,
				effect: "fade",
				autoplay: {
					delay: 5000,
					disableOnInteraction: false,
				},
				fadeEffect: {
					crossFade: true,
				},
				pagination: {
					el: ".fti-hero-4-pagination",
					clickable: true,
				},
			});
		}

		if ($(".fti_hero_5_active").length) {
			let fti_hero_5 = new Swiper('.fti_hero_5_active', {
				loop: true,
				spaceBetween: 0,
				speed: 500,
				slidesPerView: 1,
				effect: 'fade',
				autoplay: {
					delay: 5000,
					disableOnInteraction: false
				},
				fadeEffect: {
					crossFade: true
				},
				navigation: {
					nextEl: '.fti-hero-5-next',
					prevEl: '.fti-hero-5-prev',
				},
				pagination: {
					el: ".fti-hero-5-pagination",
					clickable: true,
				},
			});
		}

		if ($(".fti_hero_1_active").length) {
			let fti_hero_1 = new Swiper('.fti_hero_1_active', {
				loop: true,
				spaceBetween: 0,
				speed: 500,
				slidesPerView: 1,
				effect: 'fade',
				autoplay: {
					delay: 5000,
					disableOnInteraction: false
				},
				fadeEffect: {
					crossFade: true
				},
				pagination: {
					el: ".fti-hero-1-pagination",
					clickable: true,
					renderBullet: function (index, className) {
						return '<span class="' + className + '">' + (index + 1) + "</span>";
					},
				},

				navigation: {
					nextEl: '.fti-hero-1-next',
					prevEl: '.fti-hero-1-prev',
				},
			});
		}

		if ($(".fti_hero_2_active").length) {
			let fti_hero_2 = new Swiper('.fti_hero_2_active', {
				loop: true,
				spaceBetween: 0,
				speed: 500,
				slidesPerView: 1,
				effect: 'fade',
				// autoplay: {
				// 	delay: 5000,
				// 	disableOnInteraction: false
				// },
				fadeEffect: {
					crossFade: true
				},
				pagination: {
					el: ".fti-hero-2-pagination",
					clickable: true,
					renderBullet: function (index, className) {
						return '<span class="' + className + '">0' + (index + 1) + "</span>";
					},
				},
			});
		}
	}

	// service_list
	function tx_service_lists($scope, $) {
		if ($(".fti_project_3_active").length) {
			let fti_project_3 = new Swiper(".fti_project_3_active", {
				loop: true,
				speed: 500,
				autoplay: {
					delay: 5000,
					disableOnInteraction: false,
				},
				centeredSlides: true,
				navigation: {
					nextEl: ".fti-project-3-next",
					prevEl: ".fti-project-3-prev",
				},
				breakpoints: {
					0: {
						slidesPerView: 1,
					},
					576: {
						slidesPerView: 2,
						spaceBetween: 15,
					},
					768: {
						slidesPerView: 2,
						spaceBetween: 30,
					},
					992: {
						slidesPerView: 2,
						spaceBetween: 30,
					},
					1200: {
						slidesPerView: 2,
						spaceBetween: 30,
					},
					1400: {
						slidesPerView: 2,
						spaceBetween: 30,
					},
					1600: {
						slidesPerView: 2,
						spaceBetween: 30,
					},
				},
			});
		}

		if ($(".fti_company_3_active").length) {
			let fti_company_3 = new Swiper(".fti_company_3_active", {
				loop: true,
				spaceBetween: 0,
				speed: 500,
				slidesPerView: 1,
				autoplay: {
					delay: 5000,
					disableOnInteraction: false,
				},
				pagination: {
					el: ".fti-company-3-pagination",
					clickable: true,
					renderBullet: function (index, className) {
						return (
							'<span class="' +
							className +
							'">0' +
							(index + 1) +
							"</span>"
						);
					},
				},
			});
		}

		if ($(".fti_services_1_active").length) {
			let fti_services_1 = new Swiper('.fti_services_1_active', {
				spaceBetween: 30,
				loop: true,
				infinite: false,
				speed: 500,
				autoplay: {
					delay: 5000,
				},
				navigation: {
					nextEl: ".fti_services_1_next",
					prevEl: ".fti_services_1_prev",
				},
				breakpoints: {
					0: {
						slidesPerView: 1,
					},
					576: {
						slidesPerView: 1,
					},
					768: {
						slidesPerView: 2,
					},
					992: {
						slidesPerView: 3,
					},
					1200: {
						slidesPerView: 3,
					},
					1400: {
						slidesPerView: 3,
					},
					1600: {
						slidesPerView: 4,
					},
				}

			});
		}

		if ($(".fti_project_1_active").length) {
			let fti_project_1 = new Swiper('.fti_project_1_active', {
				spaceBetween: 30,
				loop: true,
				infinite: false,
				speed: 500,
				autoplay: {
					delay: 5000,
				},
				navigation: {
					nextEl: ".fti_project_1_next",
					prevEl: ".fti_project_1_prev",
				},
				pagination: {
					el: ".fti_project_1_pagination",
					type: "fraction",
				},
				breakpoints: {
					0: {
						slidesPerView: 1,
					},
					576: {
						slidesPerView: 2,
					},
					768: {
						slidesPerView: 2,
					},
					992: {
						slidesPerView: 3,
					},
					1200: {
						slidesPerView: 3,
					},
					1400: {
						slidesPerView: 3,
					},
					1600: {
						slidesPerView: 4,
					},
				}

			});
		}

		if ($(".fti_trand_1_active").length) {
			let fti_trand_1 = new Swiper('.fti_trand_1_active', {
				spaceBetween: 25,
				loop: true,
				infinite: false,
				speed: 500,
				autoplay: {
					delay: 5000,
				},
				pagination: {
					el: ".fti-trand-1-pagination",
					clickable: true,
				},
				breakpoints: {
					0: {
						slidesPerView: 1,
					},
					576: {
						slidesPerView: 1,
					},
					768: {
						slidesPerView: 2,
					},
					992: {
						slidesPerView: 2,
					},
					1200: {
						slidesPerView: 2,
					},
					1400: {
						slidesPerView: 2,
					},
					1600: {
						slidesPerView: 2,
					},
				}

			});
		}

		if ($(".fti_services_2_active").length) {
			let fti_services_2 = new Swiper('.fti_services_2_active', {
				spaceBetween: 30,
				loop: true,
				infinite: false,
				speed: 500,
				autoplay: {
					delay: 5000,
				},
				navigation: {
					nextEl: ".fti_services_2_next",
					prevEl: ".fti_services_2_prev",
				},
				breakpoints: {
					0: {
						slidesPerView: 1,
					},
					576: {
						slidesPerView: 1,
					},
					768: {
						slidesPerView: 2,
					},
					992: {
						slidesPerView: 3,
					},
					1200: {
						slidesPerView: 3,
					},
					1400: {
						slidesPerView: 3,
					},
					1600: {
						slidesPerView: 4,
					},
				}

			});
		}
	}

	// tx_testimonial
	function tx_testimonial($scope, $) {
		if ($(".fti_testimonial_4_active").length) {
			let fti_testimonial_4 = new Swiper(".fti_testimonial_4_active", {
				loop: true,
				spaceBetween: 0,
				speed: 500,
				slidesPerView: 1,
				autoplay: {
					delay: 5000,
					disableOnInteraction: false,
				},
				navigation: {
					nextEl: ".fti-testimonial-4-next",
					prevEl: ".fti-testimonial-4-prev",
				},
			});
		}
		if ($(".fti_blockquote_5_active").length) {
			let fti_blockquote_5 = new Swiper('.fti_blockquote_5_active', {
				loop: true,
				spaceBetween: 0,
				speed: 500,
				slidesPerView: 1,
				autoplay: {
					delay: 5000,
					disableOnInteraction: false
				},
				pagination: {
					el: ".fti-blockquote-5-pagination",
					clickable: true,
				},
			});
		}

		if ($(".chy_testimonial_5_active").length) {

			let chyt5_thumb = new Swiper('.chy_t5_preview_active', {
				spaceBetween: 30,
				loop: false,
				speed: 1000,
				slidesPerView: 3,
				direction: 'vertical',
				rtl: false,
				centeredSlides: false,
				watchSlidesProgress: false,

				breakpoints: {
					320: {
					slidesPerView: 2,
					direction: 'horizontal',
					},
					576: {
					slidesPerView: 3,
					direction: 'horizontal',
					},
					768: {
					slidesPerView: 3,
					direction: 'horizontal',

					},
					992: {
					slidesPerView: 3,
					direction: 'vertical',
					},
					1200: {
					slidesPerView: 3,
					direction: 'vertical',
					},
					1400: {
					slidesPerView: 3,
					direction: 'vertical',
					},
					1600: {
					slidesPerView: 3,
					direction: 'vertical',
					},

				}
			});

			let chyt5 = new Swiper('.chy_testimonial_5_active', {
				loop: true,
				spaceBetween: 0,
				rtl: false,
				slidesPerView: 1,
				effect: 'fade',
				autoplay: {
					delay: 40000000,
					},
				fadeEffect: {
					crossFade: true
				},
				thumbs: {
					swiper: chyt5_thumb,
				},
			});
		}
	}

	// tx_team
	function tx_team($scope, $) {
		if ($(".fti_team_2_active").length) {
			let fti_team_2 = new Swiper('.fti_team_2_active', {
				loop: true,
				infinite: false,
				speed: 500,
				autoplay: {
					delay: 5000,
				},
				navigation: {
					nextEl: ".fti_team_2_next",
					prevEl: ".fti_team_2_prev",
				},
				breakpoints: {
					0: {
						slidesPerView: 1,
					},
					576: {
						slidesPerView: 1,
					},
					768: {
						slidesPerView: 2,
						spaceBetween: 50,
					},
					992: {
						slidesPerView: 3,
						spaceBetween: 30,
					},
					1200: {
						slidesPerView: 3,
						spaceBetween: 30,
					},
					1400: {
						slidesPerView: 3,
						spaceBetween: 50,
					},
					1600: {
						slidesPerView: 3,
						spaceBetween: 50,
					},
				}
			});
		}
	}

	$(window).on("elementor/frontend/init", function () {
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tx_hero_slider.default",
			function ($scope, $) {
				bgImageActive($scope, $);
				heroSlider($scope, $);
			}
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tx_service_lists.default",
			function ($scope, $) {
				bgImageActive($scope, $);
				tx_service_lists($scope, $);
			}
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tx_cta.default",
			function ($scope, $) {
				bgImageActive($scope, $);
			}
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tx_post_grid.default",
			function ($scope, $) {
				bgImageActive($scope, $);
			}
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tx_testimonial.default",
			function ($scope, $) {
				bgImageActive($scope, $);
				tx_testimonial($scope, $);
			}
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tx_count_box.default",
			function ($scope, $) {
				bgImageActive($scope, $);
			}
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tx_about.default",
			function ($scope, $) {
				bgImageActive($scope, $);
			}
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tx_team.default",
			function ($scope, $) {
				tx_team($scope, $);
				bgImageActive($scope, $);
			}
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tx_contact_info.default",
			function ($scope, $) {
				bgImageActive($scope, $);
			}
		);

	});
})(jQuery);
