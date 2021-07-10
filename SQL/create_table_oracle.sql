DROP TABLE RESET_PASSWORD CASCADE CONSTRAINT;
DROP TABLE VERIFY_EMAIL CASCADE CONSTRAINT;
DROP TABLE PAYMENTS CASCADE CONSTRAINT;
DROP TABLE ORDER_PRODUCT CASCADE CONSTRAINT;
DROP TABLE ORDERS CASCADE CONSTRAINT;
DROP TABLE SLOTS CASCADE CONSTRAINT;
DROP TABLE VOUCHERS CASCADE CONSTRAINT;
DROP TABLE REVIEWS CASCADE CONSTRAINT; 
DROP TABLE DISCOUNTS CASCADE CONSTRAINT;
DROP TABLE PRODUCTS CASCADE CONSTRAINT;
DROP TABLE CATEGORIES CASCADE CONSTRAINT;
DROP TABLE SHOPS CASCADE CONSTRAINT;
DROP TABLE TRADERS CASCADE CONSTRAINT;
DROP TABLE CUSTOMERS CASCADE CONSTRAINT;
DROP TABLE MANAGEMENTS CASCADE CONSTRAINT;
DROP TABLE USERS CASCADE CONSTRAINT;

CREATE TABLE USERS (
	USER_ID NUMBER(10) NOT NULL PRIMARY KEY,
	FULL_NAME VARCHAR2(100) NOT NULL,
	USERNAME VARCHAR2(30) NOT NULL UNIQUE,
	EMAIL VARCHAR2(100) NOT NULL UNIQUE,
	STREET VARCHAR2(100) NULL,
	CITY VARCHAR2(100) NULL,
	STATE VARCHAR2(100) NULL,
	POSTAL VARCHAR2(100) NULL,
	COUNTRY VARCHAR2(100) NULL,
	GENDER NUMBER(10) NOT NULL,
	USER_ROLE NUMBER(10) DEFAULT 3,
	PASSWORD_HASH VARCHAR2(255) NOT NULL,
	IMAGE VARCHAR2(100) NULL,
	CREATED_AT TIMESTAMP(0) DEFAULT SYSTIMESTAMP,
	UPDATED_AT TIMESTAMP(0) NULL
);

DROP SEQUENCE USERS_seq;
CREATE SEQUENCE USERS_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER USERS_seq_tr
 BEFORE INSERT ON USERS FOR EACH ROW
 WHEN (NEW.USER_ID IS NULL)
BEGIN
 SELECT USERS_seq.NEXTVAL INTO :NEW.USER_ID FROM DUAL;
END;
/



CREATE TABLE MANAGEMENTS (
	MANAGEMENT_ID NUMBER(10) NOT NULL PRIMARY KEY,
	USER_ID NUMBER(10) NOT NULL,
	CONTACT_NO VARCHAR2(20) NOT NULL,
	FOREIGN KEY (USER_ID) REFERENCES USERS (USER_ID) ON DELETE CASCADE
);

DROP SEQUENCE MANAGEMENTS_seq;
CREATE SEQUENCE MANAGEMENTS_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER MANAGEMENTS_seq_tr
 BEFORE INSERT ON MANAGEMENTS FOR EACH ROW
 WHEN (NEW.MANAGEMENT_ID IS NULL)
BEGIN
 SELECT MANAGEMENTS_seq.NEXTVAL INTO :NEW.MANAGEMENT_ID FROM DUAL;
END;
/


CREATE TABLE CUSTOMERS (
	CUSTOMER_ID NUMBER(10) NOT NULL PRIMARY KEY,
	USER_ID NUMBER(10) NOT NULL,
	EMAIL_VERIFIED_AT TIMESTAMP(0) NULL,
	FOREIGN KEY (USER_ID) REFERENCES USERS (USER_ID) ON DELETE CASCADE
);

DROP SEQUENCE CUSTOMERS_seq;
CREATE SEQUENCE CUSTOMERS_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER CUSTOMERS_seq_tr
 BEFORE INSERT ON CUSTOMERS FOR EACH ROW
 WHEN (NEW.CUSTOMER_ID IS NULL)
BEGIN
 SELECT CUSTOMERS_seq.NEXTVAL INTO :NEW.CUSTOMER_ID FROM DUAL;
END;
/



