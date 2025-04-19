document.addEventListener('DOMContentLoaded', () => {
	'use strict'

	showPass()
})

const showPass = () => {
	const buttons = document.querySelectorAll('.show-pass')

	if(!buttons.length) return

	buttons.forEach(button => {
		button.addEventListener('click', () => {
			const input = button.previousElementSibling

			if (!input || input.tagName.toLowerCase() !== 'input') return

			const isPasswordVisible = input.type === 'text'

			input.type = isPasswordVisible ? 'password' : 'text'
			button.textContent = isPasswordVisible ? 'Показать' : 'Скрыть'
		})
	})
}