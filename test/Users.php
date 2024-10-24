<?php

/* Crear el Usuario Administrador */

require_once '../helpers/connection.php';
require_once '../models/UserModel.php';

UserModel::add(
    "Luis",                // Nombre
    "Cuiza",               // Apellido
    "admin@yopmail.com",   // Email
    "admin",               // Contraseña
    "admin"                // Rol
);

UserModel::add(
    "Esther",              // Nombre
    "Sanguino",            // Apellido
    "client@yopmail.com",  // Email
    "client",              // Contraseña
    "client"               // Rol
);