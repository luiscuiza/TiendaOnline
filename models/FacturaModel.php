<?php

class FacturaModel {

    // Agregar una nueva factura
    static public function add($cliente_id, $total) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("INSERT INTO facturas (cliente_id, total) VALUES (:cliente_id, :total)");
            $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
            $stmt->bindParam(':total', $total, PDO::PARAM_STR);
            if ($stmt->execute()) {
                return ['status' => true, 'message' => 'Factura agregada correctamente', 'data' => ['id' => $pdo->lastInsertId()]];
            } else {
                return ['status' => false, 'message' => 'Error al agregar la factura'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Actualizar una factura
    static public function update($id, $cliente_id, $total) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("UPDATE facturas SET cliente_id = :cliente_id, total = :total WHERE id = :id AND deleted_at IS NULL");
            $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
            $stmt->bindParam(':total', $total, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return ['status' => true, 'message' => 'Factura actualizada correctamente'];
            } else {
                return ['status' => false, 'message' => 'Error al actualizar la factura'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Eliminar (soft delete) una factura
    static public function delete($id) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("UPDATE facturas SET deleted_at = NOW() WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return ['status' => true, 'message' => 'Factura eliminada correctamente'];
            } else {
                return ['status' => false, 'message' => 'Error al eliminar la factura'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Obtener una factura por ID
    static public function getById($id) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("SELECT * FROM facturas WHERE id = :id AND deleted_at IS NULL");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return ['status' => true, 'data' => $stmt->fetch(PDO::FETCH_ASSOC)];
            } else {
                return ['status' => false, 'message' => 'Factura no encontrada'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // Obtener todas las facturas (sin eliminar)
    static public function getAll() {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->query("SELECT * FROM facturas WHERE deleted_at IS NULL");
            if ($stmt->rowCount() > 0) {
                return ['status' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
            } else {
                return ['status' => false, 'message' => 'No se encontraron facturas'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

}
