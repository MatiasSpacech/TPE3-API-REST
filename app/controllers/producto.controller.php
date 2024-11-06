<?php
include_once './app/models/producto.model.php';
require_once './app/views/json.view.php';

class ProductoController
{
    private $modelProducto;
    private $view;

    public function __construct()
    {
        $this->modelProducto = new ProductoModel();
        $this->view = new JSONView();
    }

    public function getProductos($req, $res)
    {
        //ordenamiento por atibuto
        $orderBy = false;
        $direccion = null;
        if (isset($req->query->orderBy)) {
            $orderBy = $req->query->orderBy;
            if (isset($req->query->direccion))
                $direccion = $req->query->direccion;
        }
        //Paginacion
        $pagina = false;
        $limite = false;
        if (isset($req->query->pagina) && is_numeric($req->query->pagina) && isset($req->query->limite) && is_numeric($req->query->limite)) {
            $pagina = $req->query->pagina;
            $limite = $req->query->limite;
        }
        //filtros 
        $filtro = false;
        $valor = false;
        if ((isset($req->query->filtro)) && (isset($req->query->valor))) {
            $filtro = $req->query->filtro;
            $valor = $req->query->valor;
        }

        $productos = $this->modelProducto->getProductos($orderBy, $direccion, $pagina, $limite, $filtro, $valor);
        return $this->view->response($productos);
    }

    public function getProducto($req, $res)
    {
        $id = $req->params->id;
        $producto = $this->modelProducto->getProducto($id);
        if (!$producto) {
            return $this->view->response("El producto con el id=$id no existe", 404);
        }
        return $this->view->response($producto);
    }



    public function createProducto($req, $res)
    {
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }

        if (empty($req->body->nombre)  || empty($req->body->precio) || empty($req->body->marca) || empty($req->body->descripcion) || empty($req->body->URL_imagen)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $nombre = $req->body->nombre;
        $categoria = $req->body->categoria;
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

    public function updateProducto($req, $res)
    {
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }

        $id = $req->params->id;
        $producto = $this->modelProducto->getProducto($id);

        if (!$producto) {
            return $this->view->response("El producto con el id=$id no existe", 404);
        }
        if (empty($req->body->nombre)  || empty($req->body->precio) || empty($req->body->marca) || empty($req->body->descripcion) || empty($req->body->URL_imagen) || empty($req->body->categoria)) {
            return $this->view->response('Faltan completar datos', 400);
        }
        $nombre = $req->body->nombre;
        $categoria = $req->body->categoria; //ID_Categorias
        $precio = $req->body->precio;
        $marca = $req->body->marca;
        $descripcion = $req->body->descripcion;
        $URL_imagen = $req->body->URL_imagen;
        $this->modelProducto->editarProducto($nombre, $descripcion, $precio, $marca, $URL_imagen, $categoria, $id);

        // obtengo la tarea modificada y la devuelvo en la respuesta
        $producto = $this->modelProducto->getProducto($id);
        $this->view->response($producto, 200);
    }
    public function deleteProducto($req, $res)
    {
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        $id = $req->params->id;
        $producto = $this->modelProducto->getProducto($id);
        if (!$producto) {
            return $this->view->response("El producto con el id=$id no existe", 404);
        }
        $this->modelProducto->borrarProducto($id);
        $this->view->response("El producto con el id=$id se eliminó con éxito");
    }
}
