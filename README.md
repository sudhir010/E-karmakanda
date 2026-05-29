# eKarmakanda

> Preserving Ancient Rituals with Technology

eKarmakanda is a web platform that makes Hindu rituals (Karmakanda) more accessible, authentic, and organized. Users can explore rituals, book certified priests, view auspicious dates, and contact administrators — all through a clean, responsive interface.

## Features

- **Ritual Guides** – Browse detailed explanations of 18+ pujas and ceremonies
- **Book a Pandit** – Schedule certified priests for rituals near you
- **Nepali Calendar** – Embedded Hamro Patro widget for tithis and festivals
- **User Accounts** – Register, login, and manage your profile
- **Admin Dashboard** – View bookings and contact messages

## Tech Stack

| Layer    | Technology                         |
| -------- | ---------------------------------- |
| Frontend | HTML5, CSS3, Vanilla JavaScript    |
| Backend  | PHP 8+                             |
| Database | MySQL / MariaDB                    |
| Server   | Apache / Nginx with PHP-FPM        |

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/sudhir010/E-karmakanda.git
cd E-karmakanda
```

### 2. Set up the database

Create a MySQL database and run the schema:

```bash
mysql -u root -p < ekarmakanda.sql
```

Or import `ekarmakanda.sql` via phpMyAdmin.

### 3. Configure database connection

Edit `database/config.php` with your database credentials:

```php
$host = 'localhost';
$dbname = 'ekarmakanda';
$username = 'root';
$password = '';
```

### 4. Serve the application

Point your web server's document root to the project directory. For local development:

```bash
php -S localhost:8000
```

Then open `http://localhost:8000` in your browser.

## Project Structure

```
ekarmakanda/
├── index.php              # Homepage with hero, features, newsletter
├── pujas.php              # Rituals listing (fetched from JSON)
├── ritual.php             # Single ritual detail page
├── book.php               # Booking form for pandit services
├── calendar.php           # Nepali calendar (Hamro Patro embed)
├── contact.php            # Contact form
├── login.html             # User login
├── signup.html            # User registration
├── logout.php             # Session destroy
├── css/                   # Page-specific stylesheets
│   ├── navbar.css
│   ├── styles.css
│   ├── book.css
│   ├── calendar.css
│   ├── contact.css
│   ├── form.css
│   ├── pujas.css
│   └── ritual.css
├── js/                    # Client-side scripts
│   ├── script.js          # Hero slideshow, newsletter, scroll animations
│   ├── navbar.js          # Mobile nav toggle, profile sidebar
│   └── calendar.js        # Bikram Sambat calendar logic
├── data/
│   └── pujas.json         # Ritual data (name, description, requirements)
├── database/              # PHP backend scripts
│   ├── config.php         # DB connection
│   ├── signup.php         # User registration
│   ├── login.php          # User authentication
│   ├── logout.php         # Session cleanup
│   ├── contact.php        # Save contact messages
│   ├── submit_booking.php # Save booking requests
│   └── update_name.php    # Update user's display name
├── admin/
│   └── dashboard.php      # Admin panel (view bookings & messages)
├── assets/                # Static assets
│   ├── images/
│   ├── videos/
│   └── pdfs/
└── ekarmakanda.sql        # Database schema
```

## Usage

### User Flow

1. **Browse** rituals on the homepage or `/pujas.php`
2. **Learn** about a specific ritual on `/ritual.php?id=1`
3. **Book** a pandit via the form on `/book.php`
4. **Check** auspicious dates on the calendar page
5. **Register** an account to manage your profile

### Admin Flow

1. Register a user account
2. Navigate to `/admin/dashboard.php` (must be logged in)
3. View all bookings and contact form submissions

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/your-feature`)
3. Commit your changes (`git commit -m 'feat: add your feature'`)
4. Push to the branch (`git push origin feature/your-feature`)
5. Open a Pull Request

## License

This project is open source and available under the [MIT License](LICENSE).

---

Built with ❤️ for preserving Sanatana Dharma traditions through technology.
