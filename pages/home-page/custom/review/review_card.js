// customer-review-card.js
class CustomerReviewCard extends HTMLElement {
    constructor() {
        super();

        const shadow = this.attachShadow({ mode: 'open' });

        // Attributes for the customer review card
        const customerName = this.getAttribute('customer-name') || 'Anonymous';
        const customerRating = this.getAttribute('customer-rating') || '0';
        const reviewDate = this.getAttribute('review-date') || 'N/A';
        const reviewText = this.getAttribute('review-text') || 'No review provided.';
        const reviewCount = this.getAttribute('review-count') || '0';
        const verified = this.hasAttribute('verified') ? 'Verified Customer' : '';

        const stars = this.createStars(customerRating);

        // Set character and word limits
        const maxNameLength = 10;
        const maxWords = 10;

        const truncatedName = customerName.length > maxNameLength
            ? customerName.slice(0, maxNameLength) + '...'
            : customerName;

        const truncatedReview = this.truncateText(reviewText, maxWords);

        const wrapper = document.createElement('div');
        wrapper.innerHTML = `
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Montserrat', sans-serif;
            }

            .review-card {
                background-color: #121212;
                color: #ff9800;
                padding: 20px;
                border-radius: 15px;
                border: 2px solid #ff9800;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                max-width: 380px;
                overflow: hidden;
                transition: transform 0.3s, box-shadow 0.3s;
                margin: 20px;
                cursor: pointer;
                height: 300px;
                width:300px;
            }

            .review-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 8px 15px #ff9800;
            }

            .review-header {
                display: flex;
                align-items: center;
                margin-bottom: 15px;
            }

            .avatar {
                width: 50px;
                height: 50px;
                background-color: #ff9800;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #121212;
                font-size: 20px;
                font-weight: bold;
                margin-right: 15px;
            }

            .review-info {
                display: flex;
                flex-direction: column;
            }

            .customer-name {
                font-size: 20px;
                font-weight: bold;
                color: white;
            }

            .review-count {
                font-size: 14px;
                color: #bbbbbb;
            }

            .stars {
                display: flex;
                gap: 5px;
                margin-top: 5px;
                color: #ff9800;
            }

            .review-body {
                font-size: 16px;
                color: #e0e0e0;
                margin-top: 15px;
                line-height: 1.5;
                white-space: normal;
                word-wrap: break-word;
                overflow-wrap: break-word;
            }

            .review-text {
                display: block;
                max-height: none;
                overflow: hidden;
            }


            .read-more {
                color: #ff9800;
                cursor: pointer;
                text-decoration: underline;
                display: inline-block;
                margin-top: 10px;
            }

            .review-date {
                font-size: 12px;
                color: #aaaaaa;
                margin-top: 10px;
                text-align: right;
            }

            .verified {
                display: inline-block;
                background-color: #ff9800;
                color: #121212;
                padding: 5px 10px;
                border-radius: 5px;
                font-weight: bold;
                margin-bottom: 10px;
            }

            /* Media queries for responsiveness */
            @media only screen and (max-width: 600px) {
                .review-card {
                    max-width: 100%;
                    padding: 15px;
                }
                .customer-name {
                    font-size: 18px;
                }
                .review-body {
                    font-size: 14px;
                }
                .avatar {
                    width: 40px;
                    height: 40px;
                    font-size: 18px;
                }
            }
        </style>

        <div class="review-card">
            <div class="review-header">
                <div class="avatar">${customerName.charAt(0)}</div>
                <div class="review-info">
                    <span class="customer-name">${truncatedName}</span>
                    <span class="review-count">${reviewCount} reviews</span>
                    <div class="stars">${stars}</div>
                </div>
            </div>
            <div class="review-body">
                ${verified ? `<span class="verified">${verified}</span>` : ''}
                <p class="review-text">${truncatedReview}</p>
                ${reviewText.split(' ').length > maxWords ? `<span class="read-more">Read More</span>` : ''}
                <span class="review-date">${reviewDate}</span>
            </div>
        </div>
        `;

        shadow.appendChild(wrapper);

        // Add functionality for the "Read More" link
        const readMoreLink = wrapper.querySelector('.read-more');
        const reviewTextElement = wrapper.querySelector('.review-text');
        if (readMoreLink) {
            readMoreLink.addEventListener('click', () => {
                reviewTextElement.textContent = reviewText;
                readMoreLink.style.display = 'none';
            });
        }
    }

    // Helper function to create star rating
    createStars(rating) {
        const fullStar = `⭐`;
        const emptyStar = `☆`;

        let starHTML = '';
        let roundedRating = Math.floor(rating);
        for (let i = 0; i < 5; i++) {
            if (i < roundedRating) {
                starHTML += fullStar;
            } else {
                starHTML += emptyStar;
            }
        }
        return starHTML;
    }

    // Helper function to truncate text to a certain word limit
    truncateText(text, wordLimit) {
        const words = text.split(' ');
        if (words.length > wordLimit) {
            return words.slice(0, wordLimit).join(' ') + '...';
        }
        return text;
    }
}

// Define the custom element
customElements.define('customer-review-card', CustomerReviewCard);
