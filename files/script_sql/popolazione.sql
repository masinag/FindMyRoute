use itinerariInBicicletta;

delete from itinerari;
delete from apertiIn;
delete from orari;
delete from puntiSignificativi;
delete from localita;
delete from province;

insert into province(id, sigla, nome) values
    (1, "TN", "Trento"),
    (2, "BZ", "Bolzano"),
    (3, "VI", "Vicenza");

insert into localita(id, CAP, nome, idProvincia) values
    (1, 39040, "Salorno",            2),
    (2, 38060, "Borghetto",          1),
    (3, 38057, "San Cristoforo",     1),
    (4, 36061, "Bassano del Grappa", 3),
    (5, 38050, "Imer",               1),
    (6, 38054, "Fiera di Primiero",  1),
    (7, 38024, "Cogolo di Pejo",     1),
    (8, 38020, "Mostizzolo",         1);

insert into puntiSignificativi(id, nome, tipo, sitoWeb, latitudine, longitudine, idLocalita) values
    (1, "Confine con la Provincia di Bolzano", "altro",     null, 46.231029, 11.176574, 1),
    (2, "Confine con la provincia di Verona",  "altro",     null, 45.699304, 10.925329, 2),
    (3, "Stazione FS San Cristoforo - Ischia", "altro",     null, 46.039763, 11.234038, 3),
    (4, "Centro storico Bassano del Grappa", "interesse",   null, 45.768103, 11.730397, 4),
    (5, "Rotonda di Imer",                     "altro",     null, 46.147452, 11.795902, 5),
    (6, "Centro storico di Fiera di Primiero", "interesse", null, 46.175914, 11.831815, 6),
    (7, "Strada Provinciale 87",                "altro",    null, 46.349270, 10.693864, 7),
    (8, "Ponte di Mostizzolo",                  "altro",    null, 46.392959, 11.013063, 8);

