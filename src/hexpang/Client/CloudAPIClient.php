<?php
namespace hexpang\Client;

class CloudAPIClient{
    var $app_id;
    var $API_URL;
    public function __construct($app_id)
    {
      $this->API_URL = 'http://localhost:8000/';
        $this->app_id = $app_id;
    }
    private function API_POST($url,$data){
      $sign = md5($this->app_id . $data);
      $data['sign'] = $sign;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/601.7.7 (KHTML, like Gecko) Version/9.1.2 Safari/601.7.7');
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_AUTOREFERER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $result = curl_exec($ch);
      curl_close($ch);
      return $result;
    }
    private function API_GET($url){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/601.7.7 (KHTML, like Gecko) Version/9.1.2 Safari/601.7.7');
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($ch, CURLOPT_POST, false);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_AUTOREFERER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $result = curl_exec($ch);
      curl_close($ch);
      return $result;
    }
    public function KeyGet($key){
      $url = $this->API_URL . "api/{$this->app_id}/{$key}"
      $result = $this->API_GET($url);
      return json_encode($result,true);
    }
    public function KeySet($key,$data){
        $url = $this->API_URL . "api/{$this->app_id}/{$key}/";
        $data = json_encode($data);
        $data = urlencode($data);
        $sign = md5($this->app_id . $data);
        $result = $this->API_POST($url,['data'=>$data]);
        return json_decode($result,true);
    }
}
?>
