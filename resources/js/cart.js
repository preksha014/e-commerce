// Cart functionality and toast notifications

document.addEventListener('DOMContentLoaded', function() {
    // Add to cart functionality
    const addToCartForms = document.querySelectorAll('.add-to-cart-form');
    addToCartForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const productId = this.getAttribute('data-product-id');

            fetch(`/cart/add/${productId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.toast) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: data.toast.icon,
                        title: data.toast.title,
                        text: data.toast.text,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
                // Update cart count in the navbar
                updateCartCount(data.cart_total);
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong',
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        });
    });

    // Remove from cart functionality
    const removeFromCartButtons = document.querySelectorAll('.remove-from-cart');
    removeFromCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');

            fetch(`/cart/remove/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.toast) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: data.toast.icon,
                        title: data.toast.title,
                        text: data.toast.text,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
                // Remove the item from the DOM
                const cartItem = this.closest('.cart-item');
                if (cartItem) {
                    cartItem.remove();
                }
                // Update cart count and total
                updateCartCount(data.cart_total);
                updateCartTotal(data.cart_total);
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong',
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        });
    });

    // Helper functions
    function updateCartCount(count) {
        const cartCountElement = document.querySelector('.cart-count');
        if (cartCountElement) {
            cartCountElement.textContent = count;
        }
    }

    function updateCartTotal(total) {
        const cartTotalElement = document.querySelector('.cart-total');
        if (cartTotalElement) {
            cartTotalElement.textContent = `$${total.toFixed(2)}`;
        }
    }
}));