CREATE OR REPLACE TABLE manobran;

USE manobran;

CREATE OR REPLACE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Hashed password
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    last_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert a sample admin (username: admin, password: password123)
INSERT INTO admins (email, username, password, firstname, lastname, last_login)
VALUES (
    'dharmakumar338@gmail.com', -- Email
    'polroti', -- Username
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- Hashed password for 'password123'
    'Manoj', -- First name
    'Kumar', -- Last name
    NOW() -- Current timestamp for last login
);