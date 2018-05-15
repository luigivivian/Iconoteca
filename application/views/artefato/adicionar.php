<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">


<div class="w3-container">
    <!-- Título da página -->
    <div class="w3-row">
        <h1><b>Adicionar artefato</b></h1>
    </div>

    <!-- Requisitos do formulário -->
    <div class="w3-row w3-margin w3-card-4">
        <ul class="w3-ul w3-border w3-white">
            <li class="w3-green"><h2>Requisitos</h2></li>
            <li>Todos os campos, com exceção das imagens do artefato, são <b>obrigatórios.</b></li>
            <li>O arquivo do modelo do artefato <b>DEVE</b> ser <b><span class="w3-text-green">STL</span></b>.</li>
            <li>O arquivo STL deve ter no <b>MÁXIMO</b> <span class="w3-text-green">50 MB</span></li>
            <li>Não será possível alterar o arquivo STL depois.</li>
            <li>As imagens, tanto do ícone quanto do artefato, <b>DEVEM</b> ser <b><span class="w3-text-green">PNG</span></b> ou <b><span class="w3-text-green">JPG</span></b>.</li>
            <li>As imagens, tanto do ícone quanto do artefato, <b>DEVEM</b> ser <b><span class="w3-text-green">700x400</span></b> (ou proporcional).</li>
            <li>Você deve informar o endereço de origem do artefato. Caso não seja possível, mova o marcador para o local.</li>
        </ul>
    </div>

    <!-- Erros do formulário -->
    <div class="w3-row">
        <div class="w3-container">
            <?php echo validation_errors("<p class='mensagem-erro'>", "</p>"); ?>
        </div>
    </div>

    <!-- Formulário para adicionar artefatos -->
    <div class="w3-row">
        <div id="formAddArtefato">
            <?= form_open_multipart('index.php/artefato/realizar_insert', array('class' => 'w3-container w3-margin-bottom w3-padding')) ?>

            <!-- Nome -->
            <div class="w3-row w3-section">
                <input class="w3-input w3-border" style="width: 55vw" name="nome" type="text" placeholder="Nome do artefato" maxlength="100" value="<?= set_value('nome') ?>" autofocus required>
            </div>
            <!-- Designacao -->
            <div class="w3-row w3-section">
                <input class="w3-input w3-border" style="width: 55vw" name="designacao" type="text" placeholder="Designação do artefato" maxlength="100" value="<?= set_value('designacao') ?>" autofocus required>
            </div>
            <!--  procedencia-->
            <div class="w3-row w3-section">
                <input class="w3-input w3-border" style="width: 55vw" name="procedencia" type="text" placeholder="Procedencia do artefato" maxlength="100" value="<?= set_value('procedencia') ?>" autofocus required>
            </div>
            <!--Material  -->
            <div class="w3-row w3-section">
                <input class="w3-input w3-border" style="width: 55vw" name="material" type="text" placeholder="Material do artefato (ex: Pedra)" maxlength="100" value="<?= set_value('material') ?>" autofocus required>
            </div>

            <!--  ALtura ,largura e largura-->
            <div class="w3-row w3-section">
                <input class="w3-input w3-border" style="width: 55vw" name="dimensoes" type="text" placeholder="Dimensões do artefato (largura X altura X espessura) ex: (5 X 10 X 3)" maxlength="100" value="<?= set_value('dimensoes') ?>" autofocus required>
            </div>
<!--           acervo -->
            <div class="w3-row w3-section">
                <input class="w3-input w3-border" style="width: 55vw" name="acervo" type="text" placeholder="Digite sobre o acervo do artefato" maxlength="100" value="<?= set_value('acervo') ?>" autofocus required>
            </div>

            <div class="w3-row w3-section">
                <!-- Categoria -->
                <select class="w3-select w3-white w3-border" name="categoria" style="width: 55vw">
                <?php foreach ($categorias->result() as $c) { ?>
                    <option value="<?= $c->nomeURL ?>"> <?= $c->nomeCategoria ?> </option>
                <?php } ?>
                </select>
            </div>

            <div class="w3-row w3-section">
                <!-- Arquivo STL -->
                <input type="file" id="inputArquivo" name="arquivo">
            </div>

            <div class="w3-row w3-section">
                <!-- Icone do artefato -->
                <input type="file" id="inputIcone" name="icone" required>
            </div>

            <!-- Imagens do artefato -->
            <div class="w3-row w3-section">
                <input type="file" id="inputFotos" name="imagens[]" multiple>
            </div>

            <div class="w3-row w3-section">
                <input type="file" id="inputAnexos" name="anexos[]" multiple>
            </div>

            <!--           TAGS -->
            <div class="w3-row w3-section">
                <input class="w3-input w3-border" name="tags" id="tags" style="width: 55vw" type="text" placeholder="Digite uma tag" maxlength="100" value="<?= set_value('tags') ?>" autofocus required>
            </div>

            <!-- Descrição do artefato no portfólio -->
            <div class="w3-row w3-section">
                <textarea name="shortDesc" placeholder="Escreva uma breve descrição do artefato. Até 140 caracteres." maxlength="140" rows="2" style="width: 100%" required></textarea>
            </div>

            <!-- Descrição do artefato -->
            <div class="w3-row w3-section">
                <textarea name="complDesc" id="editor" required>
                    <p>Escreva a descrição completa do artefato.</p>
                </textarea>
            </div>


            <!-- Entrada do endereço do mapa -->
            <div class="w3-row w3-section">
                <div class="w3-threequarter">
                    <input class="w3-input w3-border" id="endereco" name="endereco" type="text" placeholder="Digite o endereço de origem do artefato, ou mova o marcador para o local" required>
                </div>

                <div class="w3-quarter">
                    <input type="button" id="btnEndereco" name="btnEndereco" value="Mostrar no mapa" class="w3-button w3-block w3-green w3-border"/>
                </div>
            </div>

            <!-- Mapa -->
            <div class="w3-row w3-section">
                <div id="mapa" style="height:350px" class="w3-white"></div>
            </div>

            <!-- Valores necessários para a inserção, iniciado com valores aleatórios -->
            <input type="hidden" id="lat" name="lat" value="-28.2587812" required>
            <input type="hidden" id="lng" name="lng" value="-52.416003899999964" required>

            <!-- Submit -->
            <div class="w3-row w3-section">
                <button type="submit" class="w3-button w3-green w3-xxlarge w3-border-black w3-block w3-padding-large">Enviar</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        //autocomplete
        var tags = [''];
        getTags();
        function getTags() {
            $.ajax({
                type: 'ajax',
                url: '<?php echo base_url('index.php/Artefato/getTags')?>',
                async: false,
                dataType: 'JSON',
                success: function (data) {
                    var i;
                    for (i = 0; i < data.length; i++) {
                        tags[i] = data[i]['nome'];
                    }
                }
            });
        }

        $.noConflict();
        $('#tags').tokenfield({
            autocomplete:{
                source: tags,
                delay:50
            },
            showAutocompleteOnFocus: true
        });
    });
</script>