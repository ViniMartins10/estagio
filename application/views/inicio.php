<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" type="text/css" />
    <title>Página Principal - Sistema de Estágio</title>
</head>

<body class="h-100 bg-primary">
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="content bg-light">
            <h1 class="text-center">Página Principal</h1>
            
            <!-- Botões de Ação -->
            <div class="row m-0 p-0">
                <button type="button" class="btn btn-primary btn-block" onclick="location.href='<?php echo base_url("funcoes/consultar"); ?>'">
                    Consultar
                </button>
            </div>
            <div class="row m-0 p-0 mt-2">
                <button type="button" class="btn btn-success btn-block" onclick="location.href='<?php echo base_url("funcoes/cadastrar"); ?>'">
                    Inserir
                </button>
            </div>
            <div class="row m-0 p-0 mt-2">
                <button type="button" class="btn btn-danger btn-block" onclick="location.href='<?php echo base_url("funcoes/deletar"); ?>'">
                    Deletar
                </button>
            </div>
            <div class="row m-0 p-0 mt-2">
                <button type="button" class="btn btn-warning btn-block" onclick="location.href='<?php echo base_url("funcoes/alterar"); ?>'">
                    Alterar
                </button>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url("assets/js/jquery-3.6.0.min.js"); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>" type="text/javascript"></script>
</body>

</html>
