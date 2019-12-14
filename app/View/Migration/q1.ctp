<?php
echo $this->Form->create('FileUpload', ['type'=>'file']);
echo $this->Form->input('file', array('id'=>'file', 'name'=>'file','label' => 'File Upload', 'type' => 'file'));
echo $this->Form->submit('Upload', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>