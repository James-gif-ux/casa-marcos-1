const express = require('express');
const nodemailer = require('nodemailer');
const crypto = require('crypto');
const bodyParser = require('body-parser');
const cors = require('cors');
require('dotenv').config();  // For loading environment variables

const app = express();

// Mock database for storing bookings
const bookings = [];

app.use(cors());  // This allows cross-origin requests
app.use(bodyParser.json());

// Set up Nodemailer transporter using environment variables
const transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
        user: process.env.EMAIL_USER,  // Use email from .env
        pass: process.env.EMAIL_PASS   // Use password from .env
    }
});

// POST request to confirm booking and send verification email
app.post('/api/confirm-booking', (req, res) => {
    const userEmail = req.body.email || 'espielreo635@gmail.com';  // Default email for testing
    
    // Generate a unique verification token
    const token = crypto.randomBytes(20).toString('hex');
    
    // Save booking with token (you would actually save it in a real database)
    const booking = { email: userEmail, token: token };
    bookings.push(booking);
    
    // Send verification email
    const verificationUrl = `http://localhost:3000/verify?token=${token}`;  // Correct URL for Express route
    
    const mailOptions = {
        from: process.env.EMAIL_USER,
        to: userEmail,
        subject: 'Booking Confirmation',
        text: `Please confirm your booking by clicking the link: ${verificationUrl}`
    };
    
    transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
            return res.status(500).json({ message: 'Error sending email', error });
        }
        console.log('Message sent: %s', info.messageId);
        res.json({ message: 'Booking confirmed. Check your email to verify.' });
    });
});

// Endpoint to verify the token from the email link
app.get('/verify', (req, res) => {
    const { token } = req.query;
    
    const booking = bookings.find(b => b.token === token);
    if (booking) {
        res.send('Booking successfully verified!');
    } else {
        res.send('Invalid or expired token.');
    }
});

// Start the server
app.listen(3000, () => {
    console.log('Server running on http://localhost:3000');
});
