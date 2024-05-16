<?php
    try {
        require_once "./includes/dbh.inc.php";

        $sql = "SELECT * FROM nosilac_osiguranja";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $polise = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>

<?php
    $title = "Polise";
    include "./includes/header.php";
    include "./includes/navbar.html";
?>

    <section class="section section-polise">
        <div class="container">
            <div class="row">
                <h1 class="mt-3">Polise</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ime i Prezime</th>
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
                        <?php foreach ($polise as $polisa): ?>
                            <tr>
                                <td><a href="prikaz_polise.php?id=<?= $polisa['id']; ?>"><?= $polisa['ime_prezime']; ?></a></td>
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
                                <td>
                                    <?php
                                    if ($polisa['vrsta_osiguranja'] === 'grupno') {
                                        echo '<a href="prikaz_grupne_polise.php?id=' . $polisa['id'] . '">Grupno</a>';
                                    } else {
                                        echo 'Individualno';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php
    include "./includes/footer.php";
?>
