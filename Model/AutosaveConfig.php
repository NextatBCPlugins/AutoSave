<?php

/**
 * [AutoSave]自動保存コンフィグモデル
 *
 * @copyright Copyright 2014 - , Nextat Inc.
 * @link       http://nextat.co.jp
 * @package    nextat.bcplugins.auto_save
 * @since      baserCMS v 3.0.0
 * @version    0.9.0
 * @license    MIT License
 */
class AutoSaveConfig extends AutoSaveAppModel {

    /**
     * クラス名
     *
     * @var string
     * @access public
     */
    public $name = 'AutoSaveConfig';

    /**
     * 全設定データを連想配列で返す
     * @return array
     */
    public function getAllByHash() {
	$results = $this->find('all');
	$configs = Hash::combine($results, "{n}.{$this->name}.name", "{n}.{$this->name}.value");
	return $configs;
    }

}
