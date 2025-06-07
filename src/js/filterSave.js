document.addEventListener('DOMContentLoaded', () => {
  initFilterSave()
})

const initFilterSave = () => {
  const filterModal = document.getElementById('filter-modal')
  if (!filterModal) return
  
  const saveButton = filterModal.querySelector('.save-filters')
  const saveButtonText = filterModal.querySelector('.save-filters span')
  const clearButton = filterModal.querySelector('.clear')
  if (!saveButton || !clearButton) return

  const filterInputs = filterModal.querySelectorAll('input[type="checkbox"], input[type="radio"]')
  
  const defaultCheckedInputs = new Map()
  filterInputs.forEach(input => {
    defaultCheckedInputs.set(input.id, input.checked)
  })
  
  const updateFilterState = () => {
    let filtersChanged = false
    const activeFilters = {}
    
    filterInputs.forEach(input => {
      if (defaultCheckedInputs.get(input.id) !== input.checked) {
        filtersChanged = true
      }
      
      if (input.checked) {
        const filterType = input.type === 'radio' ? input.name : input.id
        activeFilters[filterType] = input.id
      }
    })
    
    if (filtersChanged) {
      saveButton.classList.add('save')
      saveButtonText.textContent = 'СОХРАНИТЬ ФИЛЬТРАЦИЮ'
    } else {
      saveButton.classList.remove('save')
      saveButtonText.textContent = ''
    }
    
    updateUrlWithFilters(activeFilters)
  }
  
  const updateUrlWithFilters = (filters) => {
    const url = new URL(window.location.href)
    
    for (const key of url.searchParams.keys()) {
      if (key.startsWith('filter_')) {
        url.searchParams.delete(key)
      }
    }
    
    for (const [key, value] of Object.entries(filters)) {
      url.searchParams.set(`filter_${key}`, value)
    }
    
    window.history.replaceState({}, '', url.toString())
  }
  
  const applyFiltersFromUrl = () => {
    const url = new URL(window.location.href)
    const filterParams = {}
    
    filterInputs.forEach(input => {
      input.checked = defaultCheckedInputs.get(input.id) || false
    })
    
    for (const [key, value] of url.searchParams.entries()) {
      if (key.startsWith('filter_')) {
        const filterName = key.replace('filter_', '')
        filterParams[filterName] = value
      }
    }
    
    filterInputs.forEach(input => {
      if (input.type === 'radio') {
        if (filterParams[input.name] === input.id) {
          input.checked = true
        }
      } 
      else if (input.type === 'checkbox') {
        if (filterParams[input.id] === input.id) {
          input.checked = true
        }
      }
    })
  }
  
  const resetFilters = () => {
    filterInputs.forEach(input => {
      const wasChecked = input.checked
      
      const shouldBeChecked = defaultCheckedInputs.get(input.id)
      
      if (wasChecked !== shouldBeChecked) {
        input.checked = shouldBeChecked
        
        const event = new Event('change', { bubbles: true })
        input.dispatchEvent(event)
      } else {
        input.checked = shouldBeChecked
      }
    })
    
    const url = new URL(window.location.href)
    for (const key of url.searchParams.keys()) {
      if (key.startsWith('filter_')) {
        url.searchParams.delete(key)
      }
    }
    window.history.replaceState({}, '', url.toString())
    
    saveButton.classList.remove('save')
    saveButtonText.textContent = ''
  }
  
  filterInputs.forEach(input => {
    input.addEventListener('change', updateFilterState)
  })
  
  clearButton.addEventListener('click', (e) => {
    e.preventDefault()
    resetFilters()
  })
  
  saveButton.addEventListener('click', (e) => {
    e.preventDefault()
    
    updateFilterState()
  })
  applyFiltersFromUrl()
  
  let filtersChanged = false
  filterInputs.forEach(input => {
    if (defaultCheckedInputs.get(input.id) !== input.checked) {
      filtersChanged = true
    }
  })
  
  if (filtersChanged) {
    saveButton.classList.add('save')
    saveButtonText.textContent = 'СОХРАНИТЬ ФИЛЬТРАЦИЮ'
  } else {
    saveButtonText.textContent = ''
  }
}