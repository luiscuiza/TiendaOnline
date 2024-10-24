<?php

require_once 'helpers/env.php';
require_once 'helpers/connection.php';

require_once 'models/ItemModel.php';
require_once 'models/ProductModel.php';
require_once 'models/CategoriaModel.php';
require_once 'models/FacturaModel.php';

global $env;
$env = new Environment('.env');

function testCategoriaModel() {
    echo "Testing CategoriaModel\n";
    
    // Test Add
    $response = CategoriaModel::add('Ropa');
    print_r($response);

    if ($response['status']) {
        $categoria_id = $response['data']['id'];
        
        // Test Get by ID
        $response = CategoriaModel::getById($categoria_id);
        print_r($response);

        // Test Update
        $response = CategoriaModel::update($categoria_id, 'Ropa Deportiva');
        print_r($response);

        // Test Soft Delete
        $response = CategoriaModel::delete($categoria_id);
        print_r($response);
    }
}

function testItemModel() {
    echo "Testing ItemModel\n";
    
    // Test Add
    $response = ItemModel::add('Camisa Deportiva', 'Camisa de algodón 100%', 'Nike', 'imagen1.jpg', 1);
    print_r($response);

    if ($response['status']) {
        $item_id = $response['data']['id'];
        
        // Test Get by ID
        $response = ItemModel::getById($item_id);
        print_r($response);

        // Test Update
        $response = ItemModel::update($item_id, 'Camisa Casual', 'Camisa casual de algodón', 'Adidas', 'imagen2.jpg', 1);
        print_r($response);

        // Test Soft Delete
        $response = ItemModel::delete($item_id);
        print_r($response);
    }
}

function testProductoModel() {
    echo "Testing ProductoModel\n";

    // Test Add
    $response = ProductoModel::add(1, 'M', 199.99, 50); // Usando el item_id 1
    print_r($response);

    if ($response['status']) {
        $producto_id = $response['data']['id'];

        // Test Get by ID
        $response = ProductoModel::getById($producto_id);
        print_r($response);

        // Test Update
        $response = ProductoModel::update($producto_id, 1, 'L', 249.99, 30);
        print_r($response);

        // Test Soft Delete
        $response = ProductoModel::delete($producto_id);
        print_r($response);
    }
}

function testFacturaModel() {
    echo "Testing FacturaModel\n";

    // Test Add
    $response = FacturaModel::add(1, 499.99); // Usando cliente_id 1
    print_r($response);

    if ($response['status']) {
        $factura_id = $response['data']['id'];

        // Test Get by ID
        $response = FacturaModel::getById($factura_id);
        print_r($response);

        // Test Update
        $response = FacturaModel::update($factura_id, 1, 599.99);
        print_r($response);

        // Test Soft Delete
        $response = FacturaModel::delete($factura_id);
        print_r($response);
    }
}

echo "Iniciando pruebas CRUD...\n\n";

testCategoriaModel();
echo "\n";
testItemModel();
echo "\n";
testProductoModel();
echo "\n";
testFacturaModel();

echo "Pruebas completadas.\n";

?>
