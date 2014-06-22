<?php /** email form */ ?>
<form id="WebToLeadForm" action="include/postform.php" method="POST" name="WebToLeadForm">
    <input type="email"  id="webtolead_email1" name="webtolead_email1" required="required" placeholder="<?php echo $text[$lang]['contact']['youremail']; ?>" style="width:240px" class="btn-lg btn-warning p-holder" >
    <input type="submit" id="submit"           name="submit" value="<?php echo $text[$lang]['contact']['buttontext']; ?>" class="btn-lg btn-warning">
    <input type="hidden" id="campaign_id"      name="campaign_id" value="36920704-840a-05f4-6908-53962fa1c34b">
    <input type="hidden" id="assigned_user_id" name="assigned_user_id" value="1">
    <input type="hidden" id="last_name"        name="last_name" value="crmsync.me Form email only">
    <input type="hidden" id="opportunity_name" name="opportunity_name" value="crmsync.me" />
    <input type="hidden" id="lead_source"      name="lead_source" value="Landing_Page" />
    <input type="hidden" id="redirect_url"     type="hidden" name="redirect_url" value="http://crmsync.me/gracias" />
    <label for="first_name" class="verif">Nombre: </label>
    <input name="first_name" class="verif" />
</form>

