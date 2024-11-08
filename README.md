# Trabajo Especial Tercera entrega.

## Integrantes:

- Sergio Daniel Teruggi.
- Eduardo Matias Spacech.

## Descripción

Hacemos un sistema para almacenar y visualizar los distintos productos que comercializa.(Articulos informaticos)
Nuestras entidades van a ser productos y marcas.
En la tabla producto enumeramos los siguentes atributos : su ID_Producto(Primary Key), nombre, descripcion, precio, categoria y el Id de Marcas (clave forania) .
La tabla Marcas contiene ID_Marcas(Primary Key), nombre y descripcion.

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
    Esta endpoint permite a los usuarios recuperar una lista de productos disponibles, con opciones para filtrar y ordenar los resultados por diferentes campos.

  - **Query Params**:

    - **Ordenamiento**:

      - `orderBy`: Campo por el que se desea ordenar los resultados. Los campos válidos pueden incluir:

        - `Nombre`: Ordena los productos por nombre.
          ```http
          GET tpespecialrest/api/productos?orderBy=precio
          ```
        - `Descripcion`: Ordena los productos por descripcion.
          ```http
          GET tpespecialrest/api/productos?orderBy=Descripcion.
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

      - `filtrado`: Campo por el que se desea filtrar los resultados. Los campos válidos pueden incluir:

        - `destino_inicio`: Filtra los productos por el destino de inicio.
        - `destino_fin`: Filtra los productos por el destino final.
        - `precio`: Filtra los productos por precio.

      - `filtradoDireccion`: Dirección de comparación para el campo especificado en `filtrado`. Puede ser:

        - `>`: Mayor que.
        - `<`: Menor que.
        - `=`: Igual a.

      - `cantidad`: Valor que se utilizará para el filtrado. Debe ser el valor específico que se comparará con el campo filtrado.

      **Ejemplo de Filtrado**:  
      Para obtener todos los productos cuyo precio sea mayor que 7000:

      ```http
      GET /api/boleto?filtrado=precio&filtradoDireccion=>&cantidad=7000
      ```

---

- **GET** `/api/boleto/:ID`  
  Devuelve el boleto correspondiente al `ID` solicitado.

---

- **POST** `/api/boleto`  
  Inserta un nuevo boleto con la información proporcionada en el cuerpo de la solicitud (en formato JSON).

  - **Campos requeridos**:
    - `destino_inicio`: Origen del viaje.
    - `destino_fin`: Destino del viaje.
    - `fecha_salida`: Fecha y hora de salida.
    - `precio`: Precio del boleto.

  > **Nota**: El campo `id` se genera automáticamente y no debe incluirse en el JSON.

---

- **PUT** `/api/boleto/:ID`  
  Modifica el boleto correspondiente al `ID` solicitado. La información a modificar se envía en el cuerpo de la solicitud (en formato JSON).

  - **Campos modificables**:
    - `destino_inicio`
    - `destino_fin`
    - `fecha_salida`
    - `precio`

---

- **DELETE** `/api/boleto/:ID`  
  Elimina el boleto correspondiente al `ID` solicitado.

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

### 🌐 Estructura del Proyecto

Este proyecto cuenta con una API REST que permite la consulta, modificación, eliminación e inserción de productos para viajes en colectivos de larga distancia. El diseño está orientado a facilitar la **comercialización de productos** y **gestión de pasajeros**.

---
