window.addEventListener('DOMContentLoaded', (event) => {
    agregarInput();
    eliminarInput();
    calcularTotal();
});

function agregarInput () {

    const boton = document.querySelector('#add');
    const lista = document.querySelector('.lista-productos');
    
    boton.addEventListener('click', function(event) {
        event.preventDefault();
        
        const input = document.createElement('input');
        
        input.required = 'true';
        input.type = 'text';
        input.name = 'productos[]';
        input.placeholder = 'ID único. Ej. HAV00100001';
        input.classList.add('producto-item');
        
        lista.appendChild(input);
    });    
}

function eliminarInput () {

    const boton = document.querySelector('#remove');
    const lista = document.querySelector('.lista-productos');
    
    boton.addEventListener('click', function(event) {
        event.preventDefault();

        if(lista.childElementCount > 1 )
            lista.lastChild.remove();
    });    
}


function calcularTotal() {
    const boton = document.querySelector('#calcularTotal');
    const lista = document.querySelector('.lista-productos');
    
    boton.addEventListener('click', function (event) {
        event.preventDefault();

        const inputs = lista.querySelectorAll('input');
        const inputTotal = document.querySelector('#total');

        let total = 0;

        inputs.forEach(input => {
            //console.log(input.value.slice(0, -5));

            fetch(`../consultar-precio?id=${input.value.slice(0, -5)}`)
            .then(response => response.text())  
            .then(json => {
                total += Number.parseFloat(json);
                // console.log(total);
                inputTotal.value = total;
            })    
            .catch(err => console.log('Solicitud fallida', err)); // Capturar errores
        });
 
    });

}