document.addEventListener('DOMContentLoaded', () => {
    'use strict'

    initLoadMore();
})

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
                loadProducts();
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
    alert('Load next products');
    let resultsResult = document.querySelector('.catalog-result-items');

    if (!resultsResult) {
        return;
    }
}