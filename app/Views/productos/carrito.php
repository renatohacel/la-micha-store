<section class="page-section portfolio" id="carrito">
    <div class="container">
        <!-- Portfolio Section Heading-->
        <br>
        <br>
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">LISTA DEL CARRITO</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fa-solid fa-cart-shopping"></i></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10 mb-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php if (isset($lista_carrito)) { ?>
                                <?php if ($lista_carrito == null) {
                                    echo '<tr><td colspan="5" class="text-center"><b>Lista vacia</b></td></tr>';
                                } else {
                                    $total = 0;
                                    foreach ($lista_carrito as $producto) {
                                        $_id = $producto['id'];
                                        $nombre = $producto['nombre'];
                                        $precio = $producto['precio'];
                                        $cantidad = $producto['cantidad'];
                                        $descuento = $producto['descuento'];
                                        $precio_desc = $precio - (($precio * $descuento) / 100);
                                        $subtotal = $cantidad * $precio_desc;
                                        $total += $subtotal; ?>
                                        <tr>
                                            <td><?php echo $nombre; ?></td>
                                            <td><?php echo '$' . number_format($precio_desc, 2, '.', ','); ?></td>
                                            <td>
                                                <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad; ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="ajaxUpdate(<?php echo $_id; ?>,this.value)">
                                            </td>
                                            <td>
                                                <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo '$' . number_format($subtotal, 2, '.', ','); ?></div>
                                            </td>
                                            <td><a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a></td>
                                        </tr>
                                    <?php } ?>

                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">
                                            <p class="h3" id="total"><?php echo '$' . number_format($total, 2, '.', ','); ?></p>
                                        </td>
                                    </tr>
                        </tbody>
                    <?php } ?>
                <?php } ?>
                    </table>
                </div>
            </div>
</section>

<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro de eliminar este producto del carrito?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button id="btn-elimina" type="button" class="btn btn-outline-danger" onclick="ajaxDelete()">Eliminar</button>
            </div>
        </div>
    </div>
</div>