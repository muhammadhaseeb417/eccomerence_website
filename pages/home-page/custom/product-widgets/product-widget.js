class ProductCard extends HTMLElement {
    constructor() {
        super();

        const shadow = this.attachShadow({ mode: 'open' });

        // Attributes for the product card
        const productName = this.getAttribute('product-name') || 'Default Product Name';
        const productPrice = this.getAttribute('product-price') || '$0';
        const productImg = this.getAttribute('product-img') || '/assets/img/default.png';
        const productRating = this.getAttribute('product-rating') || '0'; // Default to '0' if not provided

        const wrapper = document.createElement('div');
        wrapper.innerHTML = `
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Montserrat', sans-serif;
            }

            .product-card {
    background-color: #121212;
    color: #ff9800;
    padding: 20px;
    border-radius: 15px;
    border: 2px solid #ff9800;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    width: 250px; /* Set a fixed width for consistency */
    transition: transform 0.3s, box-shadow 0.3s;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 0; /* Remove margin */
}


            .product-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 8px 15px #ff9800;
            }

            .product-img {
                width: 100%;
                height: auto;
                border-radius: 10px;
                margin-bottom: 15px;
                transition: transform 0.3s;
            }

            .product-card:hover .product-img {
                transform: scale(1.05);
            }

            .product-name {
                font-size: 20px;
                font-weight: bold;
                color: white;
                text-align: center;
                margin-bottom: 10px;
            }

            .stars {
                display: flex;
                gap: 5px;
                color: #ff9800;
                margin-bottom: 10px;
            }

            .product-price {
                font-size: 24px;
                font-weight: bold;
                color: white;
                margin-bottom: 15px;
            }

            .add-to-cart {
                background-color: #ff9800;
                color: #121212;
                padding: 10px 15px;
                border-radius: 5px;
                font-weight: bold;
                text-transform: uppercase;
                cursor: pointer;
                transition: background-color 0.3s;
                border: none;
            }

            .add-to-cart:hover {
                background-color: #e68a00;
            }

            /* Media queries for responsiveness */
            @media only screen and (max-width: 600px) {
                .product-card {
                    max-width: 200px;
                }
                .product-name {
                    font-size: 16px;
                }
                .product-price {
                    font-size: 20px;
                }
                .add-to-cart {
                    font-size: 14px;
                }
            }
        </style>

        <div class="product-card">
            <img src="${productImg}" alt="${productName}" class="product-img">
            <p class="product-name">${productName}</p>
            <div class="stars">${this.createStarsHTML(productRating)}</div>
            <p class="product-price">${productPrice}</p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
        `;

        shadow.appendChild(wrapper);
    }

    // Helper method to create star rating HTML
    createStarsHTML(rating) {
        const roundedRating = Math.min(Math.max(Math.floor(Number(rating)), 0), 5); // Clamp between 0 and 5
        let starsHTML = '';

        for (let i = 0; i < 5; i++) {
            starsHTML += i < roundedRating ? '⭐' : '☆';
        }

        return starsHTML;
    }
}

// Define the custom element
customElements.define('product-card', ProductCard);
