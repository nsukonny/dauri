import AOS from '../../../node_modules/aos/dist/aos'
import { WINDOW_WIDTH } from "./global"
import { initDOM } from "./global"

document.addEventListener('DOMContentLoaded', () => {
	'use strict'

	const DOM = initDOM()
	const { header } = DOM

	AOS.init({
		debounceDelay: 100,
		once: true,
		anchorPlacement: 'top-bottom'
	})
	headerScroll(header)
	footerDropdowns()
	cookiesBanner()
	toggle('.searchbar', '#search', '.searchbar-close')
})

const headerScroll = (header) => {
	if (!header) return

	let lastScrollY = window.pageYOffset

	const handleScroll = () => {
		const currentScrollY = window.pageYOffset

		if (currentScrollY > lastScrollY) {
			header.classList.add('scrolled')
		} else {
			header.classList.remove('scrolled')
		}

		lastScrollY = currentScrollY
	}

	window.addEventListener('scroll', handleScroll)
}

const toggle = (selector, btn, closeBtnSelector) => {
	const toggleSelector = document.querySelector(selector)
	const toggleBtn = document.querySelector(btn)
	const closeBtn = toggleSelector?.querySelector(closeBtnSelector)


	if (!toggleSelector || !toggleBtn) return

	toggleBtn.addEventListener('click', (e) => {
		e.stopPropagation()
		toggleSelector.classList.toggle('opened')
	})

	closeBtn.addEventListener('click', () => {
		toggleSelector.classList.remove('opened')
	})

	document.addEventListener('click', (e) => {
		if (
			toggleSelector.classList.contains('opened') &&
			!toggleSelector.contains(e.target) &&
			!toggleBtn.contains(e.target)
		) {
			toggleSelector.classList.remove('opened')
		}
	})
}


const footerDropdowns = () => {
	document.addEventListener('click', e => {
		const { MD } = WINDOW_WIDTH
		const target = e.target
		if (target.closest('.col-title') && window.innerWidth < MD) {
			const footerCol = target.closest('.footer-col')
			if (footerCol) footerCol.classList.toggle('active')
		}
	})
}

const cookiesBanner = () => {
	const cookieBanner = document.getElementById('cookie-banner')
	const cookieBtn = document.getElementById('cookie-btn')

	if(!cookieBanner && !cookieBtn ) return

	const cookieAccepted = localStorage.getItem('cookieAccepted')
	if (cookieAccepted === 'true') {
		cookieBanner.style.display = 'none'
	}

	cookieBtn.addEventListener('click', () => {
		cookieBanner.classList.add('accepted')
		localStorage.setItem('cookieAccepted', 'true')

		setTimeout(() => cookieBanner.style.display = 'none', 1000)
	})
}

export const reCalculateDropdownHeight = dropdown => {
	const dropdownOpen = dropdown.querySelector('.dropdown-open'),
		dropdownInner = dropdown.querySelector('.dropdown-inner')

	if (!dropdownOpen || !dropdownInner) return

	dropdownOpen.style.height = `${dropdownInner.getBoundingClientRect().height}px`
}