<?php

defined('BASEPATH') or exit('No direct script access allowed');
include_once("M_curso.php");


class M_Professor extends CI_Model

{

    public function inserirProfessor($id, $nome, $estatus)

    {

        $sql = "insert into professor (id_professor,nome,estatus) values ( '$id','$nome','$estatus')";



        $this->db->query($sql);



        if ($this->db->affected_rows() > 0) {

            $dados = array('codigo' => 1, 'msg' => 'professor cadastrado corretamente');
        } else {

            $dados = array('codigo' => 2, 'msg' => ' houve algum problema na inserçao na tabela professor');
        }



        return $dados;
    }



    public function consultarProfessor($id, $nome, $estatus)

    {

        $sql = "select * from professor where estatus = '$estatus' ";



        if ($id != "" && $id != 0) {

            $sql = $sql . "and id_professor = '$id' ";
        }



        if (trim($nome) != '') {

            $sql = $sql . " and nome like '%$nome%'";
        }





        $retorno = $this->db->query($sql);

        if ($estatus = 'D') {
            $dados = array('codigo' => 8, 'msg' => 'Esse Professor está desativado.', 'dados' => $retorno->result());
        };

        if ($retorno->num_rows() > 0) {

            $dados = array('codigo' => 1, 'msg' => 'consulta efetuada com sucesso.', 'dados' => $retorno->result());
        } else {

            $dados =  array('codigo' => 2, 'msg' => 'dados nao encontrados');
        }





        return $dados;
    }


    public function consultarSoProfessor($id)

    {



        $sql = "select * from professor where id_professor = '$id' ";



        $retorno = $this->db->query($sql);



        if ($retorno->num_rows() > 0) {

            $dados = array('codigo' => 1, 'msg' => 'consulta efetuada com sucesso.');
        } else {

            $dados = array('codigo' => 2, 'msg' => 'dados nao encontrados');
        }



        return $dados;
    }

    public function consultarSoProfessorDesativado($id)
    {
        $sql = "select * from professor
        where id_professor = '$id'
        and estatus = 'D'";
        $retorno = $this->db->query($sql);
        if ($retorno->num_rows() > 0) {
            $dados = array(
                'codigo' => 1,
                'msg'    => 'Consulta efetuada com sucesso'
            );
        } else {
            $dados = array(
                'codigo' => 2,
                'msg'    => 'Dados não encontrados.'
            );
        }
        return $dados;
    }

    public function alterarProfessor($id, $nome)

    {



        $retornoProfessor = $this->consultarSoProfessor($id);



        if ($retornoProfessor['codigo'] == 1) {



            $sql = "update professor set nome = '$nome' where id_professor = $id";



            $this->db->query($sql);



            if ($this->db->affected_rows() > 0) {

                $dados = array('codigo' => 1, 'msg' => 'nome do professor atualizado com sucesso.');
            } else {

                $dados = array('codigo' => 2, 'msg' => 'houve algum problema no nome do professor.');
            }
        } else {

            $dados = array('codigo' => 5, 'msg' => ' o id do professor nao esta na base de dados');
        }



        return $dados;
    }



    public function apagarProfessor($id)

    {

        $retornoCurso = $this->consultarSoProfessor($id);

        if ($retornoCurso['codigo'] == 1) {

            $sql = "select* from professor where id_professor = '$id' and estatus = 'D'  ";
            $this->db->query($sql);

            if ($this->db->affected_rows() > 0) {
                $dados = array('codigo' => 0, 'msg' => 'professor já foi apagado');
            } else {

                $sql = "update professor set estatus ='D' where id_professor = $id";
                $this->db->query($sql);



                if ($this->db->affected_rows() > 0) {


                    $dados = array('codigo' => 1, 'msg' => 'professor desativado com sucesso');
                } else {

                    $dados = array('codigo' => 2, 'msg' => 'houve um problema na desativacao do professor');
                }
            }
        } else {

            $dados = array('codigo' => 5, 'msg' => 'o id do professor passado nao esta na base de dados');
        }

        return $dados;
    }


