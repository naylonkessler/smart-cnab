<?php

namespace SmartCNAB\Support\Bank;

/**
 * Bank BancoDoBrasil support class.
 */
class BancoDoBrasil
{
    /**
     * Channels codes.
     *
     * @var array
     */
    protected static $channels = [
    ];

    /**
     * Especies codes.
     *
     * @var array
     */
    protected static $especies = [
        '01' => 'Duplicata mercantil',
        '02' => 'Nota promissória',
        '03' => 'Nota de seguro',
        '05' => 'Recibo',
        '08' => 'Letra de câmbio',
        '09' => 'Warrant',
        '10' => 'Cheque',
        '12' => 'Duplicata de serviço',
        '13' => 'Nota de débito',
        '15' => 'Apólice de seguro',
        '25' => 'Dívida ativa da união',
        '26' => 'Dívida ativa de estado',
        '27' => 'Dívida ativa de município',
    ];

    /**
     * Billing instruction.
     *
     * @var array
     */
    protected static $instructions = [
        '00' => 'Ausência de instruções',
        '01' => 'Cobrar juros (dispensável se informado o valor a ser cobrado por dia de atraso)',
        '03' => 'Protestar no 3o dia útil após vencido',
        '04' => 'Protestar no 4o dia útil após vencido',
        '05' => 'Protestar no 5o dia útil após vencido',
        '06' => 'Indica protesto em dias corridos, com prazo de 6 a 29, 35 ou 40 dias corridos',
        '07' => 'Não protestar',
        '10' => 'Protestar no 10o dia corrido após vencido',
        '15' => 'Protestar no 15o dia corrido após vencido',
        '20' => 'Protestar no 20o dia corrido após vencido',
        '22' => 'Conceder desconto só até a data estipulada',
        '25' => 'Protestar no 25o dia corrido após vencido',
        '30' => 'Protestar no 30o dia corrido após vencido',
        '35' => 'Protestar no 35o dia corrido após vencido',
        '40' => 'Protestar no 40o dia corrido após vencido',
        '45' => 'Protestar no 45o dia corrido após vencido',
        '42' => 'Devolver',
        '44' => 'Baixar',
        '46' => 'Entregar ao sacado franco de pagamento',
    ];

    /**
     * Returning rejection codes.
     *
     * @var array
     */
    protected static $rejectionCodes = [
    ];

    /**
     * Remittance occurrences codes.
     *
     * @var array
     */
    protected static $remittanceOccurrences = [
        '01' => 'Registro de títulos',
        '02' => 'Solicitação de baixa',
        '03' => 'Pedido de débito em conta',
        '04' => 'Concessão de abatimento',
        '05' => 'Cancelamento de abatimento',
        '06' => 'Alteração de vencimento de título',
        '07' => 'Alteração do número de controle do participante',
        '08' => 'Alteração do número do titulo dado pelo cedente',
        '09' => 'Instrução para protestar',
        '10' => 'Instrução para sustar protesto',
        '11' => 'Instrução para dispensar juros',
        '12' => 'Alteração de nome e endereço do sacado',
        '16' => 'Alterar juros de mora',
        '31' => 'Conceder desconto',
        '32' => 'Não conceder desconto',
        '33' => 'Retificar dados da concessão de desconto',
        '34' => 'Alterar data para concessão de desconto',
        '35' => 'Cobrar multa',
        '36' => 'Dispensar multa',
        '37' => 'Dispensar indexador',
        '38' => 'Dispensar prazo limite de recebimento',
        '39' => 'Alterar prazo limite de recebimento',
        '40' => 'Alterar modalidade',
    ];

    /**
     * Return occurrences codes.
     *
     * @var array
     */
    protected static $returnOccurrences = [
    ];

    /**
     * Return the payment channels.
     *
     * @return array
     */
    public function channels()
    {
        return static::$channels;
    }

    /**
     * Return the default state of itau infos.
     *
     * @return array
     */
    public function defaults()
    {
        return [
            'especie' => '01',
            'instruction1' => '02',
            'instruction2' => '00',
        ];
    }

    /**
     * Return all available especies.
     *
     * @return array
     */
    public function especies()
    {
        return static::$especies;
    }

    /**
     * Return all available instructions.
     *
     * @return array
     */
    public function instructions()
    {
        return static::$instructions;
    }

    /**
     * Return all rejection codes.
     *
     * @return array
     */
    public function rejectionCodes()
    {
        return static::$rejectionCodes;
    }

    /**
     * Return all occurrences available for remittances.
     *
     * @return array
     */
    public function remittanceOccurrences()
    {
        return static::$remittanceOccurrences;
    }

    /**
     * Return all occurrences available for returning.
     *
     * @return array
     */
    public function returnOccurrences()
    {
        return static::$returnOccurrences;
    }
}
