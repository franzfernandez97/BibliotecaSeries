-- Insertar Plataformas
INSERT INTO platforms (name) VALUES ('Amazon Prime Video');
INSERT INTO platforms (name) VALUES ('Netflix');
INSERT INTO platforms (name) VALUES ('Max HBO');
INSERT INTO platforms (name) VALUES ('Disney +');
INSERT INTO platforms (name) VALUES ('Apple TV');


-- Inserta Series
INSERT INTO series (title, synopsis, platformid) VALUES 
("Breaking Bad", "A high school chemistry teacher turns to cooking meth to secure his family’s future after a terminal diagnosis.", 1),
("Stranger Things", "A group of kids uncover supernatural forces and secret experiments while searching for their missing friend.", 2),
("The Witcher", "A monster hunter navigates a world of dangerous creatures, politics, and destiny.", 3),
("Game of Thrones", "Noble families vie for control of the Iron Throne in a land of dragons and intrigue.", 4),
("The Mandalorian", "A bounty hunter embarks on adventures in the Star Wars galaxy while protecting a mysterious child.", 5),
("The Boys", "A group of vigilantes fight against corrupt superheroes who abuse their powers.", 1),
("Friends", "Six friends navigate life, love, and laughter in New York City.", 2),
("The Office", "A mockumentary exploring the lives of employees at Dunder Mifflin, a paper company.", 3),
("Sherlock", "A modern take on the famous detective and his adventures solving crimes in London.", 4),
("Dark", "A small town is plagued by a time-travel conspiracy that spans several generations.", 5),
("Hannibal", "A psychiatrist and a criminal profiler form a complex and dangerous relationship.", 1),
("Mindhunter", "FBI agents develop criminal profiling techniques by interviewing serial killers.", 2),
("The Crown", "A dramatization of the reign of Queen Elizabeth II and the events that shaped modern Britain.", 3),
("Peaky Blinders", "A gangster family in post-WWI Birmingham fights to expand their criminal empire.", 4),
("Black Mirror", "An anthology series that examines the dark side of modern technology.", 5),
("House of Cards", "A ruthless politician and his wife manipulate their way to power in Washington, D.C.", 1),
("Vikings", "The legendary Norse hero Ragnar Lothbrok rises to power through raids and alliances.", 2),
("The Walking Dead", "Survivors of a zombie apocalypse struggle to stay alive and find hope.", 3),
("Narcos", "The rise and fall of Colombian drug lord Pablo Escobar and the Medellín Cartel.", 4),
("Better Call Saul", "The origin story of Jimmy McGill, a con artist turned lawyer, before becoming Saul Goodman.", 5);


-- Inserta Actores
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Bryan", "Cranston", '1956-03-07', "USA");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Aaron", "Paul", '1979-08-27', "USA");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Millie", "Bobby Brown", '2004-02-19', "UK");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("David", "Harbour", '1975-04-10', "USA");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Henry", "Cavill", '1983-05-05', "UK");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Anya", "Chalotra", '1996-07-21', "UK");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Kit", "Harington", '1986-12-26', "UK");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Emilia", "Clarke", '1986-10-23', "UK");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Pedro", "Pascal", '1975-04-02', "Chile");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Gina", "Carano", '1982-04-16', "USA");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Karl", "Urban", '1972-06-07', "New Zealand");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Antony", "Starr", '1975-10-25', "New Zealand");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Jennifer", "Aniston", '1969-02-11', "USA");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Courteney", "Cox", '1964-06-15', "USA");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Steve", "Carell", '1962-08-16', "USA");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Jenna", "Fischer", '1974-03-07', "USA");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Benedict", "Cumberbatch", '1976-07-19', "UK");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Martin", "Freeman", '1971-09-08', "UK");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Louis", "Hofmann", '1997-06-03', "Germany");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Lisa", "Vicari", '1997-02-11', "Germany");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Mads", "Mikkelsen", '1965-11-22', "Denmark");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Hugh", "Dancy", '1975-06-19', "UK");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Jonathan", "Groff", '1985-03-26', "USA");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Holt", "McCallany", '1963-09-03', "USA");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Claire", "Foy", '1984-04-16', "UK");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Matt", "Smith", '1982-10-28', "UK");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Cillian", "Murphy", '1976-05-25', "Ireland");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Helen", "McCrory", '1968-08-17', "UK");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Jesse", "Plemons", '1988-02-04', "USA");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Charlie", "Brooker", '1971-03-03', "UK");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Kevin", "Spacey", '1959-07-26', "USA");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Robin", "Wright", '1966-04-08', "USA");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Travis", "Fimmel", '1979-07-15', "Australia");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Katheryn", "Winnick", '1977-12-17', "Canada");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Andrew", "Lincoln", '1973-09-14', "UK");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Danai", "Gurira", '1978-02-14', "USA");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Wagner", "Moura", '1976-06-27', "Brazil");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Pedro", "Alonso", '1971-06-21', "Spain");
INSERT INTO actors (firstname, lastname, birthdate, nationality) VALUES ("Bob", "Odenkirk", '1962-10-22', "USA");

