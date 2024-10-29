<?php
require_once 'app/models/model.php';
class ProductoModel extends Model{
    
    public function getProductos(){
        $query = $this->db->prepare('SELECT * FROM productos');    
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }
    
    public function getProducto($id) {    
        $query = $this->db->prepare('SELECT * FROM productos WHERE ID_productos = ?');
        $query->execute([$id]);    
        $producto = $query->fetch(PDO::FETCH_OBJ);    
        return $producto;
    }
    
    public function agregarProducto($Nombre, $Descripcion, $Precio, $Marca, $URL_imagen, $categoria) {         
        $query = $this->db->prepare('INSERT INTO productos(Nombre, Descripcion, Precio, Marca, URL_imagen, ID_Categorias) VALUES (?, ?, ?, ?, ?,?)');
        $query->execute([$Nombre, $Descripcion, $Precio, $Marca, $URL_imagen, $categoria]);    
        $id = $this->db->lastInsertId();    
        return $id;
    }

    public function borrarProducto($id) {
        $query = $this->db->prepare('DELETE FROM productos WHERE ID_Productos = ?');
        $query->execute([$id]);
    }

    public function editarProducto($Nombre, $Descripcion, $Precio, $Marca, $URL_imagen, $categoria, $id) { 
        $query = $this->db->prepare('UPDATE productos SET `Nombre` = ?, `Descripcion` = ?, `Precio` = ?, `Marca` = ?, `URL_imagen` = ?, `ID_Categorias` = ? WHERE `ID_Productos` = ?');
        $query->execute([$Nombre, $Descripcion, $Precio, $Marca, $URL_imagen, $categoria, $id]);
    }
}