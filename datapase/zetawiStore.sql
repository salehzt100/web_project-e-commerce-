-- Create User Table
CREATE TABLE User (
                      id INT NOT NULL AUTO_INCREMENT,
                      username VARCHAR(50) NOT NULL,
                      email VARCHAR(255) NOT NULL,
                      password VARCHAR(255) NOT NULL,
                      isadmin BOOLEAN default false,
                      PRIMARY KEY (id)
);

-- Create User Payment Table
CREATE TABLE User_Payment (
                              id INT NOT NULL AUTO_INCREMENT,
                              user_id INT NOT NULL,
                              card_number VARCHAR(16) NOT NULL,
                              card_expiry VARCHAR(7) NOT NULL,
                              PRIMARY KEY (id),
                              FOREIGN KEY (user_id) REFERENCES User(id)
);

-- Create User Address Table
CREATE TABLE User_Address (
                              id INT NOT NULL AUTO_INCREMENT,
                              user_id INT NOT NULL,
                              street_address VARCHAR(255) NOT NULL,
                              city VARCHAR(50) NOT NULL,
                              state VARCHAR(50) NOT NULL,
                              zip_code VARCHAR(10) NOT NULL,
                              PRIMARY KEY (id),
                              FOREIGN KEY (user_id) REFERENCES User(id)
);

-- Create Product Table
CREATE TABLE Product (
                         id INT NOT NULL AUTO_INCREMENT,
                         name VARCHAR(255) NOT NULL,
                         description TEXT NOT NULL,
                         price DECIMAL(10, 2) NOT NULL,
                         image_url VARCHAR(255) NOT NULL,
                         PRIMARY KEY (id)
);

-- Create Product Inventory Table
CREATE TABLE Product_Inventory (
                                   id INT NOT NULL AUTO_INCREMENT,
                                   product_id INT NOT NULL,
                                   quantity INT NOT NULL,
                                   PRIMARY KEY (id),
                                   FOREIGN KEY (product_id) REFERENCES Product(id)
);

-- Create Product Category Table
CREATE TABLE Product_Category (
                                  id INT NOT NULL AUTO_INCREMENT,
                                  product_id INT NOT NULL,
                                  category_name VARCHAR(50) NOT NULL,
                                  PRIMARY KEY (id),
                                  FOREIGN KEY (product_id) REFERENCES Product(id)
);

-- Create Order Table
CREATE TABLE Order_Details (
                               id INT NOT NULL AUTO_INCREMENT,
                               user_id INT NOT NULL,
                               order_date DATETIME NOT NULL,
                               total_amount DECIMAL(10, 2) NOT NULL,
                               PRIMARY KEY (id),
                               FOREIGN KEY (user_id) REFERENCES User(id)
);

-- Create Order Items Table
CREATE TABLE Order_Items (
                             id INT NOT NULL AUTO_INCREMENT,
                             order_id INT NOT NULL,
                             product_id INT NOT NULL,
                             quantity INT NOT NULL,
                             price DECIMAL(10, 2) NOT NULL,
                             PRIMARY KEY (id),
                             FOREIGN KEY (order_id) REFERENCES Order_Details(id),
                             FOREIGN KEY (product_id) REFERENCES Product(id)
);

-- Create Payment Details Table
CREATE TABLE Payment_Details (
                                 id INT NOT NULL AUTO_INCREMENT,
                                 order_id INT NOT NULL,
                                 card_number VARCHAR(16) NOT NULL,
                                 card_expiry VARCHAR(7) NOT NULL,
                                 PRIMARY KEY (id),
                                 FOREIGN KEY (order_id) REFERENCES Order_Details(id)
);


-- Insert into User table
INSERT INTO User (username, email, password,isadmin) VALUES ('saleh', 'saleh@gmail.com', 'Ss123456@',true);
INSERT INTO User (username, email, password,isadmin) VALUES ('ayman', 'ayman@gmail.com', 'Ss123456@',false);

-- Insert into User_Payment table
INSERT INTO User_Payment (user_id, card_number, card_expiry) VALUES (1, '1234567812345678', '05/25');
INSERT INTO User_Payment (user_id, card_number, card_expiry) VALUES (2, '8765432187654321', '09/24');

-- Insert into User_Address table
INSERT INTO User_Address (user_id, street_address, city, state, zip_code) VALUES (1, '123 Main St', 'Anytown', 'CA', '12345');
INSERT INTO User_Address (user_id, street_address, city, state, zip_code) VALUES (2, '456 Oak Ave', 'Someville', 'NY', '56789');

-- Insert into Product table
INSERT INTO Product (name, description, price, image_url) VALUES ('Product 1', 'Description for Product 1', 19.99, 'img1.jpg');
INSERT INTO Product (name, description, price, image_url) VALUES ('Product 2', 'Description for Product 2', 29.99, 'img2.jpg');

-- Insert into Product_Inventory table
INSERT INTO Product_Inventory (product_id, quantity) VALUES (1, 100);
INSERT INTO Product_Inventory (product_id, quantity) VALUES (2, 50);

-- Insert into Product_Category table
INSERT INTO Product_Category (product_id, category_name) VALUES (1, 'Category 1');
INSERT INTO Product_Category (product_id, category_name) VALUES (2, 'Category 2');

-- Insert into Order_Details table
INSERT INTO Order_Details (user_id, order_date, total_amount) VALUES (1, '2023-05-09 12:00:00', 19.99);
INSERT INTO Order_Details (user_id, order_date, total_amount) VALUES (2, '2023-05-08 15:30:00', 59.98);

-- Insert into Order_Items table
INSERT INTO Order_Items (order_id, product_id, quantity, price) VALUES (1, 1, 1, 19.99);
INSERT INTO Order_Items (order_id, product_id, quantity, price) VALUES (2, 1, 2, 39.98);
INSERT INTO Order_Items (order_id, product_id, quantity, price) VALUES (2, 2, 1, 29.99);

-- Insert into Payment_Details table
INSERT INTO Payment_Details (order_id, card_number, card_expiry) VALUES (1, '1234567812345678', '05/25');
INSERT INTO Payment_Details (order_id, card_number, card_expiry) VALUES (2, '8765432187654321', '09/24');