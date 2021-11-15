# INSTALACIÓN

## Algunas consideraciones *(sobre todo cuando se usa en entornos Linux)*

#### El modulo rewrite debe esta activado, para ello ejecute los siguientes comandos:

`sudo a2enmod rewrite`  
`sudo systemctl restart apache2.service`

#### Dar permisos a las siguientes carpetas

`sudo chmod -R 777 storage/`  
`sudo chmod -R 777 public/`  

## PASOS PARA DAR INICIO AL USO DEL SISTEMA

#### Configurar las carpetas para los archivos

NOTAS: El enlace *simbolico* se realiza entre los directorios:  
*$PATH_PROYECTO/public/raiz*  -->  *$PATH_PROYECTO/storage/app/public* puede verlo en **config/filesystems.php**  
El guardado de los archivos (por medio de laravel) se realiza en el directorio
**storage/app/public** y para la lectura de los archivos se realiza en **public/raiz**
Ejecutar lo siguiente para crear el archivo raiz donde se guardaran los documetos  

`php artisan storage:link`  


#### Generar la base de datos

Ejecute el siguiente comando para generar la base de datos

`php artisan migrate:fresh --seed`

_Si con el anterior comando la base de datos no se ha llenado con los valores predeterminados, ejecute lo siguiente_

`php artisan db:seed`
    
_Si con el comando anterior aun no se llena, tendra que ejecutarlo manualmente, para ello ejecute en orden lo siguiente_

`./seeder.sh`

#### Permisos de las nuevas carpetas creadas

`sudo chown -R www-data:$USER public/raiz/*` _Para usuarios de ubuntu_