CREATE TABLE TRADERS (
	TRADER_ID NUMBER(10) NOT NULL PRIMARY KEY,
	USER_ID NUMBER(10) NOT NULL,
	VERIFIED_AT TIMESTAMP(0) NULL,
	CONTACT_NO VARCHAR2(20) NOT NULL,
	TRADING_SINCE TIMESTAMP(0) NOT NULL,
	BUSINESS_TYPE VARCHAR2(20) NOT NULL,
	PREFERRED_PAYMENTS VARCHAR2(30) NOT NULL,
	MESSAGE VARCHAR2(200) NOT NULL,
	STATUS NUMBER(10) DEFAULT 1,
	FOREIGN KEY (USER_ID) REFERENCES USERS (USER_ID) ON DELETE CASCADE
);

DROP SEQUENCE TRADERS_seq;

CREATE SEQUENCE TRADERS_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER TRADERS_seq_tr
 BEFORE INSERT ON TRADERS FOR EACH ROW
 WHEN (NEW.TRADER_ID IS NULL)
BEGIN
 SELECT TRADERS_seq.NEXTVAL INTO :NEW.TRADER_ID FROM DUAL;
END;
/


CREATE TABLE SHOPS (
	SHOP_ID NUMBER(10) NOT NULL PRIMARY KEY,
	TRADER_ID NUMBER(10) NOT NULL,
	SHOP_NAME VARCHAR2(100) NOT NULL,
	VERIFIED_ON DATE NULL,
	GOV_NO VARCHAR2(30) NOT NULL,
	ADDRESS VARCHAR2(50) NOT NULL,
	CONTACT_NO VARCHAR2(20) NOT NULL,
	SHOP_TYPE VARCHAR2(20) NOT NULL,
	DESCRIPTION VARCHAR2(200) NOT NULL,
	CREATED_AT TIMESTAMP(0) DEFAULT SYSTIMESTAMP,
	UPDATED_AT TIMESTAMP(0) NULL,
	FOREIGN KEY (TRADER_ID) REFERENCES USERS (USER_ID) ON DELETE CASCADE 
);

DROP SEQUENCE SHOPS_seq;
CREATE SEQUENCE SHOPS_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER SHOPS_seq_tr
 BEFORE INSERT ON SHOPS FOR EACH ROW
 WHEN (NEW.SHOP_ID IS NULL)
BEGIN
 SELECT SHOPS_seq.NEXTVAL INTO :NEW.SHOP_ID FROM DUAL;
END;
/



CREATE TABLE CATEGORIES (
	CATEGORY_ID NUMBER(10) NOT NULL PRIMARY KEY,
	CATEGORY_NAME VARCHAR2(30) NOT NULL,
	DESCRIPTION VARCHAR2(200) NOT NULL,
	IMAGE VARCHAR2(200) NOT NULL,
	CREATED_AT TIMESTAMP(0) DEFAULT SYSTIMESTAMP,
	UPDATED_AT TIMESTAMP(0) NULL
);

DROP SEQUENCE CATEGORIES_seq;
CREATE SEQUENCE CATEGORIES_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER CATEGORIES_seq_tr
 BEFORE INSERT ON CATEGORIES FOR EACH ROW
 WHEN (NEW.CATEGORY_ID IS NULL)
BEGIN
 SELECT CATEGORIES_seq.NEXTVAL INTO :NEW.CATEGORY_ID FROM DUAL;
END;
/



CREATE TABLE PRODUCTS (
	PRODUCT_ID NUMBER(10) NOT NULL PRIMARY KEY,
	PRODUCT_NAME VARCHAR2(100) NOT NULL,
	CATEGORY_ID NUMBER(10) NOT NULL,
	CONFIRMED_ON DATE NULL,
	PRICE NUMBER(10) NOT NULL,
	STOCK NUMBER(10) NOT NULL,
	TRADER_ID NUMBER(10) NOT NULL,
	SHOP_ID NUMBER(10) NOT NULL,
	DESCRIPTION VARCHAR2(200) NOT NULL,
	IMAGE1 VARCHAR2(50) NOT NULL,
	IMAGE2 VARCHAR2(50) NOT NULL,
	CREATED_AT TIMESTAMP(0) DEFAULT SYSTIMESTAMP,
	UPDATED_AT TIMESTAMP(0) NULL,
	FOREIGN KEY (CATEGORY_ID) REFERENCES CATEGORIES (CATEGORY_ID) ON DELETE CASCADE,
	FOREIGN KEY (SHOP_ID) REFERENCES SHOPS (SHOP_ID) ON DELETE CASCADE,
	FOREIGN KEY (TRADER_ID) REFERENCES USERS (USER_ID) ON DELETE CASCADE
);

