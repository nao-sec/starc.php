<?php

$base_dir = '/root/starc.log/';
$shared_folder_name = 'share';

$input = file_get_contents('php://input');
$input = json_decode($input, true);

if (!isset($input['vm_name'])) {
    // エラー処理
}
$vm_name = $input['vm_name'];

if (!isset($input['url'])) {
    // エラー処理
}
$url = $input['url'];

if (!isset($input['id'])) {
    // エラー処理
}
$id = $input['id'];

$dt = date('Y-m-d_H-i-s');
$folder = $base_dir . $dt;
mkdir($folder);
exec('vboxmanage sharedfolder add "' . $vm_name . '" --name "' . $shared_folder_name . '" --hostpath "' . $folder . '" --automount', $out, $ret);
if ($ret !== 0) {
    echol("[!] Error, can't set shared folder");
    exit(-1);
}

// Write URL -> shared file
$filename = $folder . '/url.txt';
file_put_contents($filename, $url);

// Start Guest
echol('' . date("Y/m/d H:i:s") . ': Starting Guest VM...');
exec('vboxmanage startvm ' . $vm_name . ' > /dev/null &');

header('Content-Type: application/json');
echo json_encode(['id' => $dt]);
