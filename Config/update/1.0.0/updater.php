<?php
/**
 * 1.0.0 バージョン アップデートスクリプト
 */

class UpdateTask
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var callable
     */
    private $callable;

    public function __construct($description, callable $callable)
    {
        $this->description = $description;
        $this->callable = $callable;
    }

    /**
     * @return bool
     */
    public function process()
    {
        return call_user_func($this->callable);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}

class AutoSaveUpdater
{
    /**
     * @var UpdatersController
     */
    private $controller;

    public function __construct(UpdatersController $updatersController)
    {
        $this->controller = $updatersController;
    }

    /**
     * @param UpdateTask[] $tasks
     */
    public function processAll(array $tasks)
    {
        foreach ($tasks as $task) {
            $this->process($task);
        }
    }

    /**
     * @param UpdateTask $task
     */
    private function process(UpdateTask $task)
    {
        try {
            $isSuccess = $task->process();
        } catch (\Exception $e) {
            $this->controller->setUpdateLog($e->getMessage());
            $isSuccess = false;
        }
        if (!$isSuccess) {
            $errorMessage = $task->getDescription() . 'に失敗しました。';
            $this->controller->setUpdateLog($errorMessage);
            throw new RuntimeException($errorMessage);
        }

        $this->controller->setUpdateLog($task->getDescription() . 'に成功しました。');
    }
}

/** @var AutoSaveTarget $autoSaveTarget */
$autoSaveTarget = ClassRegistry::init('AutoSave.AutoSaveTarget');
$tasks = [
    new UpdateTask('auto_save_targets テーブルの構造変更', function () {
        return $this->loadSchema('1.0.0', 'AutoSave', 'auto_save_targets', $filterType = 'alter');
    }),
    new UpdateTask('auto_save_targets テーブルのレコード削除', function () use ($autoSaveTarget) {
        return $autoSaveTarget->deleteAll(['id >' => 0]);
    }),
    new UpdateTask('auto_save_targets テーブルへのCSVデータ読み込み', function () use ($autoSaveTarget) {
        $csvDirPath = __DIR__;
        return $autoSaveTarget->loadCsv('default', $csvDirPath);
    }),
];

$updater =  new AutoSaveUpdater($this);
$updater->processAll($tasks);