-- Insertar Actores_Series
INSERT INTO series_actors (idactor, idserie) VALUES (1, 1);
INSERT INTO series_actors (idactor, idserie) VALUES (2, 1);
INSERT INTO series_actors (idactor, idserie) VALUES (3, 1);
INSERT INTO series_actors (idactor, idserie) VALUES (4, 2);
INSERT INTO series_actors (idactor, idserie) VALUES (5, 2);
INSERT INTO series_actors (idactor, idserie) VALUES (6, 2);
INSERT INTO series_actors (idactor, idserie) VALUES (7, 3);
INSERT INTO series_actors (idactor, idserie) VALUES (8, 3);
INSERT INTO series_actors (idactor, idserie) VALUES (9, 4);
INSERT INTO series_actors (idactor, idserie) VALUES (10, 4);
INSERT INTO series_actors (idactor, idserie) VALUES (11, 4);
INSERT INTO series_actors (idactor, idserie) VALUES (12, 5);
INSERT INTO series_actors (idactor, idserie) VALUES (13, 5);
INSERT INTO series_actors (idactor, idserie) VALUES (14, 5);
INSERT INTO series_actors (idactor, idserie) VALUES (15, 6);
INSERT INTO series_actors (idactor, idserie) VALUES (16, 6);
INSERT INTO series_actors (idactor, idserie) VALUES (17, 7);
INSERT INTO series_actors (idactor, idserie) VALUES (18, 7);
INSERT INTO series_actors (idactor, idserie) VALUES (19, 7);
INSERT INTO series_actors (idactor, idserie) VALUES (20, 8);
INSERT INTO series_actors (idactor, idserie) VALUES (21, 8);
INSERT INTO series_actors (idactor, idserie) VALUES (22, 9);
INSERT INTO series_actors (idactor, idserie) VALUES (23, 9);
INSERT INTO series_actors (idactor, idserie) VALUES (24, 9);
INSERT INTO series_actors (idactor, idserie) VALUES (25, 10);
INSERT INTO series_actors (idactor, idserie) VALUES (26, 10);
INSERT INTO series_actors (idactor, idserie) VALUES (27, 11);
INSERT INTO series_actors (idactor, idserie) VALUES (28, 11);
INSERT INTO series_actors (idactor, idserie) VALUES (29, 11);
INSERT INTO series_actors (idactor, idserie) VALUES (30, 12);
INSERT INTO series_actors (idactor, idserie) VALUES (31, 12);
INSERT INTO series_actors (idactor, idserie) VALUES (32, 13);
INSERT INTO series_actors (idactor, idserie) VALUES (33, 13);
INSERT INTO series_actors (idactor, idserie) VALUES (34, 13);
INSERT INTO series_actors (idactor, idserie) VALUES (35, 14);
INSERT INTO series_actors (idactor, idserie) VALUES (36, 14);
INSERT INTO series_actors (idactor, idserie) VALUES (37, 15);
INSERT INTO series_actors (idactor, idserie) VALUES (38, 15);
INSERT INTO series_actors (idactor, idserie) VALUES (39, 16);
INSERT INTO series_actors (idactor, idserie) VALUES (1, 17);
INSERT INTO series_actors (idactor, idserie) VALUES (2, 17);
INSERT INTO series_actors (idactor, idserie) VALUES (3, 18);
INSERT INTO series_actors (idactor, idserie) VALUES (4, 18);
INSERT INTO series_actors (idactor, idserie) VALUES (5, 19);
INSERT INTO series_actors (idactor, idserie) VALUES (6, 19);
INSERT INTO series_actors (idactor, idserie) VALUES (7, 20);
INSERT INTO series_actors (idactor, idserie) VALUES (8, 20);

