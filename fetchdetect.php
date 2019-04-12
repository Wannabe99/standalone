<?php
$arch = isset($argv[1]) ? $argv[1] : 'amd64';
$ring = isset($argv[2]) ? $argv[2] : 'WIF';
$flight = isset($argv[3]) ? $argv[3] : 'Active';
$build = isset($argv[4]) ? intval($argv[4]) : 16251;
$minor = isset($argv[5]) ? intval($argv[5]) : 0;
$sku = isset($argv[6]) ? intval($argv[6]) : 48;

require_once dirname(__FILE__).'/api/fetchupd.php';
require_once dirname(__FILE__).'/shared/main.php';
require_once dirname(__FILE__).'/shared/genpack.php';

consoleLogger(brand('fetchupd'));

if(!get7ZipLocation()) {
    throwError('NO_7ZIP');
}

$fetchedUpdate = uupFetchUpd($arch, $ring, $flight, $build, $minor, $sku);
if(isset($fetchedUpdate['error'])) {
    throwError($fetchedUpdate['error']);
}

foreach($fetchedUpdate['updateArray'] as $update) {
    generatePack($update['updateId']);
}

echo $fetchedUpdate['foundBuild'];
echo '|';
echo $fetchedUpdate['arch'];
echo '|';
echo $fetchedUpdate['updateId'];
echo '|';
echo $fetchedUpdate['updateTitle'];
echo '|';
echo $fetchedUpdate['fileWrite'];
echo "\n";
?>
