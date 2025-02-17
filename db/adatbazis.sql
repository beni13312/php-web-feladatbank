create database if not exists feladatbank character set utf8 collate utf8mb3_hungarian_ci;

use feladatbank;


create table if not exists felhasznalok(
    id int primary key auto_increment,
    fnev varchar(50) not null unique,
    jelszo varchar(500) not null,
    ido timestamp default current_timestamp
);

create table if not exists kategoria(
    id int primary key auto_increment,
    nev varchar(50) not null unique
);

create table if not exists szint(
    id int primary key auto_increment,
    szint varchar(50) not null unique
);

create table if not exists feladatsor_feladat(
    feladat_id int not null,
    feladatsor_id int not null
);

create table if not exists feladatok(
    id int primary key auto_increment,
    kat_id int not null,
    szint_id int not null,
    cim varchar(125) not null,
    leiras text,
    ido timestamp default current_timestamp

);

create table if not exists feladatsor(
    id int primary key auto_increment,
    szint_id int not null,
    cim varchar(125) not null,
    feladat text not null,
    ido timestamp default current_timestamp

);
create table if not exists megoldasok(
    id int primary key auto_increment,
    feladat_id int not null,
    megoldas text not null,
    ido timestamp default current_timestamp
);
