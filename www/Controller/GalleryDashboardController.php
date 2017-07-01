<?php
App::uses('AppController', 'Controller');
class GalleryDashboardController extends AppController {

    public $name = 'GalleryDashboard';
    public $uses = array('UploadFile', 'Gallery','GalleryDetail', 'GalleryAlbum', 'GalleryDocument', 'GalleryVideo');


    function beforeFilter(){
        $currentUser = $this->Session->check('AuthUser');
        if(empty($currentUser)){
            $this->Session->delete('AuthUser');
            $this->Session->destroy();

            $url = Configure::read('Application.Domain').'Logins';
            $this->redirect($url);
        }
    }

    public function phpinfo(){
        phpinfo();
    }
    public function index(){
        // $pictureDetail = $this->GalleryDetail->query("SELECT * FROM gallery_post FULL JOIN  gallery_picture ON gallery_post.id = post_id ORDER BY created DESC");
        /*
        $pictureDetail = $this->GalleryDetail->query("
                            SELECT
                            gallery_post.created as created,
                            gallery_picture.location as picture_location, gallery_picture.description as picture_description,
                            gallery_picture.path as picture_path, gallery_picture.album_id as picture_album,
                            gallery_album.album_name as album_name,
                            gallery_video.path as video_path, gallery_video.location as video_location,
                            gallery_video.description as video_description,
                            gallery_document.path as document_path
                            FROM gallery_post
                            LEFT JOIN gallery_picture ON gallery_picture.post_id = gallery_post.id
                            LEFT JOIN gallery_video ON gallery_video.post_id = gallery_post.id
                            LEFT JOIN gallery_document ON gallery_document.post_id = gallery_post.id
                            LEFT JOIN gallery_album ON gallery_album.post_id = gallery_post.id
                            WHERE gallery_post.privacy = '1'
                            ORDER BY gallery_post.updated DESC");
                            */
                            $pictureDetail = [];
        $this->set('GalleryDetail', $pictureDetail);
    }
    public function album(){

    }
    public function getAlbumImage(){
        $this->autoRender = false;
        $postData = $this->request->data;
        $albumId = $postData['album_id'];
        $pictureAlbum = $this->Gallery->query("SELECT path FROM gallery_picture WHERE album_id like '$albumId'");
        echo json_encode($pictureAlbum);
    }
    public function editImageDetail(){
        $this->autoRender = false;
        $postData = $this->request->data;
        $this->GalleryDetail->save($postData);
        $this->redirect('myFile');
    }
    public function editPicture(){
        $this->autoRender = false;
        $postData = $this->request->data;
        if($postData){
            $id = $postData['id'];
            $data = $this->Gallery->query("SELECT *
                        FROM dopns.gallery_picture
                        WHERE dopns.gallery_picture.id = '$id'
                ");

            print_r(json_encode($data[0][0]));
        }
    }
    public function showImage(){
        $data = $this->params['url']['id'];
        $query = $this->UploadFile->query("SELECT * FROM upload_file WHERE id = '$data'");
        $data = $query[0][0];
        if( $data){
            $this->set("data", $data);
        }
    }
    public function deleteAllDir(){
        $this->autoRender = false;
        $dir = 'files/gallery.back';
        system('sudo rm -rf '.$dir);
        if(is_dir($dir)){
            rmdir($dir);
        }
    }
    public function deletePicture(){
        $this->autoRender = false;
        $user = "admin";
        $postData = $this->request->data;
        $pictureID = $postData['id'];
        $postID = $postData['post_id'];

        $user = "admin";
        $file = "files/gallery/$user/";
        $row = $this->GalleryDetail->query("Select * FROM gallery_picture WHERE id = '$pictureID' ");
        $pictureName = $row[0][0]['name'];
        $picturePath = $row.$pictureName;
        system('rm '.$picturePath);
        $this->GalleryDetail->delete($pictureID);
        $this->Gallery->delete($postID);
    }

    public function edit_album() {
        $id = $this->request->query['id'];
        //Album Detail
        $album = $this->GalleryAlbum->query("SELECT * FROM gallery_album WHERE id = '$id'");
        $this->set('album',$album[0]);

        //Get Picture
        $pictures = $this->GalleryDetail->query("SELECT * FROM gallery_picture WHERE album_id = '$id'");

        $this->set('pictures', $pictures);
    }
    public function deletePicAlbum(){
        $this->autoRender = false;
        $user = "admin";

        $postData = $this->request->data;
        $id = $postData['id'];
        $pictureName = $this->Gallery->query("SELECT name FROM gallery_picture WHERE id = '$id'");
        $pictureName = $pictureName[0][0]['name'];

        $picturePath = "files/gallery/$user/".$postData['album_name']."/".$pictureName;
        system('rm '.$picturePath);
        $this->GalleryDetail->delete($id);
    }

    public function uploadPictureAlbum(){
        $this->autoRender = false;
        $postData = $this->request->data;
        $user = "admin";
        $albumPath = 'files/gallery/'.$user."/".$postData['album_name']."/";
        if(!is_dir($albumPath)){
            mkdir($albumPath,0777);
        }
        for($i=0; $i<count($_FILES['files']['name']); $i++){
            if($_FILES['files']['error'][$i] == 0){
                $picTable = [
                    "id" => uniqid(),
                    "name" => $_FILES['files']['name'][$i],
                    "album_id" => $postData['album_id'],
                    "size" => $_FILES['files']['size'][$i],
                    "path" => $albumPath.$_FILES['files']['name'][$i],
                    "post_id" => $postData['post_id']
                ];
                $this->GalleryDetail->save($picTable);
                move_uploaded_file( $_FILES['files']['tmp_name'][$i], $albumPath.$_FILES['files']['name'][$i]);
                chmod($albumPath.$_FILES['files']['name'][$i], 0777);
            }
        }
        $albumTable = [
            "id" => $postData['album_id'],
            "album_name" => $postData['album_name'],
            "album_description" => $postData['album_description'],
            "album_location" => $postData['album_location'],

        ];
        $this->GalleryAlbum->save($albumTable);
        $date = new DateTime();
        $postTable = [
            'id' => $postData['post_id'],
            'updated' => $date->format('Y-m-d H:i:s')
        ];
        $this->GalleryAlbum->save($postTable);
        $this->redirect('myFile');


    }

    public function deleteAlbum(){
        $this->autoRender = false;
        $postData = $this->request->data;
        $user = "admin";
        $path = "files/gallery/".$user;
        $albumID = $postData['albumID'];


        $album = $this->GalleryAlbum->query("SELECT * FROM gallery_album WHERE id = '$albumID'");
        $albumName = $album[0][0]['album_name'];
        $albumPath = $path."/".$albumName;
        if(!rmdir($albumPath)){
            system('rm -rf '.$albumPath);
        }
        $this->GalleryDetail->query("DELETE FROM gallery_picture WHERE album_id = '$albumID'");
        $this->Gallery->delete($postData['postID']);
        $this->GalleryDetail->query("DELETE FROM gallery_picture WHERE album_id = '$albumID'");
        $this->GalleryAlbum->delete($postData['albumID']);

    }



    public function uploadPicture(){
        $this->autoRender = false;
        $postData = $this->request->data;
        $user = 'admin';
        $userDir = "files/gallery/".$user;
        if(is_dir($userDir)){}
        else{
            mkdir($userDir);
        }
        //   print_r($_FILES);
        //   return;
        if($postData['isalbum'] == "0"){
            $date = new DateTime();
            if($postData['GalleryVideo'][0]['error'] == "0"){
                $postTable = [
                    'id' => uniqid(),
                    'privacy' => $postData['privacy'],
                    'created' => $date->format('Y-m-d H:i:s'),
                    'updated' => $date->format('Y-m-d H:i:s'),
                    'isalbum' => $postData['isalbum'],
                    'user_id' => '1',
                    'type' => 'video',
                    'deleted' => 'N'
                ];
                $this->Gallery->create();
                $this->Gallery->save($postTable);
                for( $i=0; $i<count($postData['GalleryVideo']); $i++){
                    $uploadDir = 'files/gallery/'.$user;
                    $uploadFile = $uploadDir."/".date('u').".mp4";;
                    if(is_dir($uploadDir)){
                    }
                    else{
                        mkdir($uploadDir, 0777);
                    }
                    if(move_uploaded_file($postData['GalleryVideo'][$i]['tmp_name'], $uploadFile)){
                        chmod($uploadFile, 0777);
                        $videoTable = [
                            'id' => uniqid(),
                            'name' => $postData['GalleryVideo'][$i]['name'],
                            'path' => $uploadFile,
                            'size' => $postData['GalleryVideo'][$i]['size'],
                            'post_id' => $postTable['id'],
                            'location' => $postData['location'],
                            'description' => $postData['description']
                        ];
                        $this->GalleryVideo->create();
                        $this->GalleryVideo->save($videoTable);
                    }
                }
            }
            if($postData['Gallery'][0]['error'] == 0){
                $postTable = [
                    'id' => uniqid(),
                    'privacy' => $postData['privacy'],
                    'created' => $date->format('Y-m-d H:i:s'),
                    'updated' => $date->format('Y-m-d H:i:s'),
                    'isalbum' => $postData['isalbum'],
                    'user_id' => '1',
                    'type' => 'picture',
                    'deleted' => 'N'
                ];
                $this->Gallery->create();
                $this->Gallery->save($postTable);
                for( $i=0; $i<count($postData['Gallery']); $i++){
                    $uploadDir = 'files/gallery/'.$user;
                    $uploadFile = $uploadDir."/".$postData['Gallery'][$i]['name'];
                    if(is_dir($uploadDir)){
                    }
                    else{
                        mkdir($uploadDir, 0777);
                    }
                    if(move_uploaded_file($postData['Gallery'][$i]['tmp_name'], $uploadFile)){
                        chmod($uploadFile, 0777);
                        $galleryTable = [
                            'id' => uniqid(),
                            'name' => $postData['Gallery'][$i]['name'],
                            'description' => $postData['description'],
                            'location' => $postData['location'],
                            'size' => $postData['Gallery'][$i]['size'],
                            'post_id' => $postTable['id'],
                            'path' => $uploadFile,
                            'deleted' => 'N'
                        ];
                        $this->GalleryDetail->create();
                        $this->GalleryDetail->save($galleryTable);
                    }
                }
            }
            if($postData['GalleryDocument'][0]['error'] == 0){
                $postTable = [
                    'id' => uniqid(),
                    'privacy' => $postData['privacy'],
                    'created' => $date->format('Y-m-d H:i:s'),
                    'updated' => $date->format('Y-m-d H:i:s'),
                    'isalbum' => $postData['isalbum'],
                    'user_id' => '1',
                    'type' => 'document',
                    'deleted' => 'N'
                ];
                $this->Gallery->create();
                $this->Gallery->save($postTable);
                for( $i=0; $i<count($postData['GalleryDocument']); $i++){
                    $uploadDir = 'files/gallery/'.$user."/document";
                    $uploadFile = $uploadDir."/".$postData['GalleryDocument'][$i]['name'];
                    if(is_dir($uploadDir)){
                    }
                    else{
                        mkdir($uploadDir, 0777);
                    }
                    if(move_uploaded_file($postData['GalleryDocument'][$i]['tmp_name'], $uploadFile)){
                        chmod($uploadFile, 0777);
                        $documentTable = [
                            'id' => uniqid(),
                            'name' => $postData['GalleryDocument'][$i]['name'],
                            'path' => $uploadFile,
                            'size' => $postData['GalleryDocument'][$i]['size'],
                            'post_id' => $postTable['id'],
                            'location' => $postData['location'],
                            'description' => $postData['description']
                        ];
                        $this->GalleryDocument->create();
                        $this->GalleryDocument->save($documentTable);
                    }
                }
            }
            $this->redirect('index');
        }
        elseif($postData['isalbum'] == "1"){
            $date = new DateTime();
            $postTable = [
                'id' => uniqid(),
                'privacy' => $postData['privacy'],
                'created' => $date->format('Y-m-d H:i:s'),
                'updated' => $date->format('Y-m-d H:i:s'),
                'isalbum' => $postData['isalbum'],
                'user_id' => '1',
                'type' => 'picture',
                'deleted' => 'N'
            ];
            $this->Gallery->create();
            $this->Gallery->save($postTable);

            $albumTable = [
                'id' => uniqid(),
                'album_name' => $postData['album'],
                'album_description' => $postData['description'],
                'album_location' => $postData['location'],
                'post_id' => $postTable['id']
            ];
            $this->GalleryAlbum->create();
            $this->GalleryAlbum->save($albumTable);
            /*
            print_r($_POST);
            echo "<hr />";
            print_r($_FILES);
            return;
            */
            for($i=0; $i<count($_FILES['files']['name']); $i++){
                $uploadDir = 'files/gallery/'.$user;
                $dirAlbum = $uploadDir."/".$albumTable['album_name'];
                $uploadFile = $dirAlbum."/".$_FILES['files']['name'][$i];
                if(is_dir($dirAlbum)){
                }
                else{
                    mkdir($dirAlbum, 0777);
                }
                if(move_uploaded_file($_FILES['files']['tmp_name'][$i], $uploadFile)){
                    chmod($uploadFile, 0777);
                    $galleryTable = [
                        'id' => uniqid(),
                        'name' => $_FILES['files']['name'][$i],
                        'description' => $postData['description'],
                        'location' => $postData['location'],
                        'size' => $_FILES['files']['size'][$i],
                        'post_id' => $postTable['id'],
                        'path' => $uploadFile,
                        'deleted' => 'N',
                        'album_id' => $albumTable['id']
                    ];
                    $this->GalleryDetail->create();
                    $this->GalleryDetail->save($galleryTable);
                }
            }
            $this->redirect('index');
        }


    }

    public function myFile(){

        $data = $this->Gallery->query("SELECT *
                FROM dopns.gallery_post
                FULL JOIN dopns.gallery_picture ON post_id = gallery_post.id
                WHERE gallery_post.isalbum = 0 AND gallery_post.type = 'picture'
                ");
        $album = $this->Gallery->query("SELECT *
                FROM dopns.gallery_post
                FULL JOIN dopns.gallery_album ON gallery_album.post_id = gallery_post.id
                WHERE gallery_post.isalbum = 1");
        $this->set('picture',$data);
        $this->set('albums',$album);
    }

    public function showAlbum(){
        $id = $this->request->query('id');
        $pictures = $this->GalleryDetail->query("SELECT * FROM gallery_picture WHERE album_id = '$id'");
        $album = $this->GalleryDetail->query("SELECT * FROM gallery_album WHERE id = '$id' ");
        $this->set('album', $album[0][0]);
        $this->set('pictures', $pictures);

    }

    public function document(){
        $query = $this->GalleryDocument->query("SELECT * FROM gallery_document");
        $this->set('document', $query);

    }
    public function uploadDocument(){
        $this->autoRendar = false;
        $postData = $this->request->data;
        $user = 'admin';
        for($i=0; $i<count($postData['Document']); $i++){
            $uploadDir = 'files/gallery/'.$user.'/document';
            $uploadFile = $uploadDir."/".$postData['Document'][$i]['name'];
            if(is_dir($uploadDir)){
            }
            else{
                mkdir($uploadDir, 0777);
            }
            if(move_uploaded_file($postData['Document'][$i]['tmp_name'], $uploadFile)){
                chmod($uploadFile, 0777);
                $date = new DateTime();
                $documentTable = [
                    'id' => uniqid(),
                    'name' => $postData['Document'][$i]['name'],
                    'size' => $postData['Document'][$i]['size'],
                    'path' => $uploadFile,
                    'created_at' => $date->format('Y-m-d H:i:s')
                ];
                $this->GalleryDocument->create();
                $this->GalleryDocument->save($documentTable);
            }
        }
        $this->redirect("document");
    }
    public function deleteDocument(){
        $this->autoRender = false;
        $postData = $this->request->data;
        if($postData){
            $this->GalleryDocument->delete($postData);
        }
    }
    public function video(){
        $query = $this->GalleryDocument->query("SELECT * FROM gallery_video");
        $this->set('video', $query);
    }
    public function deleteVideo(){
        $this->autoRender = false;
        $postData = $this->request->data;
        if($postData){
            $this->GalleryVideo->delete($postData);
        }
    }
    public function loadVideo(){
        $postData = $this->request->data;
    }



    public function uploadVideo(){
        $this->autoRendar = false;
        $postData = $this->request->data;
        $user = 'admin';
        for($i=0; $i<count($postData['Video']); $i++){
            $date = new DateTime();
            $uploadDir = 'files/gallery/'.$user.'/Video';
            $uploadFile = $uploadDir."/".uniqid().".mp4";
            if(is_dir($uploadDir)){
            }
            else{
                mkdir($uploadDir, 0777);
            }
            if(move_uploaded_file($postData['Video'][$i]['tmp_name'], $uploadFile)){
                chmod($uploadFile, 0777);
                $videoTable = [
                    'id' => uniqid(),
                    'name' => $postData['Video'][$i]['name'],
                    'size' => $postData['Video'][$i]['size'],
                    'path' => $uploadFile,
                    'created_at' => $date->format('Y-m-d H:i:s')
                ];
                $this->GalleryVideo->create();
                $this->GalleryVideo->save($videoTable);
            }
        }
        $this->redirect('video');
    }
    public function checkLimitUpload(){
        $this->autoRender = false;
        phpinfo();
    }
}
?>