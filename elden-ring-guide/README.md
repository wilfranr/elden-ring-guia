# Elden Ring Guide API

Esta es la API de backend para la aplicación Elden Ring Guide. Proporciona todos los datos relacionados con el juego, como jefes, objetos, armas y más. Está construida con Laravel y utiliza Meilisearch para una funcionalidad de búsqueda rápida.

## Características

- API RESTful para gestionar los datos de Elden Ring.
- Documentación de API generada con Swagger (OpenAPI).
- Búsqueda potente implementada con Laravel Scout y Meilisearch.
- Endpoints para una amplia variedad de entidades del juego, incluyendo:
  - Jefes, Objetos, Municiones, Armaduras, Cenizas de Guerra, Clases, Criaturas, Hechizos, Encantamientos, NPCs, Escudos, Espíritus, Talismanes y Armas.

## Requisitos Previos

- PHP >= 8.2
- Composer
- Un servidor de base de datos compatible con Laravel (ej. MySQL, PostgreSQL, SQLite).
- Una instancia de [Meilisearch](https://www.meilisearch.com/) en ejecución.

## Guía de Instalación

1.  **Clonar el repositorio (si aún no lo has hecho):**
    ```bash
    git clone <URL_DEL_REPOSITORIO>
    cd elden-ring-guide
    ```

2.  **Instalar dependencias de PHP:**
    ```bash
    composer install
    ```

3.  **Configurar el entorno:**
    Copia el archivo de entorno de ejemplo y genera la clave de la aplicación.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Configurar el archivo `.env`:**
    Abre el archivo `.env` y configura las credenciales de tu base de datos (`DB_*`) y las claves de Meilisearch (`MEILISEARCH_*`).
    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=elden_ring
    DB_USERNAME=root
    DB_PASSWORD=

    SCOUT_DRIVER=meilisearch
    MEILISEARCH_HOST=http://127.0.0.1:7700
    MEILISEARCH_KEY=tu_clave_maestra_de_meilisearch
    ```

5.  **Ejecutar las migraciones de la base de datos:**
    Esto creará todas las tablas necesarias en tu base de datos.
    ```bash
    php artisan migrate
    ```

6.  **(Opcional) Poblar la base de datos:**
    Si hay seeders disponibles, puedes poblar la base de datos con datos iniciales.
    ```bash
    php artisan db:seed
    ```

7.  **(Opcional) Importar datos a Meilisearch:**
    Para que la búsqueda funcione, necesitas importar los modelos al índice de Meilisearch.
    ```bash
    php artisan scout:import "App\Models\SearchableItem"
    ```

## Uso

### Iniciar el Servidor de Desarrollo

Para iniciar el servidor de desarrollo local de Laravel, ejecuta:
```bash
php artisan serve
```
La API estará disponible en `http://127.0.0.1:8000`.

### Documentación de la API

La documentación de la API, generada con Swagger, está disponible en la siguiente ruta una vez que el servidor está en marcha:
```
/api/documentation
```
Por ejemplo: `http://127.0.0.1:8000/api/documentation`

### Ejecutar Pruebas

Para ejecutar el conjunto de pruebas de PHPUnit, utiliza el siguiente comando:
```bash
php artisan test
```

## Endpoints de la API

La API proporciona endpoints de solo lectura (`index`, `show`) para los siguientes recursos:

- `/api/bosses`
- `/api/items`
- `/api/ammos`
- `/api/armors`
- `/api/ashes`
- `/api/classes`
- `/api/creatures`
- `/api/incantations`
- `/api/locations`
- `/api/npcs`
- `/api/shields`
- `/api/sorceries`
- `/api/spirits`
- `/api/talismans`
- `/api/weapons`
- `/api/regions/{region}`
- `/api/search?q={termino_de_busqueda}`