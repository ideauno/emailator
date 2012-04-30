<?php

class EmailatorShell extends Shell {

    var $uses = array('Emilio');
    var $tasks = array('Send');

    function main() {
        $this->Send->execute();
    }

}

?>