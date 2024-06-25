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
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">INICIAR SESIÓN</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fa-solid fa-user"></i></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Contact Section Form-->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <form method="post" action="<?php echo base_url('valida_inicio') ?>" id="contactForm" data-sb-form-api-token="API_TOKEN">
                    <!-- Name input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="user" name="user" type="text" data-sb-validations="required" placeholder="Usuario" autocomplete="off" autofocus />
                        <label for="usuario">Usuario</label>
                        <div class="invalid-feedback" data-sb-feedback="usuario:required">El nombre es requerido.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="password" name="password" type="password" placeholder="Contraseña" data-sb-validations="required" />
                        <label for="password">Contraseña</label>
                        <div class="invalid-feedback" data-sb-feedback="password:required">La contraseña es requerida.</div>
                    </div>
                    <!-- Submit Button-->
                    <button class="btn btn-primary btn-xl col-12 " id="submitButton" type="submit"><b>Iniciar</b></button>
                </form>
            </div>
        </div>
    </div>
</section>