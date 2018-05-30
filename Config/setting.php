<?php

/**
 * [AutoSave]自動保存のシステムナビ
 *
 * @copyright Copyright 2014 - , Nextat Inc.
 * @link       https://nextat.co.jp
 * @package    nextat.bcplugins.auto_save
 * @since      baserCMS v 3.0.0
 * @version    1.0.0
 * @license    MIT License
 */
$config['BcApp.adminNavi.auto_save'] = [
    'name' => '自動保存プラグイン',
    'contents' => [
        ['name' => '設定', 'url' => ['admin' => true, 'plugin' => 'auto_save', 'controller' => 'auto_save_configs', 'action' => 'edit']]
    ]
];
