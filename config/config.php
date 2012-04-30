<?php

/**
 * Emailator
 * include the next line en app/config/config.php
 */

// include_once(ROOT . '/app/plugins/emailator/config/config.php');


/**
 * Maximum number of mail delivery simultaneously
 */
Configure::write('Emailator.max_send', '2');

/**
 * Email configuration
 */
Configure::write('Emailator.email', array(
    'replyTo' => 'cucho@mail.com',
    'from' => 'cucho@mail.com',
    'layout' => 'default',
    'smtp' => array(
        'port' => '587',
        'timeout' => '20',
        'host' => 'smtp.gmail.com',
        'username' => 'evaluaciones.ideae@gmail.com',
        'password' => 'evaluaciones1'
    )
));
?>