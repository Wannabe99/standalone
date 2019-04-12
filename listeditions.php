<?php
$lang = isset($argv[1]) ? $argv[1] : 'en-us';
$updateId = isset($argv[2]) ? $argv[2] : 0;

require_once dirname(__FILE__).'/api/listeditions.php';

$editions = uupListEditions($lang, $updateId);
if(isset($editions['error'])) {
    throwError($editions['error']);
}

$editions = $editions['editionFancyNames'];
asort($editions);

foreach($editions as $key => $val) {
    echo $key;
    echo '|';
    echo $val;
    echo "\n";
}
?>
