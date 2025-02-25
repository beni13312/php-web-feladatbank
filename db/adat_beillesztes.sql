use feladatbank;

/* Példa:
   Python:
   Mi a jele az egysoros kommentnek?
   lehettséges válaszok: // # --
   megoldás: #
   */


set @kategoria = 'Python';
set @valasz1 = '//';
set @valasz2 = '#';
set @valasz3 = '--';
set @kerdes = 'Mi a jele az egysoros kommentnek?';
set @megoldas = '#';

insert into valaszok (valasz) values (@valasz1),(@valasz2),(@valasz3); -- választási lehetőségek

insert into megoldasok (megoldas) value (@megoldas); -- megoldás/megoldások

insert into feladat (kat_id, kerdes) values (
                (select kategoria.id from kategoria where kategoria.kategoria = @kategoria),@kerdes);

insert into feladat_valasz (feladat_id, valasz_id) VALUES
                        (
                        (select feladat.id from feladat where kerdes = @kerdes),
                        (select valaszok.id from valaszok where valasz = @valasz1)
                        ),                        (
                        (select feladat.id from feladat where kerdes = @kerdes),
                        (select valaszok.id from valaszok where valasz = @valasz2)
                        ),                        (
                        (select feladat.id from feladat where kerdes = @kerdes),
                        (select valaszok.id from valaszok where valasz = @valasz3)
                        );
insert into feladat_megoldas (feladat_id, megoldas_id) VALUES (
                        (select feladat.id from feladat where kerdes=@kerdes),
                        (select megoldasok.id from megoldasok where megoldas= @megoldas)
                        );