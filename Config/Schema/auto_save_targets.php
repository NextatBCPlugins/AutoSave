<?php

class AutoSaveTargetsSchema extends CakeSchema {

    public $name = 'AutoSaveTargets';
    public $file = 'auto_save_targets.php';
    public $connection = 'plugin';

    public function before($event = array()) {
	return true;
    }

    public function after($event = array()) {
	
    }

    public $auto_save_targets = array(
	'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 8, 'key' => 'primary'),
	'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50),
	'status' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
	'plugin' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50),
	'controller' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50),
	'action' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50),
	'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
	'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
	'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
    );

}
