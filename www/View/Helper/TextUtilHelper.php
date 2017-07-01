<?php

/* /app/View/Helper/DateFormatHelper.php */
App::uses('AppHelper', 'View/Helper');

class TextUtilHelper extends AppHelper {

    public function getSecretName($secretCode) {
        $result = "";
        switch ($secretCode) {
            case "9": $result = "ไม่ระบุ";
                break;
            case "0":$result = "ไม่ลับ";
                break;
            case "1":$result = "ลับ";
                break;
        }
        return $result;
    }
    
    public function getCurrDateForPckDate(){
        return date('d')."/".date('m')."/".date('Y');
    }
    
    public function formatSqlDateForPckDate($sqlDate){
        $result = "";
        if($sqlDate != ""){
            list($date, $time) = explode(" ", $sqlDate);
            list($yyyy, $mm, $dd) = explode("-", $date);
            $result = $dd."/".$mm."/".$yyyy;
        }
        return $result;
    }
    
    public function formatPckDateForWhereCond($pckStrDate){
        $result = "";
        if($pckStrDate != ""){
            list($dd, $mm, $yyyy) = explode("/", $pckStrDate);
            $result = $yyyy."-".$mm."-".$dd;
        }
        return $result;
    }
    
    // $currFlag = 'Y','M'
    public function getSearchDefaultStartDate($currFlag = "Y"){
        $result = "";
        if($currFlag == "Y"){
            $result = "01/01/".date("Y");
        }else{
            $result = "01/".date("m")."/".date("Y");
        }
        return $result;
    }
    
    // $currFlag = 'Y','M'
    public function getSearchDefaultEndDate($currFlag = "Y"){
         $result = "";
        if($currFlag == "Y"){
            $result = "31/12/".date("Y");
        }else{
            $result = cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"))."/".date("m")."/".date("Y");
        }
        return $result;
    }
    
    public function getMonthName($monthCode){
        $result = "";
        switch ($monthCode){
            case "1":case "01":
                $result = "มกราคม";
                break;
            case "2":case "02":
                $result = "กุมภาพันธ์";
                break;
            case "3":case "03":
                $result = "มีนาคม";
                break;
            case "4":case "04":
                $result = "เมษายน";
                break;
            case "5":case "05":
                $result = "พฤษภาคม";
                break;
            case "6":case "06":
                $result = "มิถุนายน";
                break;
            case "7":case "07":
                $result = "กรกฎาคม";
                break;
            case "8":case "08":
                $result = "สิงหาคม";
                break;
            case "9":case "09":
                $result = "กันยายน";
                break;
            case "10":
                $result = "ตุลาคม";
                break;
            case "11":
                $result = "พฤศจิกายน";
                break;
            case "12":
                $result = "ธันวาคม";
                break;
            
        }
        return $result;
    }
    
    function thainumDigit($num) {
        return str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), array("o", "๑", "๒", "๓", "๔", "๕", "๖", "๗", "๘", "๙"), $num);
    }

}
