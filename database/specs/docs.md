# Documentación del Proyecto

## Portal Web de Tecnología — MTT

---

**Autor:** Amangeldiuly Madi  
**Materia:** Producción Web  
**Año:** 2026  

---

## Índice

1. [Introducción](#1-introducción)
2. [Objetivos](#2-objetivos)
3. [Tecnologías Utilizadas](#3-tecnologías-utilizadas)
4. [Cómo Funciona el Sistema](#4-cómo-funciona-el-sistema)
5. [Base de Datos](#5-base-de-datos)
6. [Roles y Permisos](#6-roles-y-permisos)
7. [Funcionalidades y Flujo de Trabajo](#7-funcionalidades-y-flujo-de-trabajo)
8. [Panel de Administración](#8-panel-de-administración)
9. [Personalización](#9-personalización)
10. [Glosario](#10-glosario)

---

## 1. Introducción

Esta documentación corresponde al desarrollo de un portal de noticias e interacción sobre tecnología. La idea principal fue construir una plataforma limpia y accesible, pensada para que personas no técnicas puedan informarse sobre el sector tech de forma sencilla sin perderse entre tecnicismos.

A nivel funcional, el sistema opera como una comunidad: permite la lectura de artículos redactados por el equipo editorial, pero también le da a los lectores registrados herramientas para comentar, interactuar, personalizar su interfaz e incluso generar su propio contenido bajo ciertos permisos.

### Capacidades del sistema para el usuario

* **Navegación y lectura:** Acceso completo al catálogo de artículos publicados.
* **Cuentas de usuario:** Registro con avatar personalizado, biografía y enlaces de contacto.
* **Interacción social:** Sistema de comentarios, reacción "me gusta" e interactividad entre perfiles (seguimiento de autores).
* **Organización personal:** Guardado de publicaciones favoritas para lectura posterior.
* **Búsqueda y filtros:** Consultas rápidas por palabras clave, categorías temáticas y etiquetas.
* **Ajustes de UI:** Elección de temas (modo claro/oscuro) y acentos de color personalizados.

---

## 2. Objetivos

### Objetivo General

Desarrollar una aplicación web funcional tipo blog/portal de noticias tecnológicas que combine la gestión de contenido con herramientas de interacción social de forma segura e intuitiva.

### Objetivos Específicos

* Implementar un flujo seguro de autenticación y manejo de sesiones.
* Diseñar un esquema relacional de base de datos eficiente para gestionar usuarios, posts, comentarios y relaciones sociales.
* Establecer una jerarquía clara de accesos basada en 3 roles (Usuario, Editor y Administrador).
* Crear una interfaz responsiva con soporte para modo oscuro y temas de color.
* Integrar funcionalidades dinámicas sin recarga completa de página para acciones rápidas (likes, guardados).
* Proveer un panel de administración centralizado para moderar contenido, gestionar permisos y ver métricas del sitio.

---

## 3. Tecnologías Utilizadas

Para este proyecto elegí un stack clásico pero sólido, priorizando la estabilidad del lado del servidor y la agilidad en la maquetación.

### PHP
Es el lenguaje base del servidor. Se encarga de procesar la lógica de negocio, procesar peticiones HTTP y comunicarse con la base de datos para renderizar la información dinámica.

### Laravel
Seleccioné este framework para PHP porque acelera drásticamente el desarrollo y mantiene una estructura de código limpia. Nos resuelve tareas complejas mediante:

* **Routing y Controladores:** Organización lógica del flujo de URLs y peticiones.
* **ORM Eloquent (Modelos):** Mapeo de la base de datos como objetos PHP, simplificando consultas.
* **Motor de Plantillas Blade:** Renderizado de vistas HTML modulares y reutilizables.
* **Migraciones y Seeders:** Control de versiones del esquema de base de datos y carga de datos de prueba.
* **Módulos de Seguridad:** Manejo integrado de contraseñas, tokens CSRF y sesiones.

### JavaScript
Utilizado en el cliente para dar fluidez a la interfaz. Se usó principalmente para alternar entre el modo claro/oscuro guardando la preferencia local y para procesar las reacciones (likes/guardados) vía peticiones asíncronas para no recargar la página.

### MariaDB
Sistema gestor de base de datos relacional. Almacena de forma estructurada toda la información persistente del portal (cuentas, posts, interacciones, logs).

### Bootstrap
Framework de CSS implementado para construir una interfaz limpia y adaptar el diseño a pantallas móviles y de escritorio. Se consumió mediante CDN para aligerar la carga de archivos locales.

### Resumen del Stack

| Tecnología | Entorno | Uso en el proyecto |
|---|---|---|
| PHP | Servidor | Lenguaje backend principal |
| Laravel | Servidor | Framework MVC de desarrollo |
| JavaScript | Cliente | Comportamiento dinámico y tema oscuro |
| MariaDB | Servidor | Base de datos relacional |
| Bootstrap | Cliente | Maquetación y componentes visuales |

---

## 4. Cómo Funciona el Sistema

### 4.1 Arquitectura del proyecto

El portal sigue el patrón de arquitectura MVC (Modelo-Vista-Controlador) distribuido entre servidor y cliente:

```
┌──────────────────────────────────────────────────────────────┐
│                                                              │
│    EL USUARIO                 EL SITIO WEB           LA DATA  │
│                                                              │
│  ┌──────────┐          ┌─────────────────┐      ┌─────────┐ │
│  │          │          │                 │      │         │ │
│  │Navegador │ ◄──────► │     Laravel     │ ◄──► │ MariaDB │ │
│  │(Chrome,  │   envía  │    (cerebro)    │consultas│(datos) │ │
│  │ Firefox) │  peticiones                │      │         │ │
│  │          │          │                 │      │         │ │
│  └──────────┘          └─────────────────┘      └─────────┘ │
│       │                         │                        │  │
│       ▼                         ▼                        ▼  │
│  Lo que ve               Lo que procesa            Donde se  │
│  el usuario             las peticiones              guardan │
│                                                   los datos │
└──────────────────────────────────────────────────────────────┘
```

1. **Cliente (Navegador):** Muestra el HTML/CSS estilizado y ejecuta JS para interacción inmediata.
2. **Servidor (Laravel):** Recibe solicitudes, valida credenciales/permisos y ejecuta lógica de negocio.
3. **Persistencia (MariaDB):** Guarda y entrega la información requerida por los modelos.

### 4.2 Ciclo de una petición HTTP

```
1. Usted escribe una dirección (ej: localhost:8000)
                    │
                    ▼
2. El navegador envía una petición al servidor
                    │
                    ▼
3. Laravel recibe la petición y busca qué función debe ejecutar
                    │
                    ▼
4. Laravel verifica si el usuario tiene permiso para acceder
   (¿está registrado? ¿tiene el rol adecuado?)
                    │
                    ▼
5. La función correspondiente consulta la base de datos
   si es necesario
                    │
                    ▼
6. Laravel genera la página HTML con los datos obtenidos
                    │
                    ▼
7. El navegador recibe la página y la muestra al usuario
```

### 4.3 Control de accesos y seguridad

Antes de procesar cualquier acción sensible, la aplicación pasa la solicitud por una capa de middlewares que comprueban autenticación y nivel de rol.

```
┌─────────────────────────────────────────────────────┐
│                  NIVELES DE ACCESO                  │
├─────────────────────────────────────────────────────┤
│                                                     │
│  ┌───────────────────────────────────────────────┐  │
│  │  ADMINISTRADOR                                │  │
│  │  Puede hacer todo: gestionar usuarios,        │  │
│  │  configurar el sitio, ver reportes,           │  │
│  │  editar/eliminar cualquier contenido          │  │
│  └───────────────────────────────────────────────┘  │
│                      ▲                              │
│  ┌───────────────────┴─────────────────────────┐    │
│  │  EDITOR                                     │    │
│  │  Puede crear, editar y eliminar sus propias │    │
│  │  publicaciones. Puede gestionar categorías  │    │
│  │  y etiquetas                                │    │
│  └───────────────────────────────────────────────┘    │
│                      ▲                              │
│  ┌───────────────────┴─────────────────────────┐    │
│  │  USUARIO                                    │    │
│  │  Puede leer publicaciones, comentar, dar    │    │
│  │  me gusta, guardar, seguir usuarios,        │    │
│  │  editar su perfil                           │    │
│  └───────────────────────────────────────────────┘    │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### 4.4 Estructura del repositorio

```
PP/
├── app/
│   ├── Enums/                 # Opciones fijas (roles, colores)
│   ├── Http/
│   │   ├── Controllers/       # Controladores de cada sección
│   │   └── Middleware/        # Middlewares de permisos y auth
│   ├── Models/                # Modelos de Eloquent
│   └── Providers/             # Proveedores de servicios
├── database/
│   ├── factories/             # Generación de datos sintéticos
│   ├── migrations/            # Estructura e historial de tablas
│   └── seeders/               # Poblado inicial de datos
├── public/
│   ├── css/                   # Estilos propios
│   ├── js/                    # Scripts JS del cliente
│   └── storage/               # Archivos subidos (avatares, covers)
├── resources/
│   └── views/                 # Plantillas Blade HTML
│       ├── layouts/           # Layout base maestro
│       ├── components/        # Componentes UI reutilizables
│       ├── auth/              # Formularios de login/registro
│       ├── publicacion/       # Módulos de lectura/redacción
│       ├── perfil/            # Vistas de perfiles
│       ├── dashboard/         # Paneles personales
│       ├── categorias/        # Gestión de taxonomía
│       └── admin/             # Panel administrativo
└── routes/
    └── web.php                # Definición de rutas del sitio
```

---

## 5. Base de Datos

### 5.1 Estructura general

La base de datos consta de **15 tablas** interrelacionadas mediante llaves foráneas para garantizar integridad referencial.

### 5.2 Mapa de relaciones

```
                        ┌──────────┐
                        │  roles   │
                        └────┬─────┘
                             │
                        ┌────┴─────────┐     ┌────────────────┐
                        │  usuarios    │────►│ perfil_usuarios│
                        └──┬──┬──┬──┬──┘     └────────────────┘
                           │  │  │  │
             ┌─────────────┘  │  │  └──────────────┐
             │                │  │                 │
             ▼                │  ▼                 ▼
       ┌───────────┐          │  ┌──────────────┐  ┌──────────────┐
       │ seguidores│          │  │config_usuarios│  │    likes     │
       └───────────┘          │  └──────────────┘  └──────────────┘
                              ▼
                 ┌──────────────────────┐
                 │    publicaciones     │
                 └──┬──────┬────────────┘
                    │      │
         ┌──────────┘      └──────────────┐
         ▼                                ▼
  ┌──────────────┐               ┌───────────────────┐
  │ comentarios  │               │etiquetas_publicac.│
  └──────────────┘               └───────────────────┘
                                          │
                                          ▼
                                 ┌──────────────┐
                                 │  etiquetas   │
                                 └──────────────┘

  ┌──────────────┐
  │ categorias   │─────── (referenciada por publicaciones)
  └──────────────┘
```

### 5.3 Resumen de tablas principales

| Tabla | Propósito |
|---|---|
| `roles` | Catálogo de roles de acceso. |
| `usuarios` | Credenciales e información base de la cuenta. |
| `perfil_usuarios` | Datos complementarios del perfil público. |
| `config_usuarios` | Preferencias individuales de UI y privacidad. |
| `categorias` | Clasificación temática principal para los posts. |
| `etiquetas` | Descriptores secundarios tipo hashtag. |
| `publicaciones` | Artículos creados, imágenes asociadas y metadata. |
| `comentarios` | Retroalimentación enviada por usuarios en los posts. |
| `configuraciones` | Ajustes operativos globales controlados por el Admin. |
| `likes` | Registro de reacciones en posts o comentarios. |
| `guardadas` | Lista de marcadores/favoritos por usuario. |
| `seguidores` | Grafo de relaciones de seguimiento entre cuentas. |
| `etiquetas_publicaciones` | Tabla pivote N:M entre publicaciones y etiquetas. |

### 5.4 Lógica de cardinalidad

* **Usuarios:** Puede redactar múltiples artículos, dejar comentarios, dar reacciones y seguir a otros usuarios. Posee únicamente 1 perfil extenso y 1 registro de configuración.
* **Publicaciones:** Tienen 1 autor único y pertenecen a 1 categoría, pero pueden contener múltiples comentarios, reacciones, etiquetas y marcadores de favoritos.
* **Comentarios:** Cada comentario pertenece a 1 usuario y 1 post específico, pudiendo recibir reacciones de otros usuarios.

---

## 6. Roles y Permisos

Definimos una jerarquía acumulativa: el **Editor** hereda todas las capacidades del **Usuario**, mientras que el **Administrador** posee control absoluto sobre la plataforma.

| Funcionalidad | Usuario | Editor | Administrador |
|---|:---:|:---:|:---:|
| Leer posts, buscar y filtrar | ✅ | ✅ | ✅ |
| Comentar y reaccionar (likes) | ✅ | ✅ | ✅ |
| Guardar favoritos y seguir usuarios | ✅ | ✅ | ✅ |
| Gestionar perfil propio | ✅ | ✅ | ✅ |
| Publicar y gestionar posts propios | ❌ | ✅ | ✅ |
| Administrar taxonomía (categorías/tags) | ❌ | ✅ | ✅ |
| Moderación global (editar/borrar todo) | ❌ | ❌ | ✅ |
| Ver analíticas y reportes | ❌ | ❌ | ✅ |
| Gestionar usuarios y roles | ❌ | ❌ | ✅ |
| Cambiar configuración global del sitio | ❌ | ❌ | ✅ |

---

## 7. Funcionalidades y Flujo de Trabajo

### 7.1 Autenticación

```
REGISTRO:
  ┌──────────┐     ┌──────────────┐     ┌──────────────┐     ┌──────────┐
  │ El usuario│────►│ Llena el     │────►│ Se crea su   │────►│ Se redirige│
  │ accede a  │     │ formulario:  │     │ cuenta con   │     │ a su perfil│
  │ registro  │     │ nombre, user,│     │ rol "usuario"│     │ nuevo    │
  │          │     │ email, tel,  │     │ Se inicia    │     │          │
  │          │     │ contraseña   │     │ sesión auto. │     │          │
  └──────────┘     └──────────────┘     └──────────────┘     └──────────┘

INICIO DE SESIÓN:
  ┌──────────┐     ┌──────────────┐     ┌──────────────┐
  │ El usuario│────►│ Ingresa email│────►│ Si son       │────► Se redirige
  │ accede a  │     │ y contraseña │     │ correctas:   │      al inicio
  │ login    │     │ (opcional:   │     │ se crea la   │
  │          │     │ "recordarme")│     │ sesión       │
  └──────────┘     └──────────────┘     └──────────────┘
```

### 7.2 Descubrimiento de contenido

La página principal distribuye los elementos para facilitar la lectura:
* **Bloque destacado:** Muestra automáticamente los 5 artículos con mayor número de likes.
* **Feed cronológico:** Lista las publicaciones más recientes ordenadas por fecha.
* **Módulos de filtro:** Permite aislar entradas por categorías o etiquetas seleccionadas.

### 7.3 Vista de artículo e interacción

```
┌─────────────────────────────────────────┐
│              IMAGEN DEL ARTÍCULO        │
├─────────────────────────────────────────┤
│  TÍTULO                                 │
│  Por: [autor] | Fecha: [fecha]          │
│  Categoría: [categoría]                 │
│  Etiquetas: [tag1] [tag2] [tag3]        │
├─────────────────────────────────────────┤
│                                         │
│  CONTENIDO COMPLETO DEL ARTÍCULO        │
│                                         │
├─────────────────────────────────────────┤
│  ❤️ [me gusta]   🔖 [guardar]            │
├─────────────────────────────────────────┤
│  COMENTARIOS                            │
│  ┌─────────────────────────────────┐    │
│  │ [foto] Usuario1: "Mi comentario"│    │
│  │ [foto] Usuario2: "Otro..."      │    │
│  └─────────────────────────────────┘    │
│                                         │
│  [Escribir comentario...]    [Enviar]   │
└─────────────────────────────────────────┘
```

### 7.4 Likes y Guardados
Se manejan como estados toggle mediante peticiones asíncronas:
* Si la interacción no existe, se inserta en BD y se actualiza el estado gráfico del botón.
* Si la interacción ya existía, se remueve el registro y el botón vuelve a su estado inactivo.

### 7.5 Módulo de comentarios

```
1. El usuario escribe su comentario en el campo de texto
                    │
                    ▼
2. Hace clic en "Enviar"
                    │
                    ▼
3. Se verifica que no haya superado el límite de comentarios
                    │
                    ▼
4. El comentario aparece en la lista debajo de la publicación
```

### 7.6 Proceso de publicación (Editores/Admins)

```
1. El editor o administrador accede a "Nueva publicación"
                    │
                    ▼
2. Llena el formulario:
   • Título del artículo
   • Descripción breve
   • Contenido completo
   • Imagen representativa (sube una imagen)
   • Categoría (selecciona de las disponibles)
   • Etiquetas (puede seleccionar varias)
                    │
                    ▼
3. Se verifica que no haya superado el límite de publicaciones
                    │
                    ▼
4. Se guarda la imagen en el servidor
                    │
                    ▼
5. Se crea la publicación en la base de datos
                    │
                    ▼
6. Se redirige a la vista de la nueva publicación
```

### 7.7 Control de privacidad en perfiles

Los usuarios pueden editar sus datos públicos (avatar, bio, estudios, ciudad). Cada campo incluye un flag booleano para definir si esa información debe mostrarse abiertamente en su perfil público o mantenerse privada.

### 7.8 Dashboard del usuario

Organizado por pestañas según la actividad de la cuenta:
* **Likes:** Historial de artículos respaldados.
* **Comentarios:** Actividad en conversaciones dentro del sitio.
* **Guardados:** Lista personal de marcadores para lectura rápida.
* **Mis Blogs (Editores/Admins):** Panel personal de autor para crear, modificar o retirar publicaciones.
* **Gestión Global (Admins):** Lista completa del contenido generado en todo el sistema.

---

## 8. Panel de Administración

Esta área es de acceso exclusivo para administradores y centraliza la salud del portal.

### 8.1 Métricas e informes
Permite consultar datos de impacto como las publicaciones con más comentarios o me gusta, pudiendo filtrar el rango temporal entre:
* Actividad de hoy
* Histórico semanal
* Métricas del mes
* Consolidado anual

### 8.2 Control de cuentas
* Listados paginados diferenciados por rol (Usuarios generales vs. Redactores/Editores).
* Alta manual de usuarios asignando roles directamente.
* Eliminación o baja de cuentas con restricción de autofiltrado (un administrador no puede borrarse a sí mismo).

### 8.3 Ajustes operativos del sitio
Permite configurar parámetros globales sin modificar código:
* Colores institucionales predeterminados.
* Avatares por defecto para cuentas recién registradas.
* Topes de comentarios permitidos por usuario.
* Cuotas máximas de publicación por editor.
* Permisos cruzados de edición/eliminación sobre comentarios de terceros.

---

## 9. Personalización y Frontend

### 9.1 Motor de temas
Se implementó un switch de tema claro/oscuro. La preferencia del usuario se almacena localmente (`localStorage`), garantizando que la configuración persista al navegar entre subpáginas o reabrir la sesión.

### 9.2 Esquemas de color (Acentos)
El sistema permite cambiar el color de énfasis del sitio (utilizado en botones, badges, enlaces y acentos visuales).

| Nombre de Tono | Muestra |
|---|---|
| Azul (Default) | ████ |
| Verde Esmeralda | ████ |
| Rojo Coral | ████ |
| Aqua | ████ |
| Blanco | ████ |
| Negro Neutro | ████ |

Si el usuario no especifica una preferencia, la interfaz toma el tono asignado al rol del usuario desde el panel general.

### 9.3 Gestión dinámica de activos
La plataforma integra una biblioteca de **32 vectores SVG** procesados para adoptar automáticamente las variables CSS del acento activo, asegurando que los íconos reactivos (me gusta, marcadores, hilos) coincidan siempre con el esquema gráfico seleccionado.

---

## 10. Glosario

* **Blade:** Motor de plantillas propio de Laravel que permite escribir código HTML limpio mezclado con sintaxis PHP simplificada.
* **Booleano:** Tipo de dato binario que únicamente almacena un valor de verdadero (true/1) o falso (false/0).
* **CDN (Content Delivery Network):** Servidores externos optimizados para servir archivos estáticos (como Bootstrap) a alta velocidad.
* **Controlador:** Clase en el patrón MVC encargada de recibir la petición del usuario, ejecutar la lógica requerida y decidir qué vista responder.
* **CRUD:** Acrónimo para las 4 operaciones básicas de datos: Crear, Leer, Actualizar y Eliminar (Create, Read, Update, Delete).
* **Eloquent:** El ORM (Object-Relational Mapping) de Laravel que simplifica la interacción con la base de datos MariaDB usando clases y modelos de PHP.
* **Enum:** Tipo de campo que restringe sus valores a una lista prestablecida de opciones fijas.
* **Middleware:** Filtro intermedio que procesa la petición HTTP antes de llegar al controlador; útil para comprobar permisos o autenticación.
* **MVC:** Patrón de diseño de software que separa la aplicación en tres capas: Modelo (datos), Vista (interfaz) y Controlador (lógica).
* **Paginación:** División de un conjunto grande de datos en bloques más pequeños para optimizar el rendimiento de la base de datos y la carga útil.
* **Ruta (Route):** Endpoint o dirección URL mapeada dentro de la aplicación que activa un controlador específico.
* **Seeder:** Script automatizado utilizado para poblar la base de datos con información inicial o de prueba.

## 11. Guía de Instalación

Pautas paso a paso para desplegar y poner en marcha el portal en un entorno de desarrollo local.

### 11.1 Requisitos Previos

Asegúrate de contar con las siguientes herramientas en tu entorno local:

* **PHP:** Versión 8.1 o superior (con extensiones habilitadas: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`).[cite: 1]
* **Composer:** Gestor de dependencias para PHP.
* **MariaDB** o **MySQL:** Servidor de base de datos relacional activo.
* **Git:** (Opcional) Para clonar el repositorio.

---

### 11.2 Pasos para la Configuración

#### Paso 1: Obtener el repositorio
Clona el repositorio o descarga el paquete de código fuente y posicionate en el directorio del proyecto:
```bash
git clone https://github.com/donttouchmyspagget420/pp 
cd pp
```

#### Paso 2: Instalar dependencias backend
Actualiza las librerías necesarias ejecutando Composer:
```bash
composer update
```

#### Paso 3: Configurar variables de entorno
Crea tu archivo `.env` a partir de la plantilla de ejemplo `.env.example`:
```bash
cp .env.example .env
```
Genera la clave única de la aplicación (`APP_KEY`):
```bash
php artisan key:generate
```

#### Paso 4: Preparar la base de datos
Crea la base de datos vacía en MariaDB/MySQL mediante tu consola o gestor de preferencia (ej. phpMyAdmin, DBeaver):
```sql
CREATE DATABASE portal_tech_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Abre el archivo `.env` y configura los parámetros de conexión a la base de datos:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portal_tech_db
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

#### Paso 5: Ejecutar migraciones y datos de prueba (Seeders)
Aplica la estructura de tablas y puebla la base de datos con información de prueba (roles, categorías, etiquetas, publicaciones de ejemplo y usuarios por defecto):
```bash
php artisan migrate --seed
```

#### Paso 6: Generar el enlace simbólico de almacenamiento
Para permitir el acceso público a archivos subidos por los usuarios (avatares y portadas de posts):
```bash
php artisan storage:link
```

#### Paso 7: Iniciar el servidor local
Despliega el servidor web de desarrollo embebido de Laravel:
```bash
php artisan serve
```

Accede al sitio web abriendo la siguiente URL en tu navegador:
```text
[http://127.0.0.1:8000](http://127.0.0.1:8000)
```
---

*Documento elaborado para el proyecto "Portal Web de Tecnología — Blog de Noticias Tech", materia de Producción Web.*
