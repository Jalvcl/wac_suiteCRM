<!-- Modal -->
<?php
/*** Modal multipropósito. Se puede parametrizar para registro y para login (esa era la idea, pero se usa por separado porque son muy distintos
    los forms por ahora.) ***/
$usage = 'signup';
?>
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="<?php echo $text[$lang]['modal']['signup']['label']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="<?php echo $text[$lang]['modal']['signup']['label']; ?>"><?php echo $text[$lang]['modal'][$usage]['title']; ?></h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-primary">
                    <div class="panel-heading"><?php echo $text[$lang]['modal'][$usage]['panelhead']; ?></div>
                    <div class="panel-body">
                        <p><?php echo $text[$lang]['modal'][$usage]['paneltext']; ?></p>
                        <?php include('include/registrationform.php'); ?>
                    </div>
                    
                </div>
                
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $text[$lang]['modal'][$usage]['close']; ?></button>
            </div> -->
        </div>
    </div>
</div>
<?php $usage = 'login'; ?>
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="<?php echo $text[$lang]['modal']['signup']['label']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="<?php echo $text[$lang]['modal']['signup']['label']; ?>"><?php echo $text[$lang]['modal'][$usage]['title']; ?></h4>
            </div>
<!-- this can be a good place to include the alerts -->

            <div class="modal-body">
                <div class="panel panel-primary">
                    <div class="panel-heading"><?php echo $text[$lang]['modal'][$usage]['panelhead']; ?></div>
                    <div class="panel-body">
                        
                        <?php 
                            if($_SESSION['recuperarlogin_view'] == 1){

                                // accion de recuperar login
                                $usage = 'retrievelogin';
                                echo '<p>'.$text[$lang]['modal'][$usage]['title'].'</p>';
                                include('include/recuperarloginForm.php');
                            
                            }elseif($_SESSION['recuperarlogin_view'] == 2){

                                $usage = 'enterkey';
                                echo '<p>'.$text[$lang]['modal'][$usage]['title'].'</p>';
                                include('include/recuperarloginAviso.php');
                            
                            }elseif($_SESSION['recuperarlogin_view'] == 3){

                                // se envio enlace por email con hash para que recupere la contraseña
                                $usage = 'changepass';
                                echo '<p>'.$text[$lang]['modal'][$usage]['title'].'</p>';
                                include('include/nuevopassform.php');
                            
                            }else{

                                echo '<p>'.$text[$lang]['modal'][$usage]['title'].'</p>';
                                include('include/loginform.php'); 
                            
                            }
                        ?>
                    </div>
                    
                </div>
                
            </div>
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $text[$lang]['modal'][$usage]['close']; ?></button>
            </div>-->
        </div>
    </div>
</div>

