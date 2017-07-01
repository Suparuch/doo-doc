<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function writehead($pagetitle) {
    require_once("lib.template_css.php");
    echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">";
    echo "<head>";
    echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=10;IE=9;IE=8;\"/>";
    echo "<meta http-equiv=\"Content-Type\" content=\"Text/html; charset=tis-620\"/>";
    echo "<meta http-equiv=\"content-type\" content=\"Text/html; charset=Windows-874\">";
    echo "<meta http-equiv=\"content-type\" content=\"application/x-javascript; charset=tis-620\">";
    //echo "<link href=\"${login_css}\" type=text/css rel=stylesheet>";
    echo "<title>";
    echo html($pagetitle);
    echo "</title>";
}

function createoption($optval, $selectedval = "", $txt = "-- Please select --") {
    $select = "";
    if ($optval === $selectedval) {
        $select = "SELECTED";
    }
    $opt = "<OPTION VALUE='" . $optval . "' " . $select . ">" . html($txt) . "</OPTION>";
    return $opt;
}

function html($plain) {
    $txt = htmlspecialchars($plain);
    return $txt;
}

function safetd($val) {
    return ifemptythen(trim($val), "&nbsp;");
}

function ifemptythen($val, $default) {
    if (($val == null) || (strlen($val) == 0) || ($val === false)) {
        return $default;
    } elseif ("$val" == "0.00") {
        return("-");
    } else {
        return $val;
    }
}

function redirect($location) {

    if (@$conn)
        @$conn->close();

    header("Location: $location");
    exit;
}

function debug($msg) {
    $tracestring = "";
    $backtrace = debug_backtrace();
    $count = count($backtrace);
    if ($count > 0)
        $tracestring = basename($backtrace[0]["file"]) . "[" . $backtrace[0]["line"] . "]";
    for ($i = 1; $i < $count; $i++)
        $tracestring .= "->" . basename($backtrace[$i]["file"]) . "[" . $backtrace[$i]["line"] . "]";
    echo "<hr><pre><b>DEBUG ($tracestring): </b>";
    echo $msg;
    echo "</pre><br/>";
    echo NL;
}

function debugdie($msg) {
    $tracestring = "";
    $backtrace = debug_backtrace();
    $count = count($backtrace);
    if ($count > 0)
        $tracestring = basename($backtrace[0]["file"]) . "[" . $backtrace[0]["line"] . "]";
    for ($i = 1; $i < $count; $i++)
        $tracestring .= "->" . basename($backtrace[$i]["file"]) . "[" . $backtrace[$i]["line"] . "]";
    echo "<hr><pre><b>DEBUG ($tracestring): </b>";
    echo $msg;
    echo "</pre><br/>";
    echo NL;
    die;
}

function ucase($txt) {
    $out = "";
    $len = strlen($txt);
    for ($i = 0; $i < $len; $i++) {
        $c = substr($txt, $i, 1);
        if ($c >= "a" && $c <= "z")
            $c = strtoupper($c);
        $out .= $c;
    }
    return $out;
}

function debugr($arrname, $arr) {
    $tracestring = "";
    $backtrace = debug_backtrace();
    $count = count($backtrace);
    if ($count > 0)
        $tracestring = basename($backtrace[0]["file"]) . "[" . $backtrace[0]["line"] . "]";
    for ($i = 1; $i < $count; $i++)
        $tracestring .= "->" . basename($backtrace[$i]["file"]) . "[" . $backtrace[$i]["line"] . "]";
    echo "<hr><pre><b>DEBUG ($tracestring): </b>";
    echo "arrname=$arrname<br/>";
    print_r($arr);
    echo "</pre><br/>";
    echo NL;
}

function debugrdie($arrname, $arr) {
    $tracestring = "";
    $backtrace = debug_backtrace();
    $count = count($backtrace);
    if ($count > 0)
        $tracestring = basename($backtrace[0]["file"]) . "[" . $backtrace[0]["line"] . "]";
    for ($i = 1; $i < $count; $i++)
        $tracestring .= "->" . basename($backtrace[$i]["file"]) . "[" . $backtrace[$i]["line"] . "]";
    echo "<hr><pre><b>DEBUG ($tracestring): </b>";
    echo "arrname=$arrname<br/>";
    print_r($arr);
    echo "</pre><br/>";
    echo NL;
    die;
}

