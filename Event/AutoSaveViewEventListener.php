<?php

/**
 * [AutoSave]AutoSaveビューイベントリスナー
 *
 * @copyright Copyright 2014 - , Nextat Inc.
 * @link       https://nextat.co.jp
 * @package    nextat.bcplugins.auto_save
 * @since      baserCMS v 3.0.0
 * @version    1.0.0
 * @license    MIT License
 */
class AutoSaveViewEventListener extends BcViewEventListener
{
    /**
     * 登録イベント
     * @var string[]
     */
    public $events = [
        'beforeLayout'
    ];

    /**
     * beforeLayout
     * @param CakeEvent $event
     * @return void
     */
    public function beforeLayout(CakeEvent $event)
    {
        /** @var BcAppView $View */
        $View = $event->subject();

        /** @var CakeRequest $request */
        $request = $View->request;

        //管理画面でなければ何もしない
        if (!$request->isAdmin()) {
            return;
        }

        //現在のページが自動保存オンに設定されているかチェック
        /** @var AutoSaveTarget $AutoSaveTarget */
        $AutoSaveTarget = ClassRegistry::init('AutoSave.AutoSaveTarget');
        $autoSaveTarget = $AutoSaveTarget->getRequested($request);
        if (empty($autoSaveTarget)) {
            return;
        }

        //プラグインの設定を連想配列で取得
        /** @var AutoSaveConfig $AutoSaveConfig */
        $AutoSaveConfig = ClassRegistry::init('AutoSave.AutoSaveConfig');
        $configs = $AutoSaveConfig->getAllByHash();

        // $View->BcBaser->scripts()で出力される領域（$scripts_for_layout）に
        // View/Elements/admin/script.phpの内容を追加
        $script = $View->element('AutoSave.script', array(
            'formId' => $autoSaveTarget[0]['AutoSaveTarget']['form_id'],
            'configs' => $configs
        ));

        $View->append('script', $script);

        return;
    }
}
