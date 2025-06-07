import { reCalculateDropdownHeight } from "./common/common"

document.addEventListener('DOMContentLoaded', () => {
  initPriceRangeSlider()
})

const initPriceRangeSlider = () => {
  const showRangeButtons = document.querySelectorAll('.filter-show-range')
  
  if (!showRangeButtons.length) return
  
  showRangeButtons.forEach(button => {
    button.addEventListener('click', (e) => {
      e.preventDefault()
      
      const sliderContainer = button.nextElementSibling
      
      if (!sliderContainer || !sliderContainer.classList.contains('price-range-slider-container')) return
      
      sliderContainer.style.display = 'block'
      button.style.display = 'none'
      
      {
        setupRangeSlider(sliderContainer)
        
        const dropdown = button.closest('.filter-dropdown')
        if (dropdown) {
          reCalculateDropdownHeight(dropdown)
        }
      }
    })
  })
}

const setupRangeSlider = (container) => {
  const minSlider = container.querySelector('.price-slider-min')
  const maxSlider = container.querySelector('.price-slider-max')
  const rangeElement = container.querySelector('.price-slider-range')
  const minInput = container.querySelector('.price-input-min')
  const maxInput = container.querySelector('.price-input-max')
  
  if (!minSlider || !maxSlider || !rangeElement || !minInput || !maxInput) return
  
  const minValue = parseInt(minSlider.min)
  const maxValue = parseInt(minSlider.max)
  
  setRangeValues(minSlider, maxSlider, rangeElement)
  
  minSlider.addEventListener('input', () => {
    const minVal = parseInt(minSlider.value)
    const maxVal = parseInt(maxSlider.value)
    
    if (minVal > maxVal) {
      minSlider.value = maxVal
    }
    
    minInput.value = formatPrice(parseInt(minSlider.value))
    
    setRangeValues(minSlider, maxSlider, rangeElement)
  })
  
  maxSlider.addEventListener('input', () => {
    const minVal = parseInt(minSlider.value)
    const maxVal = parseInt(maxSlider.value)
    
    if (maxVal < minVal) {
      maxSlider.value = minVal
    }
    
    maxInput.value = formatPrice(parseInt(maxSlider.value))
    
    setRangeValues(minSlider, maxSlider, rangeElement)
  })
  
  minInput.addEventListener('input', () => {
    const value = parseInt(minInput.value.replace(/\D/g, '')) || minValue
    
    const limitedValue = Math.max(minValue, Math.min(parseInt(maxSlider.value), value))
    
    minSlider.value = limitedValue
    minInput.value = formatPrice(limitedValue)
    
    setRangeValues(minSlider, maxSlider, rangeElement)
  })
  
  maxInput.addEventListener('input', () => {
    const value = parseInt(maxInput.value.replace(/\D/g, '')) || maxValue
    
    const limitedValue = Math.min(maxValue, Math.max(parseInt(minSlider.value), value))
    
    maxSlider.value = limitedValue
    maxInput.value = formatPrice(limitedValue)
    
    setRangeValues(minSlider, maxSlider, rangeElement)
  })
  
  minInput.value = formatPrice(parseInt(minSlider.value))
  maxInput.value = formatPrice(parseInt(maxSlider.value))
}

const setRangeValues = (minSlider, maxSlider, rangeElement) => {
  const minValue = parseInt(minSlider.value)
  const maxValue = parseInt(maxSlider.value)
  const minPos = ((minValue - parseInt(minSlider.min)) / (parseInt(minSlider.max) - parseInt(minSlider.min))) * 100
  const maxPos = ((maxValue - parseInt(minSlider.min)) / (parseInt(minSlider.max) - parseInt(minSlider.min))) * 100
  
  rangeElement.style.left = `${minPos}%`
  rangeElement.style.width = `${maxPos - minPos}%`
}

const formatPrice = (value) => {
  const num = parseInt(value)
  
  if (num >= 1000) {
    const thousands = Math.floor(num / 1000)
    const remainder = num % 1000
    
    let remainderStr = remainder.toString()
    while (remainderStr.length < 3) {
      remainderStr = '0' + remainderStr
    }
    
    return `${thousands}.${remainderStr}`
  }
  
  return num.toString()
}
