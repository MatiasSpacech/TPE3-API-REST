
<?php
require_once 'libs/router.php';

require_once 'app/controllers/producto.controller.php';

$router = new Router();

#                 endpoint        verbo      controller              metodo
$router->addRoute('productos'      ,            'GET',     'ProductoController',   'mostrarProductos');
$router->addRoute('tareas/:id'  ,            'GET',     'TaskApiController',   'get'   );
$router->addRoute('tareas/:id'  ,            'DELETE',  'TaskApiController',   'delete');
$router->addRoute('tareas'  ,                'POST',    'TaskApiController',   'create');
$router->addRoute('tareas/:id'  ,            'PUT',     'TaskApiController',   'update');
$router->addRoute('tareas/:id/finalizada'  , 'PUT',     'TaskApiController',   'setFinalize');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);


/*include_once "app/controllers/producto.controller.php";
include_once "app/controllers/categoria.controller.php";
require_once 'libs/response.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';
require_once 'app/controllers/auth.controller.php';


define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

if (!empty($_GET["action"])){
    $action = $_GET["action"];
}
else{
    $action= "productos";
}

$params= explode('/', $action);

switch ($params[0]) {
    case 'productos':
        sessionAuthMiddleware($res);
        $controller = new ProductoController($res);
        if (isset($params[1]))
            $controller->detalleProducto($params[1]);
        else 
            $controller->mostrarProductos();        
        break;
    case 'nuevo':
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);        
        $controller = new ProductoController($res);
        $controller->agregarProducto();    
        break;    
    case 'formProducto':
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);
        $controller = new ProductoController($res);
        $controller->nuevoProducto();
        break;
    case 'formEditarProducto':
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);        
        $controller = new ProductoController($res);
        if (isset($params[1]))
            $controller->formProducto($params[1]);         
        break;
    case 'editar':
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);        
        $controller = new ProductoController($res);
        if (isset($params[1]))
            $controller->updateProducto($params[1]);         
        break;    
    case 'eliminarProducto':
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);
        $controller = new ProductoController($res);
            if (isset($params[1]))
                $controller->deleteProducto($params[1]);         
        break;
    case 'categorias':
        sessionAuthMiddleware($res);        
        $controller = new CategoriaController($res);
        if (isset($params[1]))
            $controller->mostrarProductosPorCategoria($params[1]);
        else
            $controller->mostrarCategorias();
        break;
    case 'formCategoria':
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);
        $controller = new CategoriaController($res);
        $controller->nuevaCategoria();
        break;
    case 'nuevaCategoria':
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);
        $controller = new CategoriaController($res);
        $controller->agregarCategoria();
        break;
    case 'formEditarCategoria':
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);        
        $controller = new CategoriaController($res);
        if (isset($params[1]))
            $controller->formCategoria($params[1]);         
        break;
    case 'editarCategoria': 
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);       
        $controller = new CategoriaController($res);
        if (isset($params[1]))
          $controller->updateCategoria($params[1]);         
        break;
    case 'eliminarCategoria':
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);
        $controller = new CategoriaController($res);
        if (isset($params[1]))
            $controller->deleteCategoria($params[1]);         
        break;
    case 'admin':
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);
        $controller = new ProductoController($res);
        $controller->mostrarAdmin(); 
        break;
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();    
    
    default:
        echo ("Error 404");
        break;
}
  
 */ 
