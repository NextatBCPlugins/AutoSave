<?php

/**
 * [AutoSave]自動保存コンフィグコントローラー
 *
 * @copyright Copyright 2014 - , Nextat Inc.
 * @link       https://nextat.co.jp
 * @package    nextat.bcplugins.auto_save
 * @since      baserCMS v 3.0.0
 * @version    1.0.0
 * @license    MIT License
 *
 * @property AutoSaveTarget $AutoSaveTarget
 * @property AutoSaveConfig $AutoSaveConfig
 * @property array $data
 */
class AutoSaveConfigsController extends AppController
{
    /**
     * クラス名
     * @var string
     */
    public $name = 'AutoSaveConfigs';

    /**
     * モデル
     * @var string[]
     */
    public $uses = ['AutoSave.AutoSaveTarget', 'AutoSave.AutoSaveConfig'];

    /**
     * コンポーネント
     * @var string[]
     */
    public $components = ['BcAuth', 'BcAuthConfigure'];

    /**
     * サブメニューエレメント
     * @var string[]
     */
    public $subMenuElements = ['auto_save'];

    /**
     * パンくずナビ
     * @var array
     */
    public $crumbs = [
        ['name' => 'プラグイン管理', 'url' => ['plugin' => '', 'controller' => 'plugins', 'action' => 'index']],
        ['name' => '自動保存管理', 'url' => ['plugin' => 'auto_save', 'controller' => 'auto_save_configs', 'action' => 'edit']]
    ];

    public function beforeFilter()
    {
        parent::beforeFilter();
    }
    /**
     * [ADMIN] 設定処理
     * @return void
     */
    public function admin_edit()
    {
        $this->pageTitle = '自動保存設定';
        if (strtoupper($this->request->method()) !== 'POST' || empty($this->data)) {
            //設定の読み込み
            $targets = $this->AutoSaveTarget->find('all');
            $configs = $this->AutoSaveConfig->find('all');
            //View側で使えるようにする
            $this->set('targets', $targets);
            $this->set('configs', $configs);
            return;
        }

        if ($this->AutoSaveTarget->saveAll($this->data['AutoSaveTarget']) && $this->AutoSaveConfig->saveAll($this->data['AutoSaveConfig'])) {
            // 保存が成功した場合は、完了メッセージを設定し、リダイレクト
            $this->Flash->set('保存しました。');
            $this->redirect(array('plugin' => 'auto_save', 'controller' => 'auto_save_configs', 'action' => 'edit'));
            return;
        }

        // 失敗した場合は完了メッセージの設定のみ
        $this->setMessage('エラーが発生しました。内容を確認してください。', true);
    }
}
