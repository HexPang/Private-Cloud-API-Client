<?php

include "src/hexpang/Client/CloudAPIClient.php";

use hexpang\Client\CloudAPIClient;
$client = new CloudAPIClient('a5cUPgIotrUJfbdvvDieLkw2LA2yLcDA');
var_dump( $client->KeySet('test','ahahaha'));
var_dump( $client->KeyGet('test') );
?>
