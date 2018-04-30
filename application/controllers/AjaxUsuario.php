<?php
class AjaxUsuario extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('M_ajax');
    }
    function index(){
        $this->load->view('cadastro.php');
    }

    function getAllInst() {
        $data = $this->M_ajax->inst_list();
        echo json_encode($data);
    }

    function salvarInst(){
        $date = array(
            'nome' => $this->input->post('nome'),
            'cidade' => $this->input->post('cidade'),
            'estado' => $this->input->post('estado'),
            'pais'  => $this->input->post('pais')
        );

        $data=$this->M_ajax->salvarInst($date);
        echo json_encode($data);
    }

    //function update(){
    //    $data=$this->M_ajax->update_product();
    //    echo json_encode($data);
    //}

    //function delete(){
    //    $data=$this->M_ajax->delete_product();
     //   echo json_encode($data);
    //}

}