const express = require('express');
const reviewRouter = express.Router();


const users = [
    { email: 'test@example.com', password: 'password123' }
];

// Temporary in-memory data storage for reviews
let reviews = [
    {
        "id": 1,
        "name": "Miranda W.",
        "rating": 4.5,
        "reviewCount": 3,
        "reviewDate": "2 months ago",
        "reviewText": "I recently needed some help setting up my online account, and the support I received was thorough and efficient.",
        "verified": true
    },
    {
        "id": 2,
        "name": "John D.",
        "rating": 4.8,
        "reviewCount": 5,
        "reviewDate": "1 week ago",
        "reviewText": "Great customer service! I had an issue with my order, and they resolved it quickly. Highly recommend!",
        "verified": true
    },
    {
        "id": 3,
        "name": "Emily R.",
        "rating": 4.2,
        "reviewCount": 12,
        "reviewDate": "1 month ago",
        "reviewText": "Overall, a pleasant experience. The product was delivered on time, but the packaging could have been better.",
        "verified": true
    },
    {
        "id": 4,
        "name": "Michael T.",
        "rating": 5.0,
        "reviewCount": 8,
        "reviewDate": "3 weeks ago",
        "reviewText": "I am extremely satisfied with the service. The support team was friendly and helped me through the whole process!",
        "verified": true
    },
    {
        "id": 5,
        "name": "Sophia P.",
        "rating": 3.9,
        "reviewCount": 2,
        "reviewDate": "2 months ago",
        "reviewText": "I loved the product, but the customer support response time could be improved. Overall, a decent experience.",
        "verified": true
    },
    {
        "id": 6,
        "name": "David K.",
        "rating": 4.5,
        "reviewCount": 6,
        "reviewDate": "5 days ago",
        "reviewText": "The process was smooth, and the team was very helpful in answering my questions. Will use their service again.",
        "verified": true
    }
];

// Route to get all reviews
reviewRouter.get('/review', (req, res) => {
    res.json(reviews);
});

// Route to add a new review
reviewRouter.post('/review', (req, res) => {
    console.log(req.body)
    const { name, rating, reviewDate, reviewText, reviewCount, verified } = req.body;

    // Generate a new review ID
    const newReview = {
        id: reviews.length + 1,
        name,
        rating,
        reviewDate,
        reviewText,
        reviewCount: 5,
        verified: verified || false
    };

    // Add the new review to the array
    reviews.push(newReview);
    res.status(201).json({ message: 'Review added successfully!', review: newReview });
});

module.exports = reviewRouter;
