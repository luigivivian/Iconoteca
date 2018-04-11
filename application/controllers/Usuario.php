<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller
{
    // Index do controller Usuário
    public function index($mensagem = null)
    {
        $dados['title'] = "Área de login";
        if($mensagem) $dados['mensagem'] = $mensagem;
        $this->template->load('templates/default', 'usuario/login', $dados);
    }

    // Realizar o login
    public function login()
    {
        // Dados do formulário
        $email = $this->input->post('email');
        $senha    = md5($this->input->post('senha'));
        $query = $this->m_user->validarDados($email, $senha);

        if($query->num_rows() > 0)
        {
            $mensagem = null;
            if($query->row()->statusConta == 0)
            {
                $this->m_any->mudarCampo('usuarios', 'email', $email, array('statusConta' => "1"));
                $mensagem = "<h3 class=\"w3-text-green\"><b>Conta reativada!</b></h2>";
            }
            $varSession = array(
				'nome'      => $query->row()->nome,
                'sobrenome' => $query->row()->sobrenome,
				'email'     => $query->row()->email,
				'idUser'	=> $query->row()->idUser,
                'adm'       => $query->row()->adm,
				'logado' 	=> TRUE
			);
			$this->session->set_userdata($varSession);
			$this->conta($mensagem);
        }
        else
        {
            $mensagem = "<h4 class=\"w3-text-red\"><b>Nome de usuário ou senha incorretos!</b></h4>";
            $this->index($mensagem);
        }
    }

    public function admin(){
        if(!$this->checarLogado()) redirect();
        $dados['title'] = 'Painel Administrativo';
        if(!isset($mensagem)) $dados['mensagem'] = "Escolha as opções abaixo !";
        if($this->session->userdata('adm') != 1){
            redirect();
        }else{
            $dados['universidades'] = $this->m_any->getInst();
            $this->template->load('templates/default', 'usuario/admin', $dados);
        }
    }
    public function delInst(){
        if(!$this->checarLogado()) redirect();
        if($this->session->userdata('adm') != 1){
            redirect();
        }else{
            $this->load->library('form_validation');
            $rules = array(
                array(
                    'field' => 'inst',
                    'label' => 'instituicao',
                    'rules' => 'required'
                )
            );
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_message('required', 'Selecione uma instituição !');

            if($this->input->post('inst') == ""){
                redirect('index.php/usuario/admin', 'refresh');
            }else{
                $variable = $this->m_any->getInstCod($this->input->post('inst')); //pegando valor da lista
                $valor = $variable->result(); //pegando o valor retornado do banco de dados

                $dados['codInstituicao'] = $valor[0]->idInstituicao;

                $dados['mensagem'] = "Instituição deletada com sucesso !";
                $this->m_any->deleteWhere("idInstituicao", $dados['codInstituicao'], "instituicoes");
                //$this->template->load('templates/default', 'usuario/admin', $dados);
                redirect('index.php/usuario/admin', 'refresh');
            }
        }
    }

    public function aprovarUsuarios($id_usuario = null, $mensagem = null){
        if(!$this->checarLogado()) redirect();
        $dados['title'] = '';
        if(!isset($mensagem)) $dados['mensagem'] = "";
        if($this->session->userdata('adm') != 1){
            redirect();
        }

        if($id_usuario){ //aprovar usuario
            //pegando dados da tabela provisoria
            $query = $this->m_any->get("aprovarUsuarios", null, null, null, null, null, "idUser", $id_usuario, "*");

            //dados para inserir na tabela fixa
            $dadosU['nome']             = $query->row('nome');
            $dadosU['sobrenome']        = $query->row('sobrenome');
            $dadosU['email']            = $query->row('email');
            $dadosU['senha']            = $query->row('senha');
            $dadosU['areaAtuacao']      = $query->row('areaAtuacao');
            $dadosU['breveCurriculo']   = $query->row('bCurriculo');
            $dadosU['codInstituicao']   = $query->row('codInstituicao');
            $dadosU['adm']   = 0;

            $this->m_any->store('usuarios', $dadosU); //armazenando dados do
            $this->m_any->deleteWhere('idUser', $id_usuario, 'aprovarUsuarios'); //deletando usuario da tabela provisoria
            $dados['mensagem'] = "Usuario aprovado com sucesso !";
            $this->template->load('templates/default', 'usuario/aprovar', $dados);

        }else{  //pagina para listar usuarios
            $dados['usuarios'] = $this->m_any->get("aprovarUsuarios", null, null, null, null, null);
            $this->template->load('templates/default', 'usuario/aprovar', $dados);
        }

    }
    public function deletarUsuario($id_user = null){
        if(!$this->checarLogado()) redirect();
        $dados['title'] = '';
        if(!isset($mensagem)) $dados['mensagem'] = "";
        if($this->session->userdata('adm') != 1){
            redirect();
        }
        if($id_user){
            $dados['mensagem'] = "Usuario deletado com sucesso !";
            $this->m_any->deleteWhere('idUser', $id_user, 'aprovarUsuarios');
            $this->template->load('templates/default', 'usuario/aprovar', $dados);
        }else{

        }
    }
    public function visualizarUsuario($id_usuario = null)
    {
        if(!$this->checarLogado()) redirect();
        $dados['title'] = 'Aprovar Artefatos';
        if(!isset($mensagem)) $dados['mensagem'] = "Aprovar artefatos";
        if($this->session->userdata('adm') != 1){
            redirect();
        }
        if($id_usuario){ //aprovar usuario
            $dados['instUser'] = $this->m_any->getInstAluno($id_usuario);
            $dados['usuario'] =$this->m_any->get("aprovarUsuarios", null, null, null, null, null, "idUser", $id_usuario, null);
            $this->template->load('templates/default', 'usuario/visualizar', $dados);
        }else{  //pagina para listar usuarios
            $dados['usuarios'] = $this->m_any->get("aprovarUsuarios", null, null, null, null, null);
            $this->template->load('templates/default', 'usuario/aprovar', $dados);
        }
    }

    // Realizar o logout
    public function logout()
    {
        $varSession = array('nome', 'sobrenome', 'email', 'idUser', 'logado');
    	$this->session->unset_userdata($varSession);
    	redirect();
    }

    // Cadastrar novos usuários
    public function cadastro()
    {
        $dados['title'] = "Cadastrar usuário";
        $dados['universidades'] = $this->m_any->getInst();
        $this->template->load('templates/default', 'usuario/cadastro', $dados);
    }

    public function efetuar_cadastro_inst()
    {
        $this->load->library('form_validation');
        $rules = array(
            array(
                'field' => 'nome',
                'label' => 'nome',
                'rules' => 'required|max_length[40]'
            ),
            array(
                'field' => 'cidade',
                'label' => 'cidade',
                'rules' => 'required|max_length[80]'
            ),
            array(
                'field' => 'pais',
                'label' => 'pais',
                'rules' => 'required|max_length[80]'
            ),
            array(
                'field' => 'estado',
                'label' => 'estado',
                'rules' => 'required|max_length[30]'
            ),

        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('min_length', 'O campo deve ter pelo menos 8 caracteres.');

        if($this->form_validation->run() == FALSE)
            $this->cadastro();
        else
        {
            $dados['nome']       = $this->input->post('nome');
            $dados['cidade']  = $this->input->post('cidade');
            $dados['estado']      = $this->input->post('estado');
            $dados['pais']      = $this->input->post('pais');

            $this->m_any->store('instituicoes', $dados);

            $msg = "<h2 class=\"w3-text-green\"><b>Cadastro de instituição realizado com sucesso !</b></h2>";
            $dados['mensagem'] = $msg;
            $dados['title'] = "Cadastrar usuário";
            $dados['universidades'] = $this->m_any->getInst();
            $this->template->load('templates/default', 'usuario/cadastro', $dados);
            redirect('index.php/cadastro', 'refresh');
        }
    }

    // Validar e realizar o cadastro
    public function efetuar_cadastro()
    {
        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'nome',
                'label' => 'nome',
                'rules' => 'required|max_length[20]'
            ),
            array(
                'field' => 'sobrenome',
                'label' => 'sobrenome',
                'rules' => 'required|max_length[80]'
            ),
            array(
                'field' => 'email',
                'label' => 'e-mail',
                'rules' => 'required|valid_email|is_unique[usuarios.email]|max_length[80]'
            ),
            array(
                'field' => 'senha',
                'label' => 'senha',
                'rules' => 'required|min_length[8]'
            ),
            array(
                'field' => 'confSenha',
                'label' => 'confirmação de senha',
                'rules' => 'required|matches[senha]'
            ),
            array(
                'field' => 'areaAtuacao',
                'label' => 'Área de atuação',
                'rules' => 'required|min_length[4]'
            ),
            array(
                'field' => 'bCurriculo',
                'label' => 'Breve curriculo',
                'rules' => 'required|min_length[4]'
            ),
            array(
                'field' => 'instituicao',
                'label' => 'instituicao',
                'rules' => 'required'
            ),
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('min_length', 'O campo senha deve ter pelo menos 8 caracteres.');
        $this->form_validation->set_message('matches', 'Senha e confirmação de senha diferentes.');

        if($this->form_validation->run() == FALSE)
            $this->cadastro();
        else
        {
            $dados['nome']       = $this->input->post('nome');
            $dados['sobrenome']  = $this->input->post('sobrenome');
            $dados['email']      = $this->input->post('email');
            $dados['senha']      = md5($this->input->post('senha'));
            $dados['areaAtuacao']      = $this->input->post('areaAtuacao');
            $dados['breveCurriculo']      = $this->input->post('bCurriculo');

            $variable = $this->m_any->getInstCod($this->input->post('instituicao')); //pegando valor da lista
            $valor = $variable->result(); //pegando o valor retornado do banco de dados

            $dados['codInstituicao'] = $valor[0]->idInstituicao;

            $this->m_any->store('aprovarUsuarios', $dados); //armazenando dados do cadastro do usuario

            $mensagem = "<h2 class=\"w3-text-green\"><b>Cadastro realizado com sucesso, efetue o login !</b></h2>";
            $dados['mensagem'] = $mensagem; //msg para view
            $this->template->load('templates/default', 'usuario/login', $dados); //carregando view
        }
    }

    // Acessar o painel do usuário
    public function conta($mensagem = null, $form_error = false)
    {
        if(!$this->checarLogado()) redirect();

        $dados['title']      = "Minha conta";
        $dados['artefatos']  = $this->m_any->get("artefatos", null, null, null, "dataAdicionado", "desc", "idOwner", $this->session->userdata('idUser'), "nome, categoria");
        $dados['form_error'] = $form_error;

        if($mensagem) $dados['mensagem'] = $mensagem;

        $this->template->load('templates/default', 'usuario/painel', $dados);
    }
    //função para recupração de senha
    public function recuperarSenha(){

        $email = $this->input->post('email');
        $this->load->library('email');
        $this->email->from('iconotecaUPF@upf.br', 'UPF-Iconoteca');
        $this->email->to($email);
        $this->email->subject('Recuperação de senha');

        //Metodo utilizado para gerar uma senha aleatoria com numeros e letras
        $letras = range('A', 'Z');
        $numeros = range(1, 100);
        $chaveRecuperacao = "";
        $criptoLetras = 1;
        $criptoNumeros = 1;

        for ($i=0; $i < 2; $i++) {
            for ($j=0; $j < 2; $j++) {
                $criptoNumeros = rand(1, 99);
                $criptoLetras = rand(1, 25);
                $chaveRecuperacao = $chaveRecuperacao . '' . $letras[$criptoLetras]. '' . $numeros[$criptoNumeros];
            }
        }
        $query = $this->m_user->validarEmail($email);
        // /echo "Chave:  $chaveRecuperacao";

        if($query->num_rows() > 0)
        {
            $mensagem = null;
            if($query->row()->email == $email)
            {
                $senhaNova = md5($chaveRecuperacao);
                $this->m_any->mudarCampo('usuarios', 'email', $email, array('senha' => "$senhaNova"));
                $mensagem = "<h3 class=\"w3-text-green w3-center\"><b>Falta apenas mais uma etapa !</b></h3><h2 class=\"w3-text-red w3-center\"><b>Acesse seu email para confirmar a recuperação!</b></h2>
                        <h4 class=\"w3-text-red w3-center\"><b>Verifique a caixa de spam !</b></h4>
                        <h5 class=\"w3-text-red w3-center\"><b>$email</b></h5>";
            }else{
                $mensagem = "<h2 class=\"w3-text-red w3-center\"><b>Email invalido, utilize seu email cadastrado !</b></h2>";

            }

        $this->email->message("==================Iconoteca==================
            \nAtenção ! Esta senha NÃO É SEGURA
            \nEfetue o login utilizando esses dados
            \nApós efetuar o login utilize o painel do usuario para alterar seus dados
            \n###########Dados###########
            \nEmail: $email
            \nSenha: $chaveRecuperacao
            \n###########################
            \n============================================
");
         $result = $this->email->send();
    }else{
        $mensagem = "<h2 class=\"w3-text-red w3-center\"><b>Email invalido, utilize seu email cadastrado !</b></h2>";
    }
    $this->index($mensagem);
}

    // Desativa a conta do usuário
    public function desativar_conta()
    {
            $email = $this->session->userdata('email');
            $senha    = md5($this->input->post('senha'));

            // Caso a senha esteja correta, desativa a conta
            if($this->m_user->validarDados($email, $senha)->num_rows() > 0)
            {
                // Desativa a conta
                $this->m_any->mudarCampo('usuarios', 'idUser', $this->session->userdata('idUser'), array('statusConta' => '0'));

                // Termina a sessão
                $this->logout();
            }
            else
            {
                $mensagem = "<h3 class=\"w3-text-red\"><b>Senha inválida!</b> Não foi possível desativar sua conta.</h3>";
                $this->conta($mensagem);
            }
    }

    // Função de callback para validar a senha antiga passada na alteração de senha
    public function checa_senha($senha)
    {
        $email = $this->session->userdata('email');
        $senha    = md5($senha);
        return ($this->m_user->validarDados($email, $senha)->num_rows() > 0);
    }

    // Altera a senha do usuário
    public function alterar_senha()
    {
        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'senha_antiga',
                'label' => 'senha antiga',
                'rules' => 'required|min_length[8]|callback_checa_senha'
            ),
            array(
                'field' => 'senha_nova',
                'label' => 'nova senha',
                'rules' => 'required|min_length[8]'
            ),
            array(
                'field' => 'conf_senha_nova',
                'label' => 'confirmação de senha',
                'rules' => 'required|matches[senha_nova]'
            ),
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('min_length', 'O campo senha deve ter pelo menos 8 caracteres.');
        $this->form_validation->set_message('matches', 'Senha e confirmação de senha diferentes.');
        $this->form_validation->set_message('checa_senha', 'Senha antiga incorreta.');

        if($this->form_validation->run() == FALSE)
            $this->conta(null, true);
        else
        {
            // Realiza a alteração
            $email  = $this->session->userdata('email');
            $senhaNova = md5($this->input->post('senha_nova'));
            $this->m_any->mudarCampo('usuarios', 'email', $email, array('senha' => $senhaNova));

            // Recarrega a página
            $mensagem = "<h3 class=\"w3-text-green\"><b>Senha alterada com sucesso!</b></h3>";
            $this->conta($mensagem);
        }
    }

    // Altera o e-mail do usuário
    public function alterar_email()
    {
        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'email',
                'label' => 'e-mail',
                'rules' => 'required|valid_email|is_unique[usuarios.email]|max_length[80]'
            ),
            array(
                'field' => 'senha',
                'label' => 'senha',
                'rules' => 'required|min_length[8]|callback_checa_senha'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('checa_senha', 'Senha incorreta.');

        //
        if($this->form_validation->run() == FALSE)
            $this->conta(null, true);
        else
        {
            $email    = $this->input->post('email');

            $this->m_any->mudarCampo('usuarios', 'email', $email, array('email' => $email));
            $this->session->set_userdata('email', $email);

            // Recarrega a página
            $mensagem = "<h3 class=\"w3-text-green\"><b>E-mail alterado com sucesso!</b></h3>";
            $this->conta($mensagem);
        }
    }

    // Função utilizada para checar se o usário está logado
    public function checarLogado()
    {
        return $this->session->has_userdata('logado');
    }
}
