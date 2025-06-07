import {reCalculateDropdownHeight} from "./common/common"

document.addEventListener('DOMContentLoaded', () => {
  initBrandFilter()
})

const initBrandFilter = () => {
  const showMoreButtons = document.querySelectorAll('.filter-dropdown .filter-show-more')
  
  if (!showMoreButtons.length) return
  
  showMoreButtons.forEach(button => {
    const hiddenOptions = button.nextElementSibling
    
    if (!hiddenOptions || !hiddenOptions.classList.contains('dropdown-options-hidden')) return
    
    const hiddenBrands = hiddenOptions.querySelectorAll('.checkbox-input')
    
    if (!hiddenBrands.length) {
      button.style.display = 'none'
      return
    }
    
    const brandGroups = []
    let currentGroup = []
    
    hiddenBrands.forEach((brand, index) => {
      currentGroup.push(brand)
      
      if (currentGroup.length === 6 || index === hiddenBrands.length - 1) {
        brandGroups.push([...currentGroup])
        currentGroup = []
      }
    })
    
    let currentGroupIndex = 0
    
    button.addEventListener('click', (e) => {
      e.preventDefault()
      
      if (currentGroupIndex < brandGroups.length) {
        const brandsToShow = brandGroups[currentGroupIndex]
        
        brandsToShow.forEach(brand => {
          button.parentNode.insertBefore(brand, button)
        })
        
        currentGroupIndex++
        
        if (currentGroupIndex >= brandGroups.length) {
          button.style.display = 'none'
        }
        
        const dropdown = button.closest('.filter-dropdown')
        if (dropdown) {
          if (typeof reCalculateDropdownHeight === 'function') {
            reCalculateDropdownHeight(dropdown)
          }
        }
      }
    })
  })
}