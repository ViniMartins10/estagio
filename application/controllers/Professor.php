


<?php



defined('BASEPATH') or exit('No direct script access allowed');




class Professor extends CI_Controller
{


    private $id;
    private $nome;
    private $estatus;


    public function getID()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEstatus()
    {
        return $this->estatus;
    }



    public function setID($idFront)
    {
        $this->id = $idFront;
    }

    public function setNome($nomeFront)
    {
        $this->nome = $nomeFront;
    }

    public function setEstatus($estatusFront)
    {
        $this->estatus = $estatusFront;
    }





    public function inserirProfessor()
    {



        $json = file_get_contents('php://input');



        $resultado = json_decode($json);







        $lista = array(
            "id"      => '0',



            "nome"    => '0',



            "estatus" => '0'
        );







        if (verificarParam($resultado, $lista) == 1) {







            $this->setID($resultado->id);



            $this->setNome($resultado->nome);



            $this->setEstatus($resultado->estatus);
        }











        if (trim($this->getID()) == "" || $this->getID() == 0) {



            $retorno = array(
                'codigo' => 3,



                'msg'   => 'ID do Professor não informado ou zerado'
            );
        } elseif ($this->getEstatus() != "D" && $this->getEstatus() != "") {



            $retorno = array(
                'codigo' => 4,



                'msg'    => 'Status não condiz com o permitido.'
            );
        } elseif (strlen($this->getNome()) == 0) {



            $retorno = array(
                'codigo' => 5,



                'msg'   => 'Nome do aluno não informado.'
            );
        } else {



            $this->load->model('M_Professor');



            $retorno = $this->M_Professor->inserirProfessor($this->getID(),  $this->getNome(), $this->getEstatus());
        }



        echo json_encode($retorno);
    }











    public function consultarProfessor()
{
    $json = file_get_contents('php://input');

    // Verifique se a decodificação do JSON foi bem-sucedida
    $resultado = json_decode($json);

    if ($resultado !== null) { // Use !== para verificar se não é nulo

        $lista = array(
            "id"      => '0',
            "nome"    => '0',
            "estatus" => '0'
        );

        if (verificarParam($resultado, $lista) == 1) {
            $this->setID($resultado->id);
            $this->setNome($resultado->nome);
            $this->setEstatus($resultado->estatus);

            if ($this->getEstatus() != "D" && $this->getEstatus() != "") {
                $retorno = array(
                    'codigo' => 4,
                    'msg'    => 'Status não condiz com o permitido.'
                );
            } else {
                $this->load->model('M_Professor');
                $retorno = $this->M_Professor->consultarProfessor($this->getID(), $this->getNome(), $this->getEstatus());
            }
        } else {
            $retorno = array(
                'codigo' => 99,
                'msg'    => 'Os Campos vindos do FrontEnd não representam o método de consulta, verifique.'
            );
        }
    } else {
        $retorno = array(
            'codigo' => 100, // Adicionei um código para indicar que a decodificação falhou
            'msg'    => 'Erro na decodificação do JSON.'
        );
    }

    echo json_encode($retorno);
}





    public function alterarProfessor()
    {



        $json = file_get_contents('php://input');



        $resultado = json_decode($json);



        $lista = array(
            "id"      => '0',
            "nome"    => '0'
        );







        if (verificarParam($resultado, $lista) == 1) {



            $this->setID($resultado->id);







            $this->setNome($resultado->nome);















            $this->load->model('M_Professor');



            $retorno = $this->M_Professor->alterarProfessor($this->getID(),  $this->getNome());
        } else {

            $retorno = array(
                'codigo' => 99,



                'msg'   => 'Os campos vindos do FrontEnd não representam o método de consulta, verifique.'
            );
        }



        echo json_encode($retorno);
    }











    public function apagarProfessor()
    {



        $json = file_get_contents('php://input');



        $resultado = json_decode($json);



        $lista = array("id" => '0');







        if (verificarParam($resultado, $lista) == 1) {







            $this->setID($resultado->id);







            if (strlen($this->getID()) == 0) {



                $retorno = array(
                    'codigo' => 3,



                    'msg' => 'ID do Professor não informado'
                );
            } else {



                $this->load->model('M_Professor');



                $retorno = $this->M_Professor->apagarProfessor($this->getID());
            }
        } else {



            $retorno = array(
                'codigo' => 99,



                'msg' => 'Os campos vindos do FrontEnd não representa, o método de consulta, verifique.'
            );
        }



        echo json_encode($retorno);
    }







    public function ativaProfessor()
    {



        $json = file_get_contents('php://input');



        $resultado = json_decode($json);



        $lista = array("id" => '0');







        if (verificarParam($resultado, $lista) == 1) {







            $this->setID($resultado->id);







            if (strlen($this->getID()) == 0) {



                $retorno = array(
                    'codigo' => 3,



                    'msg' => 'ID do professor não informado'
                );
            } else {



                $this->load->model('M_Professor');



                $retorno = $this->M_Professor->ativaProfessor($this->getID());
            }
        } else {



            $retorno = array(
                'codigo' => 99,



                'msg' => 'Os campos vindos do FrontEnd não representa, o método de consulta, verifique.'
            );
        }



        echo json_encode($retorno);
    }

