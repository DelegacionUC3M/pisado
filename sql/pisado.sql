CREATE TABLE comentario_group (
  id serial PRIMARY KEY,
  id_group bigint NOT NULL,
  nia bigint NOT NULL,
  nombre varchar(50) NOT NULL,
  date date NOT NULL,
  text text NOT NULL,
  FOREIGN KEY (id_group) REFERENCES group (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE comentario_pisado (
  id serial PRIMARY KEY,
  id_pisado bigint NOT NULL,
  nia bigint NOT NULL,
  nombre varchar(50) NOT NULL,
  date date NOT NULL,
  text text NOT NULL,
  FOREIGN KEY (id_pisado) REFERENCES pisado (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE group (
  id serial PRIMARY KEY,
  subject varchar(50) NOT NULL,
  date date NOT NULL
);

CREATE TABLE archive (
  id serial PRIMARY KEY,
  id_pisado bigint UNIQUE NOT NULL,
  date date NOT NULL,
  FOREIGN KEY (id_pisado) REFERENCES pisado (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE pisado (
  id serial PRIMARY KEY,
  nia bigint NOT NULL,
  email varchar(40) NOT NULL,
  autor varchar(40) NOT NULL,
  date date NOT NULL,
  id_titulacion bigint NOT NULL,
  asignatura varchar(50) NOT NULL,
  curso smallint NOT NULL,
  grupo bigint NOT NULL,
  profesor varchar(40) NOT NULL,
  texto text NOT NULL,
  id_group bigint,
  FOREIGN KEY (id_group) REFERENCES group (id)
);
