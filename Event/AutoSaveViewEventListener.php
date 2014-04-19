<?php

/**
 * [AutoSave]AutoSaveビューイベントリスナー
 *
 * @copyright Copyright 2014 - , Nextat Inc.
 * @link       http://nextat.co.jp
 * @package    nextat.bcplugins.auto_save
 * @since      baserCMS v 3.0.0
 * @version    0.9.1
 * @license    MIT License
 */
class AutoSaveViewEventListener extends BcViewEventListener {

    /**
     * 登録イベント
     *
     * @var array
     */
    public $events = array(
	'beforeLayout'
    );

    /**
     * beforeLayout
     * 
     * @param CakeEvent $event
     * @return void 
     */
    public function beforeLayout(CakeEvent $event) {
	$View = $event->subject();
	$request = $View->request;

	//管理画面でなければ何もしない
	if (!preg_match('/^admin_/', $request->action)) {
	    return;
	}
	//現在のページが自動保存オンに設定されているかチェック
	$AutoSaveTarget = ClassRegistry::init('AutoSave.AutoSaveTarget');
	if (!$AutoSaveTarget->isEnabledOn($request)) {
	    return;
	}


	//プラグインの設定を連想配列で取得
	$AutoSaveConfig = ClassRegistry::init('AutoSave.AutoSaveConfig');
	$configs = $AutoSaveConfig->getAllByHash();


	// $View->BcBaser->scripts()で出力される領域（$scripts_for_layout）に
	// View/Elements/admin/script.phpの内容を追加
	$script = $View->element('AutoSave.script', array(
	    'formId' => Inflector::classify($request->controller) . 'Form',
	    'configs' => $configs
	));
	$View->addScript($script);

	return;
    }

}
