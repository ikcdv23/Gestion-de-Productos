# 📦 Sistema de Gestión de Inventario (DAW)

Aplicación web desarrollada en **Laravel** para la gestión integral de productos, categorías, proveedores y perfiles de usuario. Este proyecto implementa un sistema **CRUD completo**, con relaciones complejas de base de datos y una **interfaz moderna y responsiva**. Todo el entorno está **Dockerizado** para garantizar consistencia.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-000000?style=for-the-badge&logo=mysql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)

---

## ✨ Características Principales

* **Gestión de Productos**: Creación, edición y listado con validaciones en servidor.
* **Relaciones N:M**: Asignación de múltiples proveedores a productos mediante tabla pivote (`product_supplier`).
* **Relaciones 1:1**: Sistema de perfiles de usuario extendido (`users` ↔ `profiles`).
* **Relaciones 1:N**: Categorización de productos.
* **Autenticación**: Sistema seguro de Login y Registro.
* **Infraestructura Ágil**: Entorno de desarrollo completo (Apache, PHP, MySQL, phpMyAdmin) mediante Docker Compose.

---

## 🚀 Requisitos Previos

Solo necesitas dos herramientas instaladas en tu máquina local:

* [Git](https://git-scm.com/)
* [Docker Desktop](https://www.docker.com/products/docker-desktop/)
* *Node.js (Opcional, solo si deseas compilar los assets del frontend localmente)*

---

## 🛠️ Guía de Instalación Paso a Paso

Sigue estos pasos para desplegar el proyecto mediante contenedores:

### 1️⃣ Clonar el Repositorio e Iniciar Infraestructura

Descarga el código y levanta los servicios en segundo plano.

```bash
git clone [https://github.com/TU_USUARIO/TU_REPOSITORIO.git](https://github.com/TU_USUARIO/TU_REPOSITORIO.git)
cd nombre-de-tu-proyecto
docker-compose up -d
2️⃣ Configurar el Entorno
Duplica el archivo de ejemplo para crear tu configuración local y ajusta las credenciales para que apunten a la red de Docker.

Bash
cd src
cp .env.example .env
Abre el archivo src/.env y asegúrate de que la conexión a la base de datos apunte al contenedor db:

Fragmento de código
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=user
DB_PASSWORD=user_password_segura
Vuelve al directorio raíz (donde está el docker-compose.yml):

Bash
cd ..
3️⃣ Instalar Dependencias (Backend)
Descarga las librerías de Laravel usando el contenedor.

Bash
docker-compose exec web composer install
4️⃣ Generar Clave y Migrar Base de Datos
Prepara la seguridad de la aplicación y construye la estructura de la base de datos con datos de prueba (Seeders).

Bash
docker-compose exec web php artisan key:generate
docker-compose exec web php artisan migrate:fresh --seed
5️⃣ Instalar Dependencias (Frontend)
Entra a la carpeta de la aplicación y compila los estilos/scripts (Bootstrap/Vite).

Bash
cd src
npm install
npm run build
6️⃣ Acceder a la Aplicación
El servidor Apache ya está corriendo y mapeado a tu máquina local. No es necesario usar php artisan serve.

Aplicación Web: 👉 http://localhost

Gestor de Base de Datos (phpMyAdmin): 👉 http://localhost:8080


---

### 4) Transferencia de Conocimiento (Escenarios Futuros)

* **Pro-Tip 1 (SSOT - Single Source of Truth):** En ingeniería de software, la "Única Fuente de Verdad" es vital. Si decides que Docker va a alojar tu aplicación, **todas** las guías de tu README deben girar en torno a esa decisión. No dejes comandos legacy "por si acaso", confunde al usuario.
* **Pro-Tip 2 (Seguridad en Documentación):** Nunca subas contraseñas reales al README ni al repositorio en Git. En las guías, usa marcadores de posición (`user_password_segura`) y deja que el archivo `.env.example` dicte qué variables se necesitan, mientras que el `.env` (que se ignora en Git) guarda los secretos reales.

***

Teniendo en cuenta que Composer ya debe haber terminado de descargar todo, ¿pudiste ejecutar el coman
