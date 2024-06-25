<!--Contenido de la pagina-->
<br><br>
<section class="page-section portfolio" id="portfolio">
    <div class="container">
        <!-- Portfolio Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Productos</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fa-solid fa-cart-arrow-down"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Portfolio Grid Items-->
        <div class="row justify-content-center" id="portfolio-items">
            <!-- Aquí se insertarán los productos mediante jQuery -->
        </div>
    </div>
</section>
<!-- About Section-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'http://localhost/lamicha/public/productos',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var productos = response.productos;
                productos.forEach(function(producto) {
                    var precio = parseFloat(producto.precio);
                    var descuento = parseInt(producto.descuento);
                    var precio_desc = precio - ((precio * descuento) / 100);
                    var id = producto.id;
                    var html = '<div class="col-md-6 col-lg-4 mb-5">';
                    html += '<div class="portfolio-item mx-auto" data-bs-toggle="modal" onclick="ajaxAdd('+ id +')" data-bs-target="#portfolioModal1">';
                    html += '<div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">';
                    html += '<div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>';
                    html += '</div>';

                    html += '<img class="img-fluid" src="http://localhost/lamicha/public/assets/productos/' + id + '/principal.jpg" alt="..." />';
                    html += '<p class="masthead-subheading font-weight-light mb-0">' + producto.nombre + '</p>';

                    if (descuento > 0) {
                        html += '<p><del>$' + precio.toFixed(2) + '</del></p>';
                        html += '<h6>$' + precio_desc.toFixed(2) + '<small class="text-success">&nbsp'  + descuento + '% de descuento</small></h6>';
                    } else {
                        html += '<h6>$' + precio.toFixed(2) + '</h6>';
                    }

                    html += '</div>';
                    html += '</div>';

                    $('#portfolio-items').append(html);
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
</script>