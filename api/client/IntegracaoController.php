<?php

require_once '../../core/conn.php';

class Integracao {
    private $db;
    private $url = [
        "viaCep" => ["https://viacep.com.br/ws/{cep}/json/", ["API" => "ViaCEP"]],
        "brasilApi" => ["https://brasilapi.com.br/api/cep/v2/{cep}", ["API" => "Brasil API"]],
        "CepAberto" => ["https://www.cepaberto.com/api/v3/cep?cep={cep}", ["API" => "CEP Aberto"]]
    ];

    public function __construct() {
        //$this->db = ( new Database() )->getConnection();
    }

    public function integracaoCep( $cep, $api ) {

        $url = str_replace('{cep}', $cep, $this->url[$api][0]);

        $ch = curl_init($url);

        if($api == 'CepAberto'){
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Token token=09c3e3993569c6182d45126c72b51000'
            ]);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        $response = curl_exec($ch); 

        $response = json_decode($response, true);
        curl_close($ch);

        $response = array_merge($this->url[$api][1], $response);
        return $response;
    }

}
?>
