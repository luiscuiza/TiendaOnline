<?php

require_once 'helpers/env.php';
require_once 'helpers/connection.php';
require_once 'models/UserModel.php';

global $env;
$env = new Environment('.env');

/* Crear el Usuario Administrador */

UserModel::add(
    "Luis",                // Nombre
    "Cuiza",               // Apellido
    "admin@yopmail.com",   // Email
    "admin",               // Contraseña
    "admin"                // Rol
);

/* Crear el Usuario Cliente */

UserModel::add(
    "Esther",              // Nombre
    "Sanguino",            // Apellido
    "client@yopmail.com",  // Email
    "client",              // Contraseña
    "client"               // Rol
);