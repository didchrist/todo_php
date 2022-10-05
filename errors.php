<?php
// Constantes à mettre au plus haut du fichier
const ERROR_REQUIRED = "Veuillez renseigner une tâche";
const ERROR_TOO_SHORT = "Veuillez entrer au moins 5 caratères";
const ERROR_TOO_LONG = "Veuillez entrer moins de 200 caractères";
const VALIDATION = "Tache enregistrée";

// Initialisation des erreurs avec une chaine de caratère vide
$errors = [
    'task' => '',
];
$validation = [
    'task' => '',
];