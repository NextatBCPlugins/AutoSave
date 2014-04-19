<?php

/**
 * [AutoSave]自動保存ターゲットモデル
 *
 * @copyright Copyright 2014 - , Nextat Inc.
 * @link       http://nextat.co.jp
 * @package    nextat.bcplugins.auto_save
 * @since      baserCMS v 3.0.0
 * @version    0.9.0
 * @license    MIT License
 */
App::uses('BcPluginAppModel', 'Model');

class AutoSaveTarget extends AutoSaveAppModel {

    /**
     * クラス名
     *
     * @var string
     * @access public
     */
    public $name = 'AutoSaveTarget';

    /**
     * $requestと合致しstatusが有効なレコードのデータを配列で返す
     * @param CakeRequest $request
     * @return array
     */
    public function getRequested(CakeRequest $request) {

	$conditions = array(
	    'controller' => $request->controller,
	    'action' => $request->action,
	    'status' => 1
	);

	if (!empty($request->plugin)) {
	    $conditions['plugin'] = $request->plugin;
	}

	$results = $this->find('all', array(
	    'conditions' => $conditions,
	));

	return $results;
    }

    /**
     * $requestに対し自動保存が有効かどうかを返す
     * @param CakeRequest $request
     * @return boolean
     */
    public function isEnabledOn(CakeRequest $request) {
	$results = $this->getRequested($request);

	if (empty($results)) {
	    return false;
	}
	return true;
    }

}
