<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once("M_Aluno.php");

include_once("M_Professor.php");

include_once("M_Atendimento.php");



class M_atendimento extends CI_Model

{

    public function inserirAtendimento($ra, $id, $dataAt, $horaAt, $descricao, $estatus)

    {

        $sql = "INSERT INTO atendimento (ra, id_professor, data_atendimento, hora_atendimento, descricao, estatus) VALUES ('$ra', $id, '$dataAt', '$horaAt', '$descricao', '$estatus' ) ";



        $this->db->query($sql);



        if ($this->db->affected_rows() > 0) {

            $dados = array('codigo' => 1, 'msg' => 'Atendimento registrado com sucesso.');
        } else {

            $dados = array('codigo' => 2, 'msg' => 'Houve algum problema no atendimento');
        }

        return $dados;
    }
    public function consultarAtendimento($codigo, $ra, $id, $dataAt, $horaAt, $descricao, $estatus)
    {
        $sql = "SELECT * FROM atendimento WHERE estatus = '$estatus'";
        echo $sql;
        if (trim($codigo) != '') {
            $sql .= " AND codigo_atendimento = '$codigo'";
        }

        if (trim($ra) != '') {
            $sql .= " AND ra = '$ra'";
        }

        if (!empty($idprofessor)) {
            $sql .= " AND id_professor = '$id'";
        }

        if ($dataAt != '') {
            $sql .= " AND data_atendimento = '$dataAt'";
        }

        if ($horaAt != '') {
            $sql .= " AND hora_atendimento = '$horaAt'";
        }

        if (trim($descricao) != '') {
            $sql .= " AND descricao = '$descricao'";
        }

        $retorno = $this->db->query($sql);

        if ($retorno->num_rows() > 0) {
            $dados = array('codigo' => 1, 'msg' => 'Consulta efetuada com sucesso', 'dados' => $retorno->result());
        } else {
            $dados = array('codigo' => 2, 'msg' => 'Dados não encontrados');
        }

        return $dados;
    }
    public function consultaSoAtendimento($codigo)
    {
        $sql = "SELECT * FROM atendimento WHERE cod_atendimento = $codigo";
        
        $retorno = $this->db->query($sql);

        if ($retorno->num_rows() > 0) {
            $dados = array('codigo' => 1, 'msg' => 'Consulta efetuada com sucesso');
        } else {
            $dados = array('codigo' => 2, 'msg' => 'Dados não encontrados');
        }

        return $dados;
    }
    public function alteraAtendimento($codigo, $ra, $id, $dataAt, $horaAt, $descricao)
    {
        $retornoAtendimento = $this->consultaSoAtendimento($codigo);

        if ($retornoAtendimento['codigo'] == 1) {
            $aluno = new M_Aluno();
            $retornoAluno = $aluno->consultarSoAluno($ra);

            if ($retornoAluno['codigo'] == 1) {
                $professor = new M_Professor();
                $retornoProfessor = $professor->consultarSoProfessor($id);

                if ($retornoProfessor['codigo'] == 1) {
                    $sql = "UPDATE atendimento SET ";

                    if (!empty($ra)) {
                        $sql .= "ra = '$ra', ";
                    }

                    if (!empty($idProfessor)) {
                        $sql .= "id_professor = $id, ";
                    }

                    if (!empty($dataAt)) {
                        $sql .= "data_atendimento = '$dataAt', ";
                    }

                    if (!empty($horaAt)) {
                        $sql .= "hora_atendimento = '$horaAt', ";
                    }

                    if (!empty($descricao)) {
                        $sql .= "descricao = '$descricao', ";
                    }

                    $sql = rtrim($sql, ', ');
                    $sql .= " WHERE cod_atendimento = $codigo";

                    $this->db->query($sql);

                    if ($this->db->affected_rows() > 0) {
                        $dados = array('codigo' => 1, 'msg' => 'Atendimento atualizado com sucesso.');
                    } else {
                        $dados = array('codigo' => 2, 'msg' => 'Problemas ao atualizar o atendimento.');
                    }
                } else {
                    $dados = array('codigo' => 4, 'msg' => 'Professor não está na base de dados.');
                }
            } else {
                $dados = array('codigo' => 5, 'msg' => 'Aluno não está na base de dados.');
            }
        } else {
            $dados = array('codigo' => 6, 'msg' => 'Código de atendimento não está na base de dados.');
        }

        return $dados;
    }
    public function apagaAtendimento($codAtendimento)
    {
        $retornoAtendimento = $this->consultaSoAtendimento($codAtendimento);

        if ($retornoAtendimento['codigo'] == 1) {
            $sql = "UPDATE atendimento SET estatus = 'D' WHERE cod_atendimento = $codAtendimento";
            $this->db->query($sql);

            if ($this->db->affected_rows() > 0) {
                $dados = array('codigo' => 1, 'msg' => 'Atendimento desativado  com sucesso');
            } else {
                $dados = array('codigo' => 2, 'msg' => 'Houve algum problema ao concluir o atendimento, tente novamente.');
            }
        } else {
            $dados = array('codigo' => 4, 'msg' => 'Atendimento não registrado em nosso banco de dados');
        }

        return $dados;
    }
    public function ativaAtendimento($codigo)
{
    $retornoAtendimento = $this->consultaSoAtendimento($codigo);

    if ($retornoAtendimento['codigo'] == 1) {
        $sql = "UPDATE atendimento SET estatus = '' WHERE cod_atendimento = $codigo";

        $this->db->query($sql);

        if ($this->db->affected_rows() > 0) {
            $dados = array('codigo' => 1, 'msg' => 'Atendimento reativado com sucesso');
        } else {
            $dados = array('codigo' => 2, 'msg' => 'Houve algum problema ao reativar o atendimento');
        }
    } else {
        $dados = array('codigo' => 4, 'msg' => 'O código de atendimento informado não está na base de dados.');
    }

    return $dados;
}

    
}
