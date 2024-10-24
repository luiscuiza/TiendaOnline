CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'cliente') DEFAULT 'cliente',
    deleted_at TIMESTAMP NULL DEFAULT NULL  -- Soft delete
);

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    deleted_at TIMESTAMP NULL DEFAULT NULL  -- Soft delete
);

CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    marca VARCHAR(100),
    images VARCHAR(255),
    categoria_id INT,
    deleted_at TIMESTAMP NULL DEFAULT NULL,  -- Soft delete
    FOREIGN KEY (categoria_id) REFERENCES categorias(id),
    UNIQUE (nombre, marca)
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    variante VARCHAR(50) NOT NULL,        -- Talla, Color u otra variación
    precio DECIMAL(10, 2) NOT NULL,
    stock INT DEFAULT 0 NOT NULL,
    deleted_at TIMESTAMP NULL DEFAULT NULL,  -- Soft delete
    FOREIGN KEY (item_id) REFERENCES items(id),
    UNIQUE (item_id, variante)
);

CREATE TABLE facturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2),
    deleted_at TIMESTAMP NULL DEFAULT NULL,  -- Soft delete
    FOREIGN KEY (cliente_id) REFERENCES usuarios(id)
);

CREATE TABLE detalle_factura (
    factura_id INT,
    producto_id INT,
    cantidad INT,
    precio_unitario DECIMAL(10, 2),
    deleted_at TIMESTAMP NULL DEFAULT NULL,  -- Soft delete
    FOREIGN KEY (factura_id) REFERENCES facturas(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id),
    PRIMARY KEY (factura_id, producto_id)
);
