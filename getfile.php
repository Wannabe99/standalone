<?php
$updateId = isset($argv[1]) ? $argv[1] : null;
$file = isset($argv[2]) ? $argv[2] : null;

if(empty($updateId)) die('Unspecified update id');
if(empty($file)) die('Unspecified file');

require_once dirname(__FILE__).'/api/get.php';

$files = uupGetFiles($updateId, 0, 0);
if(isset($files['error'])) {
    throwError($files['error']);
}

$files = $files['files'];
$filesKeys = array_keys($files);

if(!isset($files[$file]['url'])) {
    throwError('NO_FILES');
}

echo $files[$file]['url']."\n";
echo '  out='.$file."\n";
echo '  checksum=sha-1='.$files[$file]['sha1']."\n\n";
?>
