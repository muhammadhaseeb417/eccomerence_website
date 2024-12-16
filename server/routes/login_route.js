const express = require('express');
const loginRouter = express.Router();

const users = [
    { email: 'test@example.com', password: 'password123' }
];

loginRouter.post('/login', (req, res) => {
    const { email, password } = req.body;

    // Check if email and password are correct
    const user = users.find(user => user.email === email && user.password === password);

    if (user) {
        res.json({ status: 'success', message: 'Login successful' });
    } else {
        res.json({ status: 'failed', message: 'Invalid email or password' });
    }
});


module.exports = loginRouter;