<?php

class AutoSaveTargetsSchema extends CakeSchema
{
    public $name = 'AutoSaveTargets';
    public $file = 'auto_save_targets.php';
    public $connection = 'plugin';

    public function before($event = [])
    {
        return true;
    }

    public function after($event = [])
    {
    }

    public $auto_save_targets = [
        'id' => ['type' => 'integer', 'null' => false, 'default' => null, 'length' => 8, 'key' => 'primary'],
        'name' => ['type' => 'string', 'null' => true, 'default' => null, 'length' => 50],
        'status' => ['type' => 'integer', 'null' => true, 'default' => null, 'length' => 2],
        'plugin' => ['type' => 'string', 'null' => true, 'default' => null, 'length' => 50],
        'controller' => ['type' => 'string', 'null' => true, 'default' => null, 'length' => 50],
        'action' => ['type' => 'string', 'null' => true, 'default' => null, 'length' => 50],
        'form_id' => ['type' => 'string', 'null' => true, 'default' => null, 'length' => 50],
        'created' => ['type' => 'datetime', 'null' => true, 'default' => null],
        'modified' => ['type' => 'datetime', 'null' => true, 'default' => null],
        'indexes' => ['PRIMARY' => ['column' => 'id', 'unique' => 1]],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci'],
    ];
}
