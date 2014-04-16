<?php // JS 読み込み ?>
<?php $this->BcBaser->js('AutoSave.auto_save'); ?>
<?php // CSS 読み込み ?>
<?php $this->BcBaser->css('AutoSave.auto_save',array('inline' => false)); ?>
<?php
$statuses = array(0 => 'オフ', 1 => 'オン');
?>
<h2>基本項目</h2>
<?php echo $this->bcForm->create('AutoSaveConfig', array('type'=>'file', 'enctype' => 'multipart/form-data')); ?>
<table class="form-table">
  <?php $i=0?>
  <?php foreach ($targets as $target):?>
    <tr>
      <th><?php echo $target['AutoSaveTarget']['name']?></th>
      <td><?php echo $this->bcForm->hidden("AutoSaveTarget.{$i}.id", array('value' => $target['AutoSaveTarget']['id']))?>
        <?php echo $this->bcForm->input("AutoSaveTarget.{$i}.status",array('value' => $target['AutoSaveTarget']['status'],'type' => 'select', 'options' => $statuses)) ?>
        <?php echo $this->BcHtml->image('admin/icn_help.png', array('id' => 'helpSiteUrl', 'class' => 'btn help', 'alt' => 'ヘルプ')) ?>
        <div id="helptextSiteUrl" class="helptext">自動保存の有効無効が保存できます。</div></td>
    </tr>
    <?php $i++?>
  <?php endforeach;?>
  <tr>
    <th>自動保存間隔(秒)</th>
    <td><button id="countDown" type="button"><</button>
      <?php echo $this->bcForm->hidden('AutoSaveConfig.id', array('value' => $configs[0]['AutoSaveConfig']['id']))?>
      <?php echo $this->bcForm->text('AutoSaveConfig.value',array('id' => 'countval', 'readonly' => 'readonly', 'value' => $configs[0]['AutoSaveConfig']['value'])) ?>
      <button id="countUp" type="button">></button>
      <?php echo $this->BcHtml->image('admin/icn_help.png', array('id' => 'helpSiteUrl', 'class' => 'btn help', 'alt' => 'ヘルプ')) ?>
      <div id="helptextSiteUrl" class="helptext">
          <ul>
            <li>自動保存の間隔が保存できます。</li>
            <li>保存間隔は30秒から300秒です。</li>
          </ul>
        </div></td>
  </tr>
</table>
<div class="submit">
  <?php // フォーム送信用ボタンを出力。タグに class="button" を追加 ?>
  <?php echo $this->bcForm->submit('保存', array('class' => 'button')) ?>
</div>
<?php // フォームの終了 ?>
<?php echo $this->bcForm->end(); ?>