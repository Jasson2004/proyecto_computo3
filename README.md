# Blog Semana de Sistemas 2026

Proyecto de la asignatura Técnicas de Programación para Internet (UES, Facultad Multidisciplinaria Oriental). Blog hecho con Laravel 12, con área administrativa y área pública, para publicar las experiencias de la Semana de Sistemas 2026.

**Integrantes**

- Juan Granados (GA22021)
- Jasson Sanchez (SP23001)

## Qué incluye

- Inicio y cierre de sesión, con rutas administrativas protegidas.
- Panel de control con resumen de publicaciones.
- Gestión de entradas (título, fecha, categoría, contenido, autores, imagen principal y estado borrador o publicado).
- Gestión de categorías y de imágenes de evidencias por integrante.
- Página pública con listado, detalle, búsqueda, filtro por actividad y zoom en las evidencias.

## Requisitos

- PHP 8.4 o superior, con las extensiones mbstring, xml, curl, zip, bcmath y sqlite3.
- Composer.
- Git.

## Instalación

1. Clonar el repositorio y entrar a la carpeta:

        git clone https://github.com/Jasson2004/proyecto_computo3.git
        cd proyecto_computo3

2. Instalar las dependencias:

        composer install

3. Crear el archivo de configuración y la llave de la aplicación:

        cp .env.example .env
        php artisan key:generate

4. Importar la base de datos (archivo incluido en la carpeta `db/`):

        cp db/database.sqlite database/database.sqlite

5. Importar las fotos de las evidencias (incluidas en `db/imagenes/`):

        cp -r db/imagenes/* storage/app/public/
        php artisan storage:link

6. Encender el sitio:

        php artisan serve

7. Abrir en el navegador: http://127.0.0.1:8000

## Instalación en el servidor Docker del curso

1. Clonar dentro de la carpeta `www/` del servidor, con el nombre `proyecto-computo3`:

        cd ~/servidor-laravel/www
        git clone https://github.com/Jasson2004/proyecto_computo3.git proyecto-computo3

2. Instalar y configurar, usando el atajo `lv` de la guía:

        lv proyecto-computo3 composer install
        lv proyecto-computo3 cp .env.example .env
        lv proyecto-computo3 php artisan key:generate
        lv proyecto-computo3 cp db/database.sqlite database/database.sqlite
        lv proyecto-computo3 cp -r db/imagenes/. storage/app/public/
        lv proyecto-computo3 php artisan storage:link

3. Abrir: http://proyecto-computo3.localhost:8083

## Usuarios de prueba

| Rol | Correo | Contraseña |
|---|---|---|
| Administrador | ga22021@ues.edu.sv | Sistemas2026! |
| Administrador | sp23001@ues.edu.sv | Sistemas2026! |
| Usuario sin acceso al panel | usuario@ues.edu.sv | Usuario2026! |

## Carpeta db/

- `db/database.sqlite`: base de datos con las entradas, categorías y usuarios.
- `db/imagenes/`: fotos de las evidencias (se copian a `storage/app/public/`).
