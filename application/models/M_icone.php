<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_icone extends CI_Model
{
    // Busca as imagens do artefato $id
    public function getImages($id)
    {
        $this->db->select("nomeImagem");
        $this->db->from("artefatos");
        $this->db->join('imagens', 'artefatos.idArtefato = imagens.idIcone');
        $this->db->where('idArtefato', $id);
        return $this->db->get();
    }
    public function getImagesAprovar($id)
    {
        $this->db->select("nomeImagem");
        $this->db->from("aprovarArtefatos");
        $this->db->join('imagensAprovar', 'aprovarArtefatos.idArtefato = imagensAprovar.idIcone');
        $this->db->where('idArtefato', $id);
        return $this->db->get();
    }
}
