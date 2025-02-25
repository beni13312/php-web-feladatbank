
select kategoria.kategoria, feladat.kerdes, valaszok.valasz, megoldasok.megoldas
from feladatbank.kategoria,feladatbank.feladat, feladatbank.valaszok, feladatbank.megoldasok, feladatbank.feladat_valasz, feladatbank.feladat_megoldas
where kategoria.id = feladat.kat_id and
      feladat.id = feladat_valasz.feladat_id and
      feladat.id = feladat_megoldas.feladat_id and
      feladat_valasz.valasz_id = valaszok.id and
      feladat_megoldas.megoldas_id = megoldasok.id
