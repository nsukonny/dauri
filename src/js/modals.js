import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

document.addEventListener('DOMContentLoaded', () => {
	'use strict'
	toggleModal()
})

const toggleModal = () => {
	const openButtons = document.querySelectorAll('[data-modal-target]')
	let currentModal = null
	let currentContent = null

	const openModal = (modalId) => {
		const modal = document.getElementById(modalId)
		if (!modal) return

		const content = modal.querySelector('.modal-content')
		currentModal = modal
		currentContent = content

		modal.classList.add('opened')
		disableBodyScroll(content)
	}

	const closeModal = () => {
		if (!currentModal || !currentContent) return

		currentModal.classList.remove('opened')
		enableBodyScroll(currentContent)

		currentModal = null
		currentContent = null
	}

	openButtons.forEach(button => {
		const targetId = button.dataset.modalTarget
		button.addEventListener('click', () => openModal(targetId))
	})

	document.querySelectorAll('.modal-close').forEach(btn => {
		btn.addEventListener('click', closeModal)
	})

	document.querySelectorAll('.modal-wrapper').forEach(wrapper => {
		wrapper.addEventListener('click', event => {
			if (event.target === wrapper) {
				closeModal()
			}
		})
	})

	document.addEventListener('keydown', e => {
		if (e.key === 'Escape') {
			closeModal()
		}
	})
}
