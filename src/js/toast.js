// For decoration purposes only
// The code defines a ToastManager class that manages the display of toast notifications on the page.
// The class has a constructor that accepts a container selector for the toast notifications.
// The show method creates a new toast notification with an image, text, and optional link.
// The notification is displayed for a specified duration and automatically removed after that time.
// You can remove it!!!!!!!!!!!!!!!!!!!!!!
export class ToastManager {
	constructor(containerSelector = '#toast-container') {
		this.container = document.querySelector(containerSelector)
		if (!this.container) {
			this.container = document.createElement('div')
			this.container.id = 'toast-container'
			this.container.className = 'toast-container'
			document.body.appendChild(this.container)
		}
	}

	show = ({ image = '', text = '', linkText = '', linkUrl = '', duration = 3000 } = {}) => {
		const toast = document.createElement('div')
		toast.classList.add('toast')
		toast.innerHTML = `
			${image ? `<img src="${image}" alt="" class="toast-image">` : ''}
			<div class="toast-content">
				<p class="toast-text">${text}</p>
				${linkUrl && linkText ? `<a href="${linkUrl}" class="toast-link">${linkText}</a>` : ''}
			</div>
		`
		this.container.appendChild(toast)
		const toasts = this.container.querySelectorAll('.toast')
		if (toasts.length > 3) {
			const oldest = toasts[0]
			oldest.classList.add('hide')
			oldest.addEventListener('transitionend', () => oldest.remove(), { once: true })
			setTimeout(() => {
				if (oldest.parentNode) {
					oldest.remove()
				}
			}, 1100)
		}
		toast.classList.add('hide')
		void toast.offsetWidth
		toast.classList.remove('hide')
		setTimeout(() => {
			toast.classList.add('hide')
			toast.addEventListener('transitionend', () => toast.remove(), { once: true })
			setTimeout(() => {
				if (toast.parentNode) {
					toast.remove()
				}
			}, 1100)
		}, duration)
	}
}
