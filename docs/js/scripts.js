/*!
* Start Bootstrap - Freelancer v7.0.7 (https://startbootstrap.com/theme/freelancer)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-freelancer/blob/master/LICENSE)
*/
//
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

});

function addCarrito(id) {
    let url = 'carrito';
    let formData = new FormData();
    formData.append('id', id);

    $.ajax({
        url: url,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data); // Verifica la respuesta JSON en la consola del navegador
            if (data.respuesta) {
                $('#num_cart').html(data.numero);
            } else {
                Swal.fire({
                    title: "Registrate/Inicia para añadir productos al carrito",
                    icon: 'info',
                });
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function ajaxAdd(id) {
    $.ajax({
        url: 'addCarrito',
        type: 'post',
        data: {
            id: id
        },
        dataType: 'json',
        success: function (response) {
            if (response.respuesta) {
                $('#num_cart').html(response.numero);
            } else {
                Swal.fire({
                    title: "Registrate/Incia para añadir productos al carrito",
                    icon: 'info',
                });
            }

        }
    })
}

function ajaxUpdate(id, cantidad) {
    let total = 0.00;
    let list = document.getElementsByName('subtotal[]');
    $.ajax({
        url: 'updateCarrito',
        type: 'post',
        data: {
            action: 'agregar',
            id: id,
            cantidad: cantidad

        },
        dataType: 'json',
        success: function (response) {
            if (response.respuesta) {
                $('#subtotal_' + id).html(response.sub);


                $(list).each(function () {
                    console.log("Texto del elemento:", $(this).text());
                    total += parseFloat($(this).html().replace(/[$,]/g, ''));
                });

                total = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                }).format(total);

                $('#total').html('<?php echo "$"; ?>' + total);
            } else {
                Swal.fire({
                    title: "Error",
                    icon: 'info',
                });
            }
            $.ajax({
                url: 'updateSession',
                type: 'post',
                data: {
                    id: id,
                    cantidad: cantidad
                },
                success: function (response) {
                    console.log(response);
                }
            });
        }
    })
}

let eliminaModal = document.getElementById('eliminaModal')
eliminaModal.addEventListener('show.bs.modal', function (event) {
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id')
    let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
    buttonElimina.value = id
})

function ajaxDelete() {
    let botonElimina = document.getElementById('btn-elimina');
    let id = botonElimina.value; // Asegúrate de que 'btn-elimina' es un botón y tiene un valor

    $.ajax({
        url: 'updateCarrito',
        type: 'post',
        data: {
            action: 'eliminar',
            id: id,
        },
        dataType: 'json',
        success: function (response) {
            if (response.respuesta) {
                location.reload();
            } else {
                Swal.fire({
                    title: "Error",
                    icon: 'info',
                });
            }
        }
    })
}