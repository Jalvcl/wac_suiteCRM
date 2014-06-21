<?php 
/***** alerts php
 * this contains the alert boxes that will appear in each event
 *****/ 
?>
<div class="container">
    <div class="alert alert-success alert-dismissable" id="alert1">
        <a class="close" data-dismiss="alert">×</a>
        <span><?php echo $text[$lang]['msg']['alert1']; ?></span>
    </div>
    <div class="alert alert-warning alert-dismissable" id="alert2">
        <a class="close" data-dismiss="alert">×</a>
        <span><?php echo $text[$lang]['msg']['alert2']; ?></span>
    </div>
    <div class="row">
        <p class="intro-text">&nbsp;</p>
    </div>
    <div class="row">
        <div class="hero-unit2">
            <h1 class="titulo-principal"><?php echo $text[$lang]['head']['valueprop']; ?></h1>
            <p class="bajada text-center"><?php echo $logo.'<br />'.$text[$lang]['head']['explain']; ?></p>
        </div>
        <div class="page-scroll">
            <a href="#about" class="btn btn-circle">
                <i class="fa fa-angle-double-down animated"></i>
            </a>
        </div>
        <div>
        &nbsp;<br /><br /><br /><br />
        </div>
    </div>
</div>

<div class="alert alert-warning alert-dismissable" id="alert3">
    <a class="close" data-dismiss="alert">×</a>
    <span>
        <?php echo $text[$lang]['msg']['alert3']; ?>
    </span>
    <a href="../include/forms/recuperarlogin.php" >
        <?php
            echo $text[$lang]['modal']['retrievelogin']['title'];
        ?>
    </a>
</div>
<div class="alert alert-warning alert-dismissable" id="alert4">
    <a class="close" data-dismiss="alert">×</a>
    <span>
        <?php echo $text[$lang]['msg']['alert4']; ?>
    </span>
    <a href="../include/forms/recuperarlogin.php" >
        <?php
             echo $text[$lang]['modal']['sendagain']['title'];
        ?>
    </a>
</div>


<div class="alert alert-warning alert-dismissable" id="alert5">
    <a class="close" data-dismiss="alert">×</a>
    <span>
        <?php echo 'Span alert 5' // titulo en alerta de cambio de contraseña ?>
    </span>
    <a href="../include/forms/recuperarlogin.php" >
        <?php
            echo 'Texto alert 5'; // link en el cambio de contraseña
        ?>
    </a>
</div>

<div class="alert alert-success alert-dismissable" id="alert6">
    <a class="close" data-dismiss="alert">×</a>
    <span>
        <?php echo $text[$lang]['modal']['success']['title']; ?>
    </span>
    </a>
</div>




