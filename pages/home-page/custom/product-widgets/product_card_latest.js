// product-card-latest.js
class ProductCardLatest extends HTMLElement {
    constructor() {
        super();

        const shadow = this.attachShadow({ mode: 'open' });

        // Create the card structure with default values that can be overridden
        const productName = this.getAttribute('product-name') || 'Default Product Name';
        const productPrice = this.getAttribute('product-price') || '0$';
        const productImg = this.getAttribute('product-img') || '/assets/img/default.png';
        const productRating = this.getAttribute('product-rating') || '0';
        const stars = this.createStars(productRating);

        const wrapper = document.createElement('div');
        wrapper.innerHTML = `
        <style>

        * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Montserrat', sans-serif;
            }

          .product__card_latest {
              height: 200px;
              width: 250px;
              margin: 0;
              margin-bottom: 20px;
              background-color: #121212;
              display: flex;
              flex-direction: column;
              padding: 10px;
              color: #ff9800;
                border: 2px solid #ff9800;
                transition: transform 0.3s, box-shadow 0.3s;
                cursor: pointer;
              border-radius: 10px;
          }

          .product__card_latest:hover {
                transform: translateY(-10px);
                box-shadow: 0 8px 15px #ff9800;
            }
  
          .align_item_latest {
              display: flex;
              width: 100%;
              justify-content: space-between;
              align-items: center;
          }
  
          .product__name_latest {
              font-size: 20px;
              font-weight: 700;
              color: white;
          }
  
          .img_div {
              width: 100%;
              display: flex;
              justify-content: center;
              align-items: center;
          }
  
          .rating {
              display: flex;
              align-items: center;
              gap: 10px;
          }
  
          .stars__rating {
              display: flex;
              list-style-type: none;
              padding: 0;
              margin: 0;
              font-size: 20px;
          }
  
          .cart_icon {
              font-size: 35px;
          }

          
        </style>
  
        <div class="product__card_latest">
          <div class="top_card_style">
              <div class="img_div">
                  <img src="${productImg}" alt="img" height="100px">
              </div>
  
              <div class="align_item_latest">
                  <div class="productName__Rating">
                      <p class="product__name_latest">${productName}</p>
                      <div class="rating">
                          <ul class="stars__rating">
                              ${stars}
                          </ul>
                          <p>${productRating}</p>
                      </div>
                  </div>
  
                  <span class="cart_icon">🛒</span>
              </div>
          </div>
        </div>
      `;

        shadow.appendChild(wrapper);
    }

    // Helper function to create star rating
    createStars(rating) {
        const fullStar = `⭐`;
        const halfStar = `<span class="half-Star">☆</span>`;
        const emptyStar = `<span class="empty-star">☆</span>`; // Emoji for empty star

        let starHTML = '';
        let roundedRating = Math.floor(rating);
        for (let i = 0; i < 5; i++) {
            if (i < roundedRating) {
                starHTML += fullStar;
            } else if (i === roundedRating && rating % 1 !== 0) {
                starHTML += halfStar;
            } else {
                starHTML += emptyStar;
            }
        }
        return starHTML;
    }
}

// Define the custom element
customElements.define('product-card-latest', ProductCardLatest);
