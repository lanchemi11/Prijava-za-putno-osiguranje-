<?php
try {
    require_once "./includes/dbh.inc.php";

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $sql_polisa = "SELECT * FROM nosilac_osiguranja WHERE id = :id";
        $stmt_polisa = $pdo->prepare($sql_polisa);
        $stmt_polisa->bindParam(':id', $_GET['id']);
        $stmt_polisa->execute();
        $polisa = $stmt_polisa->fetch(PDO::FETCH_ASSOC);
        
        if (!$polisa) {
            echo "Nije pronađena polisa sa datim ID-em.";
            exit;
        }

        $sql_dodatni = "SELECT * FROM dodatni_osiguranici WHERE nosilac_osiguranja_id = :id";
        $stmt_dodatni = $pdo->prepare($sql_dodatni);
        $stmt_dodatni->bindParam(':id', $_GET['id']);
        $stmt_dodatni->execute();
        $dodatni_osiguranici = $stmt_dodatni->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Nije prosleđen ID polise.";
        exit;
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<?php
    $title = "Grupne polise";
    include "./includes/header.php";
    include "./includes/navbar.html";
?>
    <section class="section section-prikaz_grupne_polise">
        <div class="container">
            <div class="row">
                <h1 class="mb-5">Detalji grupne polise</h1>
        
                <table class="table">
                    <h2 class="mb-3">Podaci o nosiocu osiguranja</h2>
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
                                <td><?= $polisa['ime_prezime']; ?></td>
                                <td><?= $polisa['datum_rodjenja']; ?></td>
                                <td><?= $polisa['broj_pasosa']; ?></td>
                                <td><?= $polisa['telefon']; ?></td>
                                <td><?= $polisa['email']; ?></td>
                                <td><?= $polisa['datum_putovanja']; ?></td>
                                <td><?= $polisa['datum_povratka']; ?></td>
                                <td>
                                    <?php
                                        $datum_od = new DateTime($polisa['datum_putovanja']);
                                        $datum_do = new DateTime($polisa['datum_povratka']);
                                        $interval = $datum_od->diff($datum_do);
                                        $broj_dana = $interval->days;
                                        echo $broj_dana;
                                    ?>
                                </td>
                                <td>Grupno</td>
                            </tr>
                    </tbody>
                </table>

                <h2 class="mt-5 mb-3">Podaci o dodatnim osiguranicima</h2>
                <?php if ($dodatni_osiguranici): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Ime i prezime</th>
                                <th>Datum rođenja</th>
                                <th>Broj pasoša</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dodatni_osiguranici as $dodatni): ?>
                                <tr>
                                    <td><?= $dodatni['ime_prezime']; ?></td>
                                    <td><?= $dodatni['datum_rodjenja']; ?></td>
                                    <td><?= $dodatni['broj_pasosa']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Nema dodatnih osiguranika za ovu polisu.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>    
<?php
    include "./includes/footer.php";
?>
