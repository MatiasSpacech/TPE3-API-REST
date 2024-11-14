"use strict"

const BASE_URL = "api/"; // url relativa a donde estoy parado (http://localhost/web2/2024/todo-list-rest/api)

// arreglo de productos
let productos = [];
let querryparams = "";

document.getElementById("formularioOrden").addEventListener('submit', function (e){
    e.preventDefault();
    const orderBy = document.getElementById('orderBy').value;
    const direccion = document.getElementById('direccion').value;     
    if (orderBy){
        querryparams += `?orderBy=${orderBy}`;    
    }
    if (direccion){
        querryparams += `&direccion=${direccion}`;  
    }
    getProductos();
    querryparams = "";
});
document.getElementById("formularioFiltro").addEventListener('submit', function (e){
    e.preventDefault();
    const filtro = document.getElementById('filtro').value;
    const valor = document.getElementById('valor').value;     
    if (filtro && valor){
        querryparams += `?filtro=${filtro}&valor=${valor}`;    
    }    
    getProductos();
    querryparams = "";
});
let pagina = Number(document.getElementById('pagina').value);
const limite = document.getElementById('limite').value;
document.getElementById("formularioPagina").addEventListener('submit', function(e) {mostrarPagina(e)});

function mostrarPagina(e){
    e.preventDefault();  
     
    if (pagina && limite){
        querryparams += `?pagina=${pagina}&limite=${limite}`;    
    }    
    getProductos();
    querryparams = "";
}

document.getElementById('sigPagina').addEventListener('click', (e)=> {
    pagina= pagina + 1;
    mostrarPagina(e);
    
})
document.getElementById('antPagina').addEventListener('click', (e)=> {
    if (pagina>=1) {
        pagina= pagina - 1;
    }
    mostrarPagina(e);        
    
})

async function getProductos() {
    try {
        const response = await fetch(BASE_URL + "productos"+ querryparams);
        if (!response.ok) {
            throw new Error('Error al llamar las tareas');
        }

        productos = await response.json();
        mostrarProductos();
    } catch(error) {
        console.log(error)
    }
}
function mostrarProductos() {
    let contenedorProductos = document.querySelector("#contenedorProductos");
    contenedorProductos.innerHTML = "";
    for (const producto of productos) {
        let html = `
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <img src=${producto.URL_imagen} class="card-img-top" alt="Producto 1">
                            <div class="card-body">
                                <h5 class="card-title">${producto.Nombre}</h5>
                                <p class="card-text">Precio: $${producto.Precio}</p>
                                <p class="card-text"> ${producto.Descripcion}</p> 
                            </div>
                        </div>
            </div>`;

        contenedorProductos.innerHTML += html;
    }
}

getProductos();