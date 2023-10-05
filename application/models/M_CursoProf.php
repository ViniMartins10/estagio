<?php

defined('BASEPATH') or exit('No direct script access allowed');
include_once("M_Professor.php");
include_once("M_curso.php");



class M_CursoProf extends CI_Model


{

    public function inserirProfCurso($id, $IdCurso)

    {
        $retornoProfessor = $this->consultarSoProfessor($id);
        $sql = "insert into cursoprof (id_prof,id_curso) values ( '$id','$IdCurso')";



        $this->db->query($sql);


    if ($retornoProfessor['codigo'] == 1) {
        if ($this->db->affected_rows() > 0) {

            $dados = array('codigo' => 1, 'msg' => 'professor foi cadastrado corretamente no curso');
        } else {

            $dados = array('codigo' => 2, 'msg' => ' houve algum problema na inserçao na tabela professor');
        }



        return $dados;
    }}
}