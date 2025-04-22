import Swiper from 'swiper'
import { WINDOW_WIDTH } from './common/global'
import { checkImageBrightness } from './checkBrightness'
import { Pagination, Autoplay, Navigation, EffectFade } from 'swiper/modules'

document.addEventListener('DOMContentLoaded', () => {
	initFadeSwiper('.swiper.hero-swiper', 2000, {
		hasPagination: true,
		paginationType: 'bullets',
		hasNavigation: false,
		autoplayToggleBtnId: 'autoplayToggle'
	})

	initFadeSwiper('.swiper.fade-swiper', 700, {
		hasPagination: true,
		paginationType: 'bullets',
		hasNavigation: false,
		autoplayToggleBtnId: 'autoplayToggle1'
	})

	initDefaultSwiper('.swiper.slides-half-swiper', 20, 20, 20, 1, 1, false, false)
	initDefaultSwiper('.swiper.collection-items-swiper', 4, 20, 114, 1, 1, false, false)
	initDefaultSwiper('.swiper.swiper-slides', 20, 20, 20, 1, 2, true, true)

	initFadeSwiper('.swiper.exclusive-swiper', 800, {
		hasPagination: true,
		paginationType: 'fraction',
		hasNavigation: true
	})

	initInfiniteSlider('.swiper-carousel', 15000, 40, 50, 60, 80, 2, 3, 5, 7)
	initInfiniteSlider('.swiper-card-carousel', 4000, 5, 5, 5, 5, 1, 2, 3, 3)
})

const initFadeSwiper = (selector, speed, { hasPagination, paginationType, hasNavigation, autoplayToggleBtnId }) => {
	const { LG } = WINDOW_WIDTH
	const container = document.querySelector(selector)
	if (!container) return

	const updateBrightness = () => {
		const activeSlide = container.querySelector('.swiper-slide-active')
		if (activeSlide) {
			const img = activeSlide.querySelector('.swiper-slide-img img')
			const text = activeSlide.querySelector('.slide-info-desc')
			if (img && text) {
				const process = () => {
					checkImageBrightness(img, (isDark, brightness) => {
						if (isDark) {
							text.classList.add('light-text')
						} else {
							text.classList.remove('light-text')
						}
					})
				}

				if (img.complete) {
					process()
				} else {
					img.addEventListener('load', process)
				}
			}
		}
	}

	const removeLightClasses = () => {
		container.querySelectorAll('.light-text').forEach(el => el.classList.remove('light-text'))
	}

	const config = {
		modules: [Autoplay, EffectFade],
		loop: true,
		speed: speed,
		effect: 'fade',
		fadeEffect: { crossFade: true },
		autoplay: { delay: 5000, disableOnInteraction: false },
		on: {
			init: function () {
				if (window.innerWidth < LG) {
					updateBrightness()
				} else {
					removeLightClasses()
				}
			},
			slideChangeTransitionStart: function () {
				if (window.innerWidth < LG) {
					updateBrightness()
				} else {
					removeLightClasses()
				}
			}
		}
	}

	if (hasPagination) {
		config.modules.push(Pagination)
		config.pagination = {
			el: container.querySelector('.swiper-pagination'),
			clickable: true,
			type: paginationType
		}
	} else {
		const paginationWrapper = container.querySelector('.pagination-wrapper')
		if (paginationWrapper) paginationWrapper.remove()
	}

	if (hasNavigation) {
		config.modules.push(Navigation)
		config.navigation = {
			nextEl: container.querySelector('.swiper-next'),
			prevEl: container.querySelector('.swiper-prev')
		}
	}

	const swiper = new Swiper(container, config)

	if (hasPagination && autoplayToggleBtnId) {
		setupAutoplayToggle(swiper, autoplayToggleBtnId);
	}

	window.addEventListener('resize', () => {
		if (window.innerWidth < LG) {
			updateBrightness()
		} else {
			removeLightClasses()
		}
	})
}

