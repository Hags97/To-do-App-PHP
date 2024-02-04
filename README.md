# To-do-App-PHP
To-Do app made with PHP, HTML, CSS Y BOOTSTRAP

Esta es una sencilla aplicación de lista de tareas (To-Do) desarrollada en PHP que utiliza WampServer, PHP 8.2.13, MySQL 8.2 y Apache 2.4.58 para almacenar usuarios y sus tareas asociadas.
Se ha realizado un simple login, con una validadción muy sencilla y uso de bbdd par guardar las tareas y usuarios registrados.


Características Principales

Registro de usuarios con nombre, correo electrónico y contraseña segura.
Inicio de sesión de usuarios.
Creación, visualización y eliminación de tareas pendientes.
Interfaz intuitiva y fácil de usar.

Requisitos

WampServer
PHP 8.2.13
MySQL 8.2
Apache 2.4.58

Configuración

Clona o descarga el repositorio.
Configura la conexión a la base de datos en config/db.php.
Inicia WampServer y asegúrate de que Apache y MySQL estén activos.
Abre la aplicación en tu navegador visitando http://localhost/nombre-de-la-app.


Uso

Regístrate con tu nombre, correo electrónico y contraseña.
Inicia sesión con tus credenciales.
Añade nuevas tareas desde la página principal.
Elimina las tareas cuándo las completes.
Cierra sesión cuando hayas terminado.



Video: https://www.youtube.com/watch?v=V8SJ6nc6634


BBDD:
CREATE DATABSE todoapp;

tablas:
-- Crear la tabla 'usuarios'
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Crear la tabla 'task'
CREATE TABLE task (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    description TEXT,
    usuario_task_id INT,
    FOREIGN KEY (usuario_task_id) REFERENCES usuarios(id) ON DELETE CASCADE
);
