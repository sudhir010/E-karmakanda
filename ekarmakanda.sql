-- Query to create the 'users' table
CREATE TABLE
    IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fullname VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        phonenumber VARCHAR(15) NOT NULL,
        password VARCHAR(255) NOT NULL confirm_password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    );

-- Query to create the 'bookings' table
CREATE TABLE
    IF NOT EXISTS bookings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(100) NOT NULL,
        puja_type VARCHAR(50) NOT NULL,
        preferred_date DATE NOT NULL,
        location VARCHAR(255) NOT NULL,
        contact_number VARCHAR(10) NOT NULL,
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

-- Query to create the 'contact' table
CREATE TABLE
    IF NOT EXISTS contact (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );