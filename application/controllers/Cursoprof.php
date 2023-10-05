<?php



defined('BASEPATH') or exit('No direct script access allowed');







class CursoProf extends CI_Controller
{

    private $json;
    private $resultado;
    private $id;
    private $idCurso;



    public function getID()
    {



        return $this->id;
    }






    public function getIdCurso()
    {



        return $this->idCurso;
    }





    public function setID($idFront)
    {



        $this->id = $idFront;
    }






    public function setIdCurso($IdCursoFront)
    {



        $this->IdCurso = $IdCursoFront;
    }




    public function inserirProfCurso()
    {



        $json = file_get_contents('php://input');



        $resultado = json_decode($json);







        $lista = array(
            "id"      => '0',



            "idcurso"    => '0',

        );







        if (verificarParam($resultado, $lista) == 1) {







            $this->setID($resultado->id);



            $this->setIdCurso($resultado->IdCurso);

        }




        if (trim((string)$this->getID()) == "" || $this->getID() == 0) {



            $retorno = array(
                'codigo' => 3,



                'msg'   => 'ID do Professor não informado ou zerado'
            );
        }  elseif (strlen($this->getIdCurso()) == 0) {



            $retorno = array(
                'codigo' => 5,



                'msg'   => 'ID do Curso não informado.'
            );
        } else {



            $this->load->model('M_CursoProf');



            $retorno = $this->M_CursoProf->inserirProfCurso($this->getID(),  $this->getIdCurso());
        }



        echo json_encode($retorno);
    }
}