CREATE TABLE users ( user_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, full_name VARCHAR(30) NOT NULL, username VARCHAR(30) NOT NULL UNIQUE, email VARCHAR(100) NOT NULL UNIQUE, street VARCHAR(100) NULL, city VARCHAR(100) NULL, state VARCHAR(100) NULL, postal VARCHAR(100) NULL, country VARCHAR(100) NULL, gender INTEGER NOT NULL, user_role INTEGER DEFAULT 3, password_hash VARCHAR(255) NOT NULL, image VARCHAR(100) NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP NULL );

CREATE TABLE managements ( management_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, user_id INTEGER NOT NULL, contact_no VARCHAR(20) NOT NULL, FOREIGN KEY (user_id) REFERENCES users(user_id) );

CREATE TABLE customers ( customer_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, user_id INTEGER NOT NULL, email_verified_at TIMESTAMP NULL, FOREIGN KEY (user_id) REFERENCES users(user_id) );

CREATE TABLE traders ( trader_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, user_id INTEGER NOT NULL, verified_at TIMESTAMP NULL, contact_no VARCHAR(20) NOT NULL, trading_since DATETIME NOT NULL, business_type INT(1) NOT NULL, preferred_payments VARCHAR(30) NOT NULL, message VARCHAR(200) NOT NULL, status INTEGER DEFAULT 1, FOREIGN KEY (user_id) REFERENCES users(user_id) );

CREATE TABLE shops ( shop_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, trader_id INTEGER NOT NULL, shop_name VARCHAR(30) NOT NULL, verified_on DATE NULL, gov_no VARCHAR(30) NOT NULL, address VARCHAR(50) NOT NULL, contact_no VARCHAR(20) NOT NULL, shop_type VARCHAR(20) NOT NULL, description VARCHAR(200) NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP NULL, FOREIGN KEY (trader_id) REFERENCES traders (trader_id) );

CREATE TABLE categories ( category_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, category_name VARCHAR(30) NOT NULL, description VARCHAR(200) NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP NULL );

CREATE TABLE products ( product_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, product_name VARCHAR(30) NOT NULL, category_id INTEGER NOT NULL, confirmed_on DATE NULL, price INTEGER NOT NULL, stock INTEGER NOT NULL, trader_id INTEGER NOT NULL, shop_id INTEGER NOT NULL, description VARCHAR(200) NOT NULL, image1 VARCHAR(50) NOT NULL, image2 VARCHAR(50) NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP NULL, FOREIGN KEY (category_id) REFERENCES categories (category_id), FOREIGN KEY (shop_id) REFERENCES shops (shop_id), FOREIGN KEY (trader_id) REFERENCES users (user_id) );

CREATE TABLE discounts ( discount_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, discount_name VARCHAR(50) NOT NULL, rate FLOAT NOT NULL, target_id INTEGER NULL, discount_type VARCHAR(20) NOT NULL, starts_on DATE NOT NULL, expires_on DATE NOT NULL, created_by INTEGER NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP NULL, FOREIGN KEY (created_by) REFERENCES users (user_id) );

CREATE TABLE reviews ( review_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, user_id INTEGER NOT NULL, product_id INTEGER NOT NULL, rating INTEGER NOT NULL, review VARCHAR(200) NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP NULL, FOREIGN KEY (user_id) REFERENCES users(user_id), FOREIGN KEY (product_id) REFERENCES products(product_id) );

CREATE TABLE orders ( order_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, slot_id INTEGER NOT NULL, status INTEGER NOT NULL, order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, FOREIGN KEY(slot_id) REFERENCES slots (slot_id) );

CREATE TABLE order_product ( order_id INTEGER NOT NULL, product_id INTEGER NOT NULL, FOREIGN KEY (order_id) REFERENCES orders(order_id), FOREIGN KEY (product_id) REFERENCES products(product_id) );

-- CREATE TABLE slot ( slot_id INT NOT NULL PRIMARY KEY AUTOINCREMENT );

-- CREATE TABLE notifications ( notification_id INT NOT NULL PRIMARY KEY AUTOINCREMENT );

-- CREATE TABLE payments ( payment_id INT NOT NULL PRIMARY KEY AUTOINCREMENT, order_id INT FOREIGN KEY REFERENCES order(order_id), amount FLOAT NOT NULL, ); 