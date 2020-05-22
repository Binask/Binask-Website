CREATE TABLE Artikelen (
                           id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                           ArtikelTitel mediumtext NOT NULL,
                           ArtikelSamenvatting mediumtext NOT NULL,
                           ArtikelLink mediumtext NOT NULL,
                           ArtikelRank int(11) NOT NULL,
                           category_id int(11) NOT NULL,
                           FOREIGN KEY (category_id) REFERENCES category(category_id)
);