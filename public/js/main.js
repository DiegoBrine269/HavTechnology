window.addEventListener('DOMContentLoaded', (event) => {
    buscarCoincidencias();
});

function buscarCoincidencias () {
    const boton = document.querySelector('#buscar');
    const tbody = document.querySelector('.tabla').querySelector('tbody');
    
    //Evento del botón
    boton.addEventListener('click', function (event) {
        event.preventDefault();
        
        const palabraClave = document.querySelector('#patron').value;
        const registros = tbody.querySelectorAll('tr');

        //Aparecemos todos de nuevo
        registros.forEach(registro => {
            registro.classList.add('visible');
            registro.classList.remove('invisible');
        });


        //Buscamos coincidencias
        let ocultar;
        registros.forEach(registro => {
            
            ocultar = true;
            const atributos = registro.querySelectorAll('td');

            atributos.forEach(a => {
                // Oculto el registro de manera condicional
                if (a.innerText.toLowerCase().includes(palabraClave.toLowerCase() )) {
                    ocultar = false;
                }  
            });

            if(ocultar) {
                registro.classList.add('invisible');
                registro.classList.remove('visible');
            }
        });
    }); 
}