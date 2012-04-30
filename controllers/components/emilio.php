<?php

class EmilioComponent extends Object {

    public $settings = array(
        'max' => '10',
        'delay' => '10'
    );

    public function initialize($controller, $settings = array()) {
        $this->settings = Set::merge($this->settings, $settings);
    }

    /**
     * Genera registros emilios
     * Estructura de $data:
     *  $data = array(
     *      [0] => array(
     *          ['email'] => 'email@email.com',
     *          ['body_data'] => array()
     *      ),
     *      [1] => array(
     *          ['email'] => 'email@email.com',
     *          ['body_data'] => array()
     *      ),
     *      .
     *      .
     *      .
     *      ,
     *      [N] => array(
     *          ['email'] => 'email@email.com',
     *          ['body_data'] => array()
     *      )      
     * );
     * 
     * 
     * @author Carlos Vásquez
     * 
     * @params array $data
     * @params string $title
     * @params string $body_ubication
     * @params int $priority
     * @params date $when
     * 
     * @return true 
     *
     * @final
     */
    public function generate($data, $title, $body_ubication, $priority = '2', $when = null) {

        
        $Emilio = ClassRegistry::init('Emailator.Emilio');
        if (!$when) {
            $when = date('Y-m-d H:i');
        }
        
        
        if (!empty($data)) {
            $count = 0;
            foreach ($data as $email_add) {
                $emilio['Emilio']['title'] = $title;                
                $emilio['Emilio']['ubication_id'] = $this->ubicacion($body_ubication);
                $emilio['Emilio']['body_data'] = serialize ($email_add['body_data']);
                $emilio['Emilio']['to'] = $email_add['email'];
                $emilio['Emilio']['send_date'] = $when;
                $emilio['Emilio']['status'] = 0;
                $emilio['Emilio']['priority'] = $priority;
                $Emilio->create();
                $Emilio->save($emilio);
                $count++;
            }
        }
    }

    private function minute_operation($date, $operator) {
        $date = String::tokenize($date, $separator = ' ');
        $hour = String::tokenize($date['1'], $separator = ':');
        $date = String::tokenize($date['0'], $separator = '-');
        return(date("Y-m-d H:i", strtotime("$operator minute", mktime($hour['0'], $hour['1'], 0, $date['1'], $date['2'], $date['0']))));
    }
    
    private function ubicacion($data){
        $Ubication = ClassRegistry::init('Emilio.Ubication');
        $a = $Ubication->field('Ubication.id', array('Ubication.route' => $data));
        if(!$a){
            $regitro['Ubication']['route'] = $data;
            $Ubication->create();
            $Ubication->save($regitro);
            return ($Ubication->id);
        } else {
            return $a;
        }
    }
    

}

?>