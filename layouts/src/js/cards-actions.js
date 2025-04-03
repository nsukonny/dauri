import { ToastManager } from "./toast"
import { fakeApiUrl } from "./common/global"

const toastManager = new ToastManager()

document.addEventListener('DOMContentLoaded', () => {
	'use strict'
	addToFavorite()
})

const addToFavorite = () => {
	const buttons = document.querySelectorAll('.add-to-fav')
	const getData = async () => {
		const response = await fetch(fakeApiUrl)
		const data = await response.json()
		return data
	}
	if (!buttons.length) return
	buttons.forEach(button => {
		button.addEventListener('click', () => {
			if (!button) return
			getData()
				.then(data => {
					if (!button.classList.contains('added')) {
						button.classList.add('added')
						toastManager.show({
							image: '/dauri/assets/img/heart.svg',
							text: 'ДОБАВЛЕНО В ИЗБРАННОЕ!',
							linkText: 'Посмотреть',
							linkUrl: '#',
							duration: 2000
						})
					} else {
						button.classList.remove('added')
						toastManager.show({
							image: '/dauri/assets/img/heart.svg',
							text: 'Вы убрали изделие из избранного.',
							linkText: 'Вернуть обратно',
							linkUrl: '#',
							duration: 6000
						})
					}
				})
				.catch(error => {
					console.error('Ошибка запроса:', error)
				})
		})
	})
}
