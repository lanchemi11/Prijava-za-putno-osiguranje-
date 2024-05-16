<?php
session_start();
$title = "Dodaj polisu";
include "./includes/header.php";
include "./includes/navbar.html";

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];

unset($_SESSION['errors']);
unset($_SESSION['form_data']);
?>

<section class="section section-form">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <form action="includes/dodajPolisu.php" method="POST">
                <div class="mb-3">
                    <label for="ime_prezime" class="form-label">Nosilac osiguranja (Ime i Prezime)</label>
                    <input type="text" class="form-control" id="imePrezime" name="ime_prezime" value="<?= htmlspecialchars($formData['ime_prezime'] ?? '') ?>" required>
                    <?php if (isset($errors['ime_prezime'])): ?>
                        <div class="text-danger"><?= $errors['ime_prezime'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="datum_rodjenja" class="form-label">Datum rođenja</label>
                    <input type="date" class="form-control" id="datumRodjenja" name="datum_rodjenja" value="<?= htmlspecialchars($formData['datum_rodjenja'] ?? '') ?>" required>
                    <?php if (isset($errors['datum_rodjenja'])): ?>
                        <div class="text-danger"><?= $errors['datum_rodjenja'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="broj_pasosa" class="form-label">Broj pasoša</label>
                    <input type="text" class="form-control" id="brojPasosa" name="broj_pasosa" value="<?= htmlspecialchars($formData['broj_pasosa'] ?? '') ?>" required>
                    <?php if (isset($errors['broj_pasosa'])): ?>
                        <div class="text-danger"><?= $errors['broj_pasosa'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="telefon" class="form-label">Telefon</label>
                    <input type="tel" class="form-control" id="telefon" name="telefon" value="<?= htmlspecialchars($formData['telefon'] ?? '') ?>">
                    <?php if (isset($errors['telefon'])): ?>
                        <div class="text-danger"><?= $errors['telefon'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($formData['email'] ?? '') ?>" required>
                    <?php if (isset($errors['email'])): ?>
                        <div class="text-danger"><?= $errors['email'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="datum_putovanja" class="form-label">Datum putovanja</label>
                    <input type="date" class="form-control" id="datumPutovanja" name="datum_putovanja" value="<?= htmlspecialchars($formData['datum_putovanja'] ?? '') ?>" required>
                    <?php if (isset($errors['datum_putovanja'])): ?>
                        <div class="text-danger"><?= $errors['datum_putovanja'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="datum_povratka" class="form-label">Datum povratka</label>
                    <input type="date" class="form-control" id="datumPovratka" name="datum_povratka" value="<?= htmlspecialchars($formData['datum_povratka'] ?? '') ?>" required>
                    <?php if (isset($errors['datum_povratka'])): ?>
                        <div class="text-danger"><?= $errors['datum_povratka'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="vrsta_osiguranja" class="form-label">Odabir vrste polise osiguranja (individualno ili grupno)</label>
                    <select class="form-select" id="vrstaOsiguranja" name="vrsta_osiguranja">
                        <option value="individualno" <?= isset($formData['vrsta_osiguranja']) && $formData['vrsta_osiguranja'] === 'individualno' ? 'selected' : '' ?>>Individualno</option>
                        <option value="grupno" <?= isset($formData['vrsta_osiguranja']) && $formData['vrsta_osiguranja'] === 'grupno' ? 'selected' : '' ?>>Grupno</option>
                    </select>
                    <?php if (isset($errors['vrsta_osiguranja'])): ?>
                        <div class="text-danger"><?= $errors['vrsta_osiguranja'] ?></div>
                    <?php endif; ?>
                </div>

                <!-- Polja za dodatne osiguranike (grupno osiguranje) -->
                <div id="dodatniOsiguranici">
                    <h2>Dodatni osiguranici</h2>
                    <div class="mb-3">
                        <label for="imePrezimeDodatni" class="form-label">Ime i Prezime</label>
                        <input type="text" class="form-control" id="imePrezimeDodatni" name="imePrezimeDodatni[]">
                    </div>
                    <div class="mb-3">
                        <label for="datumRodjenjaDodatni" class="form-label">Datum rođenja</label>
                        <input type="date" class="form-control" id="datumRodjenjaDodatni" name="datumRodjenjaDodatni[]">
                    </div>
                    <div class="mb-3">
                        <label for="brojPasosaDodatni" class="form-label">Broj pasoša</label>
                        <input type="text" class="form-control" id="brojPasosaDodatni" name="brojPasosaDodatni[]">
                    </div>
                    
                    <button type="button" class="btn btn-primary mb-3 dodajOsiguranika" id="dodajOsiguranika">Dodaj osiguranika</button>
                </div>

                <button type="submit" class="btn btn-primary">Potvrdi</button>
            </form>
        </div>
    </div>
</section>

<?php
include "./includes/footer.php";
?>
