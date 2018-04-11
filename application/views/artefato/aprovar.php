<div class="w3-container">
    <!-- Título da página -->
    <div class="w3-row">
        <h1><b>Aprovar Artefatos</b></h1>
    </div>

    <?php if(isset($mensagem)): ?>
        <div class="w3-row">
            <?= $mensagem ?>
        </div>
    <?php endif; ?>
    <?php if(isset($artefatos)){ ?>
    <?php if($artefatos->num_rows() == 0) { ?>
        <div class="w3-row">
            <h3>Nenhum artefato para ser aprovado !</h3>
        </div>
    <?php } else { ?>
        <div class="w3-row">
            <h3>Selecione um artefato</h3>
        </div>

        <div class="w3-responsive">
            <table class="w3-table-all">
                <thead>
                    <tr class="w3-black">
                        <th>Artefato</th>
                        <th>Nome</th>
                        <th class="w3-center">Visualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($artefatos->result() as $ar): ?>
                    <tr>
                        <td class="w3-left">
                            <img src="<?= base_url('assets/imagens/icones/'.$ar->icone)?>" style="width: 100px; height: 100px;">
                        </td>

                        <td><h3 style="padding-top: 22px;"><?= $ar->nome ?></h3></td>
                        <td>
                            <div style="padding-top: 27px;">
                            <?= anchor(base_url("index.php/artefato/visualizar/$ar->idArtefato"), "<i class='fa fa-search-plus fa-2x'></i>", array('class' => "w3-button w3-blue w3-hover-std-blue w3-block w3-small")) ?>
                            </div>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

    <?php } ?>
<?php } ?>
</div>
