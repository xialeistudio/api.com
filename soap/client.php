<?php
/**
 * Project: api.com
 * User: xialeistudio
 * Date: 2016/11/23 0023
 * Time: 22:21
 */
$client = new SoapClient(null, [
    'location' => 'http://api.com/soap/server.php',
    'uri' => 'api',
    'login'=>'admin4',
    'password'=>'admin4'
]);
echo $client->articleList(1,2);