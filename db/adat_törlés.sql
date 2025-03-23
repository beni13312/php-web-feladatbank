use feladatbank;

delete from feladat_valasz
where feladat_id = (select feladat.id from feladat where feladat.kerdes = 'Mi a helyes mód egy szöveg kiíratására PHP-ban?');

delete from feladat_megoldas
where feladat_id = (select feladat.id from feladat where feladat.kerdes = 'Mi a helyes mód egy szöveg kiíratására PHP-ban?');

delete from feladat
where kerdes = 'Mi a helyes mód egy szöveg kiíratására PHP-ban?';
