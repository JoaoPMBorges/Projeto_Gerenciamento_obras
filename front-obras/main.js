let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
};
window.onscroll = () =>{
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
};
/* Slides */

var swiper = new Swiper(".inicio-slider", {
    spaceBetween: 20,
    effect: "fade",
    grabCursor: true,
    loop:true,
    autoplay: {
        delay: 4000,  
    }, 
    centeredSlides: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
});

    // Seleciona todos os botões com a classe 'access-button'
    document.querySelectorAll('.access-button').forEach(button => {
        // Adiciona um ouvinte de eventos de clique a cada botão
        button.addEventListener('click', function() {
            // Obtém o valor do atributo data-url
            const url = this.getAttribute('data-url');
            // Redireciona o usuário para a URL especificada
            window.location.href = url;
        });
    });
