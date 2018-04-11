<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Iconoteca</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?= link_tag('assets/css/w3.css') ?>
    <?= link_tag('assets/css/style.css') ?>

<?php if(isset($paginaAddArtefato) || isset($paginaEditArtefato)) { ?>
    <!-- jQuery filestyle -->
    <?= link_tag('assets/css/jquery-filestyle.min.css') ?>

    <!-- CKEditor -->
    <script src="<?= base_url('assets/js/ckeditor/ckeditor.js') ?>"></script>
    <script src="<?= base_url('assets/js/ckeditor/sample.js') ?>"></script>
<?php } ?>

<?php if((isset($paginaHome) && $paginaHome) || (isset($paginaAddArtefato) && $paginaAddArtefato) || isset($paginaEditArtefato)) { ?>
    <link href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.css" rel="stylesheet"/>
<?php } ?>

    <link rel="icon" href="<?= base_url('assets/iconeUPF.ico') ?>" type="image/x-icon" />
</head>
<body class="w3-light-grey w3-content" style="max-width:1600px" id="top">
    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-collapse w3-white" style="z-index:3;width:300px;" id="mySidebar"><br>
        <div class="w3-container">
            <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
                <i class="fa fa-remove"></i>
            </a>
            <a href="<?= base_url() ?>">
                <img src="<?= base_url('assets/logoUPF.png') ?>" style="width:75%;" class="w3-round"><br><br>
            </a>
            <h4><b>ICONOTECA</b></h4>
        </div>
        <div class="w3-bar-block">
            <a href="<?php if(!isset($link)) echo base_url(); ?>#portfolio" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-large fa-fw w3-margin-right"></i>PORTFOLIO</a>
            <a href="<?php if(!isset($link)) echo base_url(); ?>#about" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-globe fa-fw w3-margin-right"></i>SOBRE</a>
            <a href="<?php if(!isset($link)) echo base_url(); ?>#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>CONTATO</a>

        <?php if(!$this->session->has_userdata('logado')) { ?>
            <a href="<?php if(!isset($link)) echo base_url('index.php/login'); ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user-circle-o fa-fw w3-margin-right"></i>LOGIN</a>
        <?php } else { ?>
        <?php  if($this->session->userdata('adm') == 1) {?>
            <a href="<?php if(!isset($link)) echo base_url('index.php/usuario/admin'); ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cogs fa-fw w3-margin-right"></i>ADMNISTRAÇÃO</a>
        <?php } ?>
            <a href="<?php if(!isset($link)) echo base_url('index.php/conta'); ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user-circle fa-fw w3-margin-right"></i>MINHA CONTA</a>
            <a href="<?php if(!isset($link)) echo base_url('index.php/logout'); ?>" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-sign-out fa-fw w3-margin-right"></i>LOGOUT</a>
        <?php } ?>

            <button onclick="myFunction('parceiros')" class="w3-bar-item w3-button w3-padding"><i class="fa fa-wrench fa-fw w3-margin-right"></i>MANTENEDORES</button>
            <div id="parceiros" class="w3-container w3-hide">
                <a href="<?php if(!isset($link)) echo base_url('index.php/mantenedores/fabricasoft'); ?>" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-wrench fa-fw w3-margin-right"></i>FABRICA DE SOFTWARE</a>
                <a href="<?php if(!isset($link)) echo base_url('index.php/mantenedores/ppgh'); ?>" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-wrench fa-fw w3-margin-right"></i>PPGH</a>
                <a href="<?php if(!isset($link)) echo base_url('index.php/mantenedores/nupha'); ?>" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-wrench fa-fw w3-margin-right"></i>NUPAH</a>
                <a href="<?php if(!isset($link)) echo base_url('index.php/mantenedores/nupha'); ?>" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-wrench fa-fw w3-margin-right"></i>LACUMA</a>
            </div>

        </div>
    </nav>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main" style="margin-left:300px">
        <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
        <div id="content">
            <?= $contents ?>
        </div>

        <!-- Footer -->
        <footer class="w3-container w3-padding-32 w3-dark-grey">
            <div class="w3-row-padding">
                <div class="w3-third">
                    <h3>FOOTER</h3>
                    <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
                    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
                </div>

                <div class="w3-third">
                    <h3>BLOG POSTS</h3>
                    <ul class="w3-ul w3-hoverable">
                        <li class="w3-padding-16">
                            <span class="w3-large">Lorem</span><br>
                            <span>Sed mattis nunc</span>
                        </li>
                        <li class="w3-padding-16">
                            <span class="w3-large">Ipsum</span><br>
                            <span>Praes tinci sed</span>
                        </li>
                    </ul>
                </div>

                <div class="w3-third">
                    <h3>POPULAR TAGS</h3>
                    <p>
                        <span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">London</span>
                        <span class="w3-tag w3-grey w3-small w3-margin-bottom">IKEA</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">NORWAY</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">DIY</span>
                        <span class="w3-tag w3-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Baby</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Family</span>
                        <span class="w3-tag w3-grey w3-small w3-margin-bottom">News</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Clothing</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Shopping</span>
                        <span class="w3-tag w3-grey w3-small w3-margin-bottom">Sports</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Games</span>
                    </p>
                </div>

            </div>
        </footer>

        <div class="w3-black w3-center w3-padding-24">Desenvolvido por <a href="http://www.upf.br/" title="W3.CSS" target="_blank" class="w3-hover-opacity">UPF</a></div>

    <!-- End page content -->
    </div>

    <script>
        // Script to open and close sidebar
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("myOverlay").style.display = "block";
        }

        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("myOverlay").style.display = "none";
        }
    </script>
    <script src="<?= base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>

