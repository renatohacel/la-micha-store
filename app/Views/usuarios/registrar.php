<?php if (isset($msg)) { ?>
    <script>
        Swal.fire({
            title: "<?php echo $msg ?>",
            icon: 'info',
        });
    </script>
<?php } ?>
<br>
<br>
<section class="page-section" id="registrar">
    <div class="container" style="margin-top: 100px;">
        <!-- Contact Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">REGISTRATE</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fa-solid fa-user"></i></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Contact Section Form-->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <form method="post" action="<?php echo base_url('guardar_registro') ?>" id="registrar" name="registrar" data-sb-form-api-token="API_TOKEN">
                    <!-- Name input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" name="usuario" id="usuario" type="text" data-sb-validations="required" placeholder="Usuario" autocomplete="off" autofocus />
                        <label for="usuario">Usuario</label>
                        <div class="invalid-feedback" data-sb-feedback="usuario:required">El nombre es requerido.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" name="password" id="password" type="password" placeholder="Contraseña" data-sb-validations="required" />
                        <label for="password">Contraseña</label>
                        <div class="invalid-feedback" data-sb-feedback="password:required">La contraseña es requerida.</div>
                    </div>
                    <!-- Email address input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" name="email" id="email" placeholder="Email" type="email" data-sb-validations="required,email" autocomplete="off" />
                        <label for="email">Email</label>
                        <div class="invalid-feedback" data-sb-feedback="email:required">El email es requerido.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email no es válido.</div>
                    </div>
                    <!-- Phone number input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" pattern="[0-9]*" name="telefono" title="Solo se permiten números" id="telefono" type="tel" data-sb-validations="required" placeholder="Telefono" maxlength="10" minlength="10" autocomplete="off" />
                        <label for="telefono">Telefono</label>
                        <div class="invalid-feedback" data-sb-feedback="telefono:required">El número de télefono es requerido.</div>
                    </div>
                    <!-- Message input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" pattern="[a-zA-Z]+\s[0-9]+" title="Calle Número" name="domicilio" id="domicilio" type="text" placeholder="Domicilio" data-sb-validations="required" autocomplete="off" />
                        <label for="name">Domicilio</label>
                        <div class="invalid-feedback" data-sb-feedback="domicilio:required">El domicilio es requerido.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" pattern="[a-zA-Z]+" name=" ciudad" id="ciudad" type="text" placeholder="Ciudad" data-sb-validations="required" autocomplete="off" />
                        <label for="name">Ciudad</label>
                        <div class="invalid-feedback" data-sb-feedback="ciudad:required">La ciudad es requerido.</div>
                    </div>
                    <!-- Submit Button-->
                    <button class="btn btn-primary btn-xl col-12 " id="submitButton" type="submit"><b>Registrar</b></button>
                </form>
            </div>
        </div>
    </div>
</section>