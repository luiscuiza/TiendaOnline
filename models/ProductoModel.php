<?php

class ProductoModel {

    // Agregar un nuevo producto
    static public function add($nombre, $descripcion, $marca, $images, $categoria_id) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("INSERT INTO productos (nombre, descripcion, marca, images, categoria_id) VALUES (:nombre, :descripcion, :marca, :images, :categoria_id)");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
            $stmt->bindParam(':images', $images, PDO::PARAM_STR);
            $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return ['status' => true, 'message' => 'Producto agregado correctamente', 'data' => ['id' => $pdo->lastInsertId()]];
            } else {
                return ['status' => false, 'message' => 'Error al agregar el producto'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Actualizar un producto
    static public function update($id, $nombre, $descripcion, $marca, $images, $categoria_id) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("UPDATE productos SET nombre = :nombre, descripcion = :descripcion, marca = :marca, images = :images, categoria_id = :categoria_id WHERE id = :id AND deleted_at IS NULL");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
            $stmt->bindParam(':images', $images, PDO::PARAM_STR);
            $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return ['status' => true, 'message' => 'Producto actualizado correctamente'];
            } else {
                return ['status' => false, 'message' => 'Error al actualizar el producto'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Eliminar (soft delete) un producto
    static public function delete($id) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("UPDATE productos SET deleted_at = NOW() WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return ['status' => true, 'message' => 'Producto eliminado correctamente'];
            } else {
                return ['status' => false, 'message' => 'Error al eliminar el producto'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Obtener un producto por ID
    static public function getById($id) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id AND deleted_at IS NULL");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return ['status' => true, 'data' => $stmt->fetch(PDO::FETCH_ASSOC)];
            } else {
                return ['status' => false, 'message' => 'Producto no encontrado'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Obtener todos los productos (sin eliminar)
    static public function getAll() {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->query("SELECT * FROM productos WHERE deleted_at IS NULL");
            if ($stmt->rowCount() > 0) {
                return ['status' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
            } else {
                return ['status' => false, 'message' => 'No se encontraron productos'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}
