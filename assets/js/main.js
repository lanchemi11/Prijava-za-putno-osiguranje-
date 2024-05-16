const vrsta_osiguranja = document.getElementById("vrstaOsiguranja");
if (vrsta_osiguranja) {
  vrsta_osiguranja.addEventListener("change", function () {
    const dodatniOsiguranici = document.getElementById("dodatniOsiguranici");
    if (this.value === "grupno") {
      dodatniOsiguranici.style.display = "block";
    } else {
      dodatniOsiguranici.style.display = "none";
    }
  });
}

const dodaj_osiguranika = document.getElementById("dodajOsiguranika");
if (dodaj_osiguranika) {
  dodaj_osiguranika.addEventListener("click", function () {
    const dodatniOsiguranici = document.getElementById("dodatniOsiguranici");
    const noviOsiguranik = `
        <div class="mb-3">
            <label for="imePrezimeDodatni" class="form-label">Ime i Prezime</label>
            <input type="text" class="form-control" name="imePrezimeDodatni[]">
        </div>
        <div class="mb-3">
            <label for="datumRodjenjaDodatni" class="form-label">Datum rođenja</label>
            <input type="date" class="form-control" name="datumRodjenjaDodatni[]">
        </div>
        <div class="mb-3">
            <label for="brojPasosaDodatni" class="form-label">Broj pasoša</label>
            <input type="text" class="form-control" name="brojPasosaDodatni[]">
        </div>
    `;
    dodatniOsiguranici.insertAdjacentHTML("beforeend", noviOsiguranik);
  });
}
