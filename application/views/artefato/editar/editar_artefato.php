<div class="w3-container">
    <!-- Título da página -->
    <div class="w3-row">
        <h1><b>Editar artefato</b></h1>
    </div>

    <!-- Requisitos do formulário -->
    <div class="w3-row w3-margin w3-card-4">
        <ul class="w3-ul w3-border w3-white">
            <li class="w3-green"><h2>Requisitos</h2></li>
            <li>O formulário segue as mesmas regras da inserção dos artefatos.</li>
            <li>Caso não queira alterar o arquivo STL ou o ícone do artefato, deixe os campos em branco.</li>
            <li>Caso deseja manter a mesma localização da origem do artefato, não mova o marcador e deixe o campo em branco.</li>
            <li>Selecione as imagens do artefato que deseja excluir, clicando nelas.</li>
        </ul>
    </div>

    <!-- Erros do formulário -->
    <div class="w3-row">
        <div class="w3-container">
            <?php echo validation_errors("<p class='mensagem-erro'>", "</p>"); ?>
        </div>
    </div>

    <!-- Formulário para editar o artefato -->
    <div class="w3-row">
        <div id="formEditArtefato">
            <?= form_open_multipart('index.php/artefato/editar_run', array('class' => 'w3-container w3-margin-bottom w3-padding')) ?>

            <!-- Nome -->
            <div class="w3-row w3-section">
                <input class="w3-input w3-border" style="width: 55vw" name="nome" type="text" placeholder="Nome do artefato" maxlength="100" value="<?= $artefato->nome ?>" autofocus required>
            </div>
            <!-- Designacao -->
            <div class="w3-row w3-section">
                <input class="w3-input w3-border" style="width: 55vw" name="designacao" type="text" placeholder="Designação do artefato" maxlength="100" value="<?= $artefato->designacao ?>" autofocus required>
            </div>
            <!--  procedencia-->
            <div class="w3-row w3-section">
                <input class="w3-input w3-border" style="width: 55vw" name="procedencia" type="text" placeholder="Procedencia do artefato" maxlength="100" value="<?= $artefato->procedencia ?>" autofocus required>
            </div>
            <!--Material  -->
            <div class="w3-row w3-section">
                <input class="w3-input w3-border" style="width: 55vw" name="material" type="text" placeholder="Material do artefato (ex: Pedra)" maxlength="100" value="<?= $artefato->material ?>" autofocus required>
            </div>

            <!--  ALtura e largura-->
            <div class="w3-row w3-section">
                <input class="w3-input w3-border" style="width: 55vw" name="dimensoes" type="text" placeholder="Dimensões do artefato (largura X altura X espessura) ex: (5 X 10 X 3)" maxlength="100" value="<?= $artefato->dimensoes ?>" autofocus required>
            </div>

            <div class="w3-row w3-section">
                <input class="w3-input w3-border" style="width: 55vw" name="acervo" type="text" placeholder="Digite sobre o acervo do artefato" maxlength="100" value="<?= $artefato->acervo ?>" autofocus required>
            </div>
            <!-- Categoria -->
            <div class="w3-row w3-section">
                <select class="w3-select w3-white w3-border" name="categoria" style="width: 55vw">
                <?php foreach ($categorias->result() as $c) { ?>
                    <option value="<?= $c->nomeURL ?>" <?php if($artefato->categoria == $c->nomeURL) echo "selected"; ?> > <?= $c->nomeCategoria ?> </option>
                <?php } ?>
                </select>
            </div>

            <!-- Arquivo STL -->
            <div class="w3-row w3-section">
                <input type="file" id="inputArquivo" name="arquivo">
            </div>

            <!-- Icone do artefato -->
            <div class="w3-row w3-section">
                <input type="file" id="inputIcone" name="icone">
            </div>

            <div class="w3-row w3-section">
                <input type="file" id="inputFotos" name="imagens[]" multiple>
            </div>


            <!-- Imagens atuais do artefato -->
            <div class="w3-row w3-section">
        <?php
                $cont = 0;
                $i = 0;
                foreach ($imagens->result() as $pic) {
                    if($cont == 0) {
        ?>
                    <div class="w3-row w3-margin-top">
        <?php       } ?>
                        <div class="w3-third">
                            <div class="w3-card">
                                <img id="<?= $i ?>" src="<?= base_url('assets/imagens/artefatos/' . $pic->nomeImagem)?>" onclick="img('<?php echo $pic->nomeImagem; ?>', '<?= $i ?>')"  alt="<?= $pic->nomeImagem ?>" class="w3-image w3-hover-sepia" style="cursor:pointer">
                            </div>
                            <input type="hidden" id="img<?= $i ?>" name="img<?= $i++ ?>" value="false">
                        </div>
        <?php
                    if(++$cont == 3 || $i == $imagens->num_rows()) {
                        $cont = 0;
        ?>
                    </div>

        <?php       } ?>
        <?php   } ?>
            </div>


            <!-- Novas imagens do artefato -->


            <div class="w3-panel w3-green">
              <div class="">
                  <h5>Atenção !</h5>
                  <p>Selecione as imagens que deseja remover, logo após confirme a remoção.</p>
                  <p>Após remover as imagens essa alteração não podera ser desfeita !</p>
                  <button onclick="deletarImagens();" type="button" class="w3-button w3-margin-top w3-margin-bottom w3-small w3-block w3-red">Remover</button>
             </div>
            </div>


            <!-- Descrição do artefato no portfólio -->
            <div class="w3-row w3-section">
                <textarea name="shortDesc" placeholder="Escreva uma breve descrição do artefato. Até 140 caracteres." maxlength="140" rows="2" style="width: 100%" required><?= $artefato->shortDesc ?></textarea>
            </div>

            <!-- Descrição do artefato -->
            <div class="w3-row w3-section">
                <textarea name="complDesc" id="editor" required>
                    <?= $artefato->complDesc ?>
                </textarea>
            </div>

            <!-- Entrada do endereço do mapa -->
            <div class="w3-row w3-section">
                <div class="w3-threequarter">
                    <input class="w3-input w3-border" id="endereco" name="endereco" type="text" placeholder="Digite o endereço de origem do artefato, ou mova o marcador para o local">
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
            <input type="hidden" id="lat" name="lat" value="<?= $artefato->lat ?>" required>
            <input type="hidden" id="lng" name="lng" value="<?= $artefato->lng ?>" required>
            <input type="hidden" name="idArtefato" value="<?= $idArtefato ?>" required>

            <!-- Submit -->
            <div class="w3-row w3-section">
                <button type="submit" class="w3-button w3-green w3-xxlarge w3-border-black w3-block w3-padding-large">Enviar</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    var imagens = [];
    function img(nomeImagen, idElemento){
        //alert(nomeImagen);
        //alert(idElemento);
        if($('#'+idElemento).hasClass('w3-opacity-max')){
            $('#'+idElemento).removeClass('w3-opacity-max');
            for (var i = 0; i < imagens.length; i++) {
                if(imagens[i] == nomeImagen){
                    imagens.splice(i, 1);
                }
            }
        }else{
            $('#'+idElemento).addClass('w3-opacity-max');
            imagens.push(nomeImagen);
            for (var i = 0; i < imagens.length; i++) {
                console.log(imagens[i]);
            }
        }
    }
    function deletarImagens(){
        //alert($('#btnDel').val());
        var url = 'deletarimagens';
        if(imagens.length < 1){
            return;
        }
        for (var i = 0; i < imagens.length; i++) {
            url = url + "/" + imagens[i];
        }
        window.location.href = '../../../' + url;

    }
</script>
