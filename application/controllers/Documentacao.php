<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Documentacao extends CI_Controller
{
    private $semestre;
    private $ra;
    private $tcer;
    private $tcenr;
    private $descatividades;
    private $fichaestagio;
    private $relatividade;
    private $rescisao;
    private $relequivalencia;
    private $observacao;
    private $estatus;

    public function getSemestre()
    {
        return $this->semestre;
    }

    public function setSemestre($semestreFront){

        $this->semestre = $semestreFront;
    }

    public function getRa()
    {
        return $this->ra;
    }

    public function setRa($raFront){

        $this->ra = $raFront;
    }

    public function getTcer()
    {
        return $this->tcer;
    }

    public function setTcer($tcerFront){

        $this->tcer = $tcerFront;
    }

    public function getTcenr()
    {
        return $this->tcenr;
    }

    public function setTcenr($tcenrFront){

        $this->tcenr = $tcenrFront;
    }


    public function getDescatividades()
    {
        return $this->descatividades;
    }

    public function setDescatividades($descatividadesFront){

        $this->descatividades = $descatividadesFront;
    }

    public function getFichaestagio()
    {
        return $this->fichaestagio;
    }

    public function setFichaestagio($fichaestagioFront){

        $this->fichaestagio = $fichaestagioFront;
    }

    public function getRelatividade()
    {
        return $this->relatividade;
    }

    public function setRelatividade($relatividadeFront){

        $this->relatividade = $relatividadeFront;
    }

    public function getRescisao()
    {
        return $this->rescisao;
    }

    public function setRescisao($rescisaoFront){
        $this->rescisao = $rescisaoFront;
    }

    public function getRelequivalencia()
    {
        return $this->relequivalencia;
    }

    public function setRelequivalencia($relequivalenciaFront){
        $this->relequivalencia = $relequivalenciaFront;
    }

    public function getObservacao()
    {
        return $this->observacao;
    }

    public function setObservacao($observacaoFront){

        $this->observacao = $observacaoFront;
    }

    public function getEstatus()
    {
        return $this->estatus;
    }

    public function setEstatus($estatusFront){

        $this->estatus = $estatusFront;
    }


    public function inserirDocumentacao()
    {
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $lista = array(
            "semestre"=>'0',
            "ra" => '0',
            "tcer" => '0',
            "tcenr" => '0',
            "descatividades" => '0',
            "fichaestagio" => '0',
            "relatividade" => '0',
            "rescisao" => '0',
            "relequivalencia" => '0',
            "observacao" => '0',
            "estatus" => '0',
        );

        if (verificarParam($resultado, $lista) == 1) {
            $this->setSemestre($resultado->semestre);
            $this->setRa($resultado->ra);
            $this->setTcer($resultado->tcer);
            $this->setTcenr($resultado->tcenr);
            $this->setDescatividades($resultado->descatividades);
            $this->setFichaestagio($resultado->fichaestagio);
            $this->setRelatividade($resultado->relatividade);
            $this->setRescisao($resultado->rescisao);
            $this->setRelequivalencia($resultado->relequivalencia);
            $this->setObservacao($resultado->observacao);
            $this->setEstatus($resultado->estatus);

            if (trim($this->getSemestre()) == "" || $this->getSemestre() == 0) {
                $retorno = array('codigo' => 3, 'msg' => 'O semestre nao informado ou zerado');

            } elseif (trim((string)$this->getRa()) == "" || $this->getRa() == 0) {
                $retorno = array('codigo' => 4, 'msg' => 'ra do Aluno nao informado ou zerado');

            } elseif (trim((string)$this->getTcer()) != "0" && $this->getTcenr() != "1") {
                $retorno = array('codigo' => 6, 'msg' => 'termo de compromisso de estagio remunerado não assinado');

            } elseif (trim((string)$this->getTcenr()) != "0" && $this->getTcenr() != "1") {
                $retorno = array('codigo' => 7, 'msg' => 'termo de compromisso de estagio não remunerado não assinado');

            } elseif (trim((string)$this->getDescatividades()) == "") {
                $retorno = array('codigo' => 8, 'msg' => 'descricao de atividades nao informada');

            } elseif (trim((string)$this->getFichaestagio()) != "D" && $this->getFichaestagio() != "") {
                $retorno = array('codigo' => 9, 'msg' => 'status nao condiz com o permitido');

            }elseif(trim((string)$this->getRelatividade()) == "0" && $this->getRelatividade() == "1" ){
                $retorno = array('codigo' => 10, 'msg' => 'status nao condiz com o permitido');
            
            }elseif(trim((string)$this->getRescisao()) != "0" && $this->getRescisao() != "1" ){
                $retorno = array('codigo' => 11, 'msg' => 'status nao condiz com o permitido');
            
            }elseif(trim((string)$this->getRelequivalencia()) != "0" && $this->getRelequivalencia() != "1" ){
                $retorno = array('codigo' => 12, 'msg' => 'status nao condiz com o permitido');
           
            }elseif(trim((string)$this->getObservacao()) == "" ){
                $retorno = array('codigo' => 13, 'msg' => 'status nao condiz com o permitido');
            
            }elseif(trim((string)$this->getEstatus()) != "D" && $this->getEstatus() != "" ){
                $retorno = array('codigo' => 15, 'msg' => 'status nao condiz com o permitido');
            
            }else {
                $this->load->model('M_Documentacao');
                $retorno = $this->M_Documentacao->inserirDocumentacao(
                    $this->getSemestre(),
                    $this->getRA(),
                    $this->getTcer(),
                    $this->getTcenr(),
                    $this->getDescatividades(),
                    $this->getFichaestagio(),
                    $this->getRelatividade(),
                    $this->getRescisao(),
                    $this->getRelequivalencia(),
                    $this->getObservacao(),
                    $this->getEstatus()
                );
            }
        } else {
            
            $retorno = array('codigo' => 99, 'msg' => 'os campos vindos do front nao representam o metodo de inserçao');
        }

        echo json_encode($retorno);
    }




    public function consultarDocumentacao()
    {
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $lista = array(
            "semestre"=>'0',
            "ra" => '0',
            "tcer" => '0',
            "tcenr" => '0',
            "descatividades" => '0',
            "fichaestagio" => '0',
            "relatividade" => '0',
            "rescisao" => '0',
            "relequivalencia" => '0',
            "observacao" => '0',
            "estatus" => '0',
        );

        if (verificarParam($resultado, $lista) == 1) {
            $this->setSemestre($resultado->semestre);
            $this->setRa($resultado->ra);
            $this->setTcer($resultado->tcer);
            $this->setTcenr($resultado->tcenr);
            $this->setDescatividades($resultado->descatividades);
            $this->setFichaestagio($resultado->fichaestagio);
            $this->setRelatividade($resultado->relatividade);
            $this->setRescisao($resultado->rescisao);
            $this->setRelequivalencia($resultado->relequivalencia);
            $this->setObservacao($resultado->observacao);
            $this->setEstatus($resultado->estatus);


            if (trim($this->getEstatus()) != "D" && $this->getEstatus() != "") {
                $retorno = array('codigo' => 10, 'msg' => 'status nao condiz com o permitido');
            } else {
                $this->load->model('M_Documentacao');
                $retorno = $this->M_Documentacao->consultarDocumentacao(

            $this->setSemestre($resultado->semestre),
            $this->setRa($resultado->ra),
            $this->setTcer($resultado->tcer),
            $this->setTcenr($resultado->tcenr),
            $this->setDescatividades($resultado->descatividades),
            $this->setFichaestagio($resultado->fichaestagio),
            $this->setRelatividade($resultado->relatividade),
            $this->setRescisao($resultado->rescisao),
            $this->setRelequivalencia($resultado->relequivalencia),
            $this->setObservacao($resultado->observacao),
            $this->setEstatus($resultado->estatus)
                );
            }
        } else {
            $retorno = array('codigo' => 99, 'msg' => 'os campos vindos do front nao representam o metodo de inserçao');
        }

        echo json_encode($retorno);
    }



    public function alteraDocumentacao()
    {
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);
    
        $lista = array(
            "semestre"=>'0',
            "ra" => '0',
            "tcer" => '0',
            "tcenr" => '0',
            "descatividades" => '0',
            "fichaestagio" => '0',
            "relatividade" => '0',
            "rescisao" => '0',
            "relequivalencia" => '0',
            "observacao" => '0',
            "estatus" => '0',
        );
    
        if (verificarParam($resultado, $lista) == 1) {
            $this->setSemestre($resultado->semestre);
            $this->setRa($resultado->ra);
            $this->setTcer($resultado->tcer);
            $this->setTcenr($resultado->tcenr);
            $this->setDescatividades($resultado->descatividades);
            $this->setFichaestagio($resultado->fichaestagio);
            $this->setRelatividade($resultado->relatividade);
            $this->setRescisao($resultado->rescisao);
            $this->setRelequivalencia($resultado->relequivalencia);
            $this->setObservacao($resultado->observacao);
            $this->setEstatus($resultado->estatus);
    
            if (trim((String)$this->getSemestre()) == "" || $this->getSemestre() == 0) {
                $retorno = array('codigo' => 3, 'msg' => 'Semestre ano não passado corretamente.');
            } else if (trim((string)$this->getRa()) == "" || $this->getRa() == 0) {
                $retorno = array('codigo' => 4, 'msg' => 'RA do aluno nao informado ou zerado.');
            } elseif ((string)$this->getEstatus() != "D" && $this->getEstatus() != "") {
                $retorno = array('codigo' => 5, 'msg' => 'status nao condiz com o permitido');
            } else {
                $this->load->model('M_Documentacao');
                $retorno = $this->M_Documentacao->alteraDocumentacao(
                    $this->getSemestre(),
                    $this->getRA(),
                    $this->getTcer(),
                    $this->getTcenr(),
                    $this->getDescatividades(),
                    $this->getFichaestagio(),
                    $this->getRelatividade(),
                    $this->getRescisao(),
                    $this->getRelequivalencia(),
                    $this->getObservacao(),
                    $this->getEstatus()
                );
            }
        } else {
            
            $retorno = array('codigo' => 99, 'msg' => 'os campos vindos do front nao representam o metodo de inserçao');
        }

        echo json_encode($retorno);
    }


    public function apagaDocumentacao()
{
    $json = file_get_contents('php://input');
    $resultado = json_decode($json);

    $lista = array("semestre" => '0',
                   "id" => '0');

    if (verificarParam($resultado, $lista) == 1) {
        $this->setSemestre($resultado->semestre);
        $id = $resultado -> id;

        if (trim($this->getSemestre()) == "" || $this->getSemestre() == 0) {
            $retorno = array('codigo' => 11, 'msg' => 'Código do atendimento não informado ou zerado');
        } else {
            $this->load->model('M_Documentacao');
            $retorno = $this->M_Documentacao->apagaDocumentacao($this->getSemestre(),$id);
        }
    } else {
        $retorno = array('codigo' => 88, 'msg' => 'O Semestre informado não está na base de dados');
    }

    echo json_encode($retorno);
}

public function ativaDocumentacao()
{
    $json = file_get_contents('php://input');
    $resultado = json_decode($json);

    $lista = array("semestre" => '0');

    if (verificarParam($resultado, $lista) == 1) {
        $this->setSemestre($resultado->semestre);

        if (trim($this->getSemestre()) == "" || $this->getSemestre() == 0) {
            $retorno = array('codigo' => 11, 'msg' => 'Semestre da DOcumentação não informado ou zerado');
        } else {
            $this->load->model('M_Documentacao');
            $retorno = $this->M_Documentacao->ativaDocumentacao($this->getSemestre());
        }
    } else {
        $retorno = array('codigo' => 88, 'msg' => 'O semestre informado não está na base de dados');
    }

    echo json_encode($retorno);
}

}