insert into itinerari (id, nome, descrizione, lunghezza, tempoPercorrenza, difficolta,
    infoUtili, tracciaGPS, idPuntoPartenza, idPuntoArrivo) values
    (1, "Pista ciclabile Valle dell'Adige",
    "La pista collega il nord e il sud del Trentino Alto Adige e la provincia di Verona con quella di Bolzano. Si sviluppa sia sulla riva destra che sinistra dell'Adige, sfruttando strade di campagna e arginali. È quasi interamente interdetta al traffico, eccetto rari mezzi agricoli che possono attraversarla per arrivare verso i campi coltivati. Il dislivello in qualsiasi dei due sensi di marcia è praticamente inesistente.
    La pista parte da poco più a sud di Bolzano ed è facilmente collegata con le altre piste ciclabili della zona ed in particolare con la ciclopista che parte da Vipiteno.
    Poco prima di arrivare al primo paese, San Michele all'Adige, esiste una variante che porta verso Mezzolombardo e Mezzocorona, denominata Teroldego di 7 chilometri. Continuando si raggiunge il paese di Nave di San Rocco, dove si riguadagna la sponda sinistra dell'Adige.
    Intorno al quindicesimo chilometro ci si discosta dal fiume per percorrere il centro della valle attraversando il biotopo Foci dell'Avisio.
    La pista ciclabile prosegue costeggiando la città di Trento. Si raggiungono quindi i comuni di Mattarello, Besenello e Calliano. A questo punto si riattraversa l'Adige per portarsi verso il paese di Nomi.
    Proseguendo si attraversa Rovereto, arrivando così a superare i 50 chilometri complessivi. Si riattraversa, poi, il fiume Adige sulla diga di Mori, da non molto lontano parte la pista ciclabile Rovereto-Lago di Garda. Da questo momento si costeggia la ferrovia del Brennero fino ad arrivare ala frazione di Chizzola (Ala).
    Ora si prosegue verso il comune di Avio, dominato dal castello di Sabbionara, gli ultimi 5 chilometri si percorrono tutti sull'argine dell'Adige, fino ad arrivare a Borghetto in corrispondenza del confine con la provincia di Verona.
    Bicigrill, strutture di ristoro dedicate ai ciclisti, sono presenti nei pressi di Ora, Salorno, Trento, Nomi e Avio.",
    80.68, "07:00:00", "1", null, "1.gpx", 1, 2),

    (2, "Ciclopista della Valsugana",
    "La ciclopista della Valsugana, che collega il cristallino Lago di Caldonazzo con la splendida Bassano del Grappa, è un vero e proprio paradiso per tutti gli appassionati delle due ruote a pedali: 80 km lungo i quali si intreccianocultura, storia e paesaggi naturali davvero unici a cavallo tra Trentino e Veneto. Due regioni legate da un passato storico condiviso e contraddistinte da un comune “elemento fluviale” che accarezza dolcemente il fondovalle: il fiume Brenta. Le sue acque vi accompagnano lungo un percorso facile, prevalentemente pianeggiante, adatto a tutti per trascorrere piacevoliore in libertà all’insegna dello sport e del contatto con la natura.",
    79.50, "06:17:00", "1", null, "2.gpx", 3, 4),

    (3, "Pista Ciclabile Primiero",
    "La pista parte da Imer e arriva ad Siror.   A caratterizzare il percorso è l'incantevole bellezza degli ambienti naturali: la strada è circondata da un cangiante paesaggio di boschi e prati, e sullo sfondo svettano grandi catene montuose tra cui il maestoso gruppo dolomitico delle Pale di S.Martino, che domina la valle. Non mancano lungo il percorso piccoli borghi immersi nel verde, casolari abbandonati ed antiche tracce della vita in montagna.
    Partenza da Masi di Imer, sull'argine del Torrente Cismon, che si segue ora su una, ora sull'altra sponda. Oltrepassato il paese di Mezzano, si attraversa un suggestivo tratto di bosco a ridosso della montagna, per poi uscire sui prati che conducono a Fiera di Primiero, capoluogo della valle. Nel centro del paese, dove il torrente Canali confluisce nel Cismon, la pista si divide in due formando un anello. Il percorso anulare passa per Transacqua e attraversa Tonadico lungo le strade del paese, per poi raggiungere Siror lungo la vecchia e poco trafficata strada di collegamento tra i due paesi. A Siror la pista ciclabile si porta nuovamente sulla sponda del torrente Cismon e lo segue fino a chiudere l'anello, a Fiera di Primiero.
    Nonostante la sua dimensione contenuta, la pista collega le località principali della valle. Dal tracciato è possibile poi raggiungere uno degli innumerevoli sentieri per mountain bike che si avventurano sulle montagne o nelle valli vicine.",
    10.76, "01:07:00", "1", null, "3.gpx", 5, 6),

    (4, "Pista Ciclabile Val di Sole",
    "La pista ciclabile della Val di Sole si sviluppa quasi per intero lungo il percorso dello spumeggiante Fiume Noce, per quasi 35 km, da Cogolo di Pejo a Fucine e quindi a Mostizzolo ricalcando il tracciato di antiche strade di collegamento o di strade arginali e di campagna. Il percorso non è impegnativo e copre un dislivello complessivo di 565 metri in discesa.
    Si possono scegliere vari percorsi ed utilizzare il treno Dolomiti Express e il Bici Bus, appositamente attrezzati per il trasporto delle bici, per integrare gli itinerari o risalire comodamente dal fondovalle. Le biciclette sono noleggiabili presso i numerosi noleggi presenti in tutta la valle.",
    33.80, "03:00:00", "2", null, "4.gpx", 7, 8);

insert into immagini (id, path, idItinerario) values
    (1, "1_1.jpg", 1),
    (2, "1_2.jpg", 1),
    (3, "1_3.jpg", 1),
    (4, "1_4.jpg", 1),
    (5, "2_1.jpg", 2),
    (6, "2_2.jpg", 2),
    (7, "3_1.jpg", 3),
    (8, "3_2.jpg", 3),
    (9, "4_1.jpg", 4),
    (10,"4_2.jpg", 4);
