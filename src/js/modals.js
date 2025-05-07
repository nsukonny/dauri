import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

document.addEventListener('DOMContentLoaded', () => {
	'use strict'
	toggleModal()
})

const toggleModal = () => {
	const openButtons = document.querySelectorAll('[data-modal-target]')
	let currentModal = null
	let currentContent = null
	let closeTimeout = null

	const openModal = (modalId) => {
		const modal = document.getElementById(modalId)
		if (!modal) return

		const content = modal.querySelector('.modal-content')
		currentModal = modal
		currentContent = content

		modal.classList.remove('not-visible')
		modal.classList.remove('fade-out')

		requestAnimationFrame(() => {
			modal.classList.add('show')
			disableBodyScroll(content)
		})
	}

	const closeModal = () => {
		if (!currentModal || !currentContent) return

		modal.classList.remove('show')
		modal.classList.add('fade-out')
		enableBodyScroll(currentContent)

		clearTimeout(closeTimeout)
		closeTimeout = setTimeout(() => {
			if (currentModal) {
				currentModal.classList.add('not-visible')
				currentModal.classList.remove('fade-out')
				currentModal = null
				currentContent = null
			}
		}, 250)
	}

	openButtons.forEach(button => {
		const targetId = button.dataset.modalTarget
		button.addEventListener('click', () => openModal(targetId))
	})

	document.querySelectorAll('.modal-close').forEach(btn => {
		btn.addEventListener('click', closeModal)
	})

	document.querySelectorAll('.modal-wrapper').forEach(backdrop => {
		backdrop.addEventListener('click', closeModal)
	})

	document.addEventListener('keydown', e => {
		if (e.key === 'Escape') {
			closeModal()
		}
	})
}
