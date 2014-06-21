<?php
/*** login form **/ ?>
<form class="form-horizontal" method="post" action="core/actions/crmConnectionSoap.php" role="form">
    <!--<div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
        </div>
    </div> -->

    <div class="form-group">
        <label for="taskhash" class="col-md-2 control-label"><?php echo $text[$lang]['modal']['signup']['hash']; ?></label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="task_hash" placeholder="<?php echo $text[$lang]['modal']['placeholder']['hash']; ?>" >
            <input class="hidden" name="type_action" value="hash">
        </div>
    </div>
     
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button onclick="this.form.submit()" type="button" class="btn btn-primary"><?php echo $text[$lang]['modal']['login']['save']; ?></button>
        </div>
    </div>
</form>