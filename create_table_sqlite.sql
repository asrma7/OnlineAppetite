DROP TABLE ORDER_PRODUCT;
DROP TABLE ORDERS;
DROP TABLE SLOTS;
DROP TABLE VOUCHERS;
DROP TABLE REVIEWS; 
DROP TABLE DISCOUNTS;
DROP TABLE PRODUCTS;
DROP TABLE CATEGORIES;
DROP TABLE SHOPS;
DROP TABLE TRADERS;
DROP TABLE CUSTOMERS;
DROP TABLE MANAGEMENTS;
DROP TABLE USERS;

CREATE TABLE USERS (
	USER_ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	FULL_NAME VARCHAR(30) NOT NULL,
	USERNAME VARCHAR(30) NOT NULL UNIQUE,
	EMAIL VARCHAR(100) NOT NULL UNIQUE,
	STREET VARCHAR(100) NULL,
	CITY VARCHAR(100) NULL,
	STATE VARCHAR(100) NULL,
	POSTAL VARCHAR(100) NULL,
	COUNTRY VARCHAR(100) NULL,
	GENDER INTEGER NOT NULL,
	USER_ROLE INTEGER DEFAULT 3,
	PASSWORD_HASH VARCHAR(255) NOT NULL,
	IMAGE VARCHAR(100) NULL,
	CREATED_AT DATETIME(0) DEFAULT CURRENT_TIMESTAMP,
	UPDATED_AT DATETIME(0) NULL
);


CREATE TABLE MANAGEMENTS (
	MANAGEMENT_ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	USER_ID INTEGER NOT NULL,
	CONTACT_NO VARCHAR(20) NOT NULL,
	FOREIGN KEY (USER_ID) REFERENCES USERS (USER_ID) ON DELETE CASCADE
);


CREATE TABLE CUSTOMERS (
	CUSTOMER_ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	USER_ID INTEGER NOT NULL,
	EMAIL_VERIFIED_AT DATETIME(0) NULL,
	FOREIGN KEY (USER_ID) REFERENCES USERS (USER_ID) ON DELETE CASCADE
);


CREATE TABLE TRADERS (
	TRADER_ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	USER_ID INTEGER NOT NULL,
	VERIFIED_AT DATETIME(0) NULL,
	CONTACT_NO VARCHAR(20) NOT NULL,
	TRADING_SINCE DATETIME(0) NOT NULL,
	BUSINESS_TYPE VARCHAR(20) NOT NULL,
	PREFERRED_PAYMENTS VARCHAR(30) NOT NULL,
	MESSAGE VARCHAR(200) NOT NULL,
	status INTEGER DEFAULT 1,
	FOREIGN KEY (USER_ID) REFERENCES USERS (USER_ID) ON DELETE CASCADE
);


CREATE TABLE SHOPS (
	SHOP_ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	TRADER_ID INTEGER NOT NULL,
	SHOP_NAME VARCHAR(30) NOT NULL,
	VERIFIED_ON DATETIME NULL,
	GOV_NO VARCHAR(30) NOT NULL,
	ADDRESS VARCHAR(50) NOT NULL,
	CONTACT_NO VARCHAR(20) NOT NULL,
	SHOP_TYPE VARCHAR(20) NOT NULL,
	DESCRIPTION VARCHAR(200) NOT NULL,
	CREATED_AT DATETIME(0) DEFAULT CURRENT_TIMESTAMP,
	UPDATED_AT DATETIME(0) NULL,
	FOREIGN KEY (TRADER_ID) REFERENCES USERS (USER_ID) ON DELETE CASCADE 
);


CREATE TABLE CATEGORIES (
	CATEGORY_ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	CATEGORY_NAME VARCHAR(30) NOT NULL,
	DESCRIPTION VARCHAR(200) NOT NULL,
	IMAGE VARCHAR(200) NOT NULL,
	CREATED_AT DATETIME(0) DEFAULT CURRENT_TIMESTAMP,
	UPDATED_AT DATETIME(0) NULL
);


