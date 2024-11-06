<?php
require_once 'app/models/model.php';
class ProductoModel extends Model
{

    public function getProductos($orderBy = false, $pagina, $limite, $filtro, $valor)
    {
        $sql = 'SELECT * FROM productos';

        if ($filtro && $valor) {
            switch ($filtro) {
                case 'Nombre':
                    $sql .= ' WHERE Nombre LIKE :Nombre';
                    break;
                case 'Descripcion':
                    $sql .= ' WHERE Descripcion LIKE :Descripcion';
                    break;
                case 'Precio':
                    $sql .= ' WHERE Precio < :Precio';
                    break;
                case 'Marca':
                    $sql .= ' WHERE Marca LIKE :Marca';
                    break;
            }
        }

        //Ordenamiento Ascendente
        if ($orderBy) {
            switch ($orderBy) {
                case 'Nombre':
                    $sql .= ' ORDER BY :Nombre';
                    break;
                case 'Descripcion':
                    $sql .= ' ORDER BY Descripcion';
                    break;
                case 'Precio':
                    $sql .= ' ORDER BY Precio';
                    break;
                case 'Marca':
                    $sql .= ' ORDER BY Marca';
                    break;
            }
        }
        //paginacion        
        if ($pagina && $limite) {
            $desplazamiento = ($pagina - 1) * $limite;
            $sql .= ' LIMIT :limite OFFSET :desplazamiento';
        }


        $query = $this->db->prepare($sql);
        //usamos bindparam() para evitar la inyeccion sql por que LIMIT y OFFSET no deja poner ? y pasarlo en el execute. 
        if ($filtro && $valor) {
            if ($filtro == "Precio") {
                $valor = floatval($valor);
                $query->bindParam(":Precio", $valor);
            } else {
                $valor = "%" . $valor . "%"; //le agrego "comodines"
                $filtro = ":" . $filtro;
                $query->bindParam($filtro, $valor);
            }
        }

        if ($pagina && $limite) {
            $query->bindParam(':limite', $limite, PDO::PARAM_INT);
            $query->bindParam(':desplazamiento', $desplazamiento, PDO::PARAM_INT);
        }
        $query->execute();

        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }

    public function getProducto($id)
    {
        $query = $this->db->prepare('SELECT * FROM productos WHERE ID_productos = ?');
        $query->execute([$id]);
        $producto = $query->fetch(PDO::FETCH_OBJ);
        return $producto;
    }

    public function agregarProducto($Nombre, $Descripcion, $Precio, $Marca, $URL_imagen, $categoria)
    {
        $query = $this->db->prepare('INSERT INTO productos(Nombre, Descripcion, Precio, Marca, URL_imagen, ID_Categorias) VALUES (?, ?, ?, ?, ?,?)');
        $query->execute([$Nombre, $Descripcion, $Precio, $Marca, $URL_imagen, $categoria]);
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function borrarProducto($id)
    {
        $query = $this->db->prepare('DELETE FROM productos WHERE ID_Productos = ?');
        $query->execute([$id]);
    }

    public function editarProducto($Nombre, $Descripcion, $Precio, $Marca, $URL_imagen, $categoria, $id)
    {
        $query = $this->db->prepare('UPDATE productos SET `Nombre` = ?, `Descripcion` = ?, `Precio` = ?, `Marca` = ?, `URL_imagen` = ?, `ID_Categorias` = ? WHERE `ID_Productos` = ?');
        $query->execute([$Nombre, $Descripcion, $Precio, $Marca, $URL_imagen, $categoria, $id]);
    }
}
