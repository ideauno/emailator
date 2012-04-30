<?php

class SendTask extends Shell {

    var $components = array('Email');
    var $uses = array('Emailator.Emilio');

    public function execute() {
        App::import('Core', 'Controller');
        App::import('Component', 'Email');
        App::import('Model', 'Emailator.Emilio');
        $this->Emilio = & new Emilio();
        $this->Controller = & new Controller();
        $this->Email = & new EmailComponent(null);
        $this->Email->initialize($this->Controller);


        $emails_to_send = $this->Emilio->findToSend();
        
        foreach($emails_to_send as $email_to_send){
            $to = $email_to_send['Emilio']['to'];
            $subject = $email_to_send['Emilio']['to'];
            $template = $email_to_send['Ubication']['route'];
            $data = unserialize($email_to_send['Emilio']['body_data']);
            if ($this->send_mail($to, $subject, $template, $data)){
                $email_to_send['Emilio']['status'] = '1';
                $this->Emilio->save($email_to_send);
            }
        }
        echo "fin :)";
    }

    private function send_mail($to, $subject, $template, $data = null) {
        if (Configure::read('debug') > 0) {
            $to = 'cuchitto@gmail.com';
        }
        
        
        $configuracion['replyTo'] = 'cucho@mail.com';
        $configuracion['from'] = 'cucho@mail.com';
        $configuracion['layout'] = 'default';
        $configuracion['smtp'] = array(
            'port' => '587',
            'timeout' => '20',
            'host' => 'smtp.gmail.com',
            'username' => 'evaluaciones.ideae@gmail.com',
            'password' => 'evaluaciones1'
        );
        
        $configuracion = Configure::read('Emailator.email');
                
        
        $this->Email->reset();
        $this->Email->to = $to;
        $this->Email->subject = $subject;
        $this->Email->template = $template;
        $this->Email->sendAs = 'html';
        $this->Email->layout = $configuracion['layout'];
        $this->Email->replyTo = $configuracion['replyTo'];
        $this->Email->from = $configuracion['from'];
        $this->Email->smtpOptions = $configuracion['smtp'];
        $this->Email->delivery = 'smtp';
        $this->Controller->set('data', $data);

        if ($this->Email->send()) {
            return true;
        }

        if (!empty($this->Email->smtpError)) {
            $this->log($this->Email->smtpError);
        }
        return false;
    }
    
    
}

?>