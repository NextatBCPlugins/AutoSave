<?php

class AutoSaveConfigsSchema extends CakeSchema
{
    public $name = 'AutoSaveConfigs';
    public $file = 'auto_save_configs.php';
    public $connection = 'plugin';

    public function before($event = [])
    {
        return true;
    }

    public function after($event = [])
    {
    }

    public $auto_save_configs = [
        'id' => ['type' => 'integer', 'null' => false, 'default' => null, 'length' => 8, 'key' => 'primary'],
        'name' => ['type' => 'string', 'null' => true, 'default' => null, 'length' => 50],
        'value' => ['type' => 'text', 'null' => true, 'default' => null],
        'created' => ['type' => 'datetime', 'null' => true, 'default' => null],
        'modified' => ['type' => 'datetime', 'null' => true, 'default' => null],
        'indexes' => ['PRIMARY' => ['column' => 'id', 'unique' => 1]],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci'],
    ];
}