    public function Login()
    {



        $json = file_get_contents('php://input');



        $resultado = json_decode($json);



        $lista = array(
            "id"      => '0',
            "nome"    => '0'
        );







        if (verificarParam($resultado, $lista) == 1) {



            $this->setID($resultado->id);
            $this->setNome($resultado->nome);


            if (trim($this->getID()) == "" || $this->getID() == 0) {



                $retorno = array(
                    'codigo' => 3,



                    'msg'   => 'ID do Professor não informado ou zerado'
                );
            } elseif (strlen($this->getNome()) == 0) {



                $retorno = array(
                    'codigo' => 5,



                    'msg'   => 'Nome do aluno não informado.'
                );
            } else {

                $this->load->model('M_Professor');
                $retorno = $this->M_Professor->Login($this->getID(),  $this->getNome());
            }
        }else{
            $retorno = array(
                'codigo' => 6,



                'msg'   => 'Insira o ID e o Nome'
            );
        }

        echo json_encode($retorno);
    }




    public function inserirProfCurso()
    {
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);


        $lista = array(
            "id" => '0',
            "idcurso" => '0',

        );

        if (verificarParam($resultado, $lista) == 1) {
            $this->setID($resultado->id);

            $idCurso = $resultado->idcurso;

            if (trim((string) $this->getID()) == "" && $this->getID() == 0) {
                $retorno = array(
                    'codigo' => 3,
                    'msg'    => 'ID do Professor não informado ou zerado',
                );
            } elseif (strlen($idCurso) == 0) {
                $retorno = array(
                    'codigo' => 5,
                    'msg'    => 'ID do Curso não informado.',
                );
            } else {
                $this->load->model('M_Professor');
                $retorno = $this->M_Professor->inserirProfCurso($this->getID(), $idCurso);
            }
        } else {
            $retorno = array(
                'codigo' => 6,
                'msg'    => 'Parâmetros inválidos',
            );
        }

        echo json_encode($retorno);
    }

    public function consultarProfCurso()
    {
        $json = file_get_contents('php://input');



        $resultado = json_decode($json);



        $lista = array(
            "id"      => '0',


            "idcurso"    => '0',

            "estatus" => '0'

        );




        if (verificarParam($resultado, $lista) == 1) {


            $this->setID($resultado->id);
            $idCurso = $resultado->idcurso;
            $this->setEstatus($resultado->estatus);


            if ($this->getEstatus() != "D" && $this->getEstatus() != "") {



                $retorno = array(
                    'codigo' => 4,



                    'msg'    => 'Status não condiz com o permitido.'
                );
            } else {



                $this->load->model('M_Professor');
                $retorno = $this->M_Professor->consultarProfCurso($this->getID(), $idCurso, $this->getEstatus());
            }
        } else {



            $retorno = array(
                'codigo' => 99,



                'msg'    => 'Os Campos vindos do FrontEnd não representam o método de consulta, verifique.'
            );
        }



        echo json_encode($retorno);
    }

    public function apagaCursoProf()
    {
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $lista = array(
            "idcurso" => '0',
            "id" => '0',
            "estatus" => '0'
        );

        if (verificarParam($resultado, $lista) == 1) {
            $this->setID($resultado->id);
            $idCurso = $resultado->idcurso;
            $this->setEstatus($resultado->estatus);

            if (empty($this->getID())) {
                $retorno = array('codigo' => 3, 'msg' => 'ID do professor não informado');
            } elseif (empty($idCurso)) {
                $retorno = array('codigo' => 4, 'msg' => 'ID do curso não informado');
            } else {
                $this->load->model('M_Professor');
                $retorno = $this->M_Professor->apagaProfCurso($this->getID(), $idCurso, $this->getEstatus());
            }
        } else {
            $retorno = array('codigo' => 5, 'msg' => 'O ID informado não está na base de dados');
        }

        echo json_encode($retorno);
    }
    public function ativaProfCurso()
    {
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $lista = array("idcurso" => '0',
                       "id" => '0',
                        "estatus" => '0');

        if (verificarParam($resultado, $lista) == 1) {
            $this->setID($resultado->id);
            $idCurso = $resultado->idcurso;
            $this->setEstatus($resultado->estatus);

            if (empty($this->getID())) {
                $retorno = array('codigo' => 3, 'msg' => 'ID do professor não informado');
            } elseif (empty($idCurso)) {
                $retorno = array('codigo' => 4, 'msg' => 'ID do curso não informado');
            } else {
                $this->load->model('M_Professor');
                $retorno = $this->M_Professor->ativaProfCurso($this->getID(), $idCurso, $this->getEstatus());
            }
        } else {
            $retorno = array('codigo' => 5, 'msg' => 'O ID informado não está na base de dados');
        }

        echo json_encode($retorno);
    }
}
