const express = require('express');
const app = express();
const mongoose = require('mongoose');

mongoose.connect('mongodb://localhost/bookings', { useNewUrlParser: true, useUnifiedTopology: true });

const guestSchema = new mongoose.Schema({
  name: String,
  email: String,
  phone: String,
  roomType: String,
});

const Guest = mongoose.model('Guest', guestSchema);

app.use(express.json());

app.post('/bookings', (req, res) => {
  const guest = new Guest(req.body);
  guest.save((err, result) => {
    if (err) {
      res.status(500).send({ message: 'Error saving booking' });
    } else {
      res.send({ message: 'Booking saved successfully' });
    }
  });
});

app.listen(3000, () => {
  console.log('Server listening on port 3000');
});