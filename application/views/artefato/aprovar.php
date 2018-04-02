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
                        <th>Nome</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($artefatos->result() as $ar): ?>
                    <tr>
                        <td><?= $ar->nome ?></td>
                        <td>
                            <?= anchor(base_url("index.php/artefato/$ar->idArtefato"), "Vizualizar", array('class' => "w3-button w3-blue w3-hover-std-blue w3-block w3-small")) ?>
                        </td>
                        <td>
                            <?= anchor(base_url("index.php/artefato/aprovarArtefato/$ar->idArtefato"), "Aprovar", array('class' => "w3-button w3-green w3-hover-std-green w3-block w3-small")) ?>
                        </td>
                        <td>
                            <?= anchor(base_url("index.php/artefato/deletarArtefato/$ar->idArtefato"), "Deletar", array('class' => "w3-button w3-red w3-hover-std-green w3-block w3-small")) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
<?php } ?>
</div>
