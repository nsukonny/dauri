import AOS from 'aos'
import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'
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
	toggle('.searchbar', '#search', '.searchbar-close', '#searchbar')
	toggle('.searchbar', '.catalog-button.search', '.searchbar-close', '#searchbar')
	toggle('.filter-modal', '#filter-button', '.filter-close', '#filter-modal', true)
})

const headerScroll = (header) => {
	if (!header) return

	let lastScrollY = window.scrollY

	const handleScroll = () => {
		const currentScrollY = window.scrollY

		if (currentScrollY > lastScrollY) {
			header.classList.add('scrolled')
		} else {
			header.classList.remove('scrolled')
		}

		lastScrollY = currentScrollY
	}

	window.addEventListener('scroll', handleScroll)
}

const toggle = (selector, btn, closeBtnSelector, lock, allowSelfClickClose = false) => {
	const toggleSelector = document.querySelector(selector)
	const toggleBtn = document.querySelector(btn)
	const closeBtn = toggleSelector?.querySelector(closeBtnSelector)

	if (!toggleSelector || !toggleBtn) return

	toggleBtn.addEventListener('click', (e) => {
		e.stopPropagation()
		const lockElement = document.querySelector(lock)
		if (!toggleSelector.classList.contains('opened')) {
			toggleSelector.classList.add('opened')
			disableBodyScroll(lockElement, { reserveScrollBarGap: true })
		} else {
			toggleSelector.classList.remove('opened')
			enableBodyScroll(lockElement)
		}
	})

	closeBtn?.addEventListener('click', () => {
		const lockElement = document.querySelector(lock)
		toggleSelector.classList.remove('opened')
		enableBodyScroll(lockElement)
	})

	document.addEventListener('click', (e) => {
		const lockElement = document.querySelector(lock)
		const isClickOutsideSelector = !toggleSelector.contains(e.target)
		const isClickOutsideBtn = !toggleBtn.contains(e.target)
		const isClickOnSelf = toggleSelector === e.target

		if (
			toggleSelector.classList.contains('opened') &&
			(
				(isClickOutsideSelector && isClickOutsideBtn) ||
				(allowSelfClickClose && isClickOnSelf)
			)
		) {
			toggleSelector.classList.remove('opened')
			enableBodyScroll(lockElement)
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