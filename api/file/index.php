<?php

$input = file_get_contents('php://input');
$input = json_decode($input, true);

if (!isset($input['id'])) {
    // エラー処理
}
$id = $input['id'];

// 2018-12-31_12-34-56
if (strlen($id) !== 19) {
    // エラー処理
}
if (!preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}_[0-9]{2}-[0-9]{2}-[0-9]{2}/")) {
    // エラー処理
}

if (!isset($input['type'])) {
    // エラー処理
}
$type = $input['type'];

$base_dir = '/root/starc.log/';
$folder = $base_dir . $id;
$file_path = null;
if ($type === 'pcap') {
    $file_path = $folder . '/traffic.pcap';
} else if ($type === 'saz') {
    $file_path = $folder . '/fiddler.saz';
}

if (!file_exists($file_path)) {
    return null;
}
return file_get_contents($file_path);
