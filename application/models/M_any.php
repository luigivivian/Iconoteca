<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Funções usadas tanto para ícones quanto para usuários
class M_any extends CI_Model
{
    /*
        Busca os registros no DB

        $table      tabela que será realizado a busca
        $limit      limite de busca
        $orderBy    nome do campo da ordenação
        $orderHow   desc ou asc
        $where      nome do campo do where
        $value      valor buscado no where
        $categoria  categoria do artefato
        $select     campos a serem buscados
        $campoBusca campo da busca (que será feito like)
        $termoBusca termo de busca
    */
    public function get($table, $categoria = null, $limit = null, $limitNum = null, $orderBy = null, $orderHow = null, $where = null, $value = null, $select = null, $campoBusca = null, $termoBusca = null)
    {
        if($value)      $this->db->where($where, $value);
        if($categoria)  $this->db->where('categoria', $categoria);
        if($termoBusca) $this->db->like($campoBusca, $termoBusca);
        if($limit)      $this->db->limit($limitNum, $limitNum*($limit-1));
        if($orderBy)    $this->db->order_by($orderBy, ($orderHow) ? $orderHow : "desc");
        if($select)     $this->db->select($select);
        $this->db->from($table);

        return $this->db->get();
    }

    public function countArtefatos($id){
        return $this->db->query("SELECT COUNT(*) AS totalArtefatos
                                FROM usuarios INNER JOIN artefatos
                                ON usuarios.idUser = artefatos.idOwner
                                WHERE artefatos.idOwner = $id");
    }

    public function getInstAluno($id){
        return $this->db->query("SELECT i.nome
                                from instituicoes i
                                INNER JOIN aprovarUsuarios u
                                ON i.idInstituicao = u.codInstituicao
                                WHERE u.idUser = $id");
    }

    public function getADM(){
        return $this->db->query("SELECT email FROM usuarios WHERE adm = 1");
    }
    public function getUser($id){
        return $this->db->query("SELECT * FROM aprovarUsuarios WHERE idUser = $id");
    }

    public function getImgs() //funcao utilizada para pegar os artefatos utilizados na area "outros artefatos"
    {
        return $this->db->query("SELECT * FROM artefatos LIMIT 10;");
    }
    //funcao para deletar as imagens na aba de editar artefatos
    public function delImgs($nome){
        $this->db->from("imagens");
        $this->db->where("nomeImagem", $nome);
        $this->db->delete();
    }
    //retorna as instituições
    public function getInst(){
        return $this->db->query("SELECT * FROM instituicoes;");
    }
    //retorna o id da instituição pelo nome
    public function getInstCod($nome){
        $get = $this->db->query("SELECT idInstituicao FROM instituicoes WHERE nome LIKE '$nome';");
        return $get;
    }

    public function getID(){
        $query = $this->db->query("SELECT max(idArtefato) AS id FROM artefatos;");
        return $query;
    }

    // Deleta um registro da tabela @tabela onde @campo for igual a @valor
    public function deleteWhere($campo, $valor, $tabela)
    {
        $this->db->from($tabela);
        $this->db->where($campo, $valor);
        $this->db->delete();
    }

    // Atualiza os campos @values (array('nome_do_campo' => 'novo_valor_campo')) da tabela $table onde $where_field for igual a $where_value
    public function mudarCampo($table, $where_field, $where_value, $values)
    {
        $this->db->where($where_field, $where_value);
        $this->db->update($table, $values);
    }

    // Registra os $dados na $table do DB
    public function store($table, $dados)
    {
        $this->db->insert($table, $dados);
    }
}
