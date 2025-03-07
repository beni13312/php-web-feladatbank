-- összess mező
select kategoria.kategoria, feladat.kerdes, valaszok.valasz, megoldasok.megoldas
from feladatbank.kategoria,feladatbank.feladat, feladatbank.valaszok, feladatbank.megoldasok, feladatbank.feladat_valasz, feladatbank.feladat_megoldas
where kategoria.id = feladat.kat_id and
      feladat.id = feladat_valasz.feladat_id and
      feladat.id = feladat_megoldas.feladat_id and
      feladat_valasz.valasz_id = valaszok.id and
      feladat_megoldas.megoldas_id = megoldasok.id;

-- feladat lekérdezés
-- 6 = Python
select feladat.id, feladat.kerdes, valaszok.valasz, megoldasok.megoldas
from feladatbank.feladat, feladatbank.valaszok, feladatbank.megoldasok, feladatbank.feladat_valasz, feladatbank.feladat_megoldas
where feladat.kat_id=6 and
      feladat.id = feladat_valasz.feladat_id and
      feladat.id = feladat_megoldas.feladat_id and
      feladat_valasz.valasz_id = valaszok.id and
      feladat_megoldas.megoldas_id = megoldasok.id
order by feladat.id ASC;

-- kerdések
-- 6 = Python
select feladat.id, feladat.kerdes
from feladatbank.feladat
where feladat.kat_id=6
order by feladat.id ASC;

-- válaszok
-- 6 = Python
select feladat.id,valaszok.valasz
from feladatbank.feladat, feladatbank.valaszok, feladatbank.feladat_valasz
where feladat.kat_id=6 and
      feladat.id = feladat_valasz.feladat_id and
      feladat_valasz.valasz_id = valaszok.id
order by feladat.id ASC;

-- megoldások
-- 6 = Python
select feladat.id, megoldasok.megoldas
from feladatbank.feladat, feladatbank.megoldasok, feladatbank.feladat_megoldas
where feladat.kat_id=6 and
      feladat.id = feladat_megoldas.feladat_id and
      feladat_megoldas.megoldas_id = megoldasok.id
order by feladat.id ASC;

-- csak válaszok
SELECT valaszok.id, valaszok.valasz
FROM feladat, valaszok, feladat_valasz
WHERE feladat.kat_id = ? AND
    feladat.id = ? AND
    feladat_valasz.feladat_id = feladat.id AND
    feladat_valasz.valasz_id = valaszok.id