
<?php
require_once 'libs/router.php';

require_once 'app/controllers/producto.controller.php';

$router = new Router();

#                 endpoint                      verbo           controller              metodo
$router->addRoute('productos'      ,            'GET',     'ProductoController',   'getProductos');
$router->addRoute('productos/:id'  ,            'GET',     'ProductoController',   'getProducto'   );
$router->addRoute('productos/:id'  ,            'DELETE',  'ProductoController',   'deleteProducto');
$router->addRoute('productos'  ,                'POST',    'ProductoController',   'createProducto');
$router->addRoute('productos/:id'  ,            'PUT',     'ProductoController',        'updateProducto');
$router->addRoute('tareas/:id/finalizada'  , 'PUT',     'TaskApiController',     'setFinalize');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);


