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
        <label for="password_c" class="col-sm-2 control-label"><?php echo $text[$lang]['modal']['signup']['password']; ?></label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password_c" id="checkpassword_c" placeholder="<?php echo $text[$lang]['modal']['placeholder']['password']; ?>">

        </div>
    </div>

    <div class="form-group">
        <label for="password_c2" class="col-sm-2 control-label"><?php echo $text[$lang]['modal']['signup']['passconf']; ?></label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password_c2" id="checkpassword_c2" placeholder="<?php echo $text[$lang]['modal']['placeholder']['passconf']; ?>">
            
        </div>
    </div>
    <input class="hidden" name="type_action" value="newpass" >
    <input class="hidden" name="user_hash" value="<?php echo $_SESSION['user_hash']; ?>">
    <input class="hidden" name="task_hash" value="<?php echo $_SESSION['task_hash']; ?>">
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button onclick="this.form.submit()" disabled="disabled" id="divCheckpwdm" type="button" class="btn btn-primary"><?php echo $text[$lang]['modal']['login']['save']; ?></button>
        </div>
    </div>
</form>

<script>



function checkPasswordMatch() {
        var password = $("#checkpassword_c").val();
        var confirmPassword = $("#checkpassword_c2").val();

    if (password != confirmPassword || password == '')
        $("#divCheckpwdm").attr('disabled','disabled');
    
    else
        if (password != '')   
            $("#divCheckpwdm").removeAttr('disabled');
        
}

$(document).ready(function () {
    $("#checkpassword_c").keyup(checkPasswordMatch);
    $("#checkpassword_c2").keyup(checkPasswordMatch);
});

</script>