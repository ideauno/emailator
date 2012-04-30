<?php

class Emilio extends EmailatorAppModel {

    var $name = 'Emilio';
    var $belongsTo = array(
        'Ubication' => array(
            'className' => 'Ubication',
            'foreignKey' => 'ubication_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    function findToSend() {
        $actual_date = date('Y-m-d H:i');
        $emails_to_send = $this->find('all', array(
            'conditions' => array(
                'Emilio.send_date <=' => $actual_date,
                'Emilio.status' => '0',
            ),
            'order' => array(
                'Emilio.priority' => 'ASC',
                'Emilio.send_date' => 'ASC'
            ),
            'limit' => Configure::read('Emailator.max_send'),
            'recursive' => 0
                ));
        return $emails_to_send;
    }

}

?>