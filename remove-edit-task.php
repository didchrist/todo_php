<?php
$filename = './data/data.json';
$_POST = filter_input_array(INPUT_POST, [
    "supprimer" => ['filter' => FILTER_VALIDATE_INT],
    "editer" => ['filter' =>  FILTER_VALIDATE_INT],
]);
$id_supp= $_POST['supprimer'] ?? "";
$id_edit = $_POST['editer'] ?? "";


if ($id_supp) {
    $todos = json_decode(file_get_contents($filename), true) ?? [];
    if (count($todos)) {
        $taskIndex = array_search($id_supp, array_column($todos, 'id'));
        array_splice($todos, $taskIndex, 1);
        file_put_contents($filename, json_encode($todos));
    }
}


if ($id_edit) {
    $data = file_get_contents($filename);
    $todos = json_decode($data, true) ?? [];
    
    if (count($todos)) {
        $taskIndex = array_search($id_edit, array_column($todos, 'id'));
        $todos[$taskIndex]['done'] = !$todos[$taskIndex]['done'];
        file_put_contents($filename, json_encode($todos));
    }
}
header('Location: ./');