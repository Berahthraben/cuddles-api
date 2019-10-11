<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Utils\LoginUtils;

class ApiController extends Controller {
    
    public function theGET($request, $response) {
        $file = "json_data.json";
        
        if (!file_exists($file)) {
            return $response->withJson("Nenhum arquivo para retornar :/", 200);
        }
        
        $jsonText = file_get_contents($file);
        
        if (!$jsonText) {
            return $response->withJson("Problemas ao recuperar arquivo salvo :/", 503);
        }
        
        return $response->withJson($jsonText);
    }
    
    public function thePOST($request, $response) {
        $jsonData = $request->getParam("dados");
        
        if (empty($jsonData)) {
            return $response->withJson("Nada para salvar!? No body envie a chave 'dados' -> '{dados: seu_json_com_stringify_aqui}'!", 200);
        }
        
        // Salva o arquivo
        $file = "json_data.json";
        $handle = fopen($file, "w");
        
        if (!$handle) {
            return $response->withJson("Problemas ao abrir arquivo :/", 503);
        }
        
        if (!fwrite($handle, json_encode($jsonData))) {
            return $response->withJson("Problemas ao gravar arquivo recebido :/", 503);
        }

        if (!fclose($handle)) {
            return $response->withJson("Problemas ao fechar arquivo. Tente enviar e salvar novamente :/", 503);
        }
        
        return $response->withJson("Arquivo salvo com sucesso! =D");
    }
}
