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
select feladat.id, feladat.kerdes
from feladatbank.feladat
where feladat.kat_id=6
order by feladat.id ASC;

-- válaszok
select feladat.id,valaszok.valasz
from feladatbank.feladat, feladatbank.valaszok, feladatbank.feladat_valasz
where feladat.kat_id=6 and
      feladat.id = feladat_valasz.feladat_id and
      feladat_valasz.valasz_id = valaszok.id
order by feladat.id ASC;

-- megoldások
select feladat.id, megoldasok.megoldas
from feladatbank.feladat, feladatbank.megoldasok, feladatbank.feladat_megoldas
where feladat.kat_id=6 and
      feladat.id = feladat_megoldas.feladat_id and
      feladat_megoldas.megoldas_id = megoldasok.id
order by feladat.id ASC;


-- a megoldások válasz id ja

select valaszok.id as 'valasz_id', megoldasok.megoldas as 'megoldas_str'
from feladat
join feladat_valasz on feladat.id = feladat_valasz.feladat_id
join feladat_megoldas on feladat.id = feladat_megoldas.feladat_id
join valaszok on feladat_valasz.valasz_id = valaszok.id
join megoldasok on feladat_megoldas.megoldas_id = megoldasok.id
where feladat.id = 6 and
      valaszok.valasz = megoldasok.megoldas;


select *
from feladat
join feladat_valasz on feladat.id = feladat_valasz.feladat_id
join feladat_megoldas on feladat.id = feladat_megoldas.feladat_id
join valaszok on feladat_valasz.valasz_id = valaszok.id
join megoldasok on feladat_megoldas.megoldas_id = megoldasok.id
where feladat.id = 6 and
      valaszok.valasz = megoldasok.megoldas