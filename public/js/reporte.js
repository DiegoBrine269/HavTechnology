window.addEventListener('DOMContentLoaded', (event) => {
    validarFechas();
});

function validarFechas () {
    const boton = document.querySelector('#submit_reporte');
    const form = document.querySelector('#form_reporte');
    const fechaInicial = document.querySelector('#fechaInicial');
    const fechaFinal = document.querySelector('#fechaFinal');
    const mensajeFechas = document.querySelector('#mensajeFechas');

    boton.addEventListener('click', function(event) {
        event.preventDefault();
        
        console.log(fechaInicial.value);
        console.log();
        
        //Validar fechas
        if(fechaInicial.value > fechaFinal.value) {
            mensajeFechas.innerText = 'La fecha inicial no puede ser mayor a la final';
            mensajeFechas.classList.remove('invisible');
            return;
        }

        if(fechaInicial.value === '' || fechaFinal.value === '') {
            mensajeFechas.innerText = 'Los campos no pueden estar vacíos';
            mensajeFechas.classList.remove('invisible');
            return;
        }
        mensajeFechas.classList.add('invisible');
        window.location = `/ventas/reporte?tipo=rango&fechaInicial=${fechaInicial.value}&fechaFinal=${fechaFinal.value}`;

        // form.submit();


    });

}