<div class="w3-row">
    <div class="w3-col" style="width:12%"><br></div>
    <div class="w3-container w3-threequarter w3-border w3-padding-32 w3-margin-top w3-white">
        <div class="w3-row w3-center">
            <h1><b>Área Administrativa</b></h1>
        </div>

    <?php if(isset($mensagem)): ?>
        <div class="w3-row">
            <div class="w3-container w3-center">
                <?= $mensagem ?>
            </div>
        </div>
    <?php endif; ?>
    </div>
    <div class="w3-col" style="width:12%"><br></div>
</div>


<div class="w3-row w3-margin-top w3-center">
  <div class="w3-third w3-container">
  </div>
  <div class="w3-third w3-container">
    <div>
        <a href="<?= base_url('index.php/artefato/aprovarArtefato'); ?>" class="w3-button w3-green w3-block w3-hover-border-color">Aprovar Artefatos</a>
    </div>
    <div class="w3-margin-top">
        <a onclick="document.getElementById('cadInst').style.display='block'" class="w3-button w3-green w3-block w3-hover-border-color">Gerenciar instituições</a>

            <div id="cadInst" class="w3-modal">
                <div class="w3-modal-content">
                    <header class="w3-container w3-green">
                        <span onclick="document.getElementById('cadInst').style.display='none'"
                        class="w3-button w3-display-topright">&times;</span>
                        <h2>Selecione uma instituição !</h2>
                    </header>
                    <div class="w3-container">
                        <div id="formDelInst">
                            <?= form_open('index.php/usuario/delInst', array('class' => "w3-container"))  ?>
                                <div class="w3-row w3-section">
                                    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-graduation-cap"></i></div>
                                    <div class="w3-rest">
                                        <select class="w3-select" name="inst">
                                            <option value="" disabled selected>Selecione uma instituição !</option>
                                            <?php foreach ($universidades->result() as $v): ?>
                                                <option value="<?php echo $v->nome; ?>" ><?php echo $v->nome; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <button class="w3-button w3-block w3-red w3-section w3-padding" type="submit">Deletar</button>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="w3-third w3-container">
  </div>
</div>
