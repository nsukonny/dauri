document.addEventListener('DOMContentLoaded', () => {
    'use strict'

    initLoadMore();
});

let nextPage = 1;

const initLoadMore = () => {
    let catalogResultWrapper = document.querySelector('.catalog-result-wrapper');

    if (!catalogResultWrapper) {
        return;
    }

    let sentinel = document.createElement('div');
    sentinel.className = 'catalog-load-sentinel';
    catalogResultWrapper.appendChild(sentinel);

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    loadProducts();
                }, 300);
            }
        });
    }, {
        root: null,
        rootMargin: '0px',
        threshold: 1.0
    });

    observer.observe(sentinel);
}

const loadProducts = () => {
    let resultsResult = document.querySelector('.catalog-result-items');

    if (!resultsResult) {
        return;
    }

    let formData = new FormData(),
        sentinel = document.querySelector('.catalog-load-sentinel');

    sentinel.classList.add('catalog-load-sentinel_preloader');

    formData.append('action', 'dauri_load_more');
    nextPage++;
    formData.append('page', nextPage);

    fetch(ajax_object.ajax_url, {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json'
        }
    })
        .then(response => response.json())
        .then(response => {
            if (response.success && !response.data.is_end) {
                resultsResult.insertAdjacentHTML('beforeend', response.data.html);
            }

            sentinel.classList.remove('catalog-load-sentinel_preloader');

            if (response.data.is_end) {
                if (sentinel) {
                    sentinel.remove();
                }
            }
        })
        .catch(error => {
            console.log(error);
        });

    return false;

}