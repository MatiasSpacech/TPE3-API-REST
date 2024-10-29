<?php
include_once './app/models/producto.model.php';
//include_once './app/views/producto.view.php';
include_once './app/models/categoria.model.php';
require_once './app/views/json.view.php';

class ProductoController
{
    private $modelProducto;
    private $view;
    private $modelCategoria;

    public function __construct()
    {
        $this->modelProducto = new ProductoModel();
        $this->view = new JSONView();
        $this->modelCategoria = new CategoriaModel();
    }

    public function getProductos($req, $res)
    {

        $productos = $this->modelProducto->getProductos();
        //$categorias = $this->modelCategoria->getCategorias();
        return $this->view->response($productos);
    }
    /*
    public function detalleProducto($id){
        $producto = $this->modelProducto->getProducto($id);
        return $this->view->verDetalle($producto);

    }
*/
    public function getProducto($req, $res)
    {
        $id = $req->params->id;
        $producto = $this->modelProducto->getProducto($id);
        //$categorias = $this->modelCategoria->getCategorias();
        if (!$producto) {
            return $this->view->response("El producto con el id=$id no existe", 404);
        }

        return $this->view->response($producto);
    }



    public function createProducto($req, $res)
    {

        if (empty($req->body->nombre)  || empty($req->body->precio) || empty($req->body->marca) || empty($req->body->descripcion) || empty($req->body->URL_imagen)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $nombre = $req->body->nombre;
        $categoria = 1; //$req->body->categoria; preguntar foraneas
        $precio = $req->body->precio;
        $marca = $req->body->marca;
        $descripcion = $req->body->descripcion;
        $URL_imagen = $req->body->URL_imagen;


        $id = $this->modelProducto->agregarProducto($nombre, $descripcion, $precio, $marca, $URL_imagen, $categoria);
        if (!$id) {
            return $this->view->response("Error al insertar tarea", 500);
        }

        $producto = $this->modelProducto->getProducto($id);
        return $this->view->response($producto, 201);
    }
    /*public function mostrarAdmin(){
        $productos = $this->modelProducto->getProductos();
        $categorias = $this->modelCategoria->getCategorias();
        return $this->view->verPanelAdmin($productos,$categorias);
    }
    */
    public function updateProducto($req, $res)
    {
        $id = $req->params->id;
        $producto = $this->modelProducto->getProducto($id);

        if (!$producto) {
            return $this->view->response("El producto con el id=$id no existe", 404);
        }
        if (empty($req->body->nombre)  || empty($req->body->precio) || empty($req->body->marca) || empty($req->body->descripcion) || empty($req->body->URL_imagen)) {
            return $this->view->response('Faltan completar datos', 400);
        }
        $nombre = $req->body->nombre;
        $categoria = 1; //$req->body->categoria; preguntar foraneas
        $precio = $req->body->precio;
        $marca = $req->body->marca;
        $descripcion = $req->body->descripcion;
        $URL_imagen = $req->body->URL_imagen;
        $this->modelProducto->editarProducto($nombre, $descripcion, $precio, $marca, $URL_imagen, $categoria, $id);

        // obtengo la tarea modificada y la devuelvo en la respuesta
        $producto = $this->modelProducto->getProducto($id);
        $this->view->response($producto, 200);

        /*if($this->modelProducto->getProducto($id)){
            $this->modelProducto->editarProducto($nombre, $descripcion, $precio, $marca, $URL_imagen, $categoria, $id);
        }
        else
            return $this->view->mostrarError('No existe el producto');
        header('Location: ' . BASE_URL);*/
    }
    public function deleteProducto($req, $res)
    {
        $id = $req->params->id;
        $producto = $this->modelProducto->getProducto($id);
        if (!$producto) {
            return $this->view->response("El producto con el id=$id no existe", 404);
        }
        $this->modelProducto->borrarProducto($id);
        $this->view->response("El producto con el id=$id se eliminó con éxito");
    }
}
