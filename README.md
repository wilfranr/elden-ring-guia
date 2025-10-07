# Elden Ring Guide

Este repositorio contiene el código fuente para una guía completa del videojuego Elden Ring. El proyecto está estructurado como un monorepo y se divide en dos componentes principales:

1.  **Backend (API RESTful)**
2.  **Frontend (Aplicación de una Sola Página - SPA)**

---

## Descripción de los Componentes

### Backend (`elden-ring-guide`)

El backend es una API RESTful construida con **Laravel (PHP)**. Se encarga de toda la lógica de negocio, la gestión de la base de datos y proporciona los datos necesarios al frontend. También incluye una potente función de búsqueda impulsada por Meilisearch.

**Para más detalles sobre cómo instalar, configurar y ejecutar el backend, consulta su documentación específica:**

> ➡️ **[Documentación del Backend](./elden-ring-guide/README.md)**

### Frontend (`elden-ring-frontend`)

El frontend es una aplicación web moderna construida con **Angular (TypeScript)**. Consume los datos de la API del backend para presentar a los usuarios una interfaz interactiva y fácil de usar donde pueden explorar toda la información sobre Elden Ring.

**Para más detalles sobre cómo instalar, configurar y ejecutar el frontend, consulta su documentación específica:**

> ➡️ **[Documentación del Frontend](./elden-ring-frontend/README.md)**

## Cómo Empezar

Para poner en marcha todo el proyecto, necesitarás configurar y ejecutar tanto el backend como el frontend por separado. Sigue las instrucciones detalladas en los archivos `README.md` de cada directorio respectivo.

1.  Configura y ejecuta el [servidor del backend](./elden-ring-guide/).
2.  Configura y ejecuta la [aplicación del frontend](./elden-ring-frontend/).
