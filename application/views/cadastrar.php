<!-- Cadastro - Sistema de Estágio -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" type="text/css" />
    <title>Cadastro - Sistema de Estágio</title>
</head>

<body class="h-100 bg-primary">
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="content bg-light">
            <h1 class="text-center">Cadastro no sistema</h1>
            <form method="post" id="cadastroForm">
                <div class="form-group mb-4">
                    <label for="idTxt" class="control-label">ID:</label>
                    <input class="form-control bg-primary text-light" placeholder="Digite seu ID" name="idTxt" id="idTxt" maxlength="15" />
                </div>
                <div class="form-group mb-4">
                    <label for="nomeTxt" class="control-label">Nome:</label>
                    <input class="form-control bg-primary text-light" placeholder="Digite seu nome" name="nomeTxt" id="nomeTxt" maxlength="50" />
                </div>
                <div class="form-group mb-4">
                    <label for="statusTxt" class="control-label">Estatus:</label>
                    <input class="form-control bg-primary text-light" placeholder="Digite seu status" name="statusTxt" id="statusTxt" maxlength="50" />
                </div>
                <div class="row m-0 p-0">
                    <button type="button" id="cadastrarUsuarioBtn" class="btn btn-success btn-block">
                        CADASTRAR
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?php echo base_url("assets/js/jquery-3.6.0.min.js"); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/js/sweetalert2.all.min.js"); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>" type="text/javascript"></script>

    <script type="text/javascript" charset="utf-8">
        var base_url = "<?= base_url(); ?>"

        $(document).ready(function() {
            $('#cadastrarUsuarioBtn').on('click', async function(e) {
                e.preventDefault();

                const config = {
                    method: "post",
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: $('#idTxt').val(),
                        nome: $('#nomeTxt').val(),
                        estatus: $('#statusTxt').val()
                    })
                };

                const request = await fetch(base_url + 'professor/inserirProfessor', config);
                const response = await request.json();

                if (response.codigo == 1) {
                    Swal.fire({
                        title: 'Cadastro realizado com sucesso',
                        text: 'Seu cadastro foi concluído. Agora você pode fazer login.',
                        icon: 'success'
                    }).then(function() {
                        window.location.href = '<?=base_url('funcoes/index')?>';
                    });
                } else {
                    Swal.fire({
                        title: 'Erro no cadastro',
                        text: response.codigo + ' - ' + response.msg,
                        icon: 'error'
                    });
                }
            });
        });
    </script>
</body>

</html>