CREATE TABLE PRODUCTS (
	PRODUCT_ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	PRODUCT_NAME VARCHAR(30) NOT NULL,
	CATEGORY_ID INTEGER NOT NULL,
	CONFIRMED_ON DATETIME NULL,
	PRICE INTEGER NOT NULL,
	STOCK INTEGER NOT NULL,
	TRADER_ID INTEGER NOT NULL,
	SHOP_ID INTEGER NOT NULL,
	DESCRIPTION VARCHAR(200) NOT NULL,
	IMAGE1 VARCHAR(50) NOT NULL,
	IMAGE2 VARCHAR(50) NOT NULL,
	CREATED_AT DATETIME(0) DEFAULT CURRENT_TIMESTAMP,
	UPDATED_AT DATETIME(0) NULL,
	FOREIGN KEY (CATEGORY_ID) REFERENCES CATEGORIES (CATEGORY_ID) ON DELETE CASCADE,
	FOREIGN KEY (SHOP_ID) REFERENCES SHOPS (SHOP_ID) ON DELETE CASCADE,
	FOREIGN KEY (TRADER_ID) REFERENCES USERS (USER_ID) ON DELETE CASCADE
);


CREATE TABLE DISCOUNTS (
	DISCOUNT_ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	DISCOUNT_NAME VARCHAR(50) NOT NULL,
	RATE DOUBLE NOT NULL,
	TARGET_ID INTEGER NULL,
	DISCOUNT_TYPE VARCHAR(20) NOT NULL,
	STARTS_ON DATETIME NOT NULL,
	EXPIRES_ON DATETIME NOT NULL,
	CREATED_BY INTEGER NOT NULL,
	CREATED_AT DATETIME(0) DEFAULT CURRENT_TIMESTAMP,
	UPDATED_AT DATETIME(0) NULL,
	FOREIGN KEY (CREATED_BY) REFERENCES USERS (USER_ID) ON DELETE CASCADE
);


CREATE TABLE REVIEWS (
	REVIEW_ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	USER_ID INTEGER NOT NULL,
	PRODUCT_ID INTEGER NOT NULL,
	RATING INTEGER NOT NULL,
	REVIEW VARCHAR(200) NOT NULL,
	CREATED_AT DATETIME(0) DEFAULT CURRENT_TIMESTAMP,
	UPDATED_AT DATETIME(0) NULL,
	FOREIGN KEY (USER_ID) REFERENCES USERS (USER_ID) ON DELETE CASCADE,
	FOREIGN KEY (PRODUCT_ID) REFERENCES PRODUCTS (PRODUCT_ID) ON DELETE CASCADE
);


CREATE TABLE VOUCHERS (
	VOUCHER_ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	VOUCHER_CODE VARCHAR(30) NOT NULL UNIQUE,
	DISCOUNT_AMOUNT INTEGER NOT NULL,
	MINIMUM INTEGER NOT NULL,
	CREATED_AT DATETIME(0) DEFAULT CURRENT_TIMESTAMP,
	UPDATED_AT DATETIME(0) NULL
);


CREATE TABLE SLOTS (
	SLOT_ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	SLOT_TIME VARCHAR(30) NOT NULL
);


CREATE TABLE ORDERS (
	ORDER_ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	SLOT_ID INTEGER NOT NULL,
	STATUS INTEGER DEFAULT 1,
	ORDER_DATE DATETIME(0) DEFAULT CURRENT_TIMESTAMP,
	AMOUNT INTEGER NOT NULL,
	FOREIGN KEY (SLOT_ID) REFERENCES SLOTS (SLOT_ID) ON DELETE CASCADE
);


CREATE TABLE ORDER_PRODUCT (
	ORDER_ID INTEGER NOT NULL,
	PRODUCT_ID INTEGER NOT NULL,
	SITE_DISCOUNT INTEGER NOT NULL,
	PRODUCT_DISCOUNT INTEGER NOT NULL,
	VOUCHER_DISCOUNT INTEGER NOT NULL,
	FOREIGN KEY (ORDER_ID) REFERENCES ORDERS (ORDER_ID) ON DELETE CASCADE,
	FOREIGN KEY (PRODUCT_ID) REFERENCES PRODUCTS (PRODUCT_ID) ON DELETE CASCADE
);

--CREATE TABLE notifications （ notification_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT ）;
--CREATE TABLE payments （ payment_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT order_id INTEGER FOREIGN KEY REFERENCES orders（order_id） amount FLOAT NOT NULL ）; 