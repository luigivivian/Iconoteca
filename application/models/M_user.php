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


}