-- Insertar directores
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("David", "Fincher", '1962-08-28', "USA");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Christopher", "Nolan", '1970-07-30', "UK");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Steven", "Spielberg", '1946-12-18', "USA");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Greta", "Gerwig", '1983-08-04', "USA");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Quentin", "Tarantino", '1963-03-27', "USA");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Alfonso", "Cuarón", '1961-11-28', "Mexico");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Guillermo", "del Toro", '1964-10-09', "Mexico");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Patty", "Jenkins", '1971-07-24', "USA");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("James", "Cameron", '1954-08-16', "Canada");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Denis", "Villeneuve", '1967-10-03', "Canada");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Martin", "Scorsese", '1942-11-17', "USA");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Francis", "Ford Coppola", '1939-04-07', "USA");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Jane", "Campion", '1954-04-30', "New Zealand");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Spike", "Lee", '1957-03-20', "USA");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Ang", "Lee", '1954-10-23', "Taiwan");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Kathryn", "Bigelow", '1951-11-27', "USA");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Wes", "Anderson", '1969-05-01', "USA");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Sofia", "Coppola", '1971-05-14', "USA");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Pedro", "Almodóvar", '1949-09-25', "Spain");
INSERT INTO directors (firstname, lastname, birthdate, nationality) VALUES ("Alejandro", "González Iñárritu", '1963-08-15', "Mexico");


-- Insertar Directores_Series
INSERT INTO series_directors (iddirector, idserie) VALUES (1, 1);
INSERT INTO series_directors (iddirector, idserie) VALUES (2, 2);
INSERT INTO series_directors (iddirector, idserie) VALUES (3, 3);
INSERT INTO series_directors (iddirector, idserie) VALUES (4, 4);
INSERT INTO series_directors (iddirector, idserie) VALUES (5, 5);
INSERT INTO series_directors (iddirector, idserie) VALUES (6, 6);
INSERT INTO series_directors (iddirector, idserie) VALUES (7, 7);
INSERT INTO series_directors (iddirector, idserie) VALUES (8, 8);
INSERT INTO series_directors (iddirector, idserie) VALUES (9, 9);
INSERT INTO series_directors (iddirector, idserie) VALUES (10, 10);
INSERT INTO series_directors (iddirector, idserie) VALUES (11, 11);
INSERT INTO series_directors (iddirector, idserie) VALUES (12, 12);
INSERT INTO series_directors (iddirector, idserie) VALUES (13, 13);
INSERT INTO series_directors (iddirector, idserie) VALUES (14, 14);
INSERT INTO series_directors (iddirector, idserie) VALUES (15, 15);
INSERT INTO series_directors (iddirector, idserie) VALUES (16, 16);
INSERT INTO series_directors (iddirector, idserie) VALUES (17, 17);
INSERT INTO series_directors (iddirector, idserie) VALUES (18, 18);
INSERT INTO series_directors (iddirector, idserie) VALUES (19, 19);
INSERT INTO series_directors (iddirector, idserie) VALUES (20, 20);
INSERT INTO series_directors (iddirector, idserie) VALUES (2, 1);
INSERT INTO series_directors (iddirector, idserie) VALUES (3, 5);
INSERT INTO series_directors (iddirector, idserie) VALUES (4, 8);
INSERT INTO series_directors (iddirector, idserie) VALUES (5, 10);
INSERT INTO series_directors (iddirector, idserie) VALUES (6, 15);

