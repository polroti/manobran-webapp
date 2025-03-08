CREATE TABLE Customer (
    id INT PRIMARY KEY AUTO_INCREMENT, -- Auto-incremented primary key
    nic VARCHAR(20) NOT NULL UNIQUE, -- NIC is mandatory and unique
    passport VARCHAR(20) UNIQUE, -- Passport is optional but unique
    first_name VARCHAR(100) NOT NULL, -- Customer name is mandatory
    last_name VARCHAR(100) NOT NULL, -- Customer name is mandatory
    gender ENUM('MALE', 'FEMALE') NOT NULL, -- Gender is optional
    dob DATE NOT NULL, -- Date of Birth is optional
    mobile VARCHAR(15) UNIQUE NOT NULL, -- Mobile is optional but unique
    email VARCHAR(100) UNIQUE NOT NULL, -- Email is optional but unique
    address TEXT NOT NULL-- Address is optional
);