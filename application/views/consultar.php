<!-- Consultar Professores - Sistema de Estágio -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" type="text/css" />
    <title>Consultar Professores - Sistema de Estágio</title>
</head>

<body class="h-100 bg-primary">
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="content bg-light">
            <h1 class="text-center">Consultar Professores</h1>
            <form method="get">
                <div class="form-group mb-4">
                    <label for="idTxt" class="control-label">ID:</label>
                    <input class="form-control bg-primary text-light" placeholder="Digite o ID do professor" name="idTxt" id="idTxt" maxlength="15" />
                </div>
                <div class="form-group mb-4">
                    <label for="nomeTxt" class="control-label">Nome:</label>
                    <input class="form-control bg-primary text-light" placeholder="Digite o Nome" name="nomeTxt" id="nomeTxt" maxlength="20">
                </div>
                <div class="form-group mb-4">
                    <label for="estatusTxt" class="control-label">Estatus:</label>
                    <input class="form-control bg-primary text-light" placeholder="Digite o Estatus" name="estatusTxt" id="estatusTxt" maxlength="20">
                </div>
                <div class="row m-0 p-0">
                    <button type="button" id="consultarBtn" class="btn btn-success btn-block">
                        CONSULTAR
                    </button>
                </div>
            </form>
            <div id="resultados" class="mt-4">
                <!-- Os resultados da consulta serão exibidos aqui -->
            </div>
        </div>
    </div>

    <script src="<?php echo base_url("assets/js/jquery-3.6.0.min.js"); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/js/sweetalert2.all.min.js"); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>" type="text/javascript"></script>

    <script type="text/javascript" charset="utf-8">
        var base_url = "<?= base_url(); ?>"

        $(document).ready(function() {
            $('#consultarBtn').on('click', async function(e) {
                e.preventDefault();

                const config = {
                    method: "post",
                    headers: {
                        'Accept': 'application/json',
                        'content-Type': 'application/json'
                    },
                    body: JSON.stringify({                       
                        id: $('#idTxt').val(),
                        nome: $('#nomeTxt').val(),
                        estatus: $('#estatusTxt').val()
                    })
                };

                const request = await fetch(base_url + 'professor/consultarProfessor', config);
                const response = await request.json();
                if (response.codigo == 1) {
                    // Limpar resultados anteriores
                    $('#resultados').empty();

                    if (response.dados.length == 1) {
                        var tableHTML = '<table class="table">\n' +
                            '<thead>\n' +
                            '<tr>\n' +
                            '<th scope="col">ID</th>\n' +
                            '<th scope="col">Nome</th>\n' +
                            '<th scope="col">Estatus</th>\n' +
                            '</tr>\n' +
                            '</thead>\n' +
                            '<tbody>';

                        response.dados.forEach(function(professor) {
                            tableHTML += '<tr>' +
                                '<td>' + professor.id + '</td>' +
                                '<td>' + professor.nome + '</td>' +
                                '<td>' + professor.estatus + '</td>' +
                                '</tr>';
                        });

                        tableHTML += '</tbody></table>';
                        // Adicionar tabela de resultados à página
                        $('#resultados').html(tableHTML);
                       
                    } else {
                        // Criar tabela de resultados
                        var tableHTML = '<table class="table">\n' +
                            '<thead>\n' +
                            '<tr>\n' +
                            '<th scope="col">ID</th>\n' +
                            '<th scope="col">Nome</th>\n' +
                            '<th scope="col">Estatus</th>\n' +
                            '</tr>\n' +
                            '</thead>\n' +
                            '<tbody>';

                        response.dados.forEach(function(professor) {
                            tableHTML += '<tr>' +
                                '<td>' + professor.id + '</td>' +
                                '<td>' + professor.nome + '</td>' +
                                '<td>' + professor.estatus + '</td>' +
                                '</tr>';
                        });

                        tableHTML += '</tbody></table>';
                        // Adicionar tabela de resultados à página
                        $('#resultados').html(tableHTML);
                    }
                } else {
                    Swal.fire({
                        title: 'Atenção!',
                        text: response.codigo + ' - ' + response.msg,
                        icon: 'error'
                    });
                }
            });
        });
    </script>
</body>

</html>
