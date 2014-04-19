<?php

/**
 * [AutoSave]自動保存のシステムナビ
 *
 * @copyright Copyright 2014 - , Nextat Inc.
 * @link       http://nextat.co.jp
 * @package    nextat.bcplugins.auto_save
 * @since      baserCMS v 3.0.0
 * @version    0.9.1
 * @license    MIT License
 */
$config['BcApp.adminNavi.auto_save'] = array(
    'name' => '自動保存プラグイン',
    'contents' => array(
	array('name' => '設定', 'url' => array('admin' => true, 'plugin' => 'auto_save', 'controller' => 'auto_save_configs', 'action' => 'edit'))
    )
);
