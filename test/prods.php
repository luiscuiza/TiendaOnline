<?php

require_once 'helpers/env.php';
require_once 'helpers/connection.php';

require_once 'models/ProductoModel.php';
require_once 'models/ProductInfoModel.php';
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

function testProductoModel() {
    echo "Testing ProductoModel\n";
    
    // Test Add
    $response = ProductoModel::add('Camisa Deportiva', 'Camisa de algodón 100%', 'Nike', 'imagen1.jpg', 1);
    print_r($response);

    if ($response['status']) {
        $producto_id = $response['data']['id'];
        
        // Test Get by ID
        $response = ProductoModel::getById($producto_id);
        print_r($response);

        // Test Update
        $response = ProductoModel::update($producto_id, 'Camisa Casual', 'Camisa casual de algodón', 'Adidas', 'imagen2.jpg', 1);
        print_r($response);

        // Test Soft Delete
        $response = ProductoModel::delete($producto_id);
        print_r($response);
    }
}

function testProductInfoModel() {
    echo "Testing ProductInfoModel\n";

    // Test Add
    $response = ProductInfoModel::add(1, 'M', 199.99, 50); // Usando el producto_id 1
    print_r($response);

    if ($response['status']) {
        $product_info_id = $response['data']['id'];

        // Test Get by ID
        $response = ProductInfoModel::getById($product_info_id);
        print_r($response);

        // Test Update
        $response = ProductInfoModel::update($product_info_id, 1, 'L', 249.99, 30);
        print_r($response);

        // Test Soft Delete
        $response = ProductInfoModel::delete($product_info_id);
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
testProductoModel();
echo "\n";
testProductInfoModel();
echo "\n";
testFacturaModel();

echo "Pruebas completadas.\n";

?>
