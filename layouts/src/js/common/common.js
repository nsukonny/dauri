import { WINDOW_WIDTH_MD } from "./global"

document.addEventListener('DOMContentLoaded', () => {
	'use strict'

	themeToggle()
	footerDropdowns()
})

const footerDropdowns = () => {
	document.addEventListener('click', e => {
		const target = e.target
		if (target.closest('.col-title') && window.innerWidth < WINDOW_WIDTH_MD) {
			const footerCol = e.target.closest('.footer-col')
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