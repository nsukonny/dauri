document.addEventListener('DOMContentLoaded', () => {
	'use strict'

	initTabs()
})

const initTabs = () => {
	const tabButtons = document.querySelectorAll('[data-tab-button]')
	tabButtons.forEach(button => {
		button.addEventListener('click', function() {
			const id = this.dataset.id
			if (!id || this.classList.contains('active')) return

			const tabContainer = this.closest('.searchbar-tabs') || this.closest('.card-tabs')
				|| this.closest('section')
			if (!tabContainer) return

			const buttons = tabContainer.querySelectorAll('[data-tab-button]')
			buttons.forEach(btn => btn.classList.remove('active'))

			this.classList.add('active')

			const parentContainer = tabContainer.closest('section') || tabContainer
			const contents = parentContainer.querySelectorAll('[data-tab-content]')
			contents.forEach(content => content.classList.remove('active'))

			const activeContent = parentContainer.querySelector(`[data-tab-content="${id}"]`)
			if (activeContent) activeContent.classList.add('active')
		})
	})

	const cardTabButtons = document.querySelectorAll('[data-card-tab-button]')
	cardTabButtons.forEach(button => {
		button.addEventListener('click', function() {
			const id = this.dataset.id
			if (!id || this.classList.contains('active')) return

			const tabContainer = this.closest('.searchbar-tabs') || this.closest('.card-tabs')
				|| this.closest('section')
			if (!tabContainer) return

			const buttons = tabContainer.querySelectorAll('[data-card-tab-button]')
			buttons.forEach(btn => btn.classList.remove('active'))

			this.classList.add('active')

			const parentContainer = tabContainer.closest('section') || tabContainer
			const contents = parentContainer.querySelectorAll('[data-card-tab-content]')
			contents.forEach(content => content.classList.remove('active'))

			const activeContent = parentContainer.querySelector(`[data-card-tab-content="${id}"]`)
			if (activeContent) activeContent.classList.add('active')
		})
	})
}
