<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LeadFormProcessor
 *
 * @author rudyard
 */
class FsiLeadFormProcessor
{

    public function FsiLeadFormProcessor()
    {
        
    }

    public function ProcessEmail()
    {
        try
        {
            if (strlen($_POST['username']) > 0)
            {
                throw new Exception('Spam!');
            }
            $lead_form = FsiLeadForm::GetLeadForm(esc_attr($_POST['recnum']));
            if($lead_form == null)
            {
                throw new Exception('Error in accessing form information...');
            }
            $lead = $this->CreateLead();
            $lead->Store();
            $this->SendLeadEmail($lead_form, $lead);
            if(strlen($lead_form->meta->auto_responder->from_address)>0 && strlen($lead_form->meta->auto_responder->subject)>0)
            {
                $this->SendAutoResponder($lead_form, $lead);
            }
            
            echo '<script type="text/javascript">window.location.href="' . $lead_form->finished_redirect . '";</script>';
        } 
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
    }
    protected function SendLeadEmail($lead_form, $lead)
    {
        $mail = $this->get_mailer();
        $mail->AddReplyTo($lead->meta->email, $lead->meta->name);
        $mail->SetFrom($lead_form->from_address);
        $addresses = explode(',', $lead_form->to_addresses);
        foreach ($addresses as $address)
        {
            $mail->AddAddress(trim($address));
        }
        $mail->Subject = $lead_form->subject;
        $mail->MsgHTML($this->CreateEmailBody($lead));
        if (!$mail->Send())
        {
            throw new Exception($mail->ErrorInfo);
        }
    }
    protected function SendAutoResponder($lead_form, $lead)
    {
        $mail = $this->get_mailer();
        $mail->SetFrom($lead_form->meta->auto_responder->from_address);
        $mail->AddAddress($lead->meta->email);
        $mail->Subject = $lead_form->meta->auto_responder->subject;
        $mail->MsgHTML($lead_form->meta->auto_responder->body_html);
        if (!$mail->Send())
        {
            throw new Exception($mail->ErrorInfo);
        }
    }
    private function get_mailer()
    {
        $mail = new PHPMailer();
        $option = FsiOption::GetOption(FsiOption::$SmtpServer);
        if(strlen($option->value)>0)
        {
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Host       = $option->value; // SMTP server
            //$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                                       // 1 = errors and messages
                                                       // 2 = messages only
            $option = FsiOption::GetOption(FsiOption::$SmtpPort);
            $mail->Port       = $option->value;                    // set the SMTP port for the GMAIL server
            $option = FsiOption::GetOption(FsiOption::$SmtpUser);
            $mail->Username   = $option->value; // SMTP account username
            $option = FsiOption::GetOption(FsiOption::$SmtpPassword);
            $mail->Password   = $option->value;        // SMTP account password
        }
        return $mail;
    }

    protected function CreateMeta($meta = null)
    {
        if ($meta == null)
        {
            $meta = new EMailLeadMeta();
        }
        $meta->from_page = esc_attr($_POST['from_page']);
        $meta->reference = esc_attr($_POST['reference']);
        $meta->name = esc_attr($_POST['name']);
        $meta->email = esc_attr($_POST['email']);
        $lead_form_fields = FsiLeadFormField::GetLeadFormFields(esc_attr($_POST['recnum']));
        foreach($lead_form_fields as $lead_form_field)
        {
            $meta->field_values[] = $lead_form_field->GetMetaFieldValue();
        }
        return $meta;
    }

    protected function CreateLead()
    {
        $lead = new FsiLead();
        $lead->ip_address = trim($_POST['ip_address']);
        $lead->type = FsiLead::$EmailLeadType;     
        $lead->form = esc_attr($_POST['recnum']);
        $lead->meta = $this->CreateMeta();
        return $lead;
    }

    protected function CreateEmailBody($lead)
    {
        $html = 'Automated Website Submission:';
        $fields = FsiLeadFormField::GetLeadFormFields($lead->form);
        foreach($fields as $field)
        {
            foreach($lead->meta->field_values as $field_value)
            {
                if($field_value->name == $field->name)
                {
                    $html .= '<p>'.$field->meta->title.': '.$field_value->value;
                }
            }
        }
        $html .= '<p>From Page: ' . $lead->meta->from_page . '</p>';
        $html .= '<p>Reference: ' . $lead->meta->reference . '</p>';
        $html .= '<p>IP Address: ' . $lead->ip_address . '</p>';
        return $html;
    }

}

?>
