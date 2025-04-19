document.addEventListener('DOMContentLoaded', () => {
	'use strict'

	changeTab()
})

const changeTab = () => {
	const
		tabsButtons = document.querySelectorAll('[data-tab-button]'),
		tabsContents = document.querySelectorAll('[data-tab-content]')

	if (!tabsButtons.length || !tabsContents.length) return

	tabsButtons.forEach(tab => {
		tab.addEventListener('click', () => {
			const id = tab.dataset.id

			if (!id || tab.classList.contains('active')) return

			tabsButtons.forEach(btn => btn.classList.remove('active'))

			tabsContents.forEach(content => content.classList.remove('active'))

			tab.classList.add('active')

			const activeContent = document.querySelector(`[data-tab-content="${id}"]`)
			if (activeContent) activeContent.classList.add('active')
		})
	})
}
