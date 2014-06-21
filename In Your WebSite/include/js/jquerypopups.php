<?php
if($_SESSION['auth'] == 'FAIL' || $_SESSION['recuperarlogin_view'] == 1 ){
    $login_screen = <<<EOT
<script>
$(login).modal('show');
$("#alert3").show();
</script>
EOT;
echo $login_screen;
unset($_SESSION['auth']);
}

elseif($_SESSION['recuperarlogin_view'] == 2){
    $login_screen = <<<EOT
<script>
$(login).modal('show');
$("#alert4").show();
</script>
EOT;
echo $login_screen;
unset($_SESSION['auth']);
}

elseif($_SESSION['recuperarlogin_view'] == 3){
    $login_screen = <<<EOT
<script>
$(login).modal('show');
$("#alert5").show();
</script>
EOT;
echo $login_screen;
unset($_SESSION['auth']);
}

elseif($_SESSION['recuperarlogin_view'] == 4){
    $login_screen = <<<EOT
<script>
$(login).modal('show');
$("#alert6").show();
</script>
EOT;
echo $login_screen;
unset($_SESSION);
}


echo $show_alert;
?>
