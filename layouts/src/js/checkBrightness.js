import { WINDOW_WIDTH } from "./common/global"

document.addEventListener('DOMContentLoaded', () => {
	'use strict'

	const {LG} = WINDOW_WIDTH

	const removeLightClasses = () => {
		document.querySelectorAll('.light-text').forEach(el => el.classList.remove('light-text'))
	}

	if (window.innerWidth < LG) {
		const slides = document.querySelectorAll('.hero .swiper-slide')

		slides.forEach(slide => {
			const img = slide.querySelector('.swiper-slide-img img')
			const textBox = slide.querySelector('.swiper-slide-info')
			if (!img || !textBox) return

			const processImage = () => {
				checkImageBrightness(img, (isDark) => {
					if (isDark) {
						textBox.classList.add('light-text')
					} else {
						textBox.classList.remove('light-text')
					}
				})
			}

			if (img.complete) {
				processImage()
			} else {
				img.addEventListener('load', processImage)
			}
		})
	} else {
		removeLightClasses()
	}

	window.addEventListener('resize', () => {
		if (window.innerWidth < LG) {
		} else {
			removeLightClasses()
		}
	})
})

export const checkImageBrightness = (img, callback) => {
	const threshold = 190
	const canvas = document.createElement('canvas')
	const ctx = canvas.getContext('2d')

	canvas.width = img.naturalWidth
	canvas.height = img.naturalHeight

	ctx.drawImage(img, 0, 0)

	const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height)
	const data = imageData.data

	let totalBrightness = 0
	let count = 0

	for (let i = 0; i < data.length; i += 4) {
		const r = data[i]
		const g = data[i + 1]
		const b = data[i + 2]
		const brightness = 0.299 * r + 0.587 * g + 0.114 * b
		totalBrightness += brightness
		count++
	}

	const avgBrightness = totalBrightness / count
	callback(avgBrightness < threshold, avgBrightness)
}