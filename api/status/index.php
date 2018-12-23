<?php

$input = file_get_contents('php://input');
$input = json_decode($input, true);

if (!isset($input['vm_name'])) {
    // エラー処理
}
$vm_name = $input['vm_name'];

if (!isset($input['id'])) {
    // エラー処理
}
$id = $input['id'];

exec('vboxmanage list runningvms', $out, $ret);
if (is_array($out)) {
    $out = implode("\n", $out);
}

header('Content-Type: application/json');
if (strpos($out, $vm_name) !== false) {
    echo json_encode(['is_running' => true]);
} else {
    echo json_encode(['is_running' => false]);
}
