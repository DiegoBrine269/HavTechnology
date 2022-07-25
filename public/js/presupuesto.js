window.addEventListener('DOMContentLoaded', (event) => {
    agregarInput();
    eliminarInput();
});

function agregarInput () {

    const boton = document.querySelector('#add');
    const lista = document.querySelector('.lista-productos');
    
    boton.addEventListener('click', function(event) {
        event.preventDefault();
        
        const input1 = document.createElement('input');
        const input2 = document.createElement('input');
        const campo = document.createElement('div');
    
        campo.classList.add('campo-dos');
        
        input1.required = 'true';
        input1.type = 'text';
        input1.name = 'productos[]';
        input1.placeholder = 'ID o SKU';
        input1.classList.add('producto-item');

        input2.required = 'true';
        input2.type = 'number';
        input2.name = 'cantidades[]';
        input2.placeholder = 'Cantidad';
        // input2.classList.add('producto-item');
        
        campo.append(input1, input2);
        lista.append(campo);
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