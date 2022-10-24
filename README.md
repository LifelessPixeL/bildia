# Bildia Test

---

Symfony version: 5.4 <br>

---

[Enunciado de la prueba](https://bildia.notion.site/Prueba-t-cnica-Full-Stack-Developer-Bildia-a50862ebba4d45588e6eb4c4014041ea)

## Instalación
Clonar el repositorio
````shell
$ git clone git@github.com:LifelessPixeL/bildia.git
````

Crear el archivo .env.local copiando .env (dejar las variables igual)
````shell
$ cd app
$ cp .env .env.local
````

Levantar los contenedores Docker
````shell
$ cd ..
$ docker-compose --env-file=app/.env.local up -d --build
````

Instalar las librerías a través de Composer
````shell
$ docker exec php composer install
````

Correr las migraciones
````shell
$ docker exec php php bin/console doctrine:migrations:migrate
````

Instalar los paquetes NPM
````shell
Desde la carpeta de proyecto

$ cd app
$ npm install
$ npm run build
````

You can now access the server at http://localhost:8080
