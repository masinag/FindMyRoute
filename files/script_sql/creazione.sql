drop database if exists itinerariInBicicletta;
create database itinerariInBicicletta;
use itinerariInBicicletta;

create table utenti(
    id       int unsigned auto_increment not null,
    username varchar(20)  unique         not null,
    email    varchar(250) unique         not null,
    password varchar(30)                 not null,

    primary key(id)
) engine = innodb;

create table province(
    id      int unsigned auto_increment not null,
    sigla   varchar(2)   unique         not null,
    nome    varchar(20)  unique         not null,

    primary key (id)
) engine = innodb;

create table localita(
    id          int         unsigned auto_increment not null,
    CAP         int(5)      unsigned                not null,
    nome        varchar(50)                         not null,
    idProvincia int         unsigned                not null,

    primary key (id),
    foreign key (idProvincia) references province(id)
        on delete restrict
        on update cascade
) engine = innodb;

create table puntiSignificativi(
    id          int         unsigned auto_increment                 not null,
    nome        varchar(50)                                         not null,
    tipo        set("ristoro", "interesse", "riparazione", "altro") not null default "altro",
    sitoWeb     varchar(300),
    -- latitudine va da 0 a 180, teniamo 3 cifre intere e 15 decimali
    latitudine  decimal(18, 15)                                     not null,
    -- la longitudine va da 0 a 90, teniamo 2 cifre intere e 15 decimali
    longitudine decimal(17,15)                                      not null,
    idUtente    int unsigned,
    idLocalita  int unsigned                                        not null,

    primary key(id),

    foreign key (idUtente) references utenti(id)
        on delete set null
        on update cascade,
    foreign key (idLocalita) references localita(id)
        on delete restrict
        on update cascade
) engine = innodb;

create table itinerari(
    id               int unsigned auto_increment not null,
    nome             varchar(30)                 not null,
    descrizione      text                        not null,
    lunghezza        decimal(7,2)                not null,
    tempoPercorrenza time                        not null,
    difficolta       set("1","2","3","4","5")    not null,
    infoUtili        text,
    tracciaGPS       varchar(250)                not null,
    idUtente         int unsigned,
    idPuntoPartenza  int unsigned                not null,
    idPuntoArrivo    int unsigned                not null,

    primary key (id),
    foreign key (idUtente) references utenti(id)
        on delete set null
        on update cascade,
    foreign key (idPuntoPartenza) references puntiSignificativi(id)
        on delete restrict
        on update cascade,
    foreign key (idPuntoArrivo)   references puntiSignificativi(id)
        on delete restrict
        on update cascade
) engine = innodb;

create table immagini(
    id int unsigned auto_increment not null,
    path varchar(300) not null,
    idItinerario int unsigned not null,

    primary key(id),
    foreign key(idItinerario) references itinerari(id)
        on delete cascade
        on update cascade
) engine = innodb;

create table orari(
    id int unsigned auto_increment not null,
    giorno set("lun", "mar", "mer", "gio", "ven", "sab", "dom") not null,
    dalle time not null,
    alle time not null,

    primary key(id)
) engine = innodb;

create table valutatiDa(
    idItinerario int unsigned not null,
    idUtente     int unsigned not null,
    voto set("1", "2", "3", "4", "5") not null,
    recensione text,

    primary key (idItinerario, idUtente),

    foreign key (idItinerario) references itinerari(id)
        on delete cascade
        on update cascade,
    foreign key (idUtente) references utenti(id)
        on delete cascade
        on update cascade
) engine = innodb;

create table apertiIn(
    idPuntoSignificativo int unsigned not null,
    idOrario int unsigned not null,

    primary key (idPuntoSignificativo, idOrario),

    foreign key (idPuntoSignificativo) references puntiSignificativi(id)
        on delete restrict
        on update cascade,
    foreign key (idOrario) references orari(id)
        on delete restrict
        on update cascade
) engine = innodb;
