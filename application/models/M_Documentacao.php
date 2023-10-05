<?php
defined('BASEPATH') or exit('No direct script access allowed');

include_once("M_Aluno.php");
include_once("M_Professor.php");
include_once("M_Atendimento.php");

class M_Documentacao extends CI_Model
{
    public function inserirDocumentacao($semestre, $ra, $tcer, $tcenr, $descatividades, $fichaestagio, $relatividade, $rescisao, $relequivalencia, $observacao, $estatus)
    {
        $aluno = new M_aluno();
        $retornoAluno = $aluno->consultarSoAluno($ra);
        if ($retornoAluno['codigo'] == 1) {
            $sql = "INSERT INTO documentacao (semestre_ano, ra_aluno, tcer,  tcenr, desc_atividades, ficha_valid_estagio, rel_atividades, rescisao,  rel_equivalencia, observacoes,estatus) VALUES ('$semestre', '$ra','$tcer','$tcenr','$descatividades', '$fichaestagio','$relatividade', '$rescisao', '$relequivalencia','$observacao','$estatus' ) ";

            $this->db->query($sql);

            if ($this->db->affected_rows() > 0) {
                $dados = array('codigo' => 1, 'msg' => 'Documentação registrada com sucesso.');
            } else {
                $dados = array('codigo' => 2, 'msg' => 'Houve algum problema na Documentação');
            }

            return $dados;
        } else {
            $dados = array('codigo' => 4, 'msg' => 'Houve um problema na verificação do ra do aluno.');
        }
    }




    public function consultarDocumentacao($semestre, $ra, $tcer, $tcenr, $descatividades, $fichaestagio, $relatividade, $rescisao, $relequivalencia, $observacao, $estatus)
    {
        $sql = "SELECT * FROM documentacao WHERE estatus = '$estatus'";

        if (trim((string)$semestre) != '') {
            $sql .= " AND semestre_ano = '$semestre'";
        }

        if (trim((string)$ra) != '') {
            $sql .= " AND ra_aluno = '$ra'";
        }

        if (!empty($tcer)) {
            $sql .= " AND tcer = '$tcer'";
        }

        if ($tcenr != '') {
            $sql .= " AND tcenr = '$tcenr'";
        }

        if ($descatividades != '') {
            $sql .= " AND desc_atividades = '$descatividades'";
        }

        if (trim((string)$fichaestagio) != '') {
            $sql .= " AND ficha_valid_estagio = '$fichaestagio'";
        }

        if ($relatividade != '') {
            $sql .= " AND rel_atividades = '$relatividade'";
        }

        if ($rescisao != '') {
            $sql .= " AND rescisao = '$rescisao'";
        }

        if ($relequivalencia != '') {
            $sql .= " AND rel_equivalencia = '$relequivalencia'";
        }

        if ($observacao != '') {
            $sql .= " AND observacoes = '$observacao'";
        }

        $retorno = $this->db->query($sql);

        if ($retorno->num_rows() > 0) {
            $dados = array('codigo' => 1, 'msg' => 'Consulta efetuada com sucesso', 'dados' => $retorno->result());
        } else {
            $dados = array('codigo' => 2, 'msg' => 'Dados não encontrados');
        }

        return $dados;
    }

    public function consultarSoDocumentacao($semestre)
    {
        $sql = "SELECT * FROM documentacao WHERE semestre_ano = $semestre";

        $retorno = $this->db->query($sql);

        if ($retorno->num_rows() > 0) {
            $dados = array('codigo' => 1, 'msg' => 'Consulta efetuada com sucesso');
        } else {
            $dados = array('codigo' => 2, 'msg' => 'Dados não encontrados');
        }

        return $dados;
    }


    public function alteraDocumentacao($semestre, $ra, $tcer, $tcenr, $descatividades, $fichaestagio, $relatividade, $rescisao, $relequivalencia, $observacao, $estatus)
{
    $retornoDocumentacao = $this->consultarSoDocumentacao($semestre);

    if ($retornoDocumentacao['codigo'] == 1) {
                  
                $sql = "UPDATE documentacao SET ";

                if (!empty($ra)) {
                    $sql .= "ra_aluno = '$ra', ";
                }

                if (!empty($tcer)) {
                    $sql .= "tcer = $tcer, ";
                }

                if (!empty($tcenr)) {
                    $sql .= "tcenr = '$tcenr', ";
                }

                if (!empty($descatividades)) {
                    $sql .= "desc_atividades = '$descatividades', ";
                }

                if (!empty($fichaestagio)) {
                    $sql .= "ficha_valid_estagio = '$fichaestagio', ";
                }

                if (!empty($relatividade)) {
                    $sql .= "rel_atividades = '$relatividade', ";
                }

                if (!empty($rescisao)) {
                    $sql .= "rescisao = '$rescisao', ";
                }

                if (!empty($relequivalencia)) {
                    $sql .= "rel_equivalencia = '$relequivalencia', ";
                }

                if (!empty($observacao)) {
                    $sql .= " observacoes = '$observacao', ";
                }

                if (!empty($estatus)) {
                    $sql .= "estatus = '$estatus', ";
                }

                $sql = rtrim($sql, ', ');
                $sql .= " WHERE semestre_ano = $semestre";

                $this->db->query($sql);

                if ($this->db->affected_rows() > 0) {
                    $dados = array('codigo' => 1, 'msg' => 'Documentação atualizado com sucesso.');
                 
            } else {
                $dados = array('codigo' => 4, 'msg' => 'Houve um problema.');
            }
       
    } else {
        $dados = array('codigo' => 6, 'msg' => 'Código de atendimento não está na base de dados.');
    }

    return $dados;
}


public function apagaDocumentacao($semestre, $id)
{
    $retornoDocumentacao = $this->consultarSoDocumentacao($semestre);
    if ($retornoDocumentacao['codigo'] == 1) {
    $professor = new M_professor();
    $retornoProfessor = $professor->consultarSoProfessor($id);

    if ($retornoProfessor['codigo'] == 1) {
        
            $sql = "update documentacao set estatus = 'D' where semestre_ano = $semestre";

            $this->db->query($sql);

            if ($this->db->affected_rows() > 0) {
                $dados = array('codigo' => 1, 'msg' => 'documentação desativada corretamente');
            } else {
                $dados = array('codigo' => 2, 'msg' => 'houve um problema na desativação da documentação');
            }
       
    } else {
        $dados = array('codigo' => 0, 'msg' => 'Professor não está no sistema');
    }
    }else{
        $dados = array('codigo' => 0, 'msg' => 'Semestre não está no sistema');
    }

    return $dados;
}
    public function ativaDocumentacao($semestre)
    {
    $retornoDocumentacao = $this->consultarSoDocumentacao($semestre);

    if ($retornoDocumentacao['codigo'] == 1) {
        $sql = "UPDATE documentacao SET estatus = '' WHERE semestre_ano = $semestre";

        $this->db->query($sql);

        if ($this->db->affected_rows() > 0) {
            $dados = array('codigo' => 1, 'msg' => 'Documento reativado com sucesso');
        } else {
            $dados = array('codigo' => 2, 'msg' => 'Houve algum problema ao reativar o Documentação');
        }
    } else {
        $dados = array('codigo' => 4, 'msg' => 'O semestre do Documentação informado não está na base de dados.');
    }

    return $dados;
}

}

