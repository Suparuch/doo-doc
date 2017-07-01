<?php
App::uses('Component', 'Controller');
App::uses('Utility', 'mfa');
class FileStorageComponentComponent extends Component {

    public $components = array('Session');
//    private $controller;

//    function initialize(Controller $controller) {
//        $this->controller = $controller;
//    }
    
    /* *
     * $path is path after 'webroot/' eg. 'files/temp/'
     */
    function save($path, $fileName, $contentType, $pathToSave = null) {
        /* Set IP of file server here */
        $storageHost = Configure::read('Storage.Application');
        $UUID = String::uuid();
        $currentUser = $this->Session->read('AuthUser');
        $SYSTEM_ID = Configure::read('Application.ApplicationId');
        $SYSTEM_NAME = Configure::read('Application.ModuleName');
        if (strlen($path) > 0 && $path[strlen($path) - 1] != '/') {
            $path .= '/';
        }
        if ($pathToSave == null) {
            $pathToSave = $path;
        } else {
            if (strlen($pathToSave) > 0 && $pathToSave[strlen($pathToSave) - 1] != '/') {
                $pathToSave .= '/';
            }
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'file' => '@' . realpath('.') . '/' . $path . $fileName,
//                        'file' => '@C:/Temp/test.txt',
//                        'file' => '@C:/xampp/htdocs/storage/app/webroot/files/test/test.pdf',
            'user_id' => $currentUser['User']['id'],
            'system_id' => $SYSTEM_ID,
            'system_name' => $SYSTEM_NAME,
            'path' => $pathToSave,
            'content_type' => $contentType,
            'key' => $UUID,
        ));
        
        curl_setopt($ch, CURLOPT_URL, $storageHost . 'fileStorages/upload/');
        
        if (!$result = curl_exec($ch)) {
            trigger_error(curl_error($ch));
        }
        curl_close($ch);
        
        // Always delete original file
        unlink(realpath('.') . '/' . $path . $fileName);
        
