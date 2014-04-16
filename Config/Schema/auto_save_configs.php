<?php

class AutoSaveConfigsSchema extends CakeSchema {

    public $name = 'AutoSaveConfigs';
    public $file = 'auto_save_configs.php';
    public $connection = 'plugin';

    public function before($event = array()) {
	return true;
    }

    public function after($event = array()) {
    }

    public $auto_save_configs = array(
	'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 8, 'key' => 'primary'),
	'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50),
	'value' => array('type' => 'text', 'null' => true, 'default' => null),
	'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
	'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
	'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
    );

}
