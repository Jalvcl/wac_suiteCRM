<?php
/*** registration form **/ ?>
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $text[$lang]['modal']['signup']['firstname']; ?></label>
            <div class="col-lg-8">
                <input class="form-control" type="text" value="Jane">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $text[$lang]['modal']['signup']['lastname']; ?></label>
            <div class="col-lg-8">
                <input class="form-control" type="text" value="Bishop">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $text[$lang]['modal']['signup']['company']; ?></label>
            <div class="col-lg-8">
                <input class="form-control" type="text" value="<?php echo $text[$lang]['modal']['signup']['companyname']; ?>">
            </div>
        </div>
        
<!--                            <div class="form-group">
            <label class="col-lg-3 control-label">Time Zone:</label>
            <div class="col-lg-8">
                <div class="ui-select">
                    <select id="user_time_zone" class="form-control">
                        <option value="Hawaii">(GMT-10:00) Hawaii</option>
                        <option value="Alaska">(GMT-09:00) Alaska</option>
                        <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                        <option value="Arizona">(GMT-07:00) Arizona</option>
                        <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                        <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00) Central Time (US &amp; Canada)</option>
                        <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                        <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                    </select>
                </div>
            </div>
        </div>
-->
        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $text[$lang]['modal']['signup']['email']; ?></label>
            <div class="col-lg-8">
                <input class="form-control" type="text" value="youremail@domain.com">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-3 control-label"><?php echo $text[$lang]['modal']['signup']['username']; ?></label>
            <div class="col-md-8">
                <input class="form-control" type="text" value="janeuser">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label"><?php echo $text[$lang]['modal']['signup']['password']; ?></label>
            <div class="col-md-8">
                <input class="form-control" type="password" value="11111122333">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label"><?php echo $text[$lang]['modal']['signup']['passconf']; ?></label>
            <div class="col-md-8">
                <input class="form-control" type="password" value="11111122333">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                <button type="button" class="btn btn-primary"><?php echo $text[$lang]['modal']['signup']['save']; ?></button>
            </div>
            <div class="col-sm-offset-1 col-sm-3">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $text[$lang]['modal'][$usage]['close']; ?></button>
            </div>
        </div>

    </form>
