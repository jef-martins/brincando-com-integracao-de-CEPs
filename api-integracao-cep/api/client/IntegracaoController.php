<?php

require_once '../../core/conn.php';

class Integracao {
    private $db;

    public function __construct() {
        //$this->db = ( new Database() )->getConnection();
    }

    public function viaCep( $cep ) {
        $url = "https://viacep.com.br/ws/$cep/json/";

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        $response = curl_exec($ch); 

        $response = json_decode($response, true);
        curl_close($ch);

        $response = array_merge(["API" => "ViaCEP"], $response);
        return $response;
    }

    public function brasilApi( $cep ) {
        $url = "https://brasilapi.com.br/api/cep/v2/$cep";

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        $response = curl_exec($ch); 

        $response = json_decode($response, true);
        curl_close($ch);

        $response = array_merge(["API" => "Brasil API"], $response);
        return $response;
    }

    public function cepAberto( $cep ) {
        $url = "https://www.cepaberto.com/api/v3/cep?cep=$cep";

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Token token=09c3e3993569c6182d45126c72b51000'
        ]);
        $response = curl_exec($ch); 

        $response = json_decode($response, true);
        curl_close($ch);

        $response = array_merge(["API" => "CEP Aberto"], $response);
        return $response;
    }

}
?>
