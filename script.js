// Wait for DOM to load
document.addEventListener('DOMContentLoaded', () => {
    // ----- ACTIVE NAV LINK -----
    const currentPath = window.location.pathname.split('/').pop() || 'index.html';
    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
        link.classList.toggle('active', link.getAttribute('href') === currentPath);
    });

    // ----- LOGIN FORM HANDLER -----
    const loginForm = document.querySelector('#loginModal form');
    loginForm.addEventListener('submit', e => {
        e.preventDefault();
        const username = document.querySelector('#username').value;
        const password = document.querySelector('#password').value;
        console.log('Login attempt:', { username, password });

        // Here you can add your real authentication
        alert(`Logged in as: ${username}`);
        bootstrap.Modal.getInstance(document.querySelector('#loginModal')).hide();
        loginForm.reset();
    });

    // ----- CART FUNCTIONALITY -----
    const cartCounter = document.getElementById('cartCounter');

    // Get cart from localStorage or initialize empty
    let cart = JSON.parse(localStorage.getItem('cart') || '[]');
    updateCartCounter();

    // Update cart counter
    function updateCartCounter() {
        cartCounter.textContent = cart.length;
    }

    // Show cart items in modal
    const cartModal = document.getElementById('cartModal');
    cartModal.addEventListener('show.bs.modal', () => {
        const modalBody = cartModal.querySelector('.modal-body');
        if (cart.length) {
            modalBody.innerHTML = cart.map((item, index) => `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>${item.name} - $${item.price}</span>
                    <button class="btn btn-sm btn-danger remove-item" data-index="${index}">Remove</button>
                </div>
            `).join('');
        } else {
            modalBody.innerHTML = '<p>Your cart is empty.</p>';
        }

        // Remove item buttons
        modalBody.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', () => {
                const index = parseInt(btn.dataset.index);
                cart.splice(index, 1);
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartCounter();
                btn.parentElement.remove();
            });
        });
    });

    // ----- ADD TO CART BUTTONS -----
    document.querySelectorAll('.one .btn').forEach(button => {
        button.addEventListener('click', e => {
            const productDiv = e.target.closest('.one');
            const name = productDiv.querySelector('h2').textContent;
            const price = Math.floor(Math.random() * 100) + 50; // Random price example
            const item = { name, price };
            cart.push(item);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCounter();
            alert(`${name} added to cart!`);
        });
    });

    // ----- OPTIONAL: SHOP NOW BUTTON ALERT -----
    document.querySelectorAll('#home .btn-dark').forEach(btn => {
        btn.addEventListener('click', () => alert('Redirecting to Shop Page...'));
    });
});