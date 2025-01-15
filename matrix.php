<?php
// matrix.php
function getMatrices() {
    $coefficients = [
        [-0.30, -0.20, -0.40], // C
        [-0.30, -0.13, -0.30], // B
        [-0.15, -0.15, -0.25], // E
        [0.30, 0.0, 0.0],      // F
        [0.15, 0.1, -0.05],    // CA
        [-0.15, -0.05, 0.1],   // EBE
        [145, 110, 135]        // Dette
    ];

    $constants = [
        500,     // Base CA
        100,     // RCA multiplier
        500 / 14, // Base EBE
        100,     // REBE multiplier
        200,     // Base reserve
        200000,  // Base ACO2
        1500000  // Base AEau
    ];

    return [
        "coefficients" => $coefficients,
        "constants" => $constants
    ];
}
header('Content-Type: application/json');
echo json_encode(getMatrices());
?>
