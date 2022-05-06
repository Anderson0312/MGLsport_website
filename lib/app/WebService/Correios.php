<?php

namespace App\WebService;

class Correios{


    const SERVICO_SEDEX        = '04014';
    const SERVICO_SEDEX_12     = '04782';
    const SERVICO_SEDEX_10     = '04790';
    const SERVICO_SEDEX_HOJE   = '04804';
    const SERVICO_SEDEX_PCA    = '04510';


    const FORMATO_CAIXA_PACOTE     = '1';
    const FORMATO_ROLO_PRISMA      = '2';
    const FORMATO_ENVELOPE         = '3';


    /** 
    * código da empresa com contrato
    *   @var string
    */
    private $codigoEmpresa = '';
    
    /** 
    * Senha da empresa com contrato
    *   @var string
    */
    private $senhaEmpresa = '';

    public function __construct($codigoEmpresa ='', $senhaEmpresa ='') {
        $this->codigoEmpresa = $codigoEmpresa;
        $this->senhaEmpresa  = $senhaEmpresa;
    }

    public function cacularFrete($codigoServico, $cepOrigem = 21930376, $cepDestino, $peso, $formato, $comprimeto, $altura, $largura, $diametro = 0, $maoPropria = false, $valorDeclarado = 0, $avisoRecebimento = false) {

        $parametros = [
            'nCdEmpresa' => this->codigoEmpresa,
            'sDsSenha' =>this->codigoSenha,
            'nCdServico' => $codigoServico,
            'sCepOrigem' => $cepOrigem,
            'sCepDestino' => $cepDestino,
            'nVlPeso' => $peso,
            'nCdFormato' => $formato,
            'nVlComprimento' => $comprimeto,
            'nVlAltura' => $altura,
            'nVlLargura' => $largura,
            'nVlDiametro' => $diametro,
            'sCdMaoPropria' => $maoPropria ? 'S' : 'N',
            'nVlValorDeclarado' => $valorDeclarado,
            'sCdAvisoRecebimento' => $avisoRecebimento ? 'S' : 'N',
            'StrRetorno' => 'xml'    
        ];

        $query = http_build_query($parametros);
    }
}

?>