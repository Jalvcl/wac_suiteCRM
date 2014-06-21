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
        <label for="username_c" class="col-md-2 control-label"><?php echo $text[$lang]['modal']['signup']['username']; ?></label>
        <div class="col-sm-10">
            <input class="form-control" name="username_c" id="username_c" type="text" value="" placeholder="<?php echo $text[$lang]['modal']['placeholder']['username']; ?>" >
        </div>
    </div>

    <div class="form-group">
        <label for="password_c" class="col-sm-2 control-label"><?php echo $text[$lang]['modal']['signup']['password']; ?></label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password_c" id="password_c" placeholder="<?php echo $text[$lang]['modal']['placeholder']['password']; ?>">
            <input class="hidden" name="type_action" value="login" >
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                
                <label for="remember_c">
                    <span class="<?php if(isset($_COOKIE['remember_me'])) echo 'checked'; ?>">
                        <input type="checkbox" id="remember_c" name="remember_c" checked="checked"> <?php echo $text[$lang]['modal']['login']['remember']; ?>
                    </span>
                </label>

            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button onclick="this.form.submit()" type="button" class="btn btn-primary"><?php echo $text[$lang]['modal']['login']['save']; ?></button>
        </div>
    </div>
</form>