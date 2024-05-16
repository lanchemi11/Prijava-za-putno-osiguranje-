<?php
    session_start();

    $errors = [];

    // Validacija
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $imePrezime = trim($_POST['ime_prezime']);
        $datumRodjenja = $_POST['datum_rodjenja'];
        $brojPasosa = trim($_POST['broj_pasosa']);
        $telefon = trim($_POST['telefon']);
        $email = trim($_POST['email']);
        $datumPutovanja = $_POST['datum_putovanja'];
        $datumPovratka = $_POST['datum_povratka'];
        $vrstaOsiguranja = $_POST['vrsta_osiguranja'];

        if (empty($imePrezime)) {
            $errors['ime_prezime'] = "Ime i prezime je obavezno.";
        } elseif (preg_match('/[0-9]/', $imePrezime)) {
            $errors['ime_prezime'] = "Ime i prezime ne sme sadrzati brojeve.";
        }
    
        if (empty($datumRodjenja)) {
            $errors['datum_rodjenja'] = "Datum rođenja je obavezan.";
        }

        if (empty($brojPasosa)) {
            $errors['broj_pasosa'] = "Broj pasoša je obavezan.";
        }

        if (empty($email)) {
            $errors['email'] = "Email je obavezan.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Neispravan format email adrese.";
        }

        if (empty($datumPutovanja)) {
            $errors['datum_putovanja'] = "Datum putovanja je obavezan.";
        }

        if (empty($datumPovratka)) {
            $errors['datum_povratka'] = "Datum povratka je obavezan.";
        }

        if (!empty($datumPutovanja) && !empty($datumPovratka) && $datumPutovanja > $datumPovratka) {
            $errors['datum_povratka'] = "Datum povratka mora biti nakon datuma putovanja.";
        }

        if (empty($vrstaOsiguranja)) {
            $errors['vrsta_osiguranja'] = "Vrsta osiguranja je obavezna.";
        }

        if (count($errors) === 0) {
            try {
                require_once "dbh.inc.php";

                $sql = "INSERT INTO nosilac_osiguranja (ime_prezime, datum_rodjenja, broj_pasosa, telefon, email, datum_putovanja, datum_povratka, vrsta_osiguranja) 
                        VALUES (:imePrezime, :datumRodjenja, :brojPasosa, :telefon, :email, :datumPutovanja, :datumPovratka, :vrstaOsiguranja)";

                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':imePrezime', $imePrezime);
                $stmt->bindParam(':datumRodjenja', $datumRodjenja);
                $stmt->bindParam(':brojPasosa', $brojPasosa);
                $stmt->bindParam(':telefon', $telefon);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':datumPutovanja', $datumPutovanja);
                $stmt->bindParam(':datumPovratka', $datumPovratka);
                $stmt->bindParam(':vrstaOsiguranja', $vrstaOsiguranja);

                $stmt->execute();

                // Dobijanje ID-a poslednjeg unetog reda
                $nosilacOsiguranjaId = $pdo->lastInsertId();

                if ($vrstaOsiguranja === 'grupno') {
                    $datumRodjenjaDodatni = $_POST['datumRodjenjaDodatni'];
                    $brojPasosaDodatni = $_POST['brojPasosaDodatni'];
                    
                    $sqlDodatni = "INSERT INTO dodatni_osiguranici (nosilac_osiguranja_id, ime_prezime, datum_rodjenja, broj_pasosa) 
                                VALUES (:nosilacOsiguranjaId, :imePrezime, :datumRodjenja, :brojPasosa)";
                    $stmtDodatni = $pdo->prepare($sqlDodatni);

                    foreach ($_POST['imePrezimeDodatni'] as $key => $imePrezimeDodatni) {
                        if (empty($imePrezimeDodatni) || empty($datumRodjenjaDodatni[$key]) || empty($brojPasosaDodatni[$key])) {
                            continue;
                        }

                        $stmtDodatni->bindParam(':nosilacOsiguranjaId', $nosilacOsiguranjaId);
                        $stmtDodatni->bindParam(':imePrezime', $imePrezimeDodatni);
                        $stmtDodatni->bindParam(':datumRodjenja', $datumRodjenjaDodatni[$key]);
                        $stmtDodatni->bindParam(':brojPasosa', $brojPasosaDodatni[$key]);
                        $stmtDodatni->execute();
                    }
                }

                header("Location: ../polise.php");
                exit;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            header("Location: ../index.php");
            exit;
        }
    }
?>
