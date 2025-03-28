function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function performSearch(query) {
    const $results = $('#search-results');
    if (!query || !query.trim()) {
        $results.html('').hide();
        return;
    }

    $.ajax({
        url: '/api/search',
        method: 'GET',
        data: { query: query },
        dataType: 'json',
        beforeSend: function () {
            $results.html('<div class="p-4 text-center text-gray-500">Loading...</div>').show();
        },
        success: function (response) {
            console.log('Search Response:', response);
            if (response.html) {
                $results.html(response.html).show();
            } else {
                $results.html('<div class="p-4 text-center text-gray-500">No results found</div>').show();
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', xhr.status, xhr.responseText);
            $results.html(`<div class="p-4 text-center text-red-500">Error ${xhr.status}: ${error}</div>`).show();
        }
    });
}

$(document).ready(function () {
    const $searchForm = $('#search-form');
    const $searchInput = $('#search-input');
    const $searchResults = $('#search-results');

    if (!$searchForm.length || !$searchInput.length || !$searchResults.length) {
        console.error('Form elements not found');
        return;
    }

    const debouncedSearch = debounce(performSearch, 300);

    $searchForm.on('submit', function (e) {
        e.preventDefault();
    });

    $searchInput.on('input', function () {
        const query = $(this).val();
        debouncedSearch(query);
    }).on('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const query = $(this).val().trim();
            if (query) {
                window.location.href = '/catalog?query=' + encodeURIComponent(query);
            }
        }
    });

    $(document).on('click', function (event) {
        if (!$(event.target).closest('#search-form').length && !$(event.target).closest('#search-results').length) {
            $searchResults.hide();
        }
    });
});