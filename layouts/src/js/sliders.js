import Swiper from 'swiper'
import { Pagination, Autoplay, EffectFade } from 'swiper/modules'
import { WINDOW_WIDTH_XL } from './common/global'

document.addEventListener('DOMContentLoaded', () => {
	'use strict'
	const swiper = new Swiper('.swiper', {
		modules: [Autoplay, Pagination, EffectFade],
		autoplay: {
			delay: 5000,
			disableOnInteraction: false
		},
		speed: 2000,
		effect: 'fade',
		fadeEffect: { crossFade: true },
		pagination: {
			el: '.swiper-pagination',
			clickable: true
		},
		simulateTouch: window.innerWidth < WINDOW_WIDTH_XL
	})
	
	const autoplayBtn = document.getElementById('autoplayToggle')
	let isAutoplayRunning = true
	autoplayBtn.addEventListener('click', () => {
		if (isAutoplayRunning) {
			swiper.autoplay.stop()
			autoplayBtn.innerHTML = `
			<svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none">
				<path d="M9.24145 4.03746C9.44878 4.14771 9.6222 4.3123 9.74313 4.51358C9.86407 4.71486 9.92796 4.94526 9.92796 5.18008C9.92796 5.4149 9.86407 5.6453 9.74313 5.84658C9.6222 6.04786 9.44878 6.21245 9.24145 6.3227L3.71093 9.33012C2.82041 9.81489 1.72656 9.18465 1.72656 8.18793V2.17266C1.72656 1.17551 2.82041 0.545707 3.71093 1.02961L9.24145 4.03746Z" fill="#585858"/>
			</svg>
			`
		} else {
			swiper.autoplay.start()
			autoplayBtn.innerHTML = `
			<svg xmlns="http://www.w3.org/2000/svg" width="8" height="11" viewBox="0 0 8 11" fill="none">
				<rect width="2.82612" height="10.3625" rx="1.41306" fill="#585858"/>
				<rect x="4.71094" width="2.82612" height="10.3625" rx="1.41306" fill="#585858"/>
			</svg>
			`
		}
		isAutoplayRunning = !isAutoplayRunning
	})
})