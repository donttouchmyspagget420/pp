--CREADO CON Estupidez natural de Amangeldiuly Madi

CREATE TABLE IF NOT EXISTS roles(
  id SERIAL PRIMARY KEY NOT NULL,
  nombre TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS etiquetas(
  id SERIAL PRIMARY KEY NOT NULL,
  nombre TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS categorias(
  id SERIAL PRIMARY KEY NOT NULL,
  nombre TEXT NOT NULL
);


CREATE TABLE IF NOT EXISTS usuarios(
  id SERIAL PRIMARY KEY NOT NULL,
  fk_rol INTEGER,
  pfp TEXT NULL,
  nombre TEXT NOT NULL,
  username TEXT UNIQUE NOT NULL,
  correo TEXT UNIQUE NOT NULL,
  ubicacion TEXT NULL,
  educacion TEXT NULL,
  siguidores INTEGER DEFAULT 0,
  siguiendo INTEGER DEFAULT 0,
  tele VARCHAR(20) UNIQUE NOT NULL,
  password TEXT NOT NULL,
  FOREIGN KEY (fk_rol) REFERENCES roles(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS publicaciones(
  id SERIAL PRIMARY KEY NOT NULL,
  imagen TEXT NOT NULL,
  titulo TEXT NOT NULL,
  contenido TEXT NOT NULL,
  fk_autor INTEGER,
  fecha DATE DEFAULT CURRENT_DATE,
  destacados INT DEFAULT 0,
  FOREIGN KEY (fk_autor) REFERENCES usuarios(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS comentarios(
  id SERIAL PRIMARY KEY NOT NULL,
  contenido TEXT NOT NULL,
  fk_autor INTEGER,
  fk_publicacion INTEGER,
  fk_comentario INTEGER NULL,
  likes INTEGER DEFAULT 0,
  respuestas INTEGER DEFAULT 0,
  FOREIGN KEY (fk_autor) REFERENCES usuarios(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL,
  FOREIGN KEY (fk_publicacion) REFERENCES publicaciones(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL,
  FOREIGN KEY (fk_comentario) REFERENCES comentarios(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS likes(
  id SERIAL NOT NULL,
  fk_autor INTEGER,
  fk_publicacion INTEGER NULL,
  fk_comentario INTEGER NULL,
  FOREIGN KEY (fk_autor) REFERENCES usuarios(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL,
  FOREIGN KEY (fk_publicacion) REFERENCES publicaciones(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL,
  FOREIGN KEY (fk_comentario) REFERENCES comentarios(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS guardadas(
  id SERIAL NOT NULL,
  fk_autor INTEGER,
  fk_publicacion INTEGER,
  FOREIGN KEY (fk_autor) REFERENCES usuarios(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL,
  FOREIGN KEY (fk_publicacion) REFERENCES publicaciones(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS configuraciones(
  colorAccentoUsuario TEXT NOT NULL,
  colorAccentoEditor TEXT NOT NULL,
  colorAccentoAdmin TEXT NOT NULL,
  pfpPorDefectoUsuario TEXT NOT NULL,
  pfpPorDefectoEditor TEXT NOT NULL,
  pfpPorDefectoAdmin TEXT NOT NULL,

  removerComentariosEditores BOOLEAN NOT NULL,
  modificarComentariosUsuarios BOOLEAN NOT NULL,

  limiteDePublicaciones INTEGER NOT NULL,
  limiteDeComentarios INTEGER NOT NULL
);

CREATE TABLE IF NOT EXISTS configUsuario(
  id SERIAL,
  fk_usuario INTEGER UNIQUE,
  color TEXT NOT NULL,
  correoPublico BOOLEAN DEFAULT FALSE,
  ubicacionPublico BOOLEAN DEFAULT FALSE,
  educacionPublico BOOLEAN DEFAULT FALSE,
  telePublico BOOLEAN DEFAULT FALSE,
  FOREIGN KEY (fk_usuario) REFERENCES usuarios(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS etiquetasPublicacion(
  id SERIAL,
  fk_publicacion INTEGER,
  fk_etiqueta INTEGER,
  FOREIGN KEY (fk_etiqueta) REFERENCES etiquetas(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL,
  FOREIGN KEY (fk_publicacion) REFERENCES publicaciones(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL
);
