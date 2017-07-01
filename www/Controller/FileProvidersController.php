<?php
class FileProvidersController extends AppController {
    
    public $components = array('FileStorageComponent');
    
    public function index($key = null, $fileName = null) {
        $this->autoRender = false;
        if ($key != null) {
            if ($fileName == null) {
                $this->FileStorageComponent->fastdownload($key);
            } else {
                /* Change name of downloading file */
                $this->FileStorageComponent->fastdownload($key, $fileName);
            }
        }
    }
    
}
?>
