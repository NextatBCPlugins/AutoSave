<?php
	echo $this->BcHtml->script(array(
		'AutoSave.vendor/store.min',
	        'AutoSave.Nextat.BcPluginAutoSave.FormData'
	));
?>
<script>
$(function(){
  var config = {
	id : '<?php echo $formId ?>',
	interval : '<?php echo $configs['interval']?>',
	prefix : 'BcPluginAutoSave',
	storage : store
  };
  var formData = new Nextat.BcPluginAutoSave.FormData(config);
                
  if(typeof CKEDITOR !== 'undefined') {
    //CKEditorが有効な場合はCKEditorの初期化まで待つ
    
    //dataReady済のインスタンスの数
    var num_ready = 0;
    
    CKEDITOR.on('instanceReady', function(event) {
	
        event.editor.on('dataReady', function(event){
            event.removeListener();
            
            //editorインスタンスの数
	    var num = 0;
	    for(var prop in CKEDITOR.instances){
		if(CKEDITOR.instances.hasOwnProperty(prop)) {
		    num++;
		}
	    }
	    
            num_ready += 1; 
            if(num_ready < num) {
                return;
            }
	    
            formData.init();
        });
         
    });
    
  } else {
      formData.init();
  }
});
</script>;

