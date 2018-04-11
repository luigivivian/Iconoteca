<div class="w3-container">
    <!-- Título da página -->
    <div class="w3-row">
        <h1><b>Editar artefatos</b></h1>
    </div>

    <?php if(isset($mensagem)): ?>
        <div class="w3-row">
            <?= $mensagem ?>
        </div>
    <?php endif; ?>

<?php if($artefatos->num_rows() == 0) { ?>
    <div class="w3-row">
        <h3>Você não possui nenhum artefato</h3>
    </div>
<?php } else { ?>
    <div class="w3-row">
        <h3>Selecione um artefato</h3>
    </div>

    <div class="w3-responsive">
        <table class="w3-table-all">
            <thead>
                <tr class="w3-black">
                    <th class="w3-left w3-margin-left">Artefatos</th>
                    <th class="w3-left"></th>
                    <th class="w3-center">Visualizar</th>
                    <th class="w3-center">Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($artefatos->result() as $ar): ?>
                <tr>
                    <td class="w3-left">
                        <img src="<?= base_url('assets/imagens/icones/'.$ar->icone)?>" style="width: 100px; height: 100px;">
                    </td>
                    <td class="w3-left">
                        <h3 style="padding-top: 22px;">
                            <?= $ar->nome ?>
                        </h3>
                    </td>

                    <td>
                        <div style="padding-top: 27px;">
                            <?= anchor(base_url("index.php/artefato/$ar->idArtefato"), "<i class='fa fa-search-plus fa-2x'></i>", array('class' => "w3-button w3-green w3-hover-std-green w3-block w3-medium")) ?>
                        </div>

                    </td>
                    <td>
                        <div style="padding-top: 27px;">
                            <?php
                                if($this->uri->segment(4) == null){
                                    $pag = 1;
                                }else{
                                    $pag = $this->uri->segment(4);
                                }
                             ?>
                            <?= anchor(base_url("index.php/artefato/editar/p/".$pag."/$ar->idArtefato"), "<i class='fa fa-edit fa-2x'></i>", array('class' => "w3-button w3-blue w3-hover-std-blue w3-block w3-medium")) ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="w3-center w3-padding-32">
        <div class="w3-bar w3-border w3-large">
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>


<?php } ?>
</div>
