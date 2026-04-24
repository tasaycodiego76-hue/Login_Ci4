<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titulo)?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1><?= esc($titulo) ?></h1>
        <p>
            Bienvenido, <strong><?= esc(session()->get('nombreusuario'))?></strong>
            Tiene los accesos de tipo <strong><?= esc(session()->get('nivelacceso')) ?> </strong>
        </p>
        <hr>
        <p>Aqui se mostrara el DASHBOARD</p>
        <a href="<?=base_url('auth/logout') ?>">Cerrar Session</a>
    </div>
    
</body>
</html>