<?php if(isset($paginaArtefato) && $paginaArtefato) { ?>
    <!-- Script da animação do loading do Artefato -->
    <script src="https://cdn.jsdelivr.net/gh/heartcode/CanvasLoader@0.9.1/js/heartcode-canvasloader-min.js"></script>

    <!-- Scrips para renderizar e interagir com o artefato -->

    <script src="<?= base_url('assets/js/three.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/TrackballControls.js') ?>"></script>
    <script src="<?= base_url('assets/js/STLLoader.js') ?>"></script>

    <!-- Google Maps -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQYtYj4WuMuVmqJ7jZqVqihwFdkIAMqrU&amp"></script>

    <!-- Inicia o Three.js e o Google Maps -->
    <script src="<?= base_url('assets/js/artefato.js') ?>"></script>
    <?php if ($nomeArquivoDownload == "nulo"){ ?>
        <script> startApp('nulo', <?= $latitude ?>, <?= $longitude ?>); </script>
    <?php }else{ ?>
        <script> startApp("<?= $arquivo ?>", <?= $latitude ?>, <?= $longitude ?>); </script>
    <?php } ?>
    <!-- Modal das imagens do artefato -->
    <script>
        function onClick(element)
        {
            document.getElementById("img01").src = element.src;
            document.getElementById("modal01").style.display = "block";
        }
    </script>
<?php } ?>
<?php if (isset($paginaHome) && $paginaHome) { ?>
    <!-- Autocomplete do campo de busca do Home -->
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            var obj = <?= $nomes ?>;
            var arr = [];
            for(var x in obj) arr.push(obj[x].nome);

            $("#termoBusca").autocomplete({
                source: arr,
                position: { my : "right top", at: "right bottom" }
            });
        });
    </script>
<?php } ?>

<?php if(isset($paginaAddArtefato) || isset($paginaEditArtefato)) { ?>
    <!-- Scripts usados para adicionar um artefato -->
    <!-- Configurações dos input file -->
    <script src="<?= base_url('assets/js/jquery-filestyle.min.js') ?>"></script>
    <script>
        $('#inputArquivo').jfilestyle({
            text: 'Selecionar arquivo STL',
            placeholder: 'Selecione o arquivo STL(Deixe em branco caso nao tenha)<?php if(isset($paginaEditArtefato)) echo " (deixe em branco caso deseja manter o mesmo)"; ?>',
            dragdrop: false,
            theme: 'green',
            inputSize: '55vw'
        });

        $('#inputIcone').jfilestyle({
            text: 'Selecionar ícone',
            placeholder: 'Selecione o ícone do artefato <?php if(isset($paginaEditArtefato)) echo " (deixe em branco caso deseja manter o mesmo)"; ?>',
            dragdrop: true,
            theme: 'green',
            inputSize: '55vw'
        });

        $('#inputFotos').jfilestyle({
            text: 'Selecionar imagens',
            placeholder: '<?php if(!isset($paginaEditArtefato)) { ?>Selecione as imagens do artefato (opcional)<?php } else { ?>Selecioen as imagens que deseja adicionar (opcional)<?php } ?>',
            dragdrop: true,
            theme: 'green',
            inputSize: '55vw'
        });
    </script>

    <!-- Inicia o CKEditor -->
    <script>
        initEditor();
    </script>

    <!-- Inicia o mapa -->
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQYtYj4WuMuVmqJ7jZqVqihwFdkIAMqrU&amp"></script>
    <script src="<?= base_url('assets/js/mapaFormulario.js') ?>"></script>
<?php } ?>

<?php if(isset($paginaEditArtefato)) { ?>
<script>
    function onClick(element)
    {
        var id = "#" + element.id, img = "img" + element.id;
        var pic = document.getElementById(img);

        $(id).toggleClass("w3-opacity-max");
        (pic.value == "false") ? pic.value = "true" : pic.value = "false";
    }
</script>
<?php } ?>

<script>
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
</body>
</html>
