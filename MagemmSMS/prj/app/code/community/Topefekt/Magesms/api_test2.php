<?php
    $url_address = ""; //write url of your eshop, without http://

    $to = "447971796595"; // number, in international format, no leading zeros or a “+” sign, e.g., 447971796595
    $text = "hello world"; // SMS text
    $unicode=0; // unicode yes=1, no=0
    $key = ""; // security key from module configuration

    $status = "";
    $query = "to=".urlencode($to)."&text=".urlencode($text)."&unicode=".$unicode."&key=".$key;

    function URLopen($url)
    {
        $dh = fopen("$url",'r');
        $result = fread($dh, 8192);
        return $result;
    }

    $data = @URLopen("http://".$url_address."/magesms/api?".$query);

    if (!$data)
    {
        die("Not connected");
    }
    else
    {
        $res = $data;
        if(preg_match("/SMSSTATUS:OK/i",$res))
        {
            $status = "OK";
        }
        if(preg_match ("/SMSSTATUSERROROK:OK/i",$res))
        {
            $status = "ERROR";
        }
    }

    echo "status: ".$status; //print status of SMS sending
