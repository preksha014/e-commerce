// Initialize Toastr
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

// Function to update wishlist icon state
function updateWishlistIcon(count) {
    const wishlistIcon = $('.wishlist-icon');
    if (count > 0) {
        wishlistIcon.attr('fill', '#ef4444').attr('stroke', '#ef4444');
    } else {
        wishlistIcon.attr('fill', 'none').attr('stroke', 'currentColor');
    }
}

// Function to check wishlist status and update UI
function checkWishlistStatus() {
    $.ajax({
        url: '/wishlist/check-status',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            updateWishlistIcon(response.count);
        },
        error: function(xhr, status, error) {
            console.error('Error checking wishlist status:', error);
        }
    });
}

$(document).ready(function() {
    // Check wishlist status on page load
    checkWishlistStatus();

    // Add to wishlist
    $(document).on('submit', '.add-to-wishlist-form', function(e) {
        e.preventDefault();
        const form = $(this);
        const productId = form.find('input[name="product_id"]').val() || form.data('product-id');

        $.ajax({
            url: '/wishlist',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                product_id: productId
            },
            success: function(response) {
                if (response.success) {
                    updateWishlistIcon(1);
                    toastr.success(response.message);
                    checkWishlistStatus();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Error adding to wishlist');
                console.error('Error:', error);
            }
        });
    });

    // Delete wishlist item
    $(document).on('click', '.delete-wishlist-item', function() {
        const productId = $(this).data('product-id');
        const row = $(this).closest('tr');
    
        $.ajax({
            url: `/wishlist/${productId}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    row.fadeOut(300, function() {
                        $(this).remove();
                        // Check wishlist status after removal
                        $.ajax({
                            url: '/wishlist/check-status',
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                updateWishlistIcon(response.count);
                                if (response.count === 0 && window.location.pathname === '/wishlist') {
                                    console.log('function called');
                                    showEmptyWishlistMessage();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error checking wishlist status:', error);
                            }
                        });
                    });
                }
            },
            error: function() {
                toastr.error('Error removing item from wishlist');
            }
        });
    });

    // Clear wishlist
    $('#clear-wishlist').on('click', function() {
        $.ajax({
            url: '/wishlist/clear',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    updateWishlistIcon(0); // Count is definitely 0
                    if (window.location.pathname === '/wishlist') {
                        showEmptyWishlistMessage();
                    }
                }
            },
            error: function() {
                toastr.error('Error clearing wishlist');
            }
        });
    });

    // Function to show empty wishlist message
    function showEmptyWishlistMessage() {
        console.log('sejdksd');
        const tbody = $('tbody');
        if (tbody.length && !tbody.find('.empty-wishlist-message').length) { // Prevent duplicate
            tbody.fadeOut(300, function() {
                $(this).html(`
                    <tr class="empty-wishlist-message">
                        <td colspan="4" class="px-8 py-6 text-center">
                            <p class="text-lg text-gray-500">Your wishlist is empty.</p>
                        </td>
                    </tr>
                `).fadeIn(300);
            });
        }
    }
});

// Function for onclick button (if still needed)
function addToWishlist(productId) {
    $.ajax({
        url: '/wishlist',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            product_id: productId
        },
        success: function(response) {
            if (response.success) {
                updateWishlistIcon(1); // Assume at least 1 item
                toastr.success(response.message);
                checkWishlistStatus(); // Refresh count
            } else {
                toastr.error(response.message);
            }
        },
        error: function(xhr, status, error) {
            toastr.error('Error adding to wishlist');
            console.error('Error:', error);
        }
    });
}