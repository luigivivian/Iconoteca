
<!-- Latest compiled and minified CSS -->
<!-- Optional theme -->
<!-- Latest compiled and minified JavaScript -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>


<div class="">
    <h2>Area exclusiva para testes de implementações / retornos de funções</h2>
        <span id="success_message"></span>
        <?= form_open('index.php/artefato/teste2', array('class' => "w3-container", 'id' => "programmer_form"))  ?>
            <div class="form-group">
                <label>Digite suas habilidades</label>
                <input type="text" name="tags" id="tags" class="form-control" />
            </div>
            <div class="form-group">
                <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
            </div>
        <?= form_close() ?>
    <?php if(isset($foi)){?>
        <div>
            <h3><?= $foi ?></h3>
        </div>
    <?php }?>

</div>


<script>
    $(document).ready(function(){
        //autocomplete
        $('#tags').tokenfield({
            autocomplete:{
                source: ['PHP','Codeigniter','HTML','JQuery','Javascript','CSS','Laravel','CakePHP','Symfony','Yii 2','Phalcon','Zend','Slim','FuelPHP','PHPixie','Mysql'],
                delay:50
            },
            showAutocompleteOnFocus: true
        });
    });
</script>