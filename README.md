# Trabajo Especial Tercera entrega.

---

## Integrantes:

- Sergio Daniel Teruggi.
- Eduardo Matias Spacech.

---

## Descripción

Hacemos un sistema para almacenar y visualizar los distintos productos que comercializa.(Articulos informaticos)
Este proyecto cuenta con una API REST que permite la consulta, modificación, eliminación e inserción de productos de informatica.

---

## DER

![Diagrama Entidad Relación](/DiagramaBD.jpg)

---

### URL de Ejemplo

`tpespecialrest/api/productos`

---

## 🚏 Endpoints

### 🎫 Productos

- **GET** `tpespecialrest/api/productos`  
  Devuelve todos los productos disponibles en la base de datos, permitiendo opcionalmente aplicar filtrado y ordenamiento a los resultados.

  - **Descripción**:  
    Esta endpoint permite a los usuarios recuperar una lista de productos disponibles, con opciones para paginar, filtrar y ordenar los resultados por diferentes campos.

  - **Query Params**:

    - **Ordenamiento**:

      - `orderBy`: Campo por el que se desea ordenar los resultados. Los campos válidos pueden incluir:

        - `Nombre`: Ordena los productos por nombre.
          ```http
          GET tpespecialrest/api/productos?orderBy=precio
          ```
        - `Descripcion`: Ordena los productos por descripcion
          ```http
          GET tpespecialrest/api/productos?orderBy=Descripcion
          ```
        - `Precio`: Ordena los productos por precio.
          ```http
          GET tpespecialrest/api/productos?orderBy=Precio
          ```
        - `Marca`: Ordena los productos por Marca.
          ```http
          GET tpespecialrest/api/productos?orderBy=Marca
          ```

      - `direccion`: Dirección de orden para el campo especificado en `orderBy`. Puede ser:
        - `ASC`: Orden ascendente (por defecto).
        - `DESC`: Orden descendente.

      **Ejemplo de Ordenamiento**:  
      Para obtener todos los productos ordenados por precio en orden descendente:

      ```http
      GET tpespecialrest/api/productos?orderBy=Precio&direccion=DESC
      ```

    - **Filtrado**:

      - `filtro`: Campo por el que se desea filtrar los resultados. Los campos válidos pueden incluir:

        - `Nombre`: Filtra los productos por el destino de inicio.
        - `Descripcion`: Filtra los productos por el destino final.
        - `Precio`: Filtra los productos por precio y muestra los menores al valor pasado.
        - `Marca`: Filtra los productos marca.
        - `Categoria`: Filtra los productos por categoria.

      - `valor`: Valor que se utilizará para el filtrado. Debe ser el valor específico que se comparará con el campo filtrado.

      **Ejemplo de Filtrado**:  
      Para obtener todos los productos que contengan en el campo 'nombre' un texto 'teclado':

      ```http
      GET tpespecialrest/api/productos?filtro=Nombre&valor=teclado
      ```

      **Paginacion**

      - `pagina`: Numero de pagina a mostrar.
      - `limite`: Cantidad de productos a mostrar.

      **Ejemplo de paginado**:  
      Para obtener todos los productos de la 'pagina' 2 que muestre 3 por pagina (´limite´):

      ```http
      GET tpespecialrest/api/productos?pagina=2&limite=3
      ```

---

- **GET** `tpespecialrest/api/productos/:ID`  
  Devuelve el producto correspondiente al `ID` solicitado.

---

- **POST** `tpespecialrest/api/productos`  
  Inserta un nuevo producto con la información proporcionada en el cuerpo de la solicitud (en formato JSON).

  - **Campos requeridos**:

    - `nombre`: Nombre del producto.
    - `descripcion`: Descripcion del producto.
    - `precio`: Precio del producto
    - `marca`: Marca del producto
    - `categoria`: Categoria del producto. (valor numerico)
    - `URL_imagen`: Url de la imagen del producto.

    **Ejemplo de json a insertar**:

    ```json
    {
      "nombre": "Parlante estereo 55",
      "descripcion": "Parlantes estéreo USB de Genius SP-U150X. Es ",
      "precio": 8000,
      "marca": "Genious",
      "categoria": 1,
      "URL_imagen": "https://acdn.mitiendanube.com/stores/001/474/949/products/sin-titulo-1101-18782821c03f75ed9116137056464768-640-0.webp"
    }
    ```

---

- **PUT** `/api/productos/:ID`  
  Modifica el producto correspondiente al `ID` solicitado. La información a modificar se envía en el cuerpo de la solicitud (en formato JSON).

  - **Campos modificables**:
    - `nombre`
    - `descripcion`
    - `precio`
    - `marca`
    - `URL_imagen`

---

- **DELETE** `/api/productos/:ID`  
  Elimina el producto correspondiente al `ID` solicitado.

---

### 🔐 Autenticación

Para acceder a recursos protegidos, los usuarios deben autenticarse utilizando un **token**.

- **POST** `/usuarios/token`  
  Este endpoint permite a los usuarios obtener un token JWT. Para utilizarlo, se deben enviar las credenciales en el encabezado de la solicitud en formato Base64 (usuario:contraseña).

  - **iniciar sesión**:

    - **Nombre de usuario**: `webadmin`
    - **Contraseña**: `admin`

  - **Respuesta**:  
    Si las credenciales son válidas, se devuelve un token JWT que puede ser utilizado para autenticar futuras solicitudes a la API.

---
