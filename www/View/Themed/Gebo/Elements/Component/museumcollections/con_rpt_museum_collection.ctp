<?php
echo $this->Html->css(array(
    'jquery-ui-1.8.4.custom',
));

//echo $this->Html->script(array(
//    'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
//    'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js',
//));

$cbunny = array(
    'APP_PATH' => Router::url('/', true)
);
echo $this->Html->scriptBlock('var CbunnyObj = ' . $this->Javascript->object($cbunny) . ';');
?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">

                <div class="row-fluid">

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width:91px;text-align:right;">ชื่อพิพิธภัณฑ์ : </td>
                                <td>                                    
                                    
<!--                                    <select name="selMuseum"  data-placeholder="" class="chzn_a input-xlarge" style="width:380px;" >
                                        <?php foreach ($Museums as $key => $Museum) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $Museum; ?></option>
                                        <?php } ?>
                                    </select>--> 
                                    
                                    <select name="selMuseum"  data-placeholder="" class="chzn_a input-xlarge" style="width:380px;" >
                                        <?php foreach ($Museums as $Museum) { ?>
                                            <option value="<?php echo $Museum['MuseumCollection']['mc_museum']; ?>"><?php echo $Museum['MuseumCollection']['mc_museum']; ?></option>
                                        <?php } ?>
                                    </select>
                                    
                                    <?php
//                                echo $this->Ajax->autoComplete_ui('txtMuseum', array(
//                                    'source' => array(
//                                        'controller' => 'MuseumCollections',
//                                        'action' => 'autoComplete',
//                                    ),
//                                ));
//                                ?>
                                    
                                </td>
                            </tr>                                                  
                        </tbody>
                    </table>	
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function modalAction2() {
        var museumName = $("select[name='selMuseum").val();
        
        window.open("../../MuseumCollections/printMuseumCollectionReport/"+museumName,"_blank");
    }
</script>
