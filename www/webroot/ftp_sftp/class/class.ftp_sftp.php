<?php
class ftp_sftp {

//determine, if ssh, to use phpseclib or php's inbuilt ssh_sftp 'libssh'
    public $ssh_type = 'phpseclib';
//    public $ssh_type = 'libssh2';
//set ths path to the directory containing the entire phpseclib files
    public $phpseclib_path = '../scripts/phpseclib0.3.10';// ส่วนนี้เอาไว้สำหรับแก้ไข path ของ phpseclib0.3.10 
//private vars generated by this class
    public $host;
    public $username;
    public $password;
    public $connection_type;
    public $port_number;
    public $connection = false;

//contruct method which will attempt to set the connection details and automatically attempt to establisha connection to the server
    public function __construct($host, $username, $password, $connection_type, $port_number = false) {
        $realpath = str_replace('\\', '/', realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'/').'/'); 
		//add the webroot to the beginning of the $this->phpseclib_path (this is bespoke to my own configuration)
        $this->phpseclib_path = $realpath . $this->phpseclib_path;
		echo $this->phpseclib_path;
        //setting the classes vars
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->connection_type = $connection_type;

        //set the port number to defaults based on connection type if none passed
        if ($port_number === false) {
            if ($connection_type == 'ftp') {
                $port_number = 21;
            } else {
                if($target_port == ""){
                    $port_number = 22;
                }
            }
        }
        $this->port_number = $port_number;

        //now set the server connection into this classes connection var
        $this->connection = $this->connect();
    }

//tests the details passed and tries to establish a connection, returns false on fail.
    function connect() {
//        br($this->connection_type);
        switch ($this->connection_type) {
            case 'ftp':
                $connection = ftp_connect($this->host);
                $login = ftp_login($connection, $this->username, $this->password);

                //if no connection was possible return false and leave $this-connection as false
                if (!$connection || !$login) {
                    return false;
                } else {
                    // enabling passive mode
                    ftp_pasv($connection, true);
                    return $connection;
                }
                break;

            case 'sftp':
                //decide which ssh type to use
                switch ($this->ssh_type) {
                    case 'phpseclib':
                        //inlcude the phpseclib path in the include array and include the ssh2 class
                        set_include_path($this->phpseclib_path);
                        
                        if (!include('Net/SSH2.php')) {
                            echo 'Sorry failed to load SSH2 class';
//                            br();
                        }
                        if (!include('Net/SFTP.php')) {
                            echo 'Sorry failed to load SFTP class';
//                            br();
                        }

                        $connection = new Net_SFTP($this->host, $this->port_number);
                        $login = $connection->login($this->username, $this->password);
                        break;

                    case 'libssh2':
                        $connection = ssh2_connect($this->host, $this->port_number);
                        $login = ssh2_auth_password($connection, 'username', 'secret');
                        break;

                    default:
                        echo 'No ssh method defined, please define one in: $ftp_sftp->ssh_type';
                        exit();
                        break;
                }


                //if no connection was possible return false and leave $this-connection as false
                if (!$connection || !$login) {
                    return false;
                } else {
                    return $connection;
                }
                break;

            default: echo 'No connection type set cannot choose a method to connect';
                break;
        }
    }

//acces the phpseclib errors
    public function errors() {
        if ($this->connection_type == 'sftp' && $this->ssh_type == 'phpseclib') {
            print_r($this->connection->getErrors());
        } else {
            echo 'no error logs available';
        }
    }

//function used by this class to check certain values are set
    public function connection_check() {
        if ($this->connection === false) {
            echo 'Sorry there seems to be a connection problem please try again';
//            br();
        }

        if ($this->connection_type === false) {
            echo 'Sorry there seems to be a no connection type set';
        }

        if ($this->connection === false || $this->connection_type === false) {
            exit();
        }
    }

//transfers a file to the connected server
    public function put($targetLocationToSendTo, $existingLocationToSendFrom) {

        //check the connection
        $this->connection_check();

        switch ($this->connection_type) {
            case 'ftp':
                //ftp_put the file across
                $put = ftp_put($this->connection, $targetLocationToSendTo, $existingLocationToSendFrom, FTP_BINARY);
                break;

            case 'sftp':
                //decide which ssh type to use
                switch ($this->ssh_type) {
                    case 'phpseclib':
                        $put = $this->connection->put($targetLocationToSendTo, $existingLocationToSendFrom, NET_SFTP_LOCAL_FILE);
                        break;

                    case 'libssh2':
                        $put = ssh2_scp_send($this->connection, $targetLocationToSendTo, $existingLocationToSendFrom, 0755);
                        break;
                }
                break;
        }

        return $put;
    }

