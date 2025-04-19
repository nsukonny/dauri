document.addEventListener('DOMContentLoaded', () => {
	'use strict'

	trackButtonScroll()
})

const trackButtonScroll = () => {
	const watchButton = document.querySelector('[data-watch-button]')
	const floatingButton = document.querySelector('[data-floating-link]')
	const footer = document.querySelector('footer')

	if (!watchButton || !floatingButton || !footer) return

	const onScroll = () => {
		const watchRect = watchButton.getBoundingClientRect()
		const footerRect = footer.getBoundingClientRect()

		const isWatchOutOfView = watchRect.bottom < 0
		const isFooterVisible = footerRect.top < window.innerHeight

		if (isWatchOutOfView && !isFooterVisible) {
			floatingButton.classList.add('scrolling')
		} else {
			floatingButton.classList.remove('scrolling')
		}
	}

	window.addEventListener('scroll', onScroll)
	window.addEventListener('resize', onScroll)
	onScroll()
}