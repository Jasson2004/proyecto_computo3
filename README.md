# Blog – Semana de Sistemas 2026

Sistema web desarrollado con **Laravel 12** para la administración y publicación de entradas de blog, como parte de la asignatura.

## Integrantes

- Juan Granados (GA22021)
- Jasson Sanchez (SP23001)

## Descripción del proyecto

Aplicación web que permite administrar publicaciones, categorías, autores e imágenes. Cuenta con un área administrativa protegida y una sección pública para consultar las publicaciones.

## Funcionalidades principales

- Inicio y cierre de sesión.
- Protección de rutas administrativas mediante autenticación.
- Panel de administración.
- Gestión de publicaciones:
  - Título y fecha.
  - Categoría.
  - Contenido.
  - Autores.
  - Imagen destacada.
  - Estado de publicación: borrador o publicada.
- Administración de categorías.
- Asociación de autores con publicaciones.
- Registro de imágenes de evidencia por publicación.
- Visualización pública de publicaciones.
- Consulta del detalle de cada publicación.
- Búsqueda y filtrado de publicaciones.
- Visualización de imágenes.

## Tecnologías utilizadas

- PHP
- Laravel 12
- PostgreSQL 17
- Docker y Docker Compose
- pgAdmin 4
- Composer
- Blade
- HTML, CSS y JavaScript
- Git y GitHub

---

# Base de datos

El proyecto utiliza **PostgreSQL** como gestor de base de datos.

La base de datos utilizada se llama:

`blog_semana_sistemas`

La información original del proyecto se encontraba almacenada en SQLite. Posteriormente se realizó la migración de estructura y la importación de los registros existentes hacia PostgreSQL.

Se conservaron los datos de las siguientes tablas principales:

| Tabla | Registros importados |
|---|---:|
| users | 3 |
| categories | 7 |
| posts | 16 |
| post_images | 83 |
| post_user | 32 |
| **Total** | **141** |

Se verificó que los registros importados coincidieran con los datos originales y que las relaciones entre publicaciones, usuarios, categorías e imágenes no presentaran registros huérfanos.

## Respaldo de la base de datos

El repositorio contiene un respaldo SQL de PostgreSQL:

`db/respaldo_blog_postgres.sql`

Este archivo permite restaurar la base de datos con su estructura y los registros guardados.

También se conserva la base de datos SQLite original como respaldo:

`db/database.sqlite`

**Importante:** el respaldo SQL ya contiene las tablas y los registros. No es necesario ejecutar `migrate:fresh`, `db:wipe` ni volver a importar los datos manualmente.

---

# Instalación y ejecución local con PostgreSQL

Esta modalidad ejecuta Laravel directamente en Ubuntu y utiliza PostgreSQL desde el entorno Docker.

## 1. Clonar el repositorio

```bash
git clone https://github.com/Jasson2004/proyecto_computo3.git
cd proyecto_computo3
```

## 2. Instalar dependencias

```bash
composer install
```

## 3. Iniciar PostgreSQL y pgAdmin

Desde la carpeta donde se encuentra el proyecto Docker del servidor:

```bash
cd ~/server-laravel-docker
docker compose up -d db pgadmin
```

## 4. Crear la base de datos

```bash
docker exec servidor_postgres createdb -U postgres blog_semana_sistemas
```

## 5. Restaurar el respaldo SQL

Desde la carpeta raíz del proyecto Laravel, ejecutar:

```bash
docker exec -i servidor_postgres psql -U postgres -d blog_semana_sistemas < db/respaldo_blog_postgres.sql
```

## 6. Configurar el archivo de entorno

Regresar a la carpeta del proyecto Laravel:

```bash
cp .env.example .env
```

Editar el archivo `.env` y configurar la conexión:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5433
DB_DATABASE=blog_semana_sistemas
DB_USERNAME=postgres
DB_PASSWORD=root123
```

La contraseña debe coincidir con la configurada en el servicio PostgreSQL del entorno Docker.

## 7. Generar la clave de Laravel

```bash
php artisan key:generate
```

Limpiar la configuración almacenada:

```bash
php artisan config:clear
```

## 8. Copiar las imágenes del proyecto

Desde la raíz del proyecto:

```bash
cp -r db/imagenes/. storage/app/public/
```

Crear el enlace simbólico de almacenamiento:

```bash
php artisan storage:link
```

## 9. Iniciar el servidor

```bash
php artisan serve
```

Abrir en el navegador:

`http://127.0.0.1:8000`

