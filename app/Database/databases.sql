-- create database and use 
CREATE DATABASE inm_audio;
USE inm_audio;

-- create admin account
CREATE TABLE admin_accounts (
    admin_account_id int auto_increment primary key,
    profile_pic LONGBLOB,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- default admin account
INSERT INTO admin_accounts (username, email, password)
VALUES ('admin', 'admin@gmail.com', '$2y$10$0tyqlNGA/EKnKwVmCnrqkuTo1H7lB6JnGYbUooeb5vBIYp2BD9Ug6');



-- create user accounts
CREATE TABLE user_accounts(
  user_id INT auto_increment primary key,
  profile_pic LONGBLOB, 
  firstname VARCHAR(255) NOT NULL,
  lastname VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone_number VARCHAR(20) NOT NULL,

  country VARCHAR(255),
  city_municipality VARCHAR(255), 
  zipcode INT(20),
  address VARCHAR(255),

  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  remember_token VARCHAR(64) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- ------------------------------------------------------------------------------

-- category
CREATE TABLE category(
  category_id INT AUTO_INCREMENT PRIMARY KEY,
  category VARCHAR(255)
);

-- products
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    product_name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock_quantity INT NOT NULL,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES category(category_id) ON DELETE SET NULL
);


-- comments
CREATE TABLE comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    user_id INT,
    comment_text TEXT,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES user_accounts(user_id) ON DELETE CASCADE
);


-- likes 
CREATE TABLE likes(
    likes_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    FOREIGN KEY(user_id) REFERENCES user_accounts(user_id) ON DELETE CASCADE,
    FOREIGN KEY(product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

-- ------------------------------------------------------------------------------


-- placed order
CREATE TABLE placedOrders(
    placed_order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT ,
    product_id INT,
    quantity INT,
    total_price INT,
    payment_method VARCHAR(10),
    date_placed TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES user_accounts(user_id) ON DELETE CASCADE
);

-- Stores cart information for each user.
CREATE TABLE carts (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_accounts(user_id) ON DELETE CASCADE
);


-- Stores items added to the cart.
CREATE TABLE cart_items (
    cart_item_id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT,
    product_id INT,
    quantity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cart_id) REFERENCES carts(cart_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);



-- ------------------------------------------------------------------------------

-- Stores user orders.
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    order_status VARCHAR(50),-- PENDING, ONGOING, COMPLETE, CANCELLED, RETURNED
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    payment_method varchar(255),
    delivery_date DATE,
    date_completed DATE,
    date_returned DATE,
    date_cancelled DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_accounts(user_id)
);
-- set to cancelled if the user deletes it account
DROP TRIGGER IF EXISTS after_user_delete;

-- DELIMITER //

-- CREATE TRIGGER after_user_delete
-- AFTER DELETE ON user_accounts
-- FOR EACH ROW
-- BEGIN
--     UPDATE orders
--     SET order_status = 'Cancelled',
--         date_cancelled = CURRENT_DATE
--     WHERE user_id = OLD.user_id;
-- END;
-- //

-- DELIMITER ;


-- Stores shipping information related to an order.
CREATE TABLE shippings (
    shipping_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20) NOT NULL,
    country VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE
);
-- seting some setting
DROP TRIGGER IF EXISTS after_order_update;
-- DELIMITER //

-- CREATE TRIGGER after_order_update
-- AFTER UPDATE ON orders
-- FOR EACH ROW
-- BEGIN
--     IF NEW.order_status = 'COMPLETE' THEN
--         UPDATE shippings
--         SET shipping_status = 'Successful'
--         WHERE order_id = NEW.order_id;
--     ELSEIF NEW.order_status = 'CANCELLED' THEN
--         UPDATE shippings
--         SET shipping_status = 'Unsuccessful'
--         WHERE order_id = NEW.order_id;
--     ELSEIF NEW.order_status = 'ONGOING' THEN
--         UPDATE shippings
--         SET shipping_status = 'On the Way'
--         WHERE order_id = NEW.order_id;
--     END IF;
-- END;
-- //

-- DELIMITER ;

-- handling sessions time
CREATE TABLE user_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_accounts(user_id) ON DELETE CASCADE
);