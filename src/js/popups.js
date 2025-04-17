document.addEventListener('DOMContentLoaded', () => {
	'use strict'
	togglePopup('.popover-ex', '.call')
})

const togglePopup = (popupSelector, buttonSelector) => {
	const buttons = document.querySelectorAll(buttonSelector)

	buttons.forEach(button => {
		button.addEventListener('click', () => {
			const container = button.closest('[data-popover-container]')
			if (!container) return

			const popup = container.querySelector(popupSelector)
			if (!popup) return

			popup.classList.add('opened')

			const closeBtn = popup.querySelector('.close')
			if (closeBtn) {
				closeBtn.addEventListener('click', () => {
					popup.classList.remove('opened')
				})
			}
		})
	})
}