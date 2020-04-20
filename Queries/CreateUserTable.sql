CREATE TABLE user (
    user_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    firstname varchar(50) NOT NULL,
    lastname varchar(50) NOT NULL,
    email varchar(100) NOT NULL,
    password varchar(40) NOT NULL,
    usertype varchar(10) NOT NULL
)