<?php
/**
 * Created by PhpStorm.
 * User: kausersarker
 * Date: 12/19/15
 * Time: 2:42 PM
 */

namespace app\Logic;


class CurlManager
{
    protected $curlurl;

    protected $curl_data;

    public function SetCurlUrl($curlurl)
    {
        $this->curlurl = $curlurl;
    }

    public function SetCurlData($curl_data)
    {
        $this->curl_data = $curl_data;
    }


    public function ProcessCurl()
    {
        unset($this->curl_data["_token"]);
        //dd($this->curl_data);
        $ch = curl_init();
        $postvars = '';
        foreach($this->curl_data as $key=>$value) {
            $postvars .= $key . "=" . $value . "&";
        }
        curl_setopt($ch,CURLOPT_URL,$this->curlurl);
        curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
        curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
        curl_setopt($ch,CURLOPT_TIMEOUT, 20);
        $response = curl_exec($ch);
        //echo $response;
        curl_close ($ch);
        return $response;
    }


    public function ProcessUrlParams($params)
    {
        $str = array();
        foreach($params as $key=>$param)
        {
            $str[] = "$key=$param";
        }
        $str = implode("&",$str);
        return $str;
    }

    function ExecuteGet($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $data = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($code == 200)
            return $data;
        else
            return false;
    }
}