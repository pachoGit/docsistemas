# INSTALACIÓN

## Algunas consideraciones *(sobre todo cuando se usa en entornos Linux)*

#### El modulo rewrite debe esta activado, para ello ejecute los siguientes comandos:

`sudo a2enmod rewrite`  
`sudo systemctl restart apache2.service`

#### Dar permisos a las siguientes carpetas

`sudo chmod -R 777 storage/`  
`sudo chmod -R 777 public/`  
Si estas en una distribución basada en Ubuntu:  
`sudo chown -R www-data:$USER storage/`  
`sudo chown -R www-data:$USER public/`  

## PASOS PARA DAR INICIO AL USO DEL SISTEMA

#### Generar la base de datos

Ejecute el siguiente comando para generar la base de datos

`php artisan migrate:fresh --seed`

_Si con el anterior comando la base de datos no se ha llenado con los valores predeterminados, ejecute lo siguiente_

`./seeder.sh`

#### Para finalizar debemos cambiar los propietarios de las nuevas carpetas creadas

Crear la carpeta public/raiz y luego ejecutar  
`sudo chown -R www-data:$USER public/raiz/*` _Para usuarios de ubuntu_