---

# Instalación mediante Docker (entorno de la asignatura)

Esta modalidad utiliza el entorno Docker proporcionado para ejecutar los proyectos Laravel.

El proyecto Laravel debe ubicarse dentro de la carpeta `www` del entorno Docker.

## 1. Iniciar el entorno Docker

Desde la carpeta `server-laravel-docker`:

```bash
cd ~/server-laravel-docker
docker compose up -d
```

## 2. Clonar el proyecto dentro de www

```bash
cd ~/server-laravel-docker/www
git clone https://github.com/Jasson2004/proyecto_computo3.git
```

## 3. Instalar dependencias

Utilizando el alias `lv` configurado en el entorno de la asignatura:

```bash
lv proyecto_computo3 composer install
```

## 4. Configurar el entorno

```bash
lv proyecto_computo3 cp .env.example .env
```

Editar el `.env` del proyecto y configurar la conexión a PostgreSQL:

```env
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=blog_semana_sistemas
DB_USERNAME=postgres
DB_PASSWORD=root123
```

En esta modalidad se utiliza `db` como host porque Laravel y PostgreSQL se comunican dentro de la red de Docker Compose.

## 5. Generar la clave de Laravel

```bash
lv proyecto_computo3 php artisan key:generate
```

Limpiar la configuración:

```bash
lv proyecto_computo3 php artisan config:clear
```

## 6. Crear la base de datos

Desde la terminal del equipo anfitrión:

```bash
docker exec servidor_postgres createdb -U postgres blog_semana_sistemas
```

## 7. Restaurar los datos de PostgreSQL

Ejecutar desde la carpeta del proyecto:

```bash
cd ~/server-laravel-docker/www/proyecto_computo3
```

Luego:

```bash
docker exec -i servidor_postgres psql -U postgres -d blog_semana_sistemas < db/respaldo_blog_postgres.sql
```

## 8. Copiar las imágenes

```bash
lv proyecto_computo3 cp -r db/imagenes/. storage/app/public/
```

Crear el enlace simbólico:

```bash
lv proyecto_computo3 php artisan storage:link
```

## 9. Acceder al proyecto

Abrir en el navegador:

`http://proyecto-computo3.localhost:8083`

---

# Acceso a pgAdmin

El entorno Docker incluye pgAdmin 4 para administrar PostgreSQL desde el navegador.

Dirección:

`http://localhost:8087`

Credenciales de acceso a pgAdmin:

| Campo | Valor |
|---|---|
| Correo | admin@example.com |
| Contraseña | admin123 |

Para conectarse al servidor PostgreSQL desde pgAdmin:

| Campo | Valor |
|---|---|
| Host | db |
| Puerto | 5432 |
| Base de datos | postgres |
| Usuario | postgres |
| Contraseña | root123 |

La base de datos del proyecto es `blog_semana_sistemas`.

---

# Usuarios de demostración

| Rol | Correo | Contraseña |
|---|---|---|
| Administrador | ga22021@ues.edu.sv | Sistemas2026! |
| Administrador | sp23001@ues.edu.sv | Sistemas2026! |
| Usuario | usuario@ues.edu.sv | Usuario2026! |

---

# Estructura de respaldos

Dentro de la carpeta `db/` se encuentran los respaldos utilizados para conservar la información del proyecto:

```text
db/
├── database.sqlite
├── respaldo_blog_postgres.sql
└── imagenes/
```

- `database.sqlite`: respaldo de la base de datos original en SQLite.
- `respaldo_blog_postgres.sql`: respaldo de la base de datos migrada a PostgreSQL.
- `imagenes/`: imágenes utilizadas por las publicaciones.

---

# Consideraciones importantes

- PostgreSQL es el gestor de base de datos utilizado actualmente por el proyecto.
- El respaldo SQL incluye la estructura y los registros de la base de datos.
- Para una instalación desde el respaldo, primero se crea la base de datos y después se restaura el archivo SQL.
- No ejecutar `php artisan migrate:fresh` ni `php artisan db:wipe` después de restaurar el respaldo, ya que estos comandos pueden eliminar información.
- No es necesario volver a importar los registros de SQLite: ya están incluidos en el respaldo PostgreSQL.

## Repositorio

GitHub: https://github.com/Jasson2004/proyecto_computo3