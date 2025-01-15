<?php
// m.php
function getM() {
    // Données des coefficients
    $CF = [
        [-0.30, -0.20, -0.40], 
        [-0.30, -0.13, -0.30], 
        [-0.15, -0.15, -0.25], 
        [0.30, 0.0, 0.0],      
        [0.15, 0.1, -0.05],    
        [-0.15, -0.05, 0.1],   
        [145, 110, 135]       
    ];

    // Données des constantes
    $CT = [
        500,    
        100,    
        500 / 14, 
        100,    
        200,    
        200000, 
        100,    
        100,    
        1500000,
        100     
    ];

    return [
        "cf" => $CF,
        "ct" => $CT
    ];
}

try {
    // Retourne les données au format JSON
    header('Content-Type: application/json');
    echo json_encode(getM());
} catch (Exception $e) {
    // Gestion des erreurs
    http_response_code(500);
    echo json_encode(["error" => "Une erreur s'est produite."]);
}
?>
