import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import { exec } from "child_process";

const swaggerGeneratorPlugin = {
    name: "swager-generator",
    handleHotUpdate({ file, server }) {
        if (file.includes("app/Http/Controllers/Api")) {
            console.log(
                "Detectado cambio en el controlador, regenerando documentación Swagger...",
            );

            exec(
                "./vendor/bin/sail artisan l5-swagger:generate",
                (error, stdout, stderr) => {
                    if (error) {
                        console.error(
                            `Error al generar la documentación Swagger: ${error.message}`,
                        );
                        return;
                    }
                    console.log(
                        "Documentación Swagger regenerada correctamente.",
                    );
                    server.ws.send({ type: "full-reload", path: "*" });
                },
            );
        }
    },
};

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
        swaggerGeneratorPlugin,
    ],
});
