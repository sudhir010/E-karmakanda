# eKarmakanda — Documentation

## Prerequisites

- **PHP 8.0+** with `mysqli` extension enabled
- **MySQL 5.7+** or **MariaDB 10.3+**
- **Web server** (Apache / Nginx) or PHP built-in server for development

---

## Quick Start (Development)

### Option A — One-click scripts

| Platform | Command |
|----------|---------|
| Windows  | Double-click `start.bat` or run `.\start.bat` |
| macOS/Linux | `bash start.sh` |

The script automatically picks PHP if installed, otherwise falls back to a static Node.js server for the frontend.

### Option B — PHP built-in server (recommended)

```bash
php -S localhost:8000
```

Open http://localhost:8000 in your browser.

### 2. Set up the database

Create a database named `ekarmakanda` and import the schema:

```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS ekarmakanda;"
mysql -u root -p ekarmakanda < ekarmakanda.sql
```

### 3. Configure credentials

Edit `database/config.php`:

```php
$host     = 'localhost';
$dbname   = 'ekarmakanda';
$username = 'root';
$password = '';
```

---

## Server Deployment

### Apache (.htaccess)

Create an `.htaccess` in the root:

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]

ErrorDocument 404 /404.php
```

### Nginx

```nginx
server {
    listen 80;
    server_name ekarmakanda.local;
    root /path/to/ekarmakanda;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.ht { deny all; }
}
```

---

## Database Tables

### `users`

| Column       | Type          | Notes                |
|-------------|---------------|----------------------|
| id          | INT (PK)      | Auto-increment       |
| fullname    | VARCHAR(100)  |                      |
| email       | VARCHAR(100)  | UNIQUE               |
| phonenumber | VARCHAR(15)   |                      |
| password    | VARCHAR(255)  | bcrypt hash          |
| created_at  | TIMESTAMP     | DEFAULT CURRENT_TIMESTAMP |

### `bookings`

| Column          | Type          | Notes                |
|----------------|---------------|----------------------|
| id             | INT (PK)      | Auto-increment       |
| full_name      | VARCHAR(100)  |                      |
| puja_type      | VARCHAR(50)   |                      |
| preferred_date | DATE          |                      |
| location       | VARCHAR(255)  |                      |
| contact_number | VARCHAR(10)   |                      |
| notes          | TEXT          |                      |
| created_at     | TIMESTAMP     | DEFAULT CURRENT_TIMESTAMP |

### `contact_messages`

| Column     | Type          | Notes                |
|-----------|---------------|----------------------|
| id        | INT (PK)      | Auto-increment       |
| name      | VARCHAR(100)  |                      |
| email     | VARCHAR(100)  |                      |
| message   | TEXT          |                      |
| created_at| TIMESTAMP     | DEFAULT CURRENT_TIMESTAMP |

---

## Project Architecture

```
ekarmakanda/
├── index.php                # Landing page
├── login.php                # User login
├── signup.php               # User registration
├── logout.php               # Session destroy
├── pujas.php                # Ritual listing with search/filter
├── ritual.php               # Single ritual detail
├── book.php                 # Pandit booking form
├── calendar.php             # Nepali calendar embed
├── contact.php              # Contact form
├── faq.php                  # FAQ accordion page
├── 404.php                  # Custom 404 page
│
├── css/                     # Stylesheets
│   ├── navbar.css           # Shared nav, sidebar, footer
│   ├── styles.css           # Homepage-specific
│   ├── book.css / contact.css / calendar.css / pujas.css / ritual.css / form.css
│   └── toast.css            # Toast notifications + spinner
│
├── js/                      # JavaScript
│   ├── navbar.js            # Mobile nav toggle + profile sidebar
│   ├── script.js            # Hero slideshow, newsletter, scroll animations
│   ├── toast.js             # Global toast notification system
│   └── calendar.js          # Bikram Sambat calendar logic
│
├── database/                # PHP backend
│   ├── config.php           # DB connection + CSRF helpers
│   ├── signup.php / login.php / logout.php
│   ├── contact.php / submit_booking.php / update_name.php
│
├── admin/
│   └── dashboard.php        # Admin panel (auth-protected)
│
├── data/
│   └── pujas.json           # 18 ritual entries
│
├── assets/                  # Static files (images, videos, PDFs)
└── ekarmakanda.sql          # Database schema
```

---

## Security

- **Passwords**: hashed with `bcrypt` via `password_hash()`
- **SQL injection**: prevented with prepared statements (`bind_param`)
- **CSRF**: per-session random tokens verified on all POST handlers
- **XSS**: all user output wrapped in `htmlspecialchars()`
- **Login**: credentials verified with `password_verify()`

---

## Features

- Ritual catalog with search and filter
- Pandit booking form with server-side persistence
- Nepali Bikram Sambat calendar widget
- User authentication (signup / login / profile)
- Admin dashboard to view bookings and messages
- Toast notification system
- Mobile-responsive design
- Scroll-triggered animations
- Password strength indicator
- Custom 404 page
- FAQ page with accordion

---

## Browser Support

- Chrome 80+
- Firefox 80+
- Safari 14+
- Edge 80+

---

## License

MIT — see [LICENSE](LICENSE) for details.