DROP SEQUENCE PRODUCTS_seq;
CREATE SEQUENCE PRODUCTS_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER PRODUCTS_seq_tr
 BEFORE INSERT ON PRODUCTS FOR EACH ROW
 WHEN (NEW.PRODUCT_ID IS NULL)
BEGIN
 SELECT PRODUCTS_seq.NEXTVAL INTO :NEW.PRODUCT_ID FROM DUAL;
END;
/



CREATE TABLE DISCOUNTS (
	DISCOUNT_ID NUMBER(10) NOT NULL PRIMARY KEY,
	DISCOUNT_NAME VARCHAR2(50) NOT NULL,
	RATE BINARY_DOUBLE NOT NULL,
	TARGET_ID NUMBER(10) NULL,
	DISCOUNT_TYPE VARCHAR2(20) NOT NULL,
	STARTS_ON DATE NOT NULL,
	EXPIRES_ON DATE NOT NULL,
	CREATED_BY NUMBER(10) NOT NULL,
	CREATED_AT TIMESTAMP(0) DEFAULT SYSTIMESTAMP,
	UPDATED_AT TIMESTAMP(0) NULL,
	FOREIGN KEY (CREATED_BY) REFERENCES USERS (USER_ID) ON DELETE CASCADE
);

DROP SEQUENCE DISCOUNTS_seq;
CREATE SEQUENCE DISCOUNTS_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER DISCOUNTS_seq_tr
 BEFORE INSERT ON DISCOUNTS FOR EACH ROW
 WHEN (NEW.DISCOUNT_ID IS NULL)
BEGIN
 SELECT DISCOUNTS_seq.NEXTVAL INTO :NEW.DISCOUNT_ID FROM DUAL;
END;
/


CREATE TABLE REVIEWS (
	REVIEW_ID NUMBER(10) NOT NULL PRIMARY KEY,
	USER_ID NUMBER(10) NOT NULL,
	PRODUCT_ID NUMBER(10) NOT NULL,
	RATING NUMBER(10) NOT NULL,
	REVIEW VARCHAR2(200) NOT NULL,
	CREATED_AT TIMESTAMP(0) DEFAULT SYSTIMESTAMP,
	UPDATED_AT TIMESTAMP(0) NULL,
	FOREIGN KEY (USER_ID) REFERENCES USERS (USER_ID) ON DELETE CASCADE,
	FOREIGN KEY (PRODUCT_ID) REFERENCES PRODUCTS (PRODUCT_ID) ON DELETE CASCADE
);

DROP SEQUENCE REVIEWS_seq;
CREATE SEQUENCE REVIEWS_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER REVIEWS_seq_tr
 BEFORE INSERT ON REVIEWS FOR EACH ROW
 WHEN (NEW.REVIEW_ID IS NULL)
BEGIN
 SELECT REVIEWS_seq.NEXTVAL INTO :NEW.REVIEW_ID FROM DUAL;
END;
/



CREATE TABLE VOUCHERS (
	VOUCHER_ID NUMBER(10) NOT NULL PRIMARY KEY,
	VOUCHER_CODE VARCHAR2(30) NOT NULL UNIQUE,
	DISCOUNT_AMOUNT NUMBER(10) NOT NULL,
	MINIMUM NUMBER(10) NOT NULL,
	CREATED_AT TIMESTAMP(0) DEFAULT SYSTIMESTAMP,
	UPDATED_AT TIMESTAMP(0) NULL
);

DROP SEQUENCE VOUCHERS_seq;
CREATE SEQUENCE VOUCHERS_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER VOUCHERS_seq_tr
 BEFORE INSERT ON VOUCHERS FOR EACH ROW
 WHEN (NEW.VOUCHER_ID IS NULL)
BEGIN
 SELECT VOUCHERS_seq.NEXTVAL INTO :NEW.VOUCHER_ID FROM DUAL;
END;
/



CREATE TABLE SLOTS (
	SLOT_ID NUMBER(10) NOT NULL PRIMARY KEY,
	SLOT_TIME VARCHAR2(30) NOT NULL
);

