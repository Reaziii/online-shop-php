--creating user database
CREATE TABLE IF NOT EXISTS users(
    id int(10) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    address VARCHAR(100),
    proImage VARCHAR(100) NOT NULL DEFAULT "/uploads/user.svg",
    role VARCHAR(10) NOT NULL DEFAULT "member",
    PRIMARY KEY(id, email, phone)
);

CREATE TABLE IF NOT EXISTS catagories(
    id int(10) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    photo VARCHAR(100) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS products(
    id int(10) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(200),
    catagory int(10) NOT NULL,
    FOREIGN KEY (catagory) REFERENCES catagories(id),
    PRIMARY KEY(id),
    image VARCHAR(100) NOT NULL,
    price float(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS productImages(
    id int(10) NOT NULL AUTO_INCREMENT,
    productId int(10) NOT NULL,
    FOREIGN KEY(productId) REFERENCES products(id),
    file_name VARCHAR(200) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS cart(
    id int(100) NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(id),
    productId int(10) NOT NULL,
    FOREIGN KEY(productId) REFERENCES products(id),
    userid int(10) NOT NULL,
    FOREIGN KEY(userid) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS orders(
    turn_id VARCHAR(100) NOT NULL,
    status VARCHAR(100) NOT NULL DEFAULT "pending",
    address VARCHAR(100) NOT NULL,
    userid int(10) NOT NULL,
    FOREIGN KEY(userid) REFERENCES users(id),
    phone VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    notes VARCHAR(100),
    order_date DATE NOT NULL,
    PRIMARY key(turn_id)
);

CREATE TABLE IF NOT EXISTS orderedProducts(
    orderid VARCHAR(100) NOT NULL,
    FOREIGN KEY(orderid) REFERENCES orders(turn_id),
    productId int(10) NOT NULL,
    FOREIGN key(productId) REFERENCES products(id)
);

CREATE TABLE IF NOT EXISTS orderSession(
    orderid VARCHAR(100) NOT NULL,
    FOREIGN KEY(orderid) REFERENCES orders(turn_id),
    session VARCHAR(1000)
);