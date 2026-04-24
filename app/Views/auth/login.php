<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h3>Login</h3>
                <h5>Iniciar Sesion en la Aplicacion</h5>
                <form action="<?= base_url('auth/login')?>" method="post">
                    <?= csrf_field()?>
                    <div class="mb-2">
                        <label for="">Usuario</label>
                        <input type="text" name="nombreusuario" id="nombreusuario" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="">Contraseña</label>
                        <input type="password" name="claveacceso" id="claveacceso" class="form-control">
                    </div>
                    <div class="mb-2 text-end">
                        <button class="btn btn-primary">Iniciar Sesión</button>
                    </div>
                </form>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach(session()->getFlashdata('errors') as $error): ?>
                            <li><?= $error?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('info')): ?>
                <div class="alert alert-info"><?=session()->getFlashdata('info') ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>