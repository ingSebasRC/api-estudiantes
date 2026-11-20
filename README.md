# API REST de Registro de Estudiantes (Laravel + MySQL + Docker)

API desarrollada en Laravel con base de datos MySQL 8.0, orquestada en contenedores separados mediante Docker Compose.

## Requisitos previos
* Docker y Docker Compose instalados.

## Pasos de ejecucion

1. Clonar el repositorio y entrar al directorio:
       git clone <URL_DE_TU_REPOSITORIO>
       cd api-estudiantes

2. Configurar variables de entorno:
       cp .env.example .env

3. Construir y levantar los contenedores (app y db):
       docker compose up -d --build

4. Instalar dependencias de Composer y generar clave de aplicacion:
       docker compose exec app composer install
       docker compose exec app php artisan key:generate

5. Ejecutar migraciones y poblar la base de datos con los 5 registros iniciales:
       docker compose exec app php artisan migrate --seed

6. Verificar el estado de los contenedores:
       docker compose ps

## Endpoints disponibles

- GET /api/health : Verifica el estado de la API y la conexion con MySQL.
- GET /api/estudiantes : Lista todos los estudiantes registrados.
- POST /api/estudiantes : Registra un nuevo estudiante (valida nombre, correo unico y programa).
- GET /api/estudiantes/{id} : Consulta un estudiante por su ID o retorna error 404.

## Pregunta teorica: Por que DB_HOST debe ser db y no localhost?

En Docker, cada contenedor posee su propia interfaz de red aislada (loopback). Si se configura DB_HOST=localhost (o 127.0.0.1) dentro de la aplicacion Laravel, el contenedor app intentara conectarse a un servidor MySQL ejecutandose dentro de si mismo, lo cual fallara con un error de conexion rechazada (Connection refused) porque MySQL corre en otro contenedor separado.

Al levantar los servicios con Docker Compose, ambos contenedores (app y db) se conectan automaticamente a una misma red virtual interna (bridge). Docker proporciona un servidor DNS embebido dentro de esa red que resuelve los nombres de los servicios definidos en el archivo docker-compose.yml hacia sus direcciones IP internas correspondientes. Por ello, al establecer DB_HOST=db, el contenedor app localiza y se comunica directamente con el contenedor de base de datos db.
