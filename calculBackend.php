<?php
header("Content-Type: application/json");

// Récupération des données POST
$input = json_decode(file_get_contents("php://input"), true);

// Vérification des données reçues
if (!isset($input['rangeSlider1'], $input['rangeSlider2'], $input['rangeSlider3'], $input['rangeSlider4'])) {
    http_response_code(400);
    echo json_encode(["error" => "Données manquantes"]);
    exit;
}

// Extraction des valeurs
$rangeSlider1 = $input['rangeSlider1'] / 100;
$rangeSlider2 = $input['rangeSlider2'] / 100;
$rangeSlider3 = $input['rangeSlider3'] / 100;
$rangeSlider4 = $input['rangeSlider4'] / 100;

// Coefficients
$C2 = -0.30; $C3 = -0.20; $C4 = -0.40;
$B2 = -0.30; $B3 = -0.13; $B4 = -0.30;
$E2 = -0.15; $E3 = -0.15; $E4 = -0.25;
$F2 = 0.30; $F3 = 0.0; $F4 = 0.0;
$CA2 = 0.15; $CA3 = 0.1; $CA4 = -0.05;
$EBE2 = -0.15; $EBE3 = -0.05; $EBE4 = 0.1;
$Dette2 = 145; $Dette3 = 110; $Dette4 = 135;

// Calculs
$CA = 500 * (1 + $rangeSlider1 + $CA2 * $rangeSlider2 + $CA3 * $rangeSlider3 + $CA4 * $rangeSlider4);
$RCA = 100 * ($rangeSlider1 + $CA2 * $rangeSlider2 + $CA3 * $rangeSlider3 + $CA4 * $rangeSlider4);
$EBE = (500 / 14) * (1 + $rangeSlider1 + $EBE2 * $rangeSlider2 + $EBE3 * $rangeSlider3 + $EBE4 * $rangeSlider4);
$REBE = 100 * ($rangeSlider1 + $EBE2 * $rangeSlider2 + $EBE3 * $rangeSlider3 + $EBE4 * $rangeSlider4);
$reserve = 200 * (1 + $rangeSlider1) - ($Dette2 * $rangeSlider2 + $Dette3 * $rangeSlider3 + $Dette4 * $rangeSlider4);
$ACO2 = 200000 * (1 + $rangeSlider1 + $C2 * $rangeSlider2 + $C3 * $rangeSlider3 + $C4 * $rangeSlider4);
$RCO2 = 100 * ($rangeSlider1 + $C2 * $rangeSlider2 + $C3 * $rangeSlider3 + $C4 * $rangeSlider4);
$RBiodiv = 100 * ($rangeSlider1 + $B2 * $rangeSlider2 + $B3 * $rangeSlider3 + $B4 * $rangeSlider4);
$AEau = 1500000 * (1 + $rangeSlider1 + $E2 * $rangeSlider2 + $E3 * $rangeSlider3 + $E4 * $rangeSlider4);
$REau = 100 * ($rangeSlider1 + $E2 * $rangeSlider2 + $E3 * $rangeSlider3 + $E4 * $rangeSlider4);
$RFournisseurs = 100 * ($F2 * $rangeSlider2 + $F3 * $rangeSlider3 + $F4 * $rangeSlider4);

// Résultats
echo json_encode([
    "RCO2" => round($RCO2),
    "ACO2" => round($ACO2),
    "RBiodiv" => round($RBiodiv),
    "REau" => round($REau),
    "AEau" => round($AEau),
    "RFournisseurs" => round($RFournisseurs),
    "CA" => round($CA),
    "RCA" => round($RCA),
    "EBE" => round($EBE),
    "REBE" => round($REBE),
    "reserve" => round($reserve)
]);
