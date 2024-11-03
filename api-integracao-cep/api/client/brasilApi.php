<?php

require_once 'IntegracaoController.php';
require_once '../../core/response.php';
require_once '../../core/header.php';



if ( json_last_error() === JSON_ERROR_NONE ) {

    $cep = $input[ 'txtCep' ] ?? null;
    
    if ( $cep ) {

        $integracao = new Integracao();
        $response = $integracao->brasilApi( $cep );
        echo Response::json( 200, 'success', $response );
    } else {
        echo Response::json( 400, 'failed' );
    }
} else {
    echo Response::json( 400, 'Erro ao decodificar Json' );
}

?>
