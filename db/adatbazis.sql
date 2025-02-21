create database if not exists feladatbank character set utf8 collate utf8mb4_hungarian_ci;

use feladatbank;


create table if not exists admin_felhasznalok( -- admin felhasználók
    id int primary key auto_increment,
    fnev varchar(50) not null unique,
    jelszo varchar(80) not null,
    ido timestamp default current_timestamp
);

create table if not exists kategoria( -- kategória pl.: hálózat
    id int primary key auto_increment,
    kategoria varchar(50) not null unique,
    ido timestamp default current_timestamp
);

create table if not exists szint( -- nehézségi szint pl.: alapszint
    id int primary key auto_increment,
    szint varchar(50) not null unique,
    ido timestamp default current_timestamp
);


create table if not exists feladat_csoport( -- belső csoportosítás pl.: Python
    id int primary key auto_increment,
    kat_id int not null,
    csoport varchar(50) not null unique ,
    ido timestamp default current_timestamp,
    foreign key (kat_id) references kategoria(id) on delete cascade
);

create table if not exists feladatok( -- feladatok
    id int primary key auto_increment,
    kat_id int not null,
    szint_id int not null,
    csoport_id int not null,
    cim varchar(125) not null,
    leiras text,
    feladat text not null,
    ido timestamp default current_timestamp,
    foreign key (kat_id) references kategoria(id) on delete cascade,
    foreign key (szint_id) references szint(id) on delete cascade,
    foreign key (csoport_id) references feladat_csoport(id) on delete cascade

);

create table if not exists megoldasok( -- megoldások
    id int primary key auto_increment,
    feladat_id int not null,
    megoldas text not null,
    ido timestamp default current_timestamp,
    foreign key (feladat_id) references feladatok(id) on delete cascade

);
