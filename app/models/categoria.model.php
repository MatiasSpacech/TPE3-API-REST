<?php
require_once 'app/models/model.php';
class CategoriaModel extends Model{
    
    public function getCategorias(){
        $query = $this->db->prepare('SELECT * FROM categorias');    
        $query->execute();
        $categorias = $query->fetchAll(PDO::FETCH_OBJ);
        return $categorias;
    }

    public function getCategoria($id) {    
        $query = $this->db->prepare('SELECT * FROM categorias WHERE ID_Categorias = ?');
        $query->execute([$id]);   
        $categoria = $query->fetch(PDO::FETCH_OBJ);    
        return $categoria;
    }

    public function getProductosXCategoria($Nombre) {    
        $query = $this->db->prepare('SELECT productos.ID_Productos, productos.Nombre, productos.Descripcion, productos.Precio, productos.Marca, productos.URL_imagen  FROM productos JOIN categorias ON productos.ID_Categorias = categorias.ID_Categorias WHERE categorias.Nombre =?');
        $query->execute([$Nombre]);    
        $productos = $query->fetchAll(PDO::FETCH_OBJ);    
        return $productos;
    }

    public function agregarCategoria($Nombre, $Descripcion, $URL_imagen) { 
        $Nombre = htmlspecialchars($Nombre);
        $Descripcion = htmlspecialchars($Descripcion);        
        $query = $this->db->prepare('INSERT INTO categorias(Nombre, Descripcion,URL_imagen) VALUES (?, ?, ?)');
        $query->execute([$Nombre, $Descripcion, $URL_imagen]);    
        $id = $this->db->lastInsertId();    
        return $id;
    }
    public function borrarCategoria($id) {
        // Verificar si hay artículos asociados a la categoría
        $query = $this->db->prepare('SELECT COUNT(*) FROM productos WHERE ID_Categorias = ?');
        $query->execute([$id]);
        $count = $query->fetchColumn();    
        if ($count > 0) {
            // Hay artículos asociados, no eliminar la categoría
            return 'No se puede eliminar la categoría porque tiene artículos asociados.';
        } else {
            // No hay artículos asociados, se puede eliminar la categoría
            $query = $this->db->prepare('DELETE FROM categorias WHERE ID_Categorias = ?');
            $query->execute([$id]);
            return 'Categoría eliminada correctamente.';
        }
    }
   

    public function editarCategoria($Nombre, $Descripcion, $URL_imagen, $id) {                   
        $query = $this->db->prepare('UPDATE categorias SET `Nombre` = ? , `Descripcion` = ?, `URL_imagen` = ? WHERE `ID_Categorias` = ?' );
        $query->execute([$Nombre, $Descripcion, $URL_imagen, $id]);
    }   
    
}