function reqvar($varname) {
    return @$_REQUEST[$varname];
}

function reqvarcs($varname) {
    return trim(@$_REQUEST[$varname]);
}

function getvar($varname) {
    return @$_GET[$varname];
}

function postvar($varname) {
    return @$_POST[$varname];
}

function fprintln($fh, $line) {
    fwrite($fh, "$line\n");
}

function toint($var) {

    return $var * 1;
}

function servervar($varname) {

    return @$_SERVER[$varname];
}

function encryptpassword($username, $password) {

    die(md5("BEA2/" . lcase($username) . "/" . $password));
    return md5("BEA2/" . lcase($username) . "/" . $password);
}

function convTisToUtf8($str) {
    $result = null;
    if (is_array($str)) {
        foreach ($str as $key => $val) {
            if (is_array($val)) {
                $val = convertToUTF8($val);
            } else {
                if (!is_utf8($val)) {
                    $val = iconv('TIS620', 'UTF-8//IGNORE', $val);
                }
            }
            $result[$key] = $val;
        }
    } else {
        if (!is_utf8($str)) {
            $result = iconv('TIS620', 'UTF-8//IGNORE', $str);
        } else {
            $result = $str;
        }
    }
    return $result;
}

function convUtf8ToTis($str) {
    $result = null;
    if (is_array($str)) {
        foreach ($str as $key => $val) {
            if (is_array($val)) {
                $val = convertToTis($val);
            } else {
                if (is_utf8($val)) {
                    $val = iconv('UTF-8', 'TIS620//IGNORE', $val);
                }
            }
            $result[$key] = $val;
        }
    } else {
        if (is_utf8($str)) {
            $result = iconv('UTF-8', 'TIS620//IGNORE', $str);
        } else {
            $result = $str;
        }
    }
    return $result;
}

function is_utf8($str) {
    $c = 0;
    $b = 0;
    $bits = 0;
    $len = strlen($str);
    for ($i = 0; $i < $len; $i++) {
        $c = ord($str[$i]);
        if ($c > 128) {
            if (($c >= 254))
                return false;
            elseif ($c >= 252)
                $bits = 6;
            elseif ($c >= 248)
                $bits = 5;
            elseif ($c >= 240)
                $bits = 4;
            elseif ($c >= 224)
                $bits = 3;
            elseif ($c >= 192)
                $bits = 2;
            else
                return false;
            if (($i + $bits) > $len)
                return false;
            while ($bits > 1) {
                $i++;
                $b = ord($str[$i]);
                if ($b < 128 || $b > 191)
                    return false;
                $bits--;
            }
        }
    }
    return true;
}

function lcase($txt) {
    $out = "";
    $len = strlen($txt);
    for ($i = 0; $i < $len; $i++) {
        $c = substr($txt, $i, 1);
        if ($c >= "A" && $c <= "Z")
            $c = strtolower($c);
        $out .= $c;
    }
    return $out;
}

function hashfilename($filename){
    if(strlen($filename) != 0){
        return hash("crc32",$filename);
    } else {
        return false;
    }
}

function validateFileType($file){
    $allow_extension = array("TXT","LOG","CSV","XLS","XLSX","XML" );
    $file_array = explode(".",$file);
    if(in_array(strtoupper($file_array[count($file_array)-1]),$allow_extension)){
        return true;
    } else {
        return false;
    }            
}

function filenameList($target_dir){
    $listfile = array();
    if($handle = @opendir($target_dir)){
        
        while(false !== ($file = readdir($handle))){
           if(validateFileType($file) === true ){
               $listfile[] = $file;
           }
        }
        closedir($handle);
    }
    sort($listfile);
    return $listfile;
}

function modYear($year){
    $mod = "";
    if(strlen($year) == 0){
        return false;
    }
    try{
        $mod = fmod($year, 4);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    } 
    return $mod;
}