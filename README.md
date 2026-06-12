# 📦 Sistema de Gestión de Inventario (DAW)

Aplicación web desarrollada en **Laravel** para la gestión integral de productos, categorías, proveedores y perfiles de usuario. Este proyecto implementa un sistema **CRUD completo**, con relaciones complejas de base de datos y una **interfaz moderna y responsiva**. Todo el entorno está **Dockerizado** para garantizar consistencia.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-000000?style=for-the-badge&logo=mysql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)

---

## Características Principales

* **Gestión de Productos**: Creación, edición y listado con validaciones en servidor.
* **Relaciones N:M**: Asignación de múltiples proveedores a productos mediante tabla pivote (`product_supplier`).
* **Relaciones 1:1**: Sistema de perfiles de usuario extendido (`users` ↔ `profiles`).
* **Relaciones 1:N**: Categorización de productos.
* **Autenticación**: Sistema seguro de Login y Registro.
* **Infraestructura Ágil**: Entorno de desarrollo completo (Apache, PHP, MySQL, phpMyAdmin) mediante Docker Compose.

---

## Requisitos Previos

Solo necesitas dos herramientas instaladas en tu máquina local:

* [Git](https://git-scm.com/)
* [Docker Desktop](https://www.docker.com/products/docker-desktop/)

---

## Guía de Instalación Paso a Paso

### 1. Clonar el Repositorio e Iniciar Infraestructura

Descarga el código y levanta los servicios en segundo plano.

```bash
git clone https://github.com/TU_USUARIO/TU_REPOSITORIO.git
cd nombre-de-tu-proyecto
docker-compose up -d
```

---

### 2️. Configurar el Entorno

Duplica el archivo de ejemplo para crear tu configuración local y ajusta las credenciales para que apunten a la red de Docker.

```bash
cd src
cp .env.example .env
```

Abre el archivo `src/.env` y asegúrate de que la conexión a la base de datos apunte al contenedor `db`:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=user
DB_PASSWORD=user_password_segura
```

Vuelve al directorio raíz (donde está el `docker-compose.yml`):
```bash
cd ..
```

---

### 3️ Instalar Dependencias (Backend)

Descarga las librerías de Laravel usando el contenedor.

```bash
docker-compose exec web composer install
```

---

### 4️ Generar Clave y Migrar Base de Datos

Prepara la seguridad de la aplicación y construye la estructura de la base de datos con datos de prueba (Seeders).

```bash
docker-compose exec web php artisan key:generate
docker-compose exec web php artisan migrate:fresh --seed
```

---

### 5️ Instalar Dependencias (Frontend)

Entra a la carpeta de la aplicación y compila los estilos/scripts (Bootstrap/Vite).

```bash
cd src
npm install
npm run build
```

---

### 6️ Acceder a la Aplicación

El servidor Apache ya está corriendo y mapeado a tu máquina local. No es necesario usar `php artisan serve`.

* **Aplicación Web:** 👉 [http://localhost](http://localhost)
* **Gestor de Base de Datos (phpMyAdmin):** 👉 [http://localhost:8080](http://localhost:8080)

---

## 📚 Notas Adicionales

* Este proyecto está orientado a fines **educativos (DAW)**.
* Sigue las buenas prácticas de Laravel (MVC, Eloquent, Seeders, Factories).
* Ideal como base para ampliar con roles, permisos o APIs REST.

---

## 📄 Licencia

Proyecto de uso académico y educativo. Puedes modificarlo y adaptarlo libremente.
