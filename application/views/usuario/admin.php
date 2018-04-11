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
        <a href="<?= base_url('index.php/usuario/aprovarUsuarios'); ?>" class="w3-button w3-green w3-block w3-hover-border-color">Aprovar Usuarios</a>
    </div>
    </div>
  </div>
  <div class="w3-third w3-container">
  </div>