        if ($result == true) {
            return $UUID;
        } else {
            return false;
        }
    }        
    
    function saveWithoutSession($userId, $path, $fileName, $contentType, $pathToSave = null) {
        /* Set IP of file server here */
        $storageHost = Configure::read('Storage.Application');
        $UUID = Utility::uuid();
        $SYSTEM_ID = Configure::read('Application.ApplicationId');
        $SYSTEM_NAME = Configure::read('Application.ModuleName');
        if (strlen($path) > 0 && $path[strlen($path) - 1] != '/') {
            $path .= '/';
        }
        if ($pathToSave == null) {
            $pathToSave = $path;
        } else {
            if (strlen($pathToSave) > 0 && $pathToSave[strlen($pathToSave) - 1] != '/') {
                $pathToSave .= '/';
            }
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'file' => '@' . realpath('.') . '/' . $path . $fileName,
//                        'file' => '@C:/Temp/test.txt',
//                        'file' => '@C:/xampp/htdocs/storage/app/webroot/files/test/test.pdf',
            'user_id' => $userId,
            'system_id' => $SYSTEM_ID,
            'system_name' => $SYSTEM_NAME,
            'path' => $pathToSave,
            'content_type' => $contentType,
            'key' => $UUID,
        ));
        
        curl_setopt($ch, CURLOPT_URL, $storageHost . 'fileStorages/upload/');
        
        if (!$result = curl_exec($ch)) {
            trigger_error(curl_error($ch));
        }
        curl_close($ch);
        
        // Always delete original file
        unlink(realpath('.') . '/' . $path . $fileName);
        
        if ($result == true) {
            return $UUID;
        } else {
            return false;
        }
    }

    function download($key = null, $fileName = null, $contentType = null, $size = null) {
        if ($key != null) {
            /* Set IP of file server here */
            $storageHost = Configure::read('Storage.Application');
            if ($fileName == null || $contentType == null || $size == null) {
                $fp  = fopen($storageHost . "fileStorages/initdownload/$key/", 'r');
                $tempString = fgets($fp);
                $file = json_decode($tempString, true);
                /*
                 * pr($file);
                 * Array
                    (
                        [content_type] => application/vnd.openxmlformats-officedocument.wordprocessingml.document
                        [file_name] => 84D480CD-C2A1-45D6-9E03-9D2D0E8A6C48.docx
                        [ext] => docx
                        [size] => 32953
                    )
                 */
                $contentType = $file['content_type'];
                if ($fileName == null) {
                    /* If don't specific $fileName then use $fileName from storage server */
                    $fileName = $file['file_name'];
                }
                $extension = strtolower($file['ext']);
                $size = $file['size'];
                fclose($fp);
            } else {
                /* If explicite $fileName, $contentType, $size parameters (faster) */
                $extension = strtolower(end(explode('.', $fileName)));
            }
            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif' || $extension == 'bmp') {
                /* Picture */
                header('Accept-Ranges: bytes');
                header('Content-Type: ' . $contentType);
                header('Content-Disposition: filename="' . $fileName . '"');
            } else {
                /* Other files */
                header('Content-Type: ' . $contentType);
                header('Content-Disposition: attachment; filename="' . $fileName . '"');
                header('Content-length: ' . $size);
            }
            readfile($storageHost . "fileStorages/download/$key/");
        }
    }
    
    function fastdownload($key = null, $fileName = null, $contentType = null, $size = null) {
        if ($key != null) {
            /* Set IP of file server here */
            $storageHost = Configure::read('Storage.Application');

            if ($fileName == null || $contentType == null || $size == null) {
                $fp  = fopen($storageHost . "filestorage.php?action=init&key=$key", 'r');
                $tempString = fgets($fp);
                $file = json_decode($tempString, true);
                /*
                 * pr($file);
                 * Array
                    (
                        [content_type] => application/vnd.openxmlformats-officedocument.wordprocessingml.document
                        [file_name] => 84D480CD-C2A1-45D6-9E03-9D2D0E8A6C48.docx
                        [ext] => docx
                        [size] => 32953
                    )
                 */
                $contentType = $file['content_type'];
                if ($fileName == null) {
                    /* If don't specific $fileName then use $fileName from storage server */
                    $fileName = $file['file_name'];
                }
                $extension = strtolower($file['ext']);
                $size = $file['size'];
                fclose($fp);
            } else {
                /* If explicite $fileName, $contentType, $size parameters (faster) */
                $extension = strtolower(end(explode('.', $fileName)));
            }
            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif' || $extension == 'bmp') {
                /* Picture */
                header('Accept-Ranges: bytes');
                header('Content-Type: ' . $contentType);
                header('Content-Disposition: filename="' . $fileName . '"');
            } else {
                /* Other files */
                header('Content-Type: ' . $contentType);
                header('Content-Disposition: attachment; filename="' . $fileName . '"');
                header('Content-length: ' . $size);
            }
            readfile($storageHost . "filestorage.php?action=download&key=$key");
        }
    }
    
    function urlByKey($key, $fileName = null) {
        if ($fileName == null) {
            $url = $this->webroot . 'fileProviders/index/' . $key;
        } else {
            /* Change name of downloading file */
            $url = $this->webroot . 'fileProviders/index/' . $key . '/' . $fileName;
        }
        return $url;
    }
    
    function copy($sourceKey = null, $destinationPath = null, $sourceExt = null) {
        if ($sourceKey != null && $destinationPath != null && $sourceExt != null) {
            $storageHost = Configure::read('Storage.Application');
            $UUID = Utility::uuid();
            $currentUser = $this->Session->read('AuthUser');
            $SYSTEM_ID = Configure::read('Application.ApplicationId');
            $SYSTEM_NAME = Configure::read('Application.ModuleName');
            $userId = $currentUser['User']['id'];
            $encodePath = base64_encode($destinationPath);
            $encodeFileName = base64_encode($UUID . '.' . $sourceExt);


            /* UUID is both key and filename (without extension) */
            /* $sourceKey = null, $encodeDestinationPath = null, $encodeDestinationFileName = null, 
             * $userId = null, $systemId = null, $systemName = null 
             */
            $url = $storageHost . "fileStorages/copy/$sourceKey/$encodePath/$encodeFileName/$userId/$SYSTEM_ID/$SYSTEM_NAME/";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            if (!$result = curl_exec($ch)) {
                trigger_error(curl_error($ch));
            }
            curl_close($ch);

            if ($result == true) {
                return $UUID;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}