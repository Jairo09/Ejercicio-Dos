Antes de Correr el proyecto hay que hacer los siguientes pasos:

1-Instala el proyecto con:

composer install


2-Configuraciones de base de datos

En este proyecto se trabaja con MySql y la base de datos que se debe crear
es "ejercicioDos"

la configuracion en el archivo ".env" es la siguiente:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ejercicioDos
DB_USERNAME=root
DB_PASSWORD=

3-Despues de crear la base de datos dirijase al directorio de este proyecto haciendo el
uso de la consola (bash en windows) y escriba el siguiente comando:

"php artisan migrate:fresh --seed"

este comando hará las migraciones de las tablas de la base de datos haciendo primero 
un borrado completo y luego agrega las tablas y al mismo tiempo crea 10 usuarios
ramdom con la configuración de los seeders

4-luego echamos a andar el sistema con 

"php artisan serve"