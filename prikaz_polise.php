<?php
    try {
        require_once "./includes/dbh.inc.php";

        // Provera da li je prosleđen ID polise preko URL-a
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            // Priprema SQL upita za dohvatanje podataka o polisi sa datim ID-em
            $sql = "SELECT * FROM nosilac_osiguranja WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $_GET['id']);
            $stmt->execute();
            $polisa = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$polisa) {
                echo "Nije pronađena polisa sa datim ID-em.";
                exit;
            }
        } else {
            echo "Nije prosleđen ID polise.";
            exit;
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>

<?php
    $title = "Polisa";
    include "./includes/header.php";
    include "./includes/navbar.html";
?>
<section class="section section-prikaz_grupne_polise">
        <div class="container">
            <div class="row">
                <h1>Detalji polise</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ime i prezime</th>
                            <th>Datum rođenja</th>
                            <th>Broj pasoša</th>
                            <th>Telefon</th>
                            <th>Email</th>
                            <th>Datum putovanja</th>
                            <th>Datum povratka</th>
                            <th>Broj dana</th>
                            <th>Vrsta osiguranja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= htmlspecialchars($polisa['ime_prezime']); ?></td>
                            <td><?= htmlspecialchars($polisa['datum_rodjenja']); ?></td>
                            <td><?= htmlspecialchars($polisa['broj_pasosa']); ?></td>
                            <td><?= htmlspecialchars($polisa['telefon']); ?></td>
                            <td><?= htmlspecialchars($polisa['email']); ?></td>
                            <td><?= htmlspecialchars($polisa['datum_putovanja']); ?></td>
                            <td><?= htmlspecialchars($polisa['datum_povratka']); ?></td>
                            <td>
                                <?php
                                    $datum_od = new DateTime($polisa['datum_putovanja']);
                                    $datum_do = new DateTime($polisa['datum_povratka']);
                                    $interval = $datum_od->diff($datum_do);
                                    $broj_dana = $interval->days;
                                    echo $broj_dana;
                                ?>
                            </td>
                            <td>
                                <?php
                                    if ($polisa['vrsta_osiguranja'] === 'grupno') {
                                        echo '<a href="prikaz_grupne_polise.php?id=' . htmlspecialchars($polisa['id']) . '">Grupno</a>';
                                    } else {
                                        echo 'Individualno';
                                    }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</section>
<?php
    include "./includes/footer.php";
?>
