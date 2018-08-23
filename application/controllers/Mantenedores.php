<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Mantenedores extends CI_Controller {

        public function index()
        {
                echo 'Teste!';
        }
        public function fabricaSoft(){
            $dados = null;
            $this->template->load('templates/default', 'mantenedores/fabricasoftware', $dados);
            //redirect('http://www.upf.br/Iceg/curso/analise-e-desenvolvimento-de-sistemas/laboratorios/fabrica-experimental-de-teste-de-software');
        }
        public function ppgh(){
            $dados = null;
            $this->template->load('templates/default', 'mantenedores/ppgh', $dados);
        }
        public function nupha(){
            $dados = null;
            $this->template->load('templates/default', 'mantenedores/nupha', $dados);
        }

}
