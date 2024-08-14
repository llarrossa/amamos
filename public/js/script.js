const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

$(document).ready(function() {
    $('.list-group-item small').each(function() {
        var risco = $(this).text().toLowerCase(); // Obtém o texto e converte para minúsculas
        
        if (risco === 'compativel') {
            $(this).addClass('compativel');
        } else if (risco === 'criterioso') {
            $(this).addClass('criterioso');
        } else if (risco === 'contraindicado') {
            $(this).addClass('contraindicado');
        }
    });
});