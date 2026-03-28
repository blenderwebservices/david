<?php

use App\Ai\Agents\DavidAgent;

try {
    echo "Iniciando prueba de conexión con Gemini 3.1 Flash-Lite...\n";
    
    $agent = new DavidAgent();
    
    // We MUST call provider() to trigger the dynamic config override from DB
    $activeProvider = $agent->provider();
    $activeModel = $agent->model();
    
    echo "Configuración activa:\n";
    echo "- Proveedor: {$activeProvider}\n";
    echo "- Modelo: {$activeModel}\n";
    echo "- API Key (ofuscada): " . substr(config("ai.providers.{$activeProvider}.key"), 0, 8) . "...\n";

    // Now call prompt without overriding provider/model, so it uses the ones from the Agent methods
    $response = $agent->prompt("Responde solo con la palabra 'LISTO' si recibes este mensaje.");
    
    echo "Respuesta de la IA: " . (string)$response . "\n";
    
    if (str_contains(strtoupper((string)$response), 'LISTO')) {
        echo "\n✅ ¡Prueba exitosa! El modelo está funcionando correctamente.\n";
    } else {
        echo "\n⚠️ Se recibió una respuesta inesperada: " . $response . "\n";
    }
} catch (\Exception $e) {
    echo "\n❌ Error de conexión: " . $e->getMessage() . "\n";
    echo "Línea: " . $e->getLine() . "\n";
}
