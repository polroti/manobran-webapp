CREATE OR REPLACE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Unique ID for each user
    email VARCHAR(100) NOT NULL UNIQUE, -- Unique email for login
    username VARCHAR(50) NOT NULL UNIQUE, -- Unique username for login
    password VARCHAR(255) NOT NULL, -- Hashed password
    firstname VARCHAR(50) NOT NULL, -- User's first name
    lastname VARCHAR(50) NOT NULL, -- User's last name
    user_type ENUM('owner', 'cashier', 'tailor') NOT NULL, -- Role of the user
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp when the user was created
    last_login TIMESTAMP NULL DEFAULT NULL -- Timestamp of the last login
);


INSERT INTO users (email, username, password, firstname, lastname, user_type, created_at, last_login)
VALUES
    ('owner@manobrantailors.com', 'owner', '$2y$10$THPqnZk9OLg4ZY9VOBudzOcZTjvSzOzxb2FlQrdOq/yLZLHrWDZEO', 'Rengiah', 'Dharmaraja', 'OWNER', NOW(), NOW()), --owner123
    ('cashier@manobrantailors.com', 'cashier', '$2y$10$NgUgJMu7idPmzMFQIZTgdO8NtUT8uVndz7pgHL1wxT6BCSut0jd2q', 'Jane', 'Smith', 'CASHIER', NOW(), NOW()), --cashier321
    ('tailor@manobrantailors.com', 'tailor', '$2y$10$3sKK9pVQ5gIM.9Dg/1JX5.lv22wj1cuZirQHF9RgHi91VhjIt91Ja', 'Alice', 'Johnson', 'tailor', NOW(), NOW()); -- trailorbro112