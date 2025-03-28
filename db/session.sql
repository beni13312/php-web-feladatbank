create table session_db( -- session tábla létrehozása, recordok eltárolása memoriában a gyorsabb lekérdezésért
    session_id varchar(256) primary key not null unique,
    session_data varchar(1024),
    ip_address varchar(40),
    created_at timestamp default current_timestamp,
    expires_at timestamp not null
) engine = memory; -- recordok tárolása memóriában a gyorsabb lekérdezésért

alter table session_db add unique (session_id);
alter table session_db
    modify created_at timestamp default current_timestamp,
    add expires_at timestamp not null;

alter table session_db add column ip_address varchar(40);

insert into session_db(session_id, session_data) VALUES ('test2', '2');

select * from session_db;
SELECT @@global.time_zone, @@session.time_zone;
