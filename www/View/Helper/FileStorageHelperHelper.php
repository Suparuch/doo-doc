<?php
class FileStorageHelperHelper extends AppHelper {
    
    public $helpers = array('Html');
    
    function urlByKey($key, $fileName = null) {
        if ($fileName == null) {
            $url = $this->Html->url(array(
                'controller' => 'fileProviders', 
                'action' => 'index', 
                $key
            ));
        } else {
            $url = $this->Html->url(array(
                'controller' => 'fileProviders', 
                'action' => 'index', 
                $key,
                $fileName
            ));
        }
//        $url = 'fileProviders/index/' . $key;
        return $url;
    }
    
}
?>
