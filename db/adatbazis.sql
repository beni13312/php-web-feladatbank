create database if not exists feladatbank character set utf8 collate utf8mb4_hungarian_ci;

use feladatbank;


create table if not exists admin_felhasznalok( -- admin felhasználók
    id int primary key auto_increment,
    fnev varchar(50) not null unique,
    jelszo varchar(80) not null,
    ido timestamp default current_timestamp
);

create table if not exists kategoria( -- kategória
    id int primary key auto_increment,
    nev varchar(50) not null unique
);

create table if not exists szint( -- nehézségi szint
    id int primary key auto_increment,
    szint varchar(50) not null unique
);


create table if not exists feladatok(
    id int primary key auto_increment,
    kat_id int not null,
    szint_id int not null,
    cim varchar(125) not null,
    leiras text,
    feladat text not null,
    ido timestamp default current_timestamp,
    foreign key (kat_id) references kategoria(id) on delete restrict,
    foreign key (szint_id) references szint(id) on delete restrict

);

create table if not exists megoldasok( -- megoldások
    id int primary key auto_increment,
    feladat_id int not null,
    megoldas text not null,
    ido timestamp default current_timestamp,
    foreign key (feladat_id) references feladatok(id) on delete restrict

);
