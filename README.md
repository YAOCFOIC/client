# Nombre del Proyecto :CLIENT
configuracion de la ruta, si no se crea la carpeta client, debes crear la manual mente tiene que poner el archivo sobre el wamp/www/  > 
*"Client : Todo lo que hagán, háganlo de corazón, como para el Señor y no para los hombres" - Colosenses 3:23*

## 1 Herramientas utilizadas
- PHP 8.0.26
- MySQL 8.0.31
- WAMPSERVER
- Patrón de arquitectura MVC

## 2 🛠 Instalación

1. Instalar [WAMPSERVER](https://www.wampserver.com/)
2. Asegurar versión PHP 8.0.26
3. MySQL 8.0.31

### 3 Configuración inicial
1. Clonar repositorio:

git clone https://github.com/YAOCFOIC/client.git

mysql -u root -p < ruta_del_archivo.sql

## Configurar constantes:
Editar app-cliente/config/constants.php con tus credenciales:

define('DB_HOST', 'localhost');

define('DB_USER', 'tu_usuario');

define('DB_PASS', 'tu_contraseña');

define('DB_NAME', 'nombre_bd');

# 🚀 Ejecución
Iniciar WAMPSERVER
Acceder a:
##### http://localhost/cliente/public/
##### 🔐 Configuración de phpMyAdmin
##### Acceder a:
###### Credenciales por defecto: 
##### Usuario: root 
##### Contraseña: (vacía) 
##### Exportar base de datos: Seleccionar base de datos Pestaña Exportar > Formato SQL Seleccionar: ✅ Exportar estructura y datos ✅ Agregar DROP TABLE
##### INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`, `creado_en`) VALUES (NULL, 'DATA', 'DATA@GMAIL.COM', '12345678*', 'admin', CURRENT_TIMESTAMP);
```bash
 📂 Estructura de carpetas
cliente/
├── app-cliente/
│   ├── controllers/ #tenemos los controladores donde gestionamos la lógica comunicación, de base de datos a nuestras “plantillas”
│   │   ├── AuthController.php # lógica de usuario
│   │   ├── OrderController.php # lógica de ordenes o pedidos de usuarios
│   │   ├── ProductController: lógica de productos usuarios
│   │   ├── OrderController.php # lógica de ordenes o pedidos de usuarios
│   │   └──ProcesoController: lógica de proceso_eventos usuarios
│   ├── models/
│   │   ├── Database.php # conexión a base de datos
│   │   ├── User.php # Consultas sql de pedidos y detalle_pedidos
│   │   ├── Models.php # Conexión a base de datos y consultas sql
│   │   ├── Order.php # Consultas sql de pedidos y detalle_pedidos
│   │   ├── Proceso.php # Consultas sql de precesos
│   │   └── Product.php # Consultas sql de productos
│   └── views/ #carpeta donde gestionamos las vistaso plantillas de nuestra aplicación 
│   │   ├── Auth/  # contiene las vistas de registro y login
│   │   ├── Errors/  # contiene la vistas de errores 404 505 etc
│   │   ├── Orders/ #  # contiene las vistas de confirmar pedidos y historial
│   │   ├── Partials/ # contiene las vistas de header footer y notificación “casi como laravel un Blade”
│   │   ├── Products/ #contiene las vistas para los productos usuarios: cliente, admin y interesados
│   │   └── Procesos/ # contiene las vistas para gestión de eventos
├── config/ # se realizan todo lo relacionado con rutas y configuraciones de la tiempos en bbdd 
│   ├── constants.php # tiene lo relacionado con la información de la bbdd y el tiempo de conexión 
│   └── routes.php # son las rutas que le damos a cada uno de nuestros procesos
└── public/ # tiene todo lo relacionado con : Cargar constantes y rutas, obtener rutas y redirecciones también el archivo css y js que se ubican es assets
    ├── assets/ # archivo que contendrá nuestros css, js y imágenes 
    │   ├── css/
    │   ├── js/
    │   └── images/
    ├── .htaccess # conexión y evitamos inyecciones XSS
    └── index.php # Cargar constantes y rutas, obtener rutas y redirecciones
```
 # Configuración importante
.htaccess: Configuración para:

Prevenir inyecciones XSS

Manejo de rutas amigables

Redirecciones seguras

Assets:

Colocar archivos CSS/JS en public/assets/

Actualizar referencias en las vistas

# ⚙️ Configuración de rutas
Editar config/routes.php para gestionar:

Autenticación

Gestión de pedidos

Flujo de productos

Procesos de eventos

