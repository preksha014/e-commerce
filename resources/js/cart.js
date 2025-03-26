// Function to update cart UI elements
function updateCartUI(response) {
    // Update cart count
    const $cartCount = $('#cart-count');
    if ($cartCount.length) {
        if (response.cart_count > 0) {
            $cartCount.text(response.cart_count).show();
        } else {
            $cartCount.hide();
            const $cartContainer = $('.overflow-x-auto').closest('section');
            $cartContainer.html(
                '<div class="border border-gray-200 bg-white p-6 text-center shadow-sm">' +
                '<p class="text-lg text-gray-500">Your cart is empty.</p>' +
                '</div>'
            );
        }
    }

    // Update item quantity and total if available
    if (response.item) {
        const $row = $(`tr[data-slug="${response.item.slug}"]`);
        if ($row.length) {
            $row.find('.quantity-value').text(response.item.quantity);
            const itemTotal = (response.item.price * response.item.quantity).toFixed(2);
            $row.find('.item-total').text(`$${itemTotal}`);
        }
    }

    // Update cart total if available
    if (response.cart_total !== undefined) {
        if (response.cart_total > 0) {
            $('.cart-total').text(`${response.cart_total.toFixed(2)}₹`);
        } else {
            $('.cart-total').text('0.00₹');
        }
    }

    // Remove the row if item was deleted or quantity is zero
    if (response.deleted || (response.item && response.item.quantity <= 0)) {
        const slug = response.deleted || response.item.slug;
        const $row = $(`tr[data-slug="${slug}"]`);
        $row.fadeOut('fast', function () {
            $(this).remove();
            // Check if cart is empty after removal
            if (response.cart_count === 0) {
                const $cartContainer = $('.overflow-x-auto').closest('section');
                $cartContainer.html(
                    '<div class="border border-gray-200 bg-white p-6 text-center shadow-sm">' +
                    '<p class="text-lg text-gray-500">Your cart is empty.</p>' +
                    '</div>'
                );
            }
        });
    }
}

// Handle add to cart and quantity update button clicks
$(document).ready(function () {
    // Handle quantity update
    $(document).on('click', '.update-cart', function (e) {
        e.preventDefault();
        const $button = $(this);
        const slug = $button.data('slug');
        const action = $button.data('action');

        $.ajax({
            url: `/cart/update/${slug}`,
            type: 'PATCH',
            data: {
                action: action,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.message) {
                    toastr.success(response.message);
                }
                updateCartUI(response);
            },
            error: function (xhr) {
                const errorMessage = xhr.responseJSON?.message || 'Failed to update quantity.';
                toastr.error(errorMessage);
            }
        });
    });

    // Handle add to cart button clicks
    $(document).on('click', '.add-to-cart', function (e) {
        e.preventDefault();
        const slug = $(this).data('slug');
        const quantity = 1; // Default quantity

        $.ajax({
            url: `/cart/add/${slug}`,
            type: 'POST',
            data: {
                slug: slug,
                quantity: quantity,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (response) {
                if (response.message) {
                    toastr.success(response.message);
                }
                updateCartUI(response);
            },
            error: function (xhr) {
                const errorMessage = xhr.responseJSON?.message || 'Failed to add item to cart.';
                toastr.error(errorMessage);
                console.error('Error:', xhr);
            }
        });
    });

    // Handle delete from cart
    $(document).on('click', '.remove-from-cart', function (e) {
        e.preventDefault();
        const $button = $(this);
        const slug = $button.data('slug');

        $.ajax({
            url: `/cart/remove/${slug}`,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.message) {
                    toastr.success(response.message);
                }
                response.deleted = slug;
                updateCartUI(response);

                // Update cart total
                if (response.cart_total !== undefined) {
                    $('.cart-total').text(`$${response.cart_total.toFixed(2)}`);
                }
            },
            error: function (xhr) {
                const errorMessage = xhr.responseJSON?.message || 'Failed to remove item from cart.';
                toastr.error(errorMessage);
            }
        });
    });
});