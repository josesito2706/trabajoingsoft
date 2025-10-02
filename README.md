# Sistema de Atención al Cliente ARIS

Sistema web desarrollado en PHP para la gestión de clientes, solicitudes, reclamos y reportes.

## Configuración para Railway

Este proyecto está configurado para desplegarse automáticamente en Railway.

### Variables de Entorno Requeridas

Configura las siguientes variables de entorno en Railway:

- `MYSQL_HOST`: Host de la base de datos MySQL
- `MYSQL_USER`: Usuario de la base de datos
- `MYSQL_PASSWORD`: Contraseña de la base de datos
- `MYSQL_DATABASE`: Nombre de la base de datos
- `MYSQL_PORT`: Puerto de la base de datos (por defecto: 3306)

### Estructura del Proyecto

- `index.php`: Página principal de login
- `controladores/`: Controladores PHP para la lógica de negocio
- `modelos/`: Modelos de datos y conexión a BD
- `vistas/`: Formularios y vistas de la aplicación
- `metodos/`: Métodos auxiliares
- `img/`: Imágenes y recursos estáticos

### Despliegue en Railway

1. Conecta tu repositorio de GitHub a Railway
2. Railway detectará automáticamente que es una aplicación PHP
3. Configura las variables de entorno de la base de datos
4. Railway desplegará automáticamente la aplicación

### Base de Datos

Asegúrate de tener una base de datos MySQL configurada con las tablas necesarias para el sistema.
