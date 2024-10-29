<?php
require_once './app/models/categoria.model.php';
require_once './app/views/categoria.view.php';

class CategoriaController
{
    private $model;
    private $view;
    private $modelProducto;

    public function __construct($res)
    {
        $this->model = new CategoriaModel();
        $this->view = new CategoriaView($res->user);
        $this->modelProducto = new ProductoModel();
        define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');
    }

    public function mostrarCategorias()
    {
        $productos = $this->modelProducto->getProductos();
        $categorias = $this->model->getCategorias();
        return $this->view->verCategorias($categorias, $productos);
    }

    public function mostrarProductosPorCategoria($nombreCategoria)
    {
        $categorias = $this->model->getCategorias();
        $productos = $this->model->getProductosXCategoria($nombreCategoria);
        return $this->view->VerProductos($productos, $nombreCategoria);
    }

    public function nuevaCategoria()
    {
        return $this->view->VerFormularioNuevoCategoria();
    }


    public function agregarCategoria()
    {
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->mostrarError('Falta completar el nombre');
        }
        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            return $this->view->mostrarError('Falta completar la descripcion');
        }
        if (!isset($_POST['URL_imagen']) || empty($_POST['URL_imagen'])) {
            return $this->view->mostrarError('Falta completar la URL de la imagen');
        }

        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $URL_imagen = $_POST['URL_imagen'];

        $id = $this->model->agregarCategoria($nombre, $descripcion, $URL_imagen);

        header('Location: ' . BASE_URL);
    }

    public function formCategoria($id)
    {
        $categoria = $this->model->getCategoria($id);
        return $this->view->verEdicionCategoria($categoria);
    }

    public function updateCategoria($id)
    {
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->mostrarError('Falta completar el nombre');
        }
        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            return $this->view->mostrarError('Falta completar la descripcion');
        }
        if (!isset($_POST['URL_imagen']) || empty($_POST['URL_imagen'])) {
            return $this->view->mostrarError('Falta completar la URL de la imagen');
        }

        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $URL_imagen = $_POST['URL_imagen'];
        //verificar que exista producto
        if ($this->model->getCategoria($id)) {
            $this->model->editarCategoria($nombre, $descripcion, $URL_imagen, $id);
        } else {
            return $this->view->mostrarError('No existe la categoria');
        }
        header('Location: ' . BASE_URL);
    }
    public function deleteCategoria($id)
    {
        if ($this->model->getCategoria($id)) {
            $this->view->mostrarError($this->model->borrarCategoria($id));
        } else
            return $this->view->mostrarError('No existe la categoria');
        header('Location: ' . BASE_URL . '/admin');
    }
}
