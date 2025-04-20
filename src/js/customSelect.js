document.addEventListener('DOMContentLoaded', () => {
	'use strict'

	initCustomSelects()
})

const initCustomSelects = () => {
	const selects = document.querySelectorAll('.custom-select')

	selects.forEach(select => {
		const input = select.querySelector('input')
		const button = select.querySelector('.select-button')
		const options = select.querySelectorAll('.select-option')

		const toggle = () => {
			document.querySelectorAll('.custom-select.opened').forEach(opened => {
				if (opened !== select) opened.classList.remove('opened')
			})

			select.classList.toggle('opened')
		}

		input.addEventListener('click', toggle)
		button.addEventListener('click', toggle)

		options.forEach(option => {
			option.addEventListener('click', () => {
				input.value = option.textContent
				select.classList.remove('opened')
			})
		})
	})

	document.addEventListener('click', e => {
		document.querySelectorAll('.custom-select.opened').forEach(select => {
			if (!select.contains(e.target)) {
				select.classList.remove('opened')
			}
		})
	})
}
