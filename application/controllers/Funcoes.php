<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Funcoes extends CI_Controller{

    public function index(){
        $this->load->view('index');
    }
    public function inicio(){
        $this->load->helper('url');
        $this->load->view('inicio');
    }
    public function cadastrar(){
        $this->load->helper('url');
        $this->load->view('cadastrar');
    }
    public function consultar(){
        $this->load->helper('url');
        $this->load->view('consultar');
    }
    public function alterar(){
        $this->load->helper('url');
        $this->load->view('alterar');
    }
}