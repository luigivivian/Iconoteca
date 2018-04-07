<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artefato extends CI_Controller
{
    // Index do controller Artefato (página do artefato $id)
    public function index($id)
    {
        if(!isset($id)) redirect();
        $artefato = $this->m_any->get("artefatos", null, null, null, null, null, "idArtefato", $id, "nome, nomeArquivo, complDesc, lat, lng, designacao, procedencia, dimensoes, material");

        if($artefato->num_rows() > 0)  // Encontrou o artefato
        {
            $artefato = $artefato->row();
            $dados = array(
                'nomeArtefato'   => $artefato->nome,
                'arquivo'        => base_url('assets/modelos/' . $artefato->nomeArquivo),
                'complDesc'      => $artefato->complDesc,
                'latitude'       => $artefato->lat,
                'longitude'      => $artefato->lng,
                'pictures'       => $this->m_icone->getImages($id),
                'locDownload'    => 'assets/modelos/'.$artefato->nomeArquivo,
                'nomeArquivoDownload'    => $artefato->nomeArquivo,
                'designacao'  =>  $artefato->designacao,
                'procedencia'  => $artefato->procedencia,
                'dimensoes'  => $artefato->dimensoes,
                'material'  => $artefato->material
            );

            $dados['title'] = $dados['nomeArtefato'] . " - Iconoteca";
            $dados['paginaArtefato'] = TRUE;
            $dados['slides'] = $this->m_any->getImgs();

            $this->template->load('templates/default', 'artefato/artefato', $dados);
        }else{// Artefato inexistente 2
                redirect();
            }
    }

    public function visualizar($id){
        if(!isset($id)) redirect();
        //Procurar artefato na area de adicionar
        $artefatoAP = $this->m_any->get("aprovarArtefatos", null, null, null, null, null, "idArtefato", $id, "nome, nomeArquivo, complDesc, lat, lng, designacao, procedencia, dimensoes, material");
        if($artefatoAP->num_rows() > 0){

            $artefato = $artefatoAP->row();
            $dados = array(
                'nomeArtefato'   => $artefato->nome,
                'arquivo'        => base_url('assets/modelos/' . $artefato->nomeArquivo),
                'complDesc'      => $artefato->complDesc,
                'latitude'       => $artefato->lat,
                'longitude'      => $artefato->lng,
                'pictures'       => $this->m_icone->getImagesAprovar($id),
                'locDownload'    => 'assets/modelos/'.$artefato->nomeArquivo,
                'nomeArquivoDownload'    => $artefato->nomeArquivo,
                'designacao'  =>  $artefato->designacao,
                'procedencia'  => $artefato->procedencia,
                'dimensoes'  => $artefato->dimensoes,
                'material'  => $artefato->material
            );

            $dados['title'] = $dados['nomeArtefato'] . " - Iconoteca";
            $dados['paginaArtefato'] = TRUE;
            $dados['slides'] = $this->m_any->getImgs();

            $this->template->load('templates/default', 'artefato/artefato', $dados);
    }
}
    public function deletarImagens($imgs){
        if(!isset($imgs)) redirect('index.php/artefato/editar/');
        $i = 3; //parametro 3 começa o nome das imagens recebidas pela url
        $fotos = 1;
        while($fotos != null){ //percorendo a url
            $fotos = $this->uri->segment($i, null); //se nao tiver mais nenhum parametro retorna nulo e sai do laço
            $i++;
            $this->m_any->delImgs("$fotos");
        }
        echo "<script>history.go(-1)</script>";
    }

    //Função para realizar o download do artefato
    public function download($arq){
        $local = 'assets/modelos/'.$arq; //local dos arquivos
        force_download($local, null); // executando download no browser
    }
    // Abre a view da página de inserção de artefato
    public function adicionar()
    {
        if(!$this->checarLogado()) redirect();

        $dados['title'] = 'Adicionar artefato';
        $dados['categorias'] = $this->m_any->get("categorias", null, null, null, "nomeCategoria", "asc");
        $dados['paginaAddArtefato'] = TRUE;

        $this->template->load('templates/default', 'artefato/adicionar', $dados);
    }

    // Função de callback para validar a extensão do arquivo STL
    public function checa_arquivo_artefato()
    {
        // Pega a extensão do arquivo
        if($_FILES['arquivo']['name'] === '') return true;
        $extArq =  strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));
        return ($extArq === 'stl');
    }

    // Função de callback para validar a extensão do icone do artefato
    public function checa_arquivo_icone()
    {
        $extFig = strtolower(pathinfo($_FILES['icone']['name'], PATHINFO_EXTENSION));
        return ($extFig === 'png' || $extFig === 'jpg');
    }

    // Função de callback para validar as extensões das imagens
    public function checa_imagens()
    {
        if($_FILES['imagens']['name'][0] === '') return true;

        $numImagens = sizeof($_FILES['imagens']['name']);
        for($i = 0; $i < $numImagens; $i++)
        {
            $ext = strtolower(pathinfo($_FILES['imagens']['name'][$i], PATHINFO_EXTENSION));
            if($ext !== 'png' && $ext !== 'jpg') return false;
        }

        return true;
    }

    // Função para validar os dados do formulário e inserir o arquivo
    public function realizar_insert()
    {
        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'nome',
                'label' => 'nome do artefato',
                'rules' => 'required|min_length[8]|max_length[100]'
            ),
            array(
                'field' => 'designacao',
                'label' => 'designacao do artefato',
                'rules' => 'required|max_length[100]'
            ),
            array(
                'field' => 'material',
                'label' => 'material do artefato',
                'rules' => 'required|min_length[4]|max_length[100]'
            ),
            array(
                'field' => 'procedencia',
                'label' => 'material do artefato',
                'rules' => 'required|min_length[4]|max_length[100]'
            ),
            array(
                'field' => 'dimensoes',
                'label' => 'dimensoes do artefato',
                'rules' => 'required'
            ),
            array(
                'field' => 'categoria',
                'label' => 'categoria',
                'rules' => 'required'
            ),
            array(
                'field' => 'shortDesc',
                'label' => 'breve descrição do artefato',
                'rules' => 'required|max_length[140]'
            ),
            array(
                'field' => 'complDesc',
                'label' => 'descrição completa do artefato',
                'rules' => 'required|max_length[65536]'
            ),
            array(
                'field' => 'lat',
                'label' => 'latitude',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'lng',
                'label' => 'longitude',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'arquivo',
                'label' => 'arquivo do artefato',
                'rules' => 'callback_checa_arquivo_artefato'
            ),
            array(
                'field' => 'icone',
                'label' => 'icone do artefato',
                'rules' => 'callback_checa_arquivo_icone'
            ),
            array(
                'field' => 'imagens[]',
                'label' => 'imagens do artefato',
                'rules' => 'callback_checa_imagens'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('checa_arquivo_artefato', 'Modelo do artefato inválido. O arquivo deve ser <b>stl</b>.');
        $this->form_validation->set_message('checa_arquivo_icone', 'Ícone do artefato inválido. O arquivo deve ser <b>png</b> ou <b>jpg</b>.');
        $this->form_validation->set_message('checa_imagens', 'Imagens do artefato inválidas. As imagens devem ser <b>png</b> ou <b>jpg</b>.');
        $this->form_validation->set_message('min_length', 'O campo nome do artefato deve ter pelo menos 8 caracteres.');

        if($this->form_validation->run() == FALSE)
            $this->adicionar();
        else
        {
            $this->load->library('upload');

            if($_FILES['arquivo']['name'] !== ''){

                // Adiciona o arquivo stl à pasta assets/modelos
                $arquivo = $_FILES['arquivo'];
                $config['upload_path'] = 'assets/modelos';
                $config['allowed_types'] = 'stl|STL';
                $config['encrypt_name'] = TRUE;
                $config['file_ext_tolower'] = TRUE;

                $this->upload->initialize($config);
                $this->upload->do_upload('arquivo');

                if ( ! $this->upload->do_upload('arquivo'))
                {
                    $data= array('error' => $this->upload->display_errors());
                    echo $data['error'];
                    die();
                }

                $filedata    = $this->upload->data();
                $nomeArquivo = $filedata['file_name']; // Nome do artefato para adicionar ao DB
            }else{
                $nomeArquivo = "nulo";
            }

            // Adiciona o ícone à pasta assets/imagens/icones
            $icone  = $_FILES['icone'];
            $config['upload_path'] = "assets/imagens/icones";
            $config['allowed_types'] = "png|PNG|jpg|JPG";
            $config['encrypt_name'] = TRUE;
            $config['file_ext_tolower'] = TRUE;

            $this->upload->initialize($config, TRUE);
            $this->upload->do_upload('icone');

            $filedata   = $this->upload->data();
            $nomeIcone  = $filedata['file_name']; // Nome do icone para adicionar ao DB

            // Registra o artefato no DB
            $dados = array(
                "nome"        => $this->input->post('nome'),
                "categoria"   => $this->input->post('categoria'),
                "shortDesc"   => $this->input->post('shortDesc'),
                "complDesc"   => $this->input->post('complDesc'),
                "idOwner"     => $this->session->userdata('idUser'),
                "lat"         => $this->input->post('lat'),
                "lng"         => $this->input->post('lng'),
                "nomeArquivo" => $nomeArquivo,
                "icone"       => $nomeIcone,
                "designacao"  => $this->input->post('designacao'),
                "procedencia"  => $this->input->post('procedencia'),
                "dimensoes"  => $this->input->post('dimensoes'),
                "material"  => $this->input->post('material')

            );
            $this->m_any->store("aprovarArtefatos", $dados);

            // Registra as imagens no DB
            $config['upload_path']      = 'assets/imagens/artefatos';
            $config['allowed_types']    = "png|PNG|jpg|JPG";
            $config['file_ext_tolower'] = TRUE;
            $config['encrypt_name']     = TRUE;

            $dados = array();
            $dados['idIcone'] = $this->m_any->get("aprovarArtefatos", null, null, null, null, null, "nomeArquivo", $nomeArquivo, "idArtefato")->row()->idArtefato;
            echo $dados['idIcone'];
            $numImagens = count($_FILES['imagens']['name']);
            $imagens    = $_FILES['imagens'];
            if($_FILES['imagens']['name'][0] !== '')
            {
                for($i = 0; $i < $numImagens; $i++)
                {
                    $_FILES['imagem']['name']     = $imagens['name'][$i];
                    $_FILES['imagem']['type']     = $imagens['type'][$i];
                    $_FILES['imagem']['tmp_name'] = $imagens['tmp_name'][$i];
                    $_FILES['imagem']['error']    = $imagens['error'][$i];
                    $_FILES['imagem']['size']     = $imagens['size'][$i];

                    $this->upload->initialize($config, true);
                    $this->upload->do_upload('imagem');

                    $filedata = $this->upload->data();

                    $dados['nomeImagem'] = $filedata['file_name'];
                    $this->m_any->store("imagensAprovar", $dados);
                }
            }

            // Retorna para o painel
            redirect('index.php/conta');
        }
    }

    // Função de callback para validar a extensão do arquivo STL no método editar_run
    public function checa_arquivo_artefato_editar()
    {
        if($_FILES['arquivo']['name'] === '') return true;

        $extArq =  strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));
        return ($extArq === 'stl');
    }

    // Função de callback para validar a extensão do icone do artefato no método editar_run
    public function checa_arquivo_icone_editar()
    {
        if($_FILES['icone']['name'] === '') return true;

        $extFig = strtolower(pathinfo($_FILES['icone']['name'], PATHINFO_EXTENSION));
        return ($extFig === 'png' || $extFig === 'jpg');
    }

    public function checa_id_artefato()
    {
        $id = $this->input->post('idArtefato');
        $art = $this->m_any->get("artefatos", null, null, null, null, null, "idArtefato", $id, "idOwner")->row();

        $userID = $this->session->userdata('idUser');
        return $art->idOwner === $userID;
    }

    // Função para editar seus artefatos
    public function deletarArtefato($id_artefato = null){
        if(!$this->checarLogado()) redirect();
        $dados['title'] = 'Aprovar Artefatos';
        if(!isset($mensagem)) $dados['mensagem'] = "Aprovar artefatos";
        if($this->session->userdata('adm') != 1){
            redirect();
        }else{
            if($id_artefato)
            {
                $dados['title'] = 'Aprovar Artefatos';
                if(!isset($mensagem)) $dados['mensagem'] = "Artefato deletado com sucesso !";
                $this->m_any->deleteWhere("idArtefato", $id_artefato, "aprovarArtefatos");
                redirect('index.php/artefato/aprovarArtefato/');
            }
        }


    }

    public function aprovarArtefato($id_artefato = null, $mensagem = null){
        if(!$this->checarLogado()) redirect();
        $dados['title'] = 'Aprovar Artefatos';
        if(!isset($mensagem)) $dados['mensagem'] = "Aprovar artefatos";
        if($this->session->userdata('adm') != 1){
            redirect();
        }
        // Se $artefato != null, validar o id do artefato
        if($id_artefato)
        {
            $query = $this->m_any->get("aprovarArtefatos", null, null, null, null, null, "idArtefato", $id_artefato);
            if($query->num_rows() == 0)
            {
                $mensagem = "<h3 class=\"w3-text-red\"><b>Artefato inválido!</b></h3>";
                $this->editar(null, $mensagem);
            }
            // Caso contrário AQUI INSERE NA TABELA DEFINITIVA
            else
            {
                $dados['artefato'] = $this->m_any->get("aprovarArtefatos", null, null, null, null, null, "idArtefato", $id_artefato, "idArtefato,nome, categoria, shortDesc, complDesc, idOwner, icone, nomeArquivo, lat, lng, designacao, procedencia, dimensoes, material");
                $id = $this->m_any->getID()->row('id');
                $id += 1;
                $dadosArtefato = array(
                    "idArtefato"  => $id,
                    "nome"        => $dados['artefato']->row('nome'),
                    "categoria"   => $dados['artefato']->row('categoria'),
                    "shortDesc"   => $dados['artefato']->row('shortDesc'),
                    "complDesc"   => $dados['artefato']->row('complDesc'),
                    "idOwner"     => $dados['artefato']->row('idOwner'),
                    "lat"         => $dados['artefato']->row('lat'),
                    "lng"         => $dados['artefato']->row('lng'),
                    "nomeArquivo" => $dados['artefato']->row('nomeArquivo'),
                    "icone"       => $dados['artefato']->row('icone'),
                    "designacao"  => $dados['artefato']->row('designacao'),
                    "procedencia" => $dados['artefato']->row('procedencia'),
                    "dimensoes"   => $dados['artefato']->row('dimensoes'),
                    "material"    => $dados['artefato']->row('material')
                );

                $this->m_any->store("artefatos", $dadosArtefato); //armazenando dados do artefato na tabela definitiva
                //pegando imagens provisorias para aprovação
                $dados['imagensAp'] = $this->m_any->get("imagensAprovar", null, null, null, null, null, "idIcone", $id_artefato, "idIcone, nomeImagem");

                foreach ($dados['imagensAp']->result() as $row) {
                    $dadosImg = array(
                        "idIcone"      => $id,
                        "nomeImagem"   => $row->nomeImagem
                    );
                    $this->m_any->store("imagens", $dadosImg); //armazenando imagens na tabela definitiva
                    $this->m_any->deleteWhere("nomeImagem", $row->nomeImagem, "imagensAprovar"); //deletando imagens da tabela de aprovação
                }
                $this->m_any->deleteWhere("idArtefato", $dados['artefato']->row('idArtefato'), "aprovarArtefatos"); //deletando artefato da tabela provisoria

                $dados['mensagem'] = "<h3 class=\"w3-text-green\"><b>Artefato aprovado com sucesso !</b></h3>";
                $this->template->load('templates/default', 'artefato/aprovar', $dados);
            }
        }
        // Caso contrário, abrir a página de seleção de artefatos
        else
        {
            $dados['artefatos']  = $this->m_any->get("aprovarArtefatos", null, null, null, null, null);
            $this->template->load('templates/default', 'artefato/aprovar', $dados);
        }
    }




    public function editar($id_artefato = null, $mensagem = null)
    {
        if(!$this->checarLogado()) redirect();
        $dados['title'] = 'Editar artefatos';
        if($mensagem) $dados['mensagem'] = $mensagem;

        // Se $artefato != null, validar o id do artefato
        if($id_artefato)
        {
            // Valida se o icone pertence a este usuário
            // Caso não pertença, mostra uma mensagem de erro no painel
            $query = $this->m_any->get("artefatos", null, null, null, null, null, "idArtefato", $id_artefato, "idOwner");
            if($query->num_rows() == 0 || $query->row()->idOwner != $this->session->userdata('idUser'))
            {
                $mensagem = "<h3 class=\"w3-text-red\"><b>Artefato inválido!</b></h3>";
                $this->editar(null, $mensagem);
            }
            // Caso contrário, abre a view para editar o artefato $id_artefato
            else
            {
                $dados['artefato'] = $this->m_any->get("artefatos", null, null, null, null, null, "idArtefato", $id_artefato, "nome, categoria, shortDesc, complDesc, icone, nomeArquivo, lat, lng, designacao, procedencia, dimensoes, material")->row();
                $dados['categorias'] = $this->m_any->get("categorias", null, null, null, "nomeCategoria", "asc");
                $dados['imagens'] = $this->m_icone->getImages($id_artefato);
                $dados['idArtefato'] = $id_artefato;
                $dados['icone'] = $this->m_any->get("artefatos", null, null, null, null, null, "idArtefato", $id_artefato, "icone")->row();
                $dados['paginaEditArtefato'] = true;
                $this->template->load('templates/default', 'artefato/editar/editar_artefato', $dados);
            }
        }
        // Caso contrário, abrir a página de seleção de artefatos
        else
        {
            $dados['artefatos']  = $this->m_any->get("artefatos", null, null, null, null, null, "idOwner", $this->session->userdata('idUser'), "nome, idArtefato, icone");
            $this->template->load('templates/default', 'artefato/editar/escolher_artefato', $dados);
        }
    }

    public function editar_run()
    {
        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'nome',
                'label' => 'nome do artefato',
                'rules' => 'required|min_length[8]|max_length[100]'
            ),
            array(
                'field' => 'categoria',
                'label' => 'categoria',
                'rules' => 'required'
            ),
            array(
                'field' => 'designacao',
                'label' => 'designacao do artefato',
                'rules' => 'required|max_length[100]'
            ),
            array(
                'field' => 'material',
                'label' => 'material do artefato',
                'rules' => 'required|min_length[4]|max_length[100]'
            ),
            array(
                'field' => 'procedencia',
                'label' => 'material do artefato',
                'rules' => 'required|min_length[4]|max_length[100]'
            ),
            array(
                'field' => 'dimensoes',
                'label' => 'dimensoes do artefato',
                'rules' => 'required'
            ),
            array(
                'field' => 'shortDesc',
                'label' => 'breve descrição do artefato',
                'rules' => 'required|max_length[140]'
            ),
            array(
                'field' => 'complDesc',
                'label' => 'descrição completa do artefato',
                'rules' => 'required|max_length[65536]'
            ),
            array(
                'field' => 'lat',
                'label' => 'latitude',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'lng',
                'label' => 'longitude',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'arquivo',
                'label' => 'arquivo do artefato',
                'rules' => 'callback_checa_arquivo_artefato_editar'
            ),
            array(
                'field' => 'icone',
                'label' => 'icone do artefato',
                'rules' => 'callback_checa_arquivo_icone_editar'
            ),
            array(
                'field' => 'imagens[]',
                'label' => 'imagens do artefato',
                'rules' => 'callback_checa_imagens'
            ),
            array(
                'field' => 'idArtefato',
                'label' => 'ID do artefato',
                'rules' => 'required|numeric|callback_checa_id_artefato'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('checa_arquivo_artefato_editar', 'Modelo do artefato inválido. O arquivo deve ser <b>stl</b>.');
        $this->form_validation->set_message('checa_arquivo_icone_editar', 'Ícone do artefato inválido. O arquivo deve ser <b>png</b> ou <b>jpg</b>.');
        $this->form_validation->set_message('checa_imagens', 'Imagens do artefato inválidas. As imagens devem ser <b>png</b> ou <b>jpg</b>.');
        $this->form_validation->set_message('checa_id_artefato', 'ID do artefato inválido.');
        $this->form_validation->set_message('min_length', 'O campo nome do artefato deve ter pelo menos 8 caracteres.');

        if($this->form_validation->run() == FALSE)
        $this->adicionar();
        else
        {
            $id_artefato = $this->input->post('idArtefato');
            $art = $this->m_any->get("artefatos", null, null, null, null, null, "idArtefato", $id_artefato, "nomeArquivo, icone")->row();
            $nomeArquivo = $art->nomeArquivo;
            $nomeIcone = $art->icone;

            $this->load->library('upload');

            // Checa se foi selecionado um arquivo stl. Caso tenha sido, exclui o atual e adiciona o novo arquivo stl à pasta assets/modelos
            if($_FILES['arquivo']['name'] !== '')
            {
                // Exclui o arquivo atual
                unlink(FCPATH . "assets/modelos/" . $nomeArquivo);

                // Adiciona o novo arquivo
                $arquivo = $_FILES['arquivo'];
                $config['upload_path'] = './assets/modelos';
                $config['allowed_types'] = 'stl|STL';
                $config['encrypt_name'] = TRUE;
                $config['file_ext_tolower'] = TRUE;

                $this->upload->initialize($config);
                $this->upload->do_upload('arquivo');

                $filedata    = $this->upload->data();
                $nomeArquivo = $filedata['file_name']; // Nome do novo artefato para adicionar ao DB
            }

            if($_FILES['icone']['name'] !== '')
            {
                // Exclui o icone atual
                unlink(FCPATH . "assets/imagens/icones/" . $nomeIcone);

                // Adiciona o novo ícone à pasta assets/imagens/icones
                $icone  = $_FILES['icone'];
                $config['upload_path'] = "./assets/imagens/icones";
                $config['allowed_types'] = "png|PNG|jpg|JPG";
                $config['encrypt_name'] = TRUE;
                $config['file_ext_tolower'] = TRUE;

                $this->upload->initialize($config, TRUE);
                $this->upload->do_upload('icone');

                $filedata   = $this->upload->data();
                $nomeIcone  = $filedata['file_name']; // Nome do novo icone para adicionar ao DB
            }

            // Atualiza os dados do artefato no DB
            $dados = array(
                "nome"        => $this->input->post('nome'),
                "categoria"   => $this->input->post('categoria'),
                "shortDesc"   => $this->input->post('shortDesc'),
                "complDesc"   => $this->input->post('complDesc'),
                "lat"         => $this->input->post('lat'),
                "lng"         => $this->input->post('lng'),
                "nomeArquivo" => $nomeArquivo,
                "icone"       => $nomeIcone,
                "designacao"  => $this->input->post('designacao'),
                "procedencia"  => $this->input->post('procedencia'),
                "dimensoes"  => $this->input->post('dimensoes'),
                "material"  => $this->input->post('material')
            );

            // $this->m_any->store("artefatos", $dados);
            $this->m_any->mudarCampo('artefatos', 'idArtefato', $id_artefato, $dados);

            // Exclui as imagens selecionadas
            $imgs_artefato = $this->m_icone->getImages($id_artefato);
            $i = 0;

            foreach ($imgs_artefato->result() as $pic)
            {
                if($this->input->post('img' . $i++) === 'true')
                {
                    // Exclui a imagem
                    unlink(FCPATH . "assets/imagens/artefatos/" . $pic->nomeImagem);

                    // Exclui o registro da imagem
                    $this->m_any->deleteWhere("nomeImagem", $pic->nomeImagem, "imagens");
                }
            }

            // Registra as novas imagens no DB
            $config['upload_path']      = './assets/imagens/artefatos';
            $config['allowed_types']    = "png|PNG|jpg|JPG";
            $config['file_ext_tolower'] = TRUE;
            $config['encrypt_name']     = TRUE;

            $dados = array();
            $dados['idIcone'] = $id_artefato;

            if($_FILES['imagens']['name'][0] !== '')
            {
                $numImagens = count($_FILES['imagens']['name']);
                $imagens    = $_FILES['imagens'];

                for($i = 0; $i < $numImagens; $i++)
                {
                    $_FILES['imagem']['name']     = $imagens['name'][$i];
                    $_FILES['imagem']['type']     = $imagens['type'][$i];
                    $_FILES['imagem']['tmp_name'] = $imagens['tmp_name'][$i];
                    $_FILES['imagem']['error']    = $imagens['error'][$i];
                    $_FILES['imagem']['size']     = $imagens['size'][$i];

                    $this->upload->initialize($config, true);
                    $this->upload->do_upload('imagem');

                    $filedata = $this->upload->data();

                    $dados['nomeImagem'] = $filedata['file_name'];
                    $this->m_any->store("imagens", $dados);
                }
            }

            // Retorna para o painel
            redirect('conta');
        }
    }

    // Função utilizada para checar se o usário está logado
    public function checarLogado()
    {
        return $this->session->has_userdata('logado');
    }
}
