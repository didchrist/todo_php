<?php
// $task = '';
$todos = [];
if (file_exists($filename)) {
    $data = file_get_contents($filename);
    $todos = json_decode($data, true) ?? [];
}

// Condition pour vérifier la méthode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Filtre pour sécuriser les input du formulaire
    $_POST = filter_input_array(INPUT_POST, [
        'task' => [
            'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_BACKTICK
        ]
    ]);
    // Récupération de la valeur et stocker dans une variable
    $task = $_POST['task'] ?? '';

    // Condition pour la gestion des erreurs et du cas succés
    if (!$task) {
        $errors['task'] = ERROR_REQUIRED;
    } elseif (mb_strlen($task) < 5) {
        $errors['task'] = ERROR_TOO_SHORT;
    } elseif (mb_strlen($task) > 200) {
        $errors['task'] = ERROR_TOO_LONG;
    } elseif ($task) {
        $validation['task'] = VALIDATION;
    }

    if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
        $todos = [...$todos, [
            'task' => $task,
            'done' => false,
            'id' => time(),
        ]];
        file_put_contents($filename, json_encode($todos));
        $task = '';
    }
}
?>