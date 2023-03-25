-- creating admin table;
CREATE TABLE IF NOT EXISTS administrator(
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(2550) NOT NULL,
    proImage VARCHAR(255) NOT NULL
);

-- Inserting admin details
INSERT INTO
    administrator (name, email, password, proImage)
SELECT
    'Admin',
    'admin@shop.com',
    '21232f297a57a5a743894a0e4a801fc3',
    '/uploads/default.jpeg'
WHERE
    NOT EXISTS (
        SELECT
            1
        FROM
            administrator
        WHERE
            email = 'admin@shop.com'
    );