-- Insertar Idiomas
INSERT INTO languages (name, isocode) VALUES ("English", "en");
INSERT INTO languages (name, isocode) VALUES ("Spanish", "es");
INSERT INTO languages (name, isocode) VALUES ("French", "fr");
INSERT INTO languages (name, isocode) VALUES ("German", "de");
INSERT INTO languages (name, isocode) VALUES ("Italian", "it");
INSERT INTO languages (name, isocode) VALUES ("Portuguese", "pt");
INSERT INTO languages (name, isocode) VALUES ("Japanese", "ja");
INSERT INTO languages (name, isocode) VALUES ("Korean", "ko");
INSERT INTO languages (name, isocode) VALUES ("Chinese", "zh");
INSERT INTO languages (name, isocode) VALUES ("Arabic", "ar");
INSERT INTO languages (name, isocode) VALUES ("Russian", "ru");
INSERT INTO languages (name, isocode) VALUES ("Hindi", "hi");
INSERT INTO languages (name, isocode) VALUES ("Bengali", "bn");
INSERT INTO languages (name, isocode) VALUES ("Malayalam", "ml");
INSERT INTO languages (name, isocode) VALUES ("Tamil", "ta");
INSERT INTO languages (name, isocode) VALUES ("Telugu", "te");
INSERT INTO languages (name, isocode) VALUES ("Marathi", "mr");
INSERT INTO languages (name, isocode) VALUES ("Gujarati", "gu");
INSERT INTO languages (name, isocode) VALUES ("Urdu", "ur");
INSERT INTO languages (name, isocode) VALUES ("Punjabi", "pa");
INSERT INTO languages (name, isocode) VALUES ("Persian", "fa");
INSERT INTO languages (name, isocode) VALUES ("Turkish", "tr");
INSERT INTO languages (name, isocode) VALUES ("Vietnamese", "vi");
INSERT INTO languages (name, isocode) VALUES ("Indonesian", "id");
INSERT INTO languages (name, isocode) VALUES ("Thai", "th");
INSERT INTO languages (name, isocode) VALUES ("Hebrew", "he");
INSERT INTO languages (name, isocode) VALUES ("Greek", "el");
INSERT INTO languages (name, isocode) VALUES ("Polish", "pl");
INSERT INTO languages (name, isocode) VALUES ("Danish", "da");
INSERT INTO languages (name, isocode) VALUES ("Swedish", "sv");
INSERT INTO languages (name, isocode) VALUES ("Dutch", "nl");
INSERT INTO languages (name, isocode) VALUES ("Norwegian", "no");
INSERT INTO languages (name, isocode) VALUES ("Finnish", "fi");
INSERT INTO languages (name, isocode) VALUES ("Hungarian", "hu");
INSERT INTO languages (name, isocode) VALUES ("Czech", "cs");
INSERT INTO languages (name, isocode) VALUES ("Romanian", "ro");
INSERT INTO languages (name, isocode) VALUES ("Slovenian", "sl");

-- Insertar Idiomas_Series
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (1, 1, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (2, 1, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (3, 1, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (4, 2, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (5, 2, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (6, 2, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (7, 3, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (8, 3, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (9, 3, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (10, 4, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (11, 4, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (12, 4, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (13, 5, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (14, 5, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (15, 5, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (16, 6, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (17, 6, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (18, 6, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (19, 7, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (20, 7, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (21, 7, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (22, 8, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (23, 8, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (24, 8, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (25, 9, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (26, 9, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (27, 9, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (28, 10, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (29, 10, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (30, 10, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (31, 11, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (32, 11, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (33, 11, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (34, 12, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (35, 12, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (36, 12, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (1, 13, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (2, 13, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (3, 13, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (4, 14, 'subtitle');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (5, 14, 'audio');
INSERT INTO languages_series (idlanguage, idserie, languagestype) VALUES (6, 14, 'subtitle');
