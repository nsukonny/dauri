document.addEventListener('DOMContentLoaded', () => {
	'use strict'
	togglePopup('.popover-ex', '.call')
	initSmartPopup()
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

const initSmartPopup = () => {
	const POPUP_STORAGE_KEY = 'seen_highlight'
	const DELAY_MS = 10000

	if (localStorage.getItem(POPUP_STORAGE_KEY) === '1') {
		return
	}

	setTimeout(() => {
		const popup = document.querySelector('.highlight-banner')
		if (!popup) return

		popup.classList.add('opened')

		const closeBtn = popup.querySelector('.highlight-close')
		if (closeBtn) {
			closeBtn.addEventListener('click', () => {
				closeSmartPopup(popup, POPUP_STORAGE_KEY)
			})
		}

		const links = popup.querySelectorAll('a')
		links.forEach(link => {
			link.addEventListener('click', () => {
				closeSmartPopup(popup, POPUP_STORAGE_KEY)
			})
		})
	}, DELAY_MS)
}

const closeSmartPopup = (popup, key) => {
	if (!popup) return

	popup.classList.remove('opened')
	localStorage.setItem(key, '1')
}