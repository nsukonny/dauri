import { WINDOW_WIDTH_MD } from "./global"

document.addEventListener('DOMContentLoaded', () => {
	document.addEventListener('click', e => {
		const target = e.target
		if (target.closest('.col-title') && window.innerWidth < WINDOW_WIDTH_MD) {
			const footerCol = e.target.closest('.footer-col')
			if (footerCol) footerCol.classList.toggle('active')
		}
	})
})