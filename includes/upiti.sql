CREATE TABLE nosilac_osiguranja (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ime_prezime VARCHAR(255) NOT NULL,
    datum_rodjenja DATE NOT NULL,
    broj_pasosa VARCHAR(50) NOT NULL,
    telefon VARCHAR(20),
    email VARCHAR(255) NOT NULL,
    datum_putovanja DATE NOT NULL,
    datum_povratka DATE NOT NULL,
    vrsta_osiguranja VARCHAR(20) NOT NULL
);

CREATE TABLE dodatni_osiguranici (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nosilac_osiguranja_id INT NOT NULL,
    ime_prezime VARCHAR(255) NOT NULL,
    datum_rodjenja DATE NOT NULL,
    broj_pasosa VARCHAR(50) NOT NULL,
    FOREIGN KEY (nosilac_osiguranja_id) REFERENCES nosilac_osiguranja(id)
);