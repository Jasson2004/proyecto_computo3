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

El proyecto utiliza **PostgreSQL** como gestor de base de datos principal.

La base de datos utilizada se llama:

`blog_semana_sistemas`

La información original del proyecto se encontraba almacenada en SQLite. Posteriormente se realizó la migración de la estructura y la importación de los registros existentes hacia PostgreSQL.

Se importaron los registros de las siguientes tablas principales:

| Tabla | Registros |
|---|---:|
| users | 3 |
| categories | 7 |
| posts | 16 |
| post_images | 83 |
| post_user | 32 |
| **Total** | **141** |

Se verificaron las cantidades de registros importados y las relaciones entre publicaciones, usuarios, categorías e imágenes.

## Respaldo de la base de datos

El repositorio contiene un respaldo SQL de PostgreSQL:

`db/respaldo_blog_postgres.sql`

Este archivo permite restaurar la estructura y los registros de la base de datos.

También se conserva la base de datos SQLite original:

`db/database.sqlite`

Este archivo se mantiene como respaldo de la información anterior a la migración.

---

# Instalación y ejecución local con PostgreSQL

En esta modalidad, Laravel se ejecuta directamente en Ubuntu y PostgreSQL funciona mediante Docker.

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

Desde la carpeta del entorno Docker del servidor:

```bash
cd ~/server-laravel-docker
docker compose up -d db pgadmin
```

## 4. Crear la base de datos

```bash
docker exec servidor_postgres createdb -U postgres blog_semana_sistemas
```

## 5. Restaurar el respaldo SQL

Regresar a la carpeta raíz del proyecto Laravel:

```bash
cd ~/proyecto_computo3
```

Ejecutar la restauración:

```bash
docker exec -i servidor_postgres psql -U postgres -d blog_semana_sistemas < db/respaldo_blog_postgres.sql
```

## 6. Configurar el archivo de entorno

Crear el archivo `.env`:

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

## 8. Copiar las imágenes

Desde la raíz del proyecto:

```bash
cp -r db/imagenes/. storage/app/public/
```

Crear el enlace simbólico:

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

El proyecto debe ubicarse dentro de la carpeta `www` del entorno Docker.

## 1. Iniciar el entorno Docker

Desde la carpeta del servidor:

```bash
cd ~/server-laravel-docker
docker compose up -d
```

## 2. Clonar el proyecto dentro de www

```bash
cd ~/server-laravel-docker/www
git clone https://github.com/Jasson2004/proyecto_computo3.git proyecto-computo3
```

Se utiliza el nombre `proyecto-computo3` porque el entorno del servidor utiliza el nombre de la carpeta para generar la dirección local del proyecto.

## 3. Instalar dependencias

Utilizando el alias `lv` configurado en el entorno de la asignatura:

```bash
lv proyecto-computo3 composer install
```

## 4. Configurar el entorno

```bash
lv proyecto-computo3 cp .env.example .env
```

Editar el archivo `.env` del proyecto y configurar la conexión:

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
lv proyecto-computo3 php artisan key:generate
```

Limpiar la configuración:

```bash
lv proyecto-computo3 php artisan config:clear
```

## 6. Crear la base de datos

Desde la terminal del equipo anfitrión:

```bash
docker exec servidor_postgres createdb -U postgres blog_semana_sistemas
```

## 7. Restaurar el respaldo PostgreSQL

Desde la carpeta del proyecto clonado:

```bash
cd ~/server-laravel-docker/www/proyecto-computo3
```

Ejecutar:

```bash
docker exec -i servidor_postgres psql -U postgres -d blog_semana_sistemas < db/respaldo_blog_postgres.sql
```

## 8. Copiar las imágenes

```bash
lv proyecto-computo3 cp -r db/imagenes/. storage/app/public/
```

Crear el enlace simbólico:

```bash
lv proyecto-computo3 php artisan storage:link
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
- El respaldo SQL contiene la estructura y los registros de PostgreSQL.
- Para instalar el proyecto desde el respaldo, primero se crea la base de datos y después se restaura el archivo SQL.
- No ejecutar `php artisan migrate:fresh` ni `php artisan db:wipe` después de restaurar el respaldo, ya que estos comandos pueden eliminar información.
- No es necesario volver a importar los registros de SQLite: ya están incluidos en el respaldo PostgreSQL.
- Las credenciales de demostración se proporcionan para facilitar la revisión del proyecto.

## Repositorio

GitHub: https://github.com/Jasson2004/proyecto_computo3