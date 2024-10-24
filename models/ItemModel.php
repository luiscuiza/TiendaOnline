<?php

class ItemModel {

    // Agregar un nuevo item
    static public function add($nombre, $descripcion, $marca, $images, $categoria_id) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("INSERT INTO items (nombre, descripcion, marca, images, categoria_id) VALUES (:nombre, :descripcion, :marca, :images, :categoria_id)");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
            $stmt->bindParam(':images', $images, PDO::PARAM_STR);
            $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return ['status' => true, 'message' => 'Item agregado correctamente', 'data' => ['id' => $pdo->lastInsertId()]];
            } else {
                return ['status' => false, 'message' => 'Error al agregar el item'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Actualizar un item
    static public function update($id, $nombre, $descripcion, $marca, $images, $categoria_id) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("UPDATE items SET nombre = :nombre, descripcion = :descripcion, marca = :marca, images = :images, categoria_id = :categoria_id WHERE id = :id AND deleted_at IS NULL");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
            $stmt->bindParam(':images', $images, PDO::PARAM_STR);
            $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return ['status' => true, 'message' => 'Item actualizado correctamente'];
            } else {
                return ['status' => false, 'message' => 'Error al actualizar el item'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Eliminar (soft delete) un item
    static public function delete($id) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("UPDATE items SET deleted_at = NOW() WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return ['status' => true, 'message' => 'Item eliminado correctamente'];
            } else {
                return ['status' => false, 'message' => 'Error al eliminar el item'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Obtener un item por ID
    static public function getById($id) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("SELECT * FROM items WHERE id = :id AND deleted_at IS NULL");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return ['status' => true, 'data' => $stmt->fetch(PDO::FETCH_ASSOC)];
            } else {
                return ['status' => false, 'message' => 'Item no encontrado'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Obtener todos los items (sin eliminar)
    static public function getAll() {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->query("SELECT * FROM items WHERE deleted_at IS NULL");
            if ($stmt->rowCount() > 0) {
                return ['status' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
            } else {
                return ['status' => false, 'message' => 'No se encontraron items'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}
