-- creates the database and uses it
create database INM_Audio;
use INM_Audio;


-- ------------------------------------------------------------------------------


-- create admin table
create table admin_accounts (
    admin_account_id int auto_increment primary key,
    profile_pic LONGBLOB,
    username varchar(255) not null,
    email varchar(255) not null,
    password varchar(255) not null,
    remember_token VARCHAR(64) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- inserts default admin account NOTE: it hashes the +
-- + password into random set of numbers, letters and symbols
 -- note the combination of random numbers, letters and symbols is a hashed passwrod, For this the password is 'admin'
insert into admin_accounts (username, email, password)
values ('admin', 'admin@gmail.com', '$2y$10$0tyqlNGA/EKnKwVmCnrqkuTo1H7lB6JnGYbUooeb5vBIYp2BD9Ug6');

-- user accounts info
create table user_accounts(
  user_id int auto_increment primary key,
  profile_pic LONGBLOB, 
  firstname varchar(255) not null,
  lastname varchar(255) not null,
  email varchar(255) not null,
  phone_number varchar(20) not null,

  country varchar(255),
  city_municipality varchar(255), 
  zipcode varchar(20),
  address varchar(255),

  username varchar(255) not null,
  password varchar(255) not null,
  remember_token VARCHAR(64) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



-- ------------------------------------------------------------------------------


-- category for a product
CREATE TABLE category(
  category_id INT AUTO_INCREMENT PRIMARY KEY,
  category VARCHAR(255)
);


-- Stores information about the products.
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




-- Stores comments related to products.
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



-- ------------------------------------------------------------------------------




-- Stores cart information for each user.
CREATE TABLE carts (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
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
    total_amount DECIMAL(10, 2) NOT NULL,
    order_status VARCHAR(50) DEFAULT 'Pending',
    payment_method varchar(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Stores items included in an order.
CREATE TABLE order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);


-- Stores shipping information related to an order.
CREATE TABLE shippings (
    shipping_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20) NOT NULL,
    country VARCHAR(100) NOT NULL,
    shipping_status VARCHAR(50) DEFAULT 'Not Shipped',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE
);



<<<<<<< HEAD
CREATE TABLE transactions (
    transaction_id varchar(255) primary key auto_increment,
    user_id varhcar(255) not null, 
    date date not null, 
    Ammount int not null,
    payment_method varchar(255) not null,
    status varchar(255) not null,
    created_at TIMESTAMP default CURRENT_TIMESTAMP
);
=======
-- transaction table
CREATE TABLE transactions (
    transaction_id int auto_increment primary key,
    user_id int,
    ammount int not null,
    payment_method varchar(255) DEFAULT 'Pending', 
    status varchar(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

>>>>>>> 2f2219950418aede0cb26433665f9e5552b4c043











-- handling sessions time
CREATE TABLE user_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_accounts(user_id) ON DELETE CASCADE
);








