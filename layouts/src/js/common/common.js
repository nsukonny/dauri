import AOS from '../../../node_modules/aos/dist/aos'
import { WINDOW_WIDTH } from "./global"
import { initDOM } from "./global"

document.addEventListener('DOMContentLoaded', () => {
	'use strict'

	const DOM = initDOM()
	const { header } = DOM

	AOS.init()
	headerScroll(header)
	themeToggle()
	footerDropdowns()
	cookiesBanner()
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

const themeToggle = () => {
	const themeToggleButtons = document.querySelectorAll('.theme-button')

	const savedTheme = localStorage.getItem('theme') || 'light'
	document.documentElement.setAttribute('data-theme', savedTheme)
	updateButtons(savedTheme)

	themeToggleButtons.forEach(themeToggleButton => {
		themeToggleButton.addEventListener('click', () => {
			const currentTheme = document.documentElement.getAttribute('data-theme')
			const newTheme = currentTheme === 'light' ? 'dark' : 'light'

			document.documentElement.setAttribute('data-theme', newTheme)
			localStorage.setItem('theme', newTheme)
			updateButtons(newTheme)
		})
	})

	function updateButtons(theme) {
		themeToggleButtons.forEach(themeToggleButton => {
			const lightImg = themeToggleButton.querySelector('.lightImg')
			const darkImg = themeToggleButton.querySelector('.darkImg')
			const text = themeToggleButton.querySelector('.theme-text')

			if (theme === 'light') {
				lightImg.classList.remove('hidden')
				darkImg.classList.add('hidden')
				text.textContent = 'Ночная тема'
			} else {
				darkImg.classList.remove('hidden')
				lightImg.classList.add('hidden')
				text.textContent = 'Дневная тема'
			}
		})
	}
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