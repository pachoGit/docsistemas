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

Ejecutar lo siguiente para crear el archivo raiz donde se guardaran los documetos  
NOTAS: El enlace *simbolico* se realiza entre los directorios:  
*$PATH_PROYECTO/storage/app/public* --> *$PATH_PROYECTO/public/raiz* puede verlo en **config/filesystems.php**  
El guardado de los archivos (por medio de laravel) se realiza en el directorio
**storage/app/public** y para la lectura de los archivos se realiza en **public/raiz**

`php artisan storage:link`


#### Generar la base de datos

`php artisan migrate:fresh --seed`

Si con el anterior comando la base de datos no se ha llenado con los valores predeterminados, ejecute lo siguiente

`php artisan db:seed`
    
Si con el comando anterior aun no se llena, tendra que ejecutarlo manualmente, para ello ejecute en orden lo siguiente  
`php artisan db:seed --class=ProcesosSeeder`  
`php artisan db:seed --class=SubProcesosSeeder`  
`php artisan db:seed --class=UnidadesSeeder`  
`php artisan db:seed --class=EstandaresSeeder`  
`php artisan db:seed --class=TipoDocumentoSeeder`  
`php artisan db:seed --class=GrupoDocumentosSeeder`  