const initDefaultSwiper = (selector, spbInit, spbInitSm, spbInitMd, spvSM, spvXL, initOnMobileOnly = false, startFromLast = false) => {
	const swiperContainers = document.querySelectorAll(selector)
	const { XL } = WINDOW_WIDTH

	const initSwiperForContainer = (container) => {
		if (container.swiperInstance) return

		const totalSlides = container.querySelectorAll('.swiper-slide').length
		const lastSlideIndex = Math.max(totalSlides - 1, 0)

		container.swiperInstance = new Swiper(container, {
			modules: [Autoplay, Navigation],
			speed: 1000,
			spaceBetween: 20,
			initialSlide: startFromLast ? lastSlideIndex : 0,
			navigation: {
				nextEl: container.querySelector('.swiper-next'),
				prevEl: container.querySelector('.swiper-prev')
			},
			breakpoints: {
				320: {
					slidesPerView: 1
				},
				480: {
					slidesPerView: spvSM,
					spaceBetween: spbInitSm
				},
				768: {
					spaceBetween: spbInitMd,
					slidesPerView: spvXL
				}
			}
		})
	}

	const destroySwiperForContainer = (container) => {
		if (container.swiperInstance) {
			container.swiperInstance.destroy(true, true)
			container.swiperInstance = null
		}
	}

	const checkAndInit = () => {
		swiperContainers.forEach(container => {
			if (initOnMobileOnly) {
				if (window.innerWidth <= XL) {
					destroySwiperForContainer(container)
					return
				} else {
					initSwiperForContainer(container)
				}
			} else {
				initSwiperForContainer(container)
			}
		})
	}

	checkAndInit()
	window.addEventListener('resize', checkAndInit)
}

const initInfiniteSlider = (selector, speed, spaceInit, spaceSm, spaceMd, spaceXl, spInit, sm, md, xl) => {
	const container = document.querySelector(selector)
	if (!container) return

	new Swiper(container, {
		modules: [Autoplay],
		loop: true,
		speed: speed,
		slidesPerView: spInit,
		allowTouchMove: false,
		spaceBetween: spaceInit,
		autoplay: { delay: 0, disableOnInteraction: true },
		freeMode: true,

		breakpoints: {
			480: {
				spaceBetween: spaceSm,
				slidesPerView: sm
			},
			768: {
				spaceBetween: spaceMd,
				slidesPerView: md
			},
			1200: {
				spaceBetween: spaceXl,
				slidesPerView: xl
			},
		}
	})
}

const setupAutoplayToggle = (swiper, btnId) => {
	const autoplayBtn = document.getElementById(btnId)
	if (!autoplayBtn) return

	let isAutoplayRunning = true

	autoplayBtn.addEventListener('click', () => {
		if (isAutoplayRunning) {
			swiper.autoplay.stop()
			autoplayBtn.innerHTML = playIcon()
		} else {
			swiper.autoplay.start()
			autoplayBtn.innerHTML = pauseIcon()
		}
		isAutoplayRunning = !isAutoplayRunning
	})
}

const playIcon = () => `
	<svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none">
		<path d="M9.24145 4.03746C9.44878 4.14771 9.6222 4.3123 9.74313 4.51358C9.86407 4.71486 9.92796 4.94526 9.92796 5.18008C9.92796 5.4149 9.86407 5.6453 9.74313 5.84658C9.6222 6.04786 9.44878 6.21245 9.24145 6.3227L3.71093 9.33012C2.82041 9.81489 1.72656 9.18465 1.72656 8.18793V2.17266C1.72656 1.17551 2.82041 0.545707 3.71093 1.02961L9.24145 4.03746Z" fill="#585858"/>
	</svg>
`

const pauseIcon = () => `
	<svg xmlns="http://www.w3.org/2000/svg" width="8" height="11" viewBox="0 0 8 11" fill="none">
		<rect width="2.82612" height="10.3625" rx="1.41306" fill="#585858"/>
		<rect x="4.71094" width="2.82612" height="10.3625" rx="1.41306" fill="#585858"/>
	</svg>
`