<?php
    function _http_post($url, $param=array()){
        if(is_array($param)){
            $param = _formatArrayToFormData($param);
        }
        
        $httph = curl_init($url);
        curl_setopt($httph, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($httph, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($httph, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($httph, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.3319.102 Safari/537.36");
        curl_setopt($httph, CURLOPT_POST, 1);
        curl_setopt($httph, CURLOPT_TIMEOUT, 20);
        curl_setopt($httph, CURLOPT_POSTFIELDS, $param);
        curl_setopt($httph, CURLOPT_HEADER,0);
        $rst = curl_exec($httph);
        curl_close($httph);
        return $rst;
    }

    function _formatArrayToFormData($param){
        $result = array();
        foreach ($param as $i => $value) {
            $result[] = $i.'='.$value;
        }
        return join('&', $result);
    }

    function _getRandomCode($length = 4){
        $str = null;
        $strPol = "abcdefghijklmnopqrstuvwxyz0123456789";
        $max = strlen($strPol) - 1;
        for($i = 0; $i < $length; $i++){
            $str.=$strPol[rand(0,$max)];
        }
        return $str;
    }

    function _log($msg) {
        $logFile = fopen("./log.txt", "w") or die("unable to open log file.");
        $logText = date('Y-m-d H:i:s') . " -> " . $msg;
        fwrite($logFile, $logText);
    }
?>