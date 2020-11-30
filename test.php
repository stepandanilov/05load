<!DOCTYPE html>
<html lang="ru">
<meta charset="utf-8">
<body>
<h1>!Вашафамилия!</h1>
<?php
$iter = 100000;
$salt = openssl_random_pseudo_bytes(16);
$hash = hash_pbkdf2("sha256", "password", $salt, $iter);
echo $hash . "<b> reported by </b>" . gethostname(); 
?>
<h1>Значение тега name</h1>
<?php
require('vendor/autoload.php');
$sdk = new Aws\Sdk(['region' => 'us-east-1', 'version' => 'latest']);
$ec2 = $sdk->createEC2();
$args = array('Filters' =>
          array(
            array('Name'=>'key',
                  'Values'=>array('name')
            ),
            array('Name'=>'resource-type',
                  'Values'=>array('instance')
            )
          )
        );
$result = $ec2->describeTags($args);
$nametag = $result['Tags'][0]['Value'];
echo "name=" . $nametag;
?>
</body>
</html>