//list the contents of a remote directory
    public function dir_list($dirToList) {

        //check the connection
        $this->connection_check();

        //run appropriate list
        switch ($this->connection_type) {
            case 'ftp':
                $list = $this->connection = ftp_nlist($this->connection, $dirToList);
                break;

            case 'sftp':
                //decide which ssh type to use
                switch ($this->ssh_type) {
                    case 'phpseclib':
                        $list = $this->connection->nlist($dirToList);
                        break;

                    case 'libssh2':
                        echo 'Sorry there is no support for nlist with libssh2, however this link has a possible answer: http://randomdrake.com/2012/02/08/listing-and-downloading-files-over-sftp-with-php-and-ssh2/';
                        break;
                }
                break;
        }

        return $list;
    }

//get the timestamp of the file on another server
    public function remote_filemtime($pathToFile) {

        //check the connection
        $this->connection_check();

        //run appropriate list
        switch ($this->connection_type) {
            case 'ftp':
                $timeStamp = ftp_mdtm($this->connection, $pathToFile);
                break;

            case 'sftp':
                //decide which ssh type to use
                switch ($this->ssh_type) {
                    case 'phpseclib':
                        $statinfo = $this->connection->stat($pathToFile);
                        break;

                    case 'libssh2':
                        $statinfo = ssh2_sftp_stat($this->connection, $pathToFile);
                        break;
                }

                if ($statinfo['mtime']) {
                    $timeStamp = $statinfo['mtime'];
                } else {
                    $timeStamp = false;
                }
                break;
        }

        return $timeStamp;
    }

//make a directory on the remote server
    public function make_dir($dirToMake) {
        //check the connection
        $this->connection_check();

        //run appropriate list
        switch ($this->connection_type) {
            case 'ftp':
                $dir_made = ftp_mkdir($this->connection, $dirToMake);
                break;

            case 'sftp':
                //decide which ssh type to use
                switch ($this->ssh_type) {
                    case 'phpseclib':
                        $statinfo = $this->connection->mkdir($dirToMake);
                        break;

                    case 'libssh2':
                        $statinfo = ssh2_sftp_mkdir($this->connection, $dirToMake, 0755);
                        break;
                }
                break;
        }

        return $dir_made;
    }

//change directory
    public function change_dir($dirToMoveTo) {
        //check the connection
        $this->connection_check();

        //run appropriate list
        switch ($this->connection_type) {
            case 'ftp': $chdir = ftp_chdir($this->connection, $dirToMoveTo);
                break;

            case 'sftp':
                //decide which ssh type to use
                switch ($this->ssh_type) {
                    case 'phpseclib':
                        $chdir = $this->connection->chdir($dirToMoveTo);
                        break;

                    case 'libssh2':
                        echo 'Sorry this feature does exist yet for when using libssh2 with the ftp_sftp class';
                        exit();
                        break;
                }
                break;
        }

        return $chdir;
    }

//curent directory we are looking in
    public function pwd() {

        //check the connection
        $this->connection_check();

        //run appropriate list
        switch ($this->connection_type) {
            case 'ftp': $pwd = ftp_pwd($this->connection);
                break;

            case 'sftp':
                //decide which ssh type to use
                switch ($this->ssh_type) {
                    case 'phpseclib':
                        $pwd = $this->connection->pwd();
                        break;

                    case 'libssh2':
                        echo 'Sorry this feature does exist yet for when using libssh2';
                        exit();
                        break;
                }
                break;
        }

        return $pwd;
    }

//delete file
    public function delete_file($fileToDelete) {
        //check the connection
        $this->connection_check();

        //run appropriate list
        switch ($this->connection_type) {
            case 'ftp': $unlink = ftp_delete($this->connection, $fileToDelete);
                break;

            case 'sftp':
                //decide which ssh type to use
                switch ($this->ssh_type) {
                    case 'phpseclib':
                        $unlink = $this->connection->delete($fileToDelete);
                        break;

                    case 'libssh2':
                        $unlink = ssh2_sftp_unlink($this->connection, $fileToDelete);
                        break;
                }
                break;
        }

        return $unlink;
    }

}

//end of class
