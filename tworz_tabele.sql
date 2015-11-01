create table wiadomosci (
    id serial primary key,
    kiedy timestamp not null default current_timestamp,
    kto text,
    tresc text
);

create table obejrzenia (
    id serial primary key,
    kiedy timestamp not null default current_timestamp,
    kto text,
    ip text
);

insert into wiadomosci (kto, tresc) values ('Piotrek', 'Dzień dobry, Ulu!');
