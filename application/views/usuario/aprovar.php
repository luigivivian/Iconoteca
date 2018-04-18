<div class="w3-container">
    <!-- Título da página -->
    <div class="w3-row">
        <h1><b>Aprovar Usuarios</b></h1>
    </div>

    <?php if(isset($mensagem)): ?>
        <div class="w3-row">
            <?= $mensagem ?>
        </div>
    <?php endif; ?>
    <?php if(isset($usuarios)){ ?>
    <?php if($usuarios->num_rows() == 0) { ?>
        <div class="w3-row">
            <h3>Nenhum usuario para ser aprovado !</h3>
        </div>
    <?php } else { ?>
        <div class="w3-row">
            <h3>Selecione um usuario</h3>
        </div>
<!--            card testes-->
             <div class="w3-row w3-margin-left">
                <?php
                    $cont = 0;
                    foreach($usuarios->result() as $user):
                        $cont++;
                        if($cont > 3) {
                            $cont = 0;
                            echo '<div class="w3-margin-top w3-row" style="margin-top: 5px;"> <br></div >';
                        }
                ?>
                <div class="w3-card-4 w3-dark-grey w3-margin-left w3-margin-bottom" style="width:31%; float: left;">
                    <div class="w3-container w3-center ">
                        <h3><?=$user->nome?> <?=$user->sobrenome?></h3>
                        <img src="../../assets/imagens/mantenedores/user1.png" alt="Avatar" style="width:80%">
                            <h5><?=$user->areaAtuacao?></h5>
                        <div class="w3-section">
                            <?= anchor(base_url("index.php/usuario/visualizarUsuario/$user->idUser"), "<i class='fa fa-search-plus fa-2x'></i>", array('class' => "w3-button w3-blue w3-hover-std-blue w3-block w3-small")) ?>

                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
<!--           Fim card -->

    <?php } ?>
<?php } ?>
</div>
