<?php
App::uses('Component', 'Controller');

class GeneratorComponent extends Component {

    public function getID(){
        $parts = explode(' ',microtime());
        $micro = $parts[0] * 1000000;
        
        return(substr(date('YmdHis'),2).sprintf("%06d",$micro));
    }

    public function getModelID(){
        $parts = explode(' ',microtime());
        $micro = $parts[0] * 1000000;
        
        return(substr(date('YmdHis'),2).sprintf("%06d",$micro));
    }

    public function getDivisionID(){
        $parts = explode(' ',microtime());
        $micro = $parts[0] * 1000000;
        
        return(substr(date('YmdHis'),2).sprintf("%06d",$micro));
    }

    public function getPositionID(){
        $parts = explode(' ',microtime());
        $micro = $parts[0] * 1000000;
        
        return(substr(date('YmdHis'),2).sprintf("%06d",$micro));
    }

    public function getPropertyID(){
        $parts = explode(' ',microtime());
        $micro = $parts[0] * 1000000;
        
        return(substr(date('YmdHis'),2).sprintf("%06d",$micro));
    }
    
    public function setLimit(){
        return 20;
    }
}
?>
