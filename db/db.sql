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
  siguidores INTEGER NOT NULL,
  siguiendo INTEGER NOT NULL,
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
  fk_etiqueta INTEGER,
  fk_categoria INTEGER,
  fecha DATE NOW(),
  guardados INTEGER NOT NULL,
  
  FOREIGN KEY (fk_autor) REFERENCES usuarios(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL,
  FOREIGN KEY (fk_etiqueta) REFERENCES etiquetas(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL,
  FOREIGN KEY (fk_categoria) REFERENCES categorias(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS comentarios(
  id SERIAL PRIMARY KEY NOT NULL,
  contenido TEXT NOT NULL,
  fk_autor INTEGER,
  fk_publicacion INTEGER,
  likes INTEGER,
  FOREIGN KEY (fk_autor) REFERENCES usuarios(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL,
  FOREIGN KEY (fk_publicacion) REFERENCES publicaciones(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS respuestas(
  id SERIAL PRIMARY KEY NOT NULL,
  contenido TEXT NOT NULL,
  fk_autor INTEGER,
  fk_comentario INTEGER,
  likes INTEGER,
  FOREIGN KEY (fk_autor) REFERENCES usuarios(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL,
  FOREIGN KEY (fk_comentario) REFERENCES comentarios(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS likes(
  id SERIAL PRIMARY KEY NOT NULL,
  fk_autor INTEGER,
  fk_publicacion INTEGER,

  FOREIGN KEY (fk_autor) REFERENCES usuarios(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL,
  FOREIGN KEY (fk_publicacion) REFERENCES publicaciones(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS guardadas(
  id SERIAL PRIMARY KEY NOT NULL,
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

