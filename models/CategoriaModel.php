<?php

class CategoriaModel {

    // Agregar una nueva categoría
    static public function add($nombre) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("INSERT INTO categorias (nombre) VALUES (:nombre)");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            if ($stmt->execute()) {
                return ['status' => true, 'message' => 'Categoría agregada correctamente', 'data' => ['id' => $pdo->lastInsertId()]];
            } else {
                return ['status' => false, 'message' => 'Error al agregar la categoría'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Actualizar una categoría
    static public function update($id, $nombre) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("UPDATE categorias SET nombre = :nombre WHERE id = :id AND deleted_at IS NULL");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return ['status' => true, 'message' => 'Categoría actualizada correctamente'];
            } else {
                return ['status' => false, 'message' => 'Error al actualizar la categoría'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Eliminar (soft delete) una categoría
    static public function delete($id) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("UPDATE categorias SET deleted_at = NOW() WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return ['status' => true, 'message' => 'Categoría eliminada correctamente'];
            } else {
                return ['status' => false, 'message' => 'Error al eliminar la categoría'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Obtener una categoría por ID
    static public function getById($id) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("SELECT * FROM categorias WHERE id = :id AND deleted_at IS NULL");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return ['status' => true, 'data' => $stmt->fetch(PDO::FETCH_ASSOC)];
            } else {
                return ['status' => false, 'message' => 'Categoría no encontrada'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Obtener todas las categorías (sin eliminar)
    static public function getAll() {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->query("SELECT * FROM categorias WHERE deleted_at IS NULL");
            if ($stmt->rowCount() > 0) {
                return ['status' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
            } else {
                return ['status' => false, 'message' => 'No se encontraron categorías'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
    
}
