<style>
.container {
    position: relative;
    width: 50%;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.container:hover .image {
  opacity: 0.3;
}

.container:hover .middle {
  opacity: 1;
}

.text {
  background-color: #4CAF50;
  color: white;
  font-size: 16px;
  padding: 16px 32px;
}
</style>

<div class="w3-container">
    <!-- Nome do artefato -->
    <div class="w3-row">
        <h1><b><?= $nomeArtefato ?></b></h1>
    </div>

    <!-- Renderização do artefato -->
    <?php if($nomeArquivoDownload == "nulo"){ ?>
        <?php if($pictures->num_rows() > 0) { ?>
            <div class="">
                <div class="w3-display-middlew3-margin-bottom">
                    <h2>Modelo 3d indisponivel</h2>
                </div>
                <div class="w3-margin-top w3-margin-bottom w3-display-container" style="width: 100%;">
                    <div class="w3-display-container">
                        <?php foreach ($pictures->result() as $pic): ?>
                            <div class="mySlides">
                                <img src="<?= base_url('assets/imagens/artefatos/' .$pic->nomeImagem)?>" style="width:100%; height: 550px; ">
                            </div>
                        <?php endforeach; ?>
                        <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-middle" style="width:100%">
                            <div class="w3-button w3-display-left" onclick="plusDivs2(-1)">&#10094;</div>
                            <div class="w3-button w3-display-right" onclick="plusDivs2(1)">&#10095;</div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="artefato" style="visibility: hidden; display: none;">
            </div>
        <?php }else{ ?>
            <div class="mySlides">
            </div>
        <?php } ?>
    <?php }else{ ?>
        <div class="w3-row w3-margin-top">
            <div class="w3-rest">
                <div class="loading-container">
                    <div id="artefato">
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- Fullscreen do artefato -->
    <div class="w3-row w3-margin-top">
        <div class="w3-center">
            <h5 class="w3-opacity">Pressione 'f' para expandir/fechar</h5>
            <h5 class="w3-opacity">Use o mouse para girar o objeto</h5>
            <h5 class="w3-opacity">Use a rolagem do mouse para controlar o zoom</h5>
            <!-- alinhando botao de download no centro -->
            <div class="w3-row">
                <!-- div fantasma -->
                <div class="w3-col s4"><p></p></div>
                <!-- botao  -->
                <?php if($nomeArquivoDownload == "nulo"){ ?>
                    <div class="w3-col s4"><a class="w3-button w3-disabled w3-block w3-teal">Baixar modelo 3D</a></div>
                <?php }else{ ?>
                    <div class="w3-col s4"><a class="w3-button w3-block w3-teal" href="<?= base_url('index.php/artefato/download/'.$nomeArquivoDownload)?>">Baixar modelo 3D</a></div>
                <?php } ?>
                <!--div fantasma  -->
                <div class="w3-col s4"><p></p></div>
            </div>

        </div>
    </div>

    <!-- Descrição completa do artefato -->




    <div class="w3-row w3-margin-top">
        <?= $complDesc ?>
    </div>
    <div class="w3-row w3-margin-top">
        <h4>Designação: <?php echo $designacao ?></h4>
        <h4>Procedência: <?php echo $procedencia ?></h4>
        <h4>Dimensões: <?php echo $dimensoes ?> CM</h4>
        <h4>Material: <?php echo $material ?></h4>
    </div>

    <!--  Slides imagens-->
    <?php if($pictures->num_rows() > 0) { ?>
        <?php if($nomeArquivoDownload == 'nulo'){ ?>
            <div>
            </div>
        <?php }else{ ?>
            <div class="w3-margin-bottom">
                <h2>Imagens</h2>
            </div>
            <div class="w3-margin-top w3-margin-bottom ">
                <div class="w3-display-container">
                    <?php foreach ($pictures->result() as $pic): ?>
                        <div class="mySlides">
                            <img src="<?= base_url('assets/imagens/artefatos/' .$pic->nomeImagem)?>" style="width:100%; height: 550px; ">
                        </div>
                    <?php endforeach; ?>
                    <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-middle" style="width:100%">
                        <div class="w3-button w3-display-left" onclick="plusDivs2(-1)">&#10094;</div>
                        <div class="w3-button w3-display-right" onclick="plusDivs2(1)">&#10095;</div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php }else{ ?>
        <div class="mySlides">

        </div>

    <?php } ?>


    <!-- Origem do artefato -->
    <div class="w3-row w3-margin-top w3-margin-bottom">
        <h2>Origem do artefato</h2>
        <div id="map">
            <!-- Here goes the map -->
        </div>
    </div>

    <?php if(isset($aprovar) && $aprovar == TRUE){ ?>
        <div class="w3-row w3-margin-top w3-margin-bottom">
            <div class="w3-margin-top w3-col s6">
                <button onclick="document.getElementById('aprovarMod').style.display='block'" class="w3-button w3-green w3-hover-std-green w3-block w3-xxlarge">Aprovar</button>
                <!-- <?= anchor(base_url("index.php/artefato/aprovarArtefato/$id"), "Aprovar", array('class' => "w3-button w3-green w3-hover-std-green w3-block w3-xxlarge")) ?> -->
            </div>
            <div class="w3-margin-top w3-col s6">
                <button onclick="document.getElementById('excluirMod').style.display='block'" class="w3-button w3-red w3-hover-std-green w3-block w3-xxlarge">Excluir</button>
                <!-- <?= anchor(base_url("index.php/artefato/deletarArtefato/$id"), "Deletar", array('class' => "w3-button w3-red w3-hover-std-green w3-block w3-xxlarge")) ?> -->
            </div>
        </div>
        <div id="excluirMod" class="w3-modal">
            <div class="w3-modal-content">
                <header class="w3-container w3-red">
                    <span onclick="document.getElementById('excluirMod').style.display='none'"
                    class="w3-button w3-display-topright">&times;</span>
                    <h2>Deseja realmente excluir esse artefato ?</h2>
                    <h4>Atenção: Essa operação não podera ser desfeita</h4>
                </header>
                <div class="w3-container">
                    <div class="w3-row w3-margin-bottom w3-margin-top">
                        <div class="w3-col s6">
                            <?= anchor(base_url("index.php/artefato/deletarArtefato/$id"), "Confirmar Exclusão", array('class' => "w3-button w3-green w3-hover-std-green w3-block w3-xxlarge")) ?>
                        </div>
                        <div class="w3-col s6">
                            <button onclick="document.getElementById('excluirMod').style.display='none'" class="w3-button w3-red w3-hover-std-green w3-block w3-xxlarge">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="aprovarMod" class="w3-modal">
            <div class="w3-modal-content">
                <header class="w3-container w3-green">
                    <span onclick="document.getElementById('aprovarMod').style.display='none'"
                    class="w3-button w3-display-topright">&times;</span>
                    <h2>Deseja realmente aprovar esse artefato ?</h2>
                </header>
                <div class="w3-container">
                    <div class="w3-row w3-margin-bottom w3-margin-top">
                        <div class="w3-col s6">
                            <?= anchor(base_url("index.php/artefato/aprovarArtefato/$id"), "Confirmar Aprovação", array('class' => "w3-button w3-green w3-hover-std-green w3-block w3-xxlarge")) ?>
                        </div>
                        <div class="w3-col s6">
                            <button onclick="document.getElementById('aprovarMod').style.display='none'" class="w3-button w3-red w3-hover-std-green w3-block w3-xxlarge">Cancelar</button>
                        </div>
                </div>
            </div>
        </div>

    <?php } ?>

    <?php if(!isset($aprovar) || $aprovar == FALSE){ ?>
    <div class="w3-container w3-border w3-border-grey w3-margin-top w3-margin-bottom w3-white w3-leftbar w3-rightbar w3-topbar w3-bottombar">

        <div class="w3-margin-top w3-margin-bottom w3-display-container" id="outrosArtefatos">
            <div class="textOutrosArtefatos w3-margin-top">
                <h2 class="w3-center">Outros artefatos</h2>
            </div>
            <?php foreach ($slides->result() as $slide): ?>
                <div class="w3-row slides w3-margin-top">
                    <div class="w3-col s6 container">
                            <img src="<?= base_url('assets/imagens/icones/'.$slide->icone)?>" style="width: 100%; height: 450px;"class="image fotosArtefatos">
                            <div class="middle">
                              <a class="w3-button w3-green" href="<?= base_url('index.php/artefato/'.$slide->idArtefato); ?>"><i class="fa fa-eye fa-fw"></i>Ver artefato</a>
                            </div>
                    </div>
                    <div class="w3-col s6 w3-margin-top">
                        <!--  Div da descricao-->
                        <div class="w3-row w3-margin-top">

                            <div class="w3-col s1"><p></p></div>

                            <div class="w3-col s10">
                                <div class="fotosArtefatos">
                                    <h2><?= $slide->nome?></h2>
                                    <h3><?= $slide->categoria?></h3>
                                    <h4><?= $slide->shortDesc?></h4>

                                    <h4>Designação: <?php echo $slide->designacao ?></h4>
                                    <h4>Procedência: <?php echo $slide->procedencia ?></h4>
                                    <h4>Dimensões: <?php echo $slide->dimensoes ?> CM</h4>
                                    <h4>Material: <?php echo $slide->material ?></h4>
                                </div>
                            </div>
                            <div class="w3-col s1"><p></p></div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

            <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
            <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>

        </div>
    </div>

<?php }else{ ?>
    <div class="w3-margin-top w3-margin-bottom w3-display-container" id="fantstamOutrosArtefatos">
            <div class="w3-row slides w3-margin-top">
            </div>
<?php } ?>

    <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
        <span class="w3-button w3-red w3-hover-std-red w3-xlarge w3-display-topright">&times;</span>
        <div class="w3-modal-content w3-animate-zoom">
            <img id="img01" style="width:100%">
        </div>
    </div>
</div>

<script>
//Slide outros artefatos
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("slides");
    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    x[slideIndex-1].style.display = "block";
}

//Slides imagens do artefato
var slideIndex = 1;
showDivs2(slideIndex);

function plusDivs2(n) {
    showDivs2(slideIndex += n);
}


function showDivs2(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    x[slideIndex-1].style.display = "block";
}

</script>
