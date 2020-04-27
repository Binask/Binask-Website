CREATE TABLE Artikelen (
                            id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                            ArtikelTitel mediumtext NOT NULL,
                            ArtikelSamenvatting mediumtext NOT NULL,
                            ArtikelLink mediumtext NOT NULL,
                            ArtikelCategorie mediumtext NOT NULL,
                            ArtikelRank int(4) DEFAULT '9999'
);