<?php

class CustomTasks{
	function retrievePass(&$bean,$event,$arguments=''){
        $timeDate = new TimeDate();
        if($bean->name == 'Cambio de Contraseña' && $bean->status == 'Not Started'){
            if($this->sendTaskEmail($bean)){
                $bean->status = 'In Progress';
                $GLOBALS['log']->fatal('Tasks Auto: el cambio de contraseña fue reportado al cliente');
            }
		}
	}

    function sendTaskEmail($bean){
        global $current_user;

        $rel_mod = substr($bean->parent_type,0,strlen($bean->parent_type)-1);
        $focus = new $rel_mod;
        $focus->retrieve($bean->parent_id);
        $user = new User();

        $imagEntry = array(
                'entryPoint' => 'image',
                'name' => 'logo_bma_120.png',
                'id' => $focus->id,
                'description' => 'Cambio Contraseña crmsync.me',
        );
        $linkEntry = array(
                'entryPoint' => 'link',
                'url' => 'blancomartin.cl/customizarcrm',
                'id' => $focus->id,
                'description' => 'Cambio Contraseña crmsync.me',
        );
        $ima1Entry = array(
                 'entryPoint' => 'image',
                 'name' => 'company_logo.png',
                 'id' => $bean->id,
                 'description' => 'Call password change',
        );

        $imagRef = 'http://crm.blancomartin.cl/index.php?' . http_build_query($imagEntry);
        $linkRef = 'http://crm.blancomartin.cl/index.php?' . http_build_query($linkEntry);
        $ima1Ref = 'http://crm.ofirent.cl/index.php?' . http_build_query($ima1Entry);


        $user->retrieve($bean->assigned_user_id);
        $subject = 'crmsync.me // '.$bean->name;

       

		$content = '<p><img src="'.$ima1Ref.'" width="140" alt="Logo crmsync.me"/></p>'
		.'<p>Enlace para recuperar contraseña:'
		.$bean->id
		.'</p>'
		.'<br /><br /><br /><span style="font-size:80%">Sistema basado en SuiteCRM. Ideado y personalizado por:<br />'
        .'<img src="'.$imagRef.'" alt="Logo Blanco Martín y Asociados" width="70" />'
        .'&nbsp;&nbsp;<a href="'.$linkRef.'">Blanco Martin & Asociados</a>. Especialistas en automatización de atención a clientes.</span></i>';
		

        return ($this->sendEmail($focus->email1,$subject,$content,$focus));
    }

    function sendEmail($emailTo, $emailSubject, $emailBody, SugarBean $relatedBean = null){
        $emailObj = new Email();
        $defaults = $emailObj->getSystemDefaultEmail();
        $mail = new SugarPHPMailer();
        $mail->setMailerForSystem();
        $mail->From = $defaults['email'];
        $mail->FromName = $defaults['name'];
        $mail->ClearAllRecipients();
        $mail->ClearReplyTos();
        $mail->Subject=from_html($emailSubject);
        //$mail->Body=from_html($emailBody);
            $mail->Body=$emailBody;
            $mail->AltBody=from_html($emailBody);
        $mail->prepForOutbound();
        $mail->AddAddress($emailTo);

        //now create email
        if (@$mail->Send()) {
            $emailObj->to_addrs= '';
            $emailObj->type= 'archived';
            $emailObj->deleted = '0';
            $emailObj->name = $mail->Subject ;
            $emailObj->description = $mail->Body;
            $emailObj->description_html = null;
            $emailObj->from_addr = $mail->From;
            if ( $relatedBean instanceOf SugarBean && !empty($relatedBean->id) ) {
                $emailObj->parent_type = $relatedBean->module_dir;
                $emailObj->parent_id = $relatedBean->id;
            }
            $emailObj->date_sent = TimeDate::getInstance()->nowDb();
            $emailObj->modified_user_id = '1';
            $emailObj->created_by = '1';
            $emailObj->status = 'sent';
            $emailObj->save();
            return true;
        }
    }

}
?>