    public function ativaProfessor($id)
    {
        $retornoAluno = $this->consultarSoProfessorDesativado($id);
        if ($retornoAluno['codigo'] == 1) {
            $sql = "update professor set estatus = ''
            where id_professor = $id";
            $this->db->query($sql);
            if ($this->db->affected_rows() > 0) {
                $dados = array(
                    'codigo' => 1,
                    'msg'    => 'Professor ativado corretamente.'
                );
            } else {
                $dados = array(
                    'codigo' => 2,



                    'Houve algum problema na ativação do Professor.'
                );
            }
        } else {
            $dados = array(
                'codigo' => 4,



                'msg'    => ' O ID não está desativado.'
            );
        }


        return $dados;
    }
    public function Login($id, $nome)
    {
        $retornoProfessor = $this->consultarSoProfessor($id);

        if ($retornoProfessor['codigo'] == 1) {
            $sql = "SELECT * FROM professor WHERE id_professor = '$id' AND estatus = 'D'";
            $retorno = $this->db->query($sql);

            if ($retorno->num_rows() > 0) {
                $dados = array(
                    'codigo' => 1,
                    'msg'    => 'O professor não está ativo.'
                );
            } else {
                $sql = "SELECT * FROM professor WHERE id_professor = '$id' and nome = '$nome'";
                $retorno = $this->db->query($sql);

                if ($retorno->num_rows() > 0) {
                    $dados = array(
                        'codigo' => 1,
                        'msg'    => 'Acesso realizado com sucesso.'
                    );
                } else {
                    $dados = array(
                        'codigo' => 2,
                        'msg'    => 'Houve algum problema no nome do professor.'
                    );
                }
            }
        } else {
            $dados = array('codigo' => 5, 'msg' => 'O id do professor não está na base de dados');
        }

        return $dados;
    }


    public function inserirProfCurso($id, $idCurso)
    {

        $retornoProfessor = $this->consultarSoProfessor($id);
        $curso = new M_Curso();
        $retornoCurso = $curso->consultarSoCurso($idCurso);

        if ($retornoCurso['codigo'] == 1) {
            if ($retornoProfessor['codigo'] == 1) {
                $sql = "insert into cursoprof (id_curso, id_professor) values ('$idCurso', $id)";
                $this->db->query($sql);

                if ($this->db->affected_rows() > 0) {
                    $dados = array(
                        'codigo' => 1,
                        'msg'    => 'Professor cadastrado no curso corretamente.'
                    );
                } else {
                    $dados = array(
                        'codigo' => 2,
                        'msg'    => 'Houve algum problema na inserção na tabela cursoprof.'
                    );
                }
            } else {
                $dados = array(
                    'codigo' => 8,
                    'msg'    => 'Professor se encontra desativado, ative-o.'
                );
            }
        } else {
            $dados = array(
                'codigo' => 7,
                'msg'    => 'Curso informado não cadastrado na base de dados.'
            );
        }

        return $dados;
    }


    public function consultarProfCurso($id, $idCurso,$estatus)
    {  
        $sql = "SELECT * FROM cursoprof WHERE estatus = '$estatus'";
       
       

        if (!empty($id) != '') {

            $sql = $sql . " and id_professor = '$id'";
        }
        
        if(!empty($idCurso) != '') {

            $sql = $sql . " and id_curso = '$idCurso'";

        }
        $retorno = $this->db->query($sql);
        

        if ($retorno->num_rows() > 0) {

            $dados = array('codigo' => 1, 'msg' => 'consulta efetuada com sucesso.', 'dados' => $retorno->result());
        } else {

            $dados =  array('codigo' => 2, 'msg' => 'dados nao encontrados');
        }


        return $dados;
    

}


    public function apagaProfCurso( $id,$idCurso, $estatus)
    {
        $retornoProfCurso = $this->consultarProfCurso($id, $idCurso, $estatus);
    
        if ($retornoProfCurso['codigo'] == 1) {
            $sql = "update cursoprof set estatus = 'D' WHERE id_professor = $id and id_curso = $idCurso ";
          
            $this->db->query($sql);
    
            if ($this->db->affected_rows() > 0) {
                $dados = array('codigo' => 1, 'msg' => 'cursoProf desativado corretamente');
            } else {
                $dados = array('codigo' => 2, 'msg' => 'Houve um problema na desativação do Professor curso');
            }
        } else {
            $dados = array('codigo' => 4, 'msg' => 'ProfCurso informado não está na base de dados');
        }
    
        return $dados;
    }

    public function ativaProfCurso($id,$idCurso, $estatus)
{
    $retornoProfCurso = $this->consultarProfCurso($id, $idCurso, $estatus);

    if ($retornoProfCurso['codigo'] == 1) {
        $sql = "UPDATE cursoprof SET estatus = '' WHERE id_professor = $id";
       
        $this->db->query($sql);

        if ($this->db->affected_rows() > 0) {
            $dados = array('codigo' => 1, 'msg' => 'Atendimento reativado com sucesso');
        } else {
            $dados = array('codigo' => 2, 'msg' => 'Houve algum problema ao reativar o atendimento');
        }
    } else {
        $dados = array('codigo' => 4, 'msg' => 'O código de ProfCurso informado não está na base de dados.');
        
    }

    return $dados;
}
    
}
