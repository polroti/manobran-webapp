CREATE TABLE Orders (
    id INT PRIMARY KEY AUTO_INCREMENT, -- Auto-incremented primary key
    customer_id INT NOT NULL, -- Foreign key to Customer table
    completion_date DATE, -- Actual completion date
    expected_completion_date DATE, -- Expected completion date
    created_by VARCHAR(100) NOT NULL, -- Who created the order
    created_date DATETIME NOT NULL, -- When the order was created
    notes TEXT, -- Optional notes or instructions
    status ENUM('PENDING', 'IN_PROGRESS', 'COMPLETED', 'CANCELLED') DEFAULT 'PENDING', -- Order status
    payment_status ENUM('PAID', 'UNPAID', 'PARTIALLY_PAID') DEFAULT 'UNPAID', -- Payment status
    payment_method ENUM('CASH', 'CARD', 'ONLINE'), -- Payment method
    invoice_id VARCHAR(50) UNIQUE, -- Invoice ID (unique)
    delivery_method ENUM('DELIVERY', 'PICKUP'), -- Delivery method
    delivery_address TEXT, -- Delivery address
    pickup_time DATETIME, -- Pickup time
    advance_paid BOOLEAN DEFAULT FALSE, -- Whether advance payment was made
    advance_pay_amount DECIMAL(10, 2), -- Advance payment amount
    advance_pay_date DATE, -- Advance payment date
    cancel_reason TEXT, -- Reason for cancellation
    order_type VARCHAR(100), -- Type of order (e.g., new blouse stitches, alterations, design drawings)
    priority ENUM('LOW', 'MEDIUM', 'HIGH', 'URGENT') DEFAULT 'MEDIUM', -- Priority level
    assigned_to INT, -- Foreign key to User table (tailor assigned to the order)
    FOREIGN KEY (customer_id) REFERENCES Customer(id), -- Link to Customer table
    FOREIGN KEY (assigned_to) REFERENCES User(id) -- Link to User table
);