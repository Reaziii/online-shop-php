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