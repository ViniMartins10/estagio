<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once("M_Professor.php");

class M_curso extends CI_Model

{

    public function inserirCurso($descricao, $estatus)

    {

        $sql = "insert into curso (descricao,estatus) values ('$descricao','$estatus')";



        $this->db->query($sql);



        if ($this->db->affected_rows() > 0) {

            $dados = array('codigo' => 1, 'msg' => 'curso cadastrado corretamente');
        } else {

            $dados = array('codigo' => 2, 'msg' => ' houve algum problema na inserçao na tabela curso');
        }



        return $dados;
    }



    public function consultarCurso($idCurso, $descricao, $estatus)

    {

        $sql = "select * from curso where estatus = '$estatus' ";



        if ($idCurso != "" && $idCurso != 0) {

            $sql = $sql . "and id_curso = '$idCurso' ";
        }



        if (trim($descricao) != '') {

            $sql = $sql . " and descricao like '%$descricao%'";
        }

      



        $retorno = $this->db->query($sql);

        if ($estatus = 'D'){
            $dados = array('codigo' => 8, 'msg' => 'Esse curso está desativado.', 'dados' => $retorno->result());
        };

        if ($retorno->num_rows() > 0) {

            $dados = array('codigo' => 1, 'msg' => 'consulta efetuada com sucesso.', 'dados' => $retorno->result());
        } else {

            $dados =  array('codigo' => 2, 'msg' => 'dados nao encontrados');
        }

       

    

        return $dados;
    }


    public function consultarSoCurso($idCurso)

    {



        $sql = "select * from curso where id_curso = '$idCurso' ";



        $retorno = $this->db->query($sql);



        if ($retorno->num_rows() > 0) {

            $dados = array('codigo' => 1, 'msg' => 'consulta efetuada com sucesso.');
        } else {

            $dados = array('codigo' => 2, 'msg' => 'dados nao encontrados');
        }



        return $dados;
    }



    public function alterarCurso($idCurso, $descricao)
{
    $retornoCurso = $this->consultarSoCurso($idCurso);

    if ($retornoCurso['codigo'] == 1) {
        $sql = "update curso set descricao = '$descricao' where id_curso = '$idCurso'" ;
       
        $this->db->query($sql);

        if ($this->db->affected_rows() > 0) {
            $dados = array('codigo' => 1, 'msg' => 'Descrição do curso atualizada com sucesso.');
        } else {
            $dados = array('codigo' => 2, 'msg' => 'Houve algum problema na atualização da descrição do curso.');
        }
    } else {
        $dados = array('codigo' => 5, 'msg' => 'O ID do curso não está na base de dados.');
    }

    return $dados;
}




    public function apagarCurso($idCurso, $id)

    {
        $professor = new M_professor();
        $retornoProfessor = $professor -> consultarSoProfessor($id);
        if ($retornoProfessor['codigo']==1){
        $retornoCurso = $this-> consultarSoCurso($idCurso);

        if ($retornoCurso['codigo'] == 1) {

            $sql = "select* from curso where id_curso = '$idCurso' and estatus = 'D'  ";
            $this->db->query($sql);

            if($this->db->affected_rows()>0){
                $dados = array('codigo' => 0, 'msg' => 'curso já foi apagado');

            } else{ 

            $sql = "update curso set estatus ='D' where id_curso = $idCurso";
            $this->db->query($sql);



            if ($this->db->affected_rows() > 0) {


                $dados = array('codigo' => 1, 'msg' => 'curso desativado com sucesso');
            } else {

                $dados = array('codigo' => 2, 'msg' => 'houve um problema na desativacao do curso');
            }
        }
            }else {
        
            $dados = array('codigo' => 5, 'msg' => 'o id do curso passado nao esta na base de dados');
            }

    }

        return $dados;
    }
}
