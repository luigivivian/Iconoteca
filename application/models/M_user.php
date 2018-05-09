<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model
{
    // Validar os dados do usuário em algum campo que necessite senha
    public function validarDados($email, $senha)
    {
        return $this->db->get_where('usuarios', array('email' => $email, 'senha' => $senha));
    }

    public function validarEmail($email)
    {
        return $this->db->get_where('usuarios', array('email' => $email));
    }
    public function getVisitantes(){
        return $this->db->query("SELECT email FROM visitantes");
    }
    public function validarEmailVisitantes($email){
        return $this->db->get_where('visitantes', array('email' => $email));
    }
    public function verificarStatus($email){
        return $this->db->get_where('visitantes', array('email' => $email));
    }
    public function ativarEmail($email){
        $this->db->set('status', 1);
        $this->db->where('email', $email);
        $this->db->update('visitantes');
    }

}
