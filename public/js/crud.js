document.addEventListener("DOMContentLoaded", function () {

    botonesCrud();
});

function botonesCrud() {
    const btn = document.querySelector('.boton-registrar');
    const modal = document.querySelector('#modal-registrar');

    btn.addEventListener('click', e => { 
        console.log(btn);
        modal.classList.remove('invisible');        
    });
    
}