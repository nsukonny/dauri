import Swiper from 'swiper'
import { Pagination, Autoplay, Navigation, EffectFade } from 'swiper/modules'

document.addEventListener('DOMContentLoaded', () => {
	initFadeSwiper('.swiper.hero-swiper', {
		hasPagination: true,
		hasNavigation: false,
		autoplayToggleBtnId: 'autoplayToggle'
	})

	initDefaultSwiper('.swiper.slides-half-swiper')

	initFadeSwiper('.swiper.exclusive-swiper', {
		hasPagination: false,
		hasNavigation: true
	})
})

const initFadeSwiper = (selector, { hasPagination, hasNavigation, autoplayToggleBtnId }) => {
	const container = document.querySelector(selector)
	if (!container) return

	const config = {
		modules: [Autoplay, EffectFade],
		loop: true,
		speed: 2000,
		effect: 'fade',
		fadeEffect: { crossFade: true },
		autoplay: { delay: 5000, disableOnInteraction: false },
	}

	if (hasPagination) {
		config.modules.push(Pagination)
		config.pagination = {
			el: container.querySelector('.swiper-pagination'),
			clickable: true
		}
	}

	if (!hasPagination) {
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
		setupAutoplayToggle(swiper, autoplayToggleBtnId)
	}
}

const initDefaultSwiper = (selector) => {
	const swiperContainers = document.querySelectorAll(selector)

	swiperContainers.forEach(container => {
		new Swiper(container, {
			modules: [Autoplay, Navigation],
			spaceBetween: 20,
			speed: 1000,
			slidesPerView: 1,
			navigation: {
				nextEl: container.querySelector('.swiper-next'),
				prevEl: container.querySelector('.swiper-prev')
			},
			breakpoints: {
				480: { slidesPerView: 2, spaceBetween: 20 },
				768: { slidesPerView: 3 }
			}
		})
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