create table session_db( -- session tábla létrehozása
    session_id varchar(256) primary key not null,
    session_data varchar(1024)
) engine = memory; -- recordok tárolása memóriában a gyorsabb lekérdezésért

insert into session_db(session_id, session_data) VALUES ('test2', '2');

select * from session_db