DROP SEQUENCE SLOTS_seq;
CREATE SEQUENCE SLOTS_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER SLOTS_seq_tr
 BEFORE INSERT ON SLOTS FOR EACH ROW
 WHEN (NEW.SLOT_ID IS NULL)
BEGIN
 SELECT SLOTS_seq.NEXTVAL INTO :NEW.SLOT_ID FROM DUAL;
END;
/



CREATE TABLE ORDERS (
	ORDER_ID NUMBER(10) NOT NULL PRIMARY KEY,
	USER_ID NUMBER(10) NOT NULL,
	SLOT_ID NUMBER(10) NOT NULL,
	STATUS NUMBER(10) DEFAULT 1,
	ORDER_DATE TIMESTAMP(0) DEFAULT SYSTIMESTAMP,
	AMOUNT NUMBER(10) NOT NULL,
	VOUCHER_CODE VARCHAR2(30) NULL,
	VOUCHER_DISCOUNT NUMBER(10) NULL,
	FOREIGN KEY (USER_ID) REFERENCES USERS (USER_ID) ON DELETE CASCADE,
	FOREIGN KEY (SLOT_ID) REFERENCES SLOTS (SLOT_ID) ON DELETE CASCADE
);

DROP SEQUENCE ORDERS_seq;

CREATE SEQUENCE ORDERS_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER ORDERS_seq_tr
 BEFORE INSERT ON ORDERS FOR EACH ROW
 WHEN (NEW.ORDER_ID IS NULL)
BEGIN
 SELECT ORDERS_seq.NEXTVAL INTO :NEW.ORDER_ID FROM DUAL;
END;
/


CREATE TABLE ORDER_PRODUCT (
	ID NUMBER(19) NOT NULL PRIMARY KEY,
	ORDER_ID NUMBER(19) NOT NULL,
	PRODUCT_ID NUMBER(19) NOT NULL,
	SITE_DISCOUNT NUMBER(19) NULL,
	PRODUCT_DISCOUNT NUMBER(19) NULL,
	QUANTITY NUMBER(19) NULL,
	STATUS NUMBER(19) DEFAULT 1,
	FOREIGN KEY (ORDER_ID) REFERENCES ORDERS (ORDER_ID) ON DELETE CASCADE,
	FOREIGN KEY (PRODUCT_ID) REFERENCES PRODUCTS (PRODUCT_ID) ON DELETE CASCADE
);

DROP SEQUENCE ORDER_PRODUCT_seq;

CREATE SEQUENCE ORDER_PRODUCT_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER ORDER_PRODUCT_seq_tr
 BEFORE INSERT ON ORDER_PRODUCT FOR EACH ROW
 WHEN (NEW.ID IS NULL)
BEGIN
 SELECT ORDER_PRODUCT_seq.NEXTVAL INTO :NEW.ID FROM DUAL;
END;
/


CREATE TABLE PAYMENTS (
	PAYMENT_ID NUMBER(10) NOT NULL PRIMARY KEY,
	ORDER_ID NUMBER(10) NOT NULL,
	AMOUNT BINARY_DOUBLE NOT NULL,
	PAYMENT_METHOD VARCHAR2(15) NOT NULL,
	PAYMENT_DATE TIMESTAMP(0) DEFAULT SYSTIMESTAMP,
	TXN_ID VARCHAR2(100) NULL,
	PAYMENT_FEE BINARY_DOUBLE NULL,
	FOREIGN KEY (ORDER_ID) REFERENCES ORDERS (ORDER_ID)
);

DROP SEQUENCE PAYMENTS_seq;

CREATE SEQUENCE PAYMENTS_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER PAYMENTS_seq_tr
 BEFORE INSERT ON PAYMENTS FOR EACH ROW
 WHEN (NEW.PAYMENT_ID IS NULL)
BEGIN
 SELECT PAYMENTS_seq.NEXTVAL INTO :NEW.PAYMENT_ID FROM DUAL;
END;
/


CREATE TABLE RESET_PASSWORD (
	EMAIL VARCHAR2(100) NOT NULL UNIQUE,
	TOKEN VARCHAR2(32) NOT NULL,
	CREATED_AT TIMESTAMP(0) DEFAULT SYSTIMESTAMP
);


CREATE TABLE VERIFY_EMAIL (
	EMAIL VARCHAR2(100) NOT NULL UNIQUE,
	TOKEN VARCHAR2(32) NOT NULL,
	CREATED_AT TIMESTAMP(0) DEFAULT SYSTIMESTAMP
);