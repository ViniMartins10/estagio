<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" type="text/css" />
    <title>Alterar Nome - Sistema de Estágio</title>
</head>

<body class="h-100 bg-primary">
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="content bg-light">
            <h1 class="text-center">Alterar Nome</h1>
            <form method="post" id="alterarNomeForm">
                <div class="form-group mb-4">
                    <label for="idTxt" class="control-label">ID:</label>
                    <input class="form-control bg-primary text-light" placeholder="Digite o ID do professor" name="idTxt" id="idTxt" maxlength="15" />
                </div>
                <div class="form-group mb-4">
                    <label for="nomeTxt" class="control-label">Nome:</label>
                    <input class="form-control bg-primary text-light" placeholder="Digite o Nome" name="nomeTxt" id="nomeTxt" maxlength="20">
                </div>
                <div class="row m-0 p-0">
                    <button type="button" id="alterarNomeBtn" class="btn btn-warning btn-block">
                        ALTERAR NOME
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
            $('#alterarNomeBtn').on('click', async function(e) {
                e.preventDefault();

                const config = {
                    method: "post",
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: $('#idTxt').val(),
                        nome: $('#nomeTxt').val()
                    })
                };

                const request = await fetch(base_url + 'professor/alterarProfessor', config);
                const response = await request.json();

                if (response.codigo == 1) {
                    Swal.fire({
                        title: 'Nome alterado com sucesso',
                        text: 'O nome do professor foi alterado com sucesso.',
                        icon: 'success'
                    }).then(function() {
                        // Redirecionar para a página de consulta ou outra página apropriada
                        window.location.href = '<?= base_url('funcoes/consultar') ?>';
                    });
                } else {
                    Swal.fire({
                        title: 'Erro na alteração de nome',
                        text: response.codigo + ' - ' + response.msg,
                        icon: 'error'
                    });
                }
            });
        });
    </script>
</body>

</html>