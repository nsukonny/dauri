import { reCalculateDropdownHeight } from "./common/common"


document.addEventListener('DOMContentLoaded', () => {
	'use strict'

	toggleDropdown('.dropdown', '.dropdown-button')
})

const toggleDropdown = (selector, button) => {
	const dropdowns = document.querySelectorAll(selector)

	if (!dropdowns.length) return

	dropdowns.forEach(dropdown => {
		const dropdownButton = dropdown.querySelector(button)

		if (dropdown.classList.contains('opened'))
			reCalculateDropdownHeight(dropdown)

		dropdownButton.addEventListener('click', () => {
			const dropdownOpen = dropdown.querySelector('.dropdown-open')
			const showMoreText = dropdown.querySelector('.show-more-text')

			if (!dropdownOpen) return

			if (!dropdown.classList.contains('opened')) {
				dropdown.classList.add('opened')

				if (showMoreText) {
					showMoreText.textContent = "Скрыть"
				}

				reCalculateDropdownHeight(dropdown)
			} else {
				dropdown.classList.remove('opened')
				if (showMoreText) {
					showMoreText.textContent = "Показать еще"
				}
				dropdownOpen.style.height = '0'
			}
		})
	})
}

window.addEventListener('resize', () => {
	const dropdowns = document.querySelectorAll('.dropdown.opened')

	if (!dropdowns.length) return

	dropdowns.forEach(dropdown => reCalculateDropdownHeight(dropdown))
})