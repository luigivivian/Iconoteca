<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	/*
		$param1 pode ser tanto a categoria quanto a página
		$param2 só será chamado quando a categoria  ser especificada
	*/
	public function index($param1 = 1, $param2 = 1)
	{
		if($this->session->has_userdata('termoBusca'))
		{
			$this->session->unset_userdata('termoBusca');
			$this->session->unset_userdata('categoria');
		}

		$dados['title']  	 = "Iconoteca";
		$dados['paginaHome'] = TRUE;
		$dados['nomes'] 	 = json_encode($this->m_any->get("artefatos", null, null, null, "nome", "asc", null, null, "nome")->result());

		$URL = base_url('home/');
		$categoriasValidas = $this->m_any->get("categorias", null, null, null, "nomeCategoria", "asc");
		$categoria = (is_numeric($param1)) ? null : $param1;
		$limit     = (is_numeric($param1)) ? $param1 : $param2;

		// Caso seja passado alguma categoria, é necessário validá-la
		if(!is_numeric($param1))
		{
			// Cria um vetor de categorias válidas
			foreach ($categoriasValidas->result() as $c)
				$cat[] = $c->nomeURL;

			// Testa se a categoria do parâmetro está no vetor
			if(in_array($param1, $cat)) // Categoria válida
			{
				$categoria = $param1;
				$limit	   = $param2;
				if($limit == 0) $limit++;
			}
			else // Categoria inválida
			{
				$erro['heading'] = "ERRO 404 - Categoria inválida";
	            $erro['message'] = "O valor <b>$param1</b> é inválido. Esta categoria não existe.";
	            $this->load->view('errors/html/error_404', $erro);
			}
		}
		// Caso contrário apenas realiza a busca
		else
		{
			$limit = $param1;
			if($limit == 0) $limit++;
		}

		// Realiza a busca com os parâmetros após a validação dos campos
		$dados['artefatos'] = $this->m_any->get("artefatos", $categoria, $limit, 6, "dataAdicionado", "desc", null, null, "idArtefato, icone, nome, shortDesc, nomeArquivo");
		$dados['categoria'] = $categoria;
		$totalRows = $this->m_any->get("artefatos", $categoria)->num_rows();

		if($dados['artefatos']->num_rows() > 0) $dados['categorias'] = $categoriasValidas;
		if($categoria) $URL = $URL . "/$categoria/";

		$this->createPagination($URL, $totalRows);

		$this->template->load('templates/default', 'home', $dados);
	}

	public function buscarArtefato($limit = null)
	{
		$dados['title']  	 = "Iconoteca";
		$dados['paginaHome'] = TRUE;
		$dados['nomes'] 	 = json_encode($this->m_any->get("artefatos", null, null, null, "nome", "asc", null, null, "nome")->result());

		if($limit == null) $limit = 1;

		if($this->input->post('newSearch') !== null)
		{
			$this->session->unset_userdata('termoBusca');
			$this->session->unset_userdata('categoria');
		}

		// Caso esteja carregando pela primeira vez a view dessa busca
		if($limit === 1 && !$this->session->has_userdata('termoBusca'))
		{
			$this->session->set_userdata('termoBusca', $this->input->post('termoBusca'));
			$this->session->set_userdata('categoria',  $this->input->post('categoriaBusca'));
		}

		$termoBusca = $this->session->termoBusca;
		$categoria  = $this->session->categoria;

		if($categoria == "todos") $categoria = null;

		$dados['artefatos']  = $this->m_any->get("artefatos", $categoria, $limit, 6, "dataAdicionado", "desc", null, null, "idArtefato, icone, nome, shortDesc", "nome", $termoBusca);
		$dados['categoria']  = $categoria;
		$dados['termoBusca'] = $termoBusca;

		if($dados['artefatos']->num_rows() > 0) $dados['categorias'] = $this->m_any->get("categorias", null, null, null, "nomeCategoria", "asc");

		$URL = base_url('buscar/');
		$totalRows = $this->m_any->get("artefatos", $categoria, null, null, "dataAdicionado", "desc", null, null, "idArtefato, icone, nome, shortDesc", "nome", $termoBusca)->num_rows();

		$this->createPagination($URL, $totalRows);
		$this->template->load('templates/default', 'home', $dados);
	}

	public function createPagination($URL, $totalRows)
	{
		// Paginação
		$this->load->library('pagination');
		$config['base_url']   = $URL;
		$config['total_rows'] = $totalRows;
		$config['per_page']   = 6;
		$config['num_links']  = 3;
		$config['use_page_numbers'] = TRUE;
		$config['cur_tag_open'] = '<a class="w3-bar-item w3-black w3-button">';
		$config['cur_tag_close'] = '</a>';
		$config['attributes'] = array('class' => 'w3-bar-item w3-button w3-hover-black');
		$this->pagination->initialize($config);
	}
}
