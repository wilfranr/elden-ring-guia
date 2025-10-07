# Elden Ring Guide Frontend

Este es el proyecto de frontend para la aplicación Elden Ring Guide. Es una aplicación de una sola página (SPA) construida con Angular, diseñada para interactuar con la [API de backend de Elden Ring Guide](../elden-ring-guide/).

## Requisitos Previos

- [Node.js](https://nodejs.org/) (se recomienda la versión LTS)
- [Angular CLI](https://angular.io/cli) (puedes instalarla globalmente con `npm install -g @angular/cli`)
- El [servidor de la API de backend](https://github.com/Yosepht25/Elden-Ring-Guia/tree/main/elden-ring-guide) debe estar en ejecución para que la aplicación funcione correctamente.

## Guía de Instalación

1.  **Navegar al directorio del frontend:**
    ```bash
    cd elden-ring-frontend
    ```

2.  **Instalar dependencias de Node.js:**
    ```bash
    npm install
    ```

## Uso

### Iniciar el Servidor de Desarrollo

Para iniciar el servidor de desarrollo de Angular, ejecuta el siguiente comando. Esto compilará la aplicación y la servirá en `http://localhost:4200/`.

```bash
npm start
```

La aplicación se recargará automáticamente si cambias alguno de los archivos fuente.

### Generar Componentes, Directivas, Pipes y Servicios

Para generar nuevos componentes o cualquier otro artefacto de Angular, puedes usar Angular CLI:

```bash
ng generate component nombre-del-componente
ng generate service nombre-del-servicio
```

### Construir la Aplicación para Producción

Para construir la aplicación para un entorno de producción, utiliza el siguiente comando:

```bash
npm run build
```

Los artefactos de la compilación se almacenarán en el directorio `dist/`. Esta compilación incluye optimizaciones como la minificación de código y la eliminación de código no utilizado (`tree-shaking`) para un rendimiento óptimo.

### Ejecutar Pruebas Unitarias

Para ejecutar las pruebas unitarias a través de [Karma](https://karma-runner.github.io), ejecuta:

```bash
npm test
```

Esto iniciará el corredor de pruebas y ejecutará todos los archivos de especificaciones (`.spec.ts`) del proyecto.