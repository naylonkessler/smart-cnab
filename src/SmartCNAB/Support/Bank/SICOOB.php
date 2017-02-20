<?php

namespace SmartCNAB\Support\Bank;

use SmartCNAB\Contracts\Support\BankSupportInterface;

/**
 * Bank SICOOB support class.
 */
class SICOOB implements BankSupportInterface
{
    /**
     * Constants for returning occurrences statuses.
     */
    const OCCURRENCES_DISCHARGED = [9, 10];
    const OCCURRENCES_ENTRY = [2];
    const OCCURRENCES_PAID = [5, 6, 15];
    const OCCURRENCES_PROTESTED = [23];

    /**
     * Documents (especies) prefixed.
     *
     * @var array
     */
    protected static $documentsPrefixes = [
        'DM' => 'Duplicata mercantil',
        'CH' => 'Cheque',
        'DS' => 'Duplicata de serviço',
        'PC' => 'Parcela de consórcio',
        'OU' => 'Outros',
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
        '06' => 'Duplicata rural',
        '08' => 'Letra de câmbio',
        '09' => 'Warrant',
        '10' => 'Cheque',
        '12' => 'Duplicata de serviço',
        '13' => 'Nota de débito',
        '14' => 'Triplicata mercantil',
        '15' => 'Triplicata de serviço',
        '18' => 'Fatura',
        '20' => 'Apólice de seguro',
        '21' => 'Mensalidade escolar',
        '22' => 'Parcela de consórcio',
        '99' => 'Outros',
    ];

    /**
     * Emission codes.
     *
     * @var array
     */
    protected static $emission = [
        '01' => 'Cooperativa',
        '02' => 'Cliente',
    ];

    /**
     * Postage codes.
     *
     * @var array
     */
    protected static $postage = [
        '01' => 'Cooperativa',
        '02' => 'Cliente',
    ];

    /**
     * Billing instruction.
     *
     * @var array
     */
    protected static $instructions = [
        '00' => 'Ausência de instruções',
        '01' => 'Cobrar juros',
        '03' => 'Protestar 3 dias úteis após vencimento',
        '04' => 'Protestar 4 dias úteis após vencimento',
        '05' => 'Protestar 5 dias úteis após vencimento',
        '07' => 'Não protestar',
        '10' => 'Protestar 10 dias úteis após vencimento',
        '15' => 'Protestar 15 dias úteis após vencimento',
        '20' => 'Protestar 20 dias úteis após vencimento',
        '22' => 'Conceder desconto so até data estipulada',
        '42' => 'Devolver após 15 dias vencido',
        '43' => 'Devolver após 30 dias vencido',
    ];

    /**
     * Remittance occurrences codes.
     *
     * @var array
     */
    protected static $remittanceOccurrences = [
        '01' => 'Registro de títulos',
        '02' => 'Solicitação de baixa',
        '04' => 'Concessão de abatimento',
        '05' => 'Cancelamento de abatimento',
        '06' => 'Alteração de vencimento',
        '08' => 'Alteração de seu número',
        '09' => 'Instrução para protestar',
        '10' => 'Instrução para sustar protesto',
        '11' => 'Instrução para dispensar juros',
        '12' => 'Alteração de pagador',
        '31' => 'Alteração de outros dados',
        '34' => 'Baixa - pagamento direto ao beneficiário',
    ];

    /**
     * Return occurrences codes.
     *
     * @var array
     */
    protected static $returnOccurrences = [
        '02' => 'Confirmação entrada título;',
        '05' => 'Liquidação sem registro',
        '06' => 'Liquidação normal',
        '09' => 'Baixa de titulo',
        '10' => 'Baixa solicitada pedido beneficiário',
        '11' => 'Títulos em ser',
        '14' => 'Alteração de vencimento',
        '15' => 'Liquidação em cartório',
        '23' => 'Encaminhado a protesto',
        '27' => 'Confirmação alteração dados',
        '48' => 'Confirmação de instrução de transferência de carteira/modalidade de cobrança',
    ];

    /**
     * @return array
     */
    public function billing()
    {
        return [];
    }

    /**
     * @return array
     */
    public function channels()
    {
        return [];
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
            'instruction1' => '00',
            'instruction2' => '00',
        ];
    }

    /**
     * Return all available documents prefixes.
     *
     * @return array
     */
    public function documentsPrefixes()
    {
        return static::$documentsPrefixes;
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
     * Return all available emission.
     *
     * @return array
     */
    public function emission()
    {
        return static::$emission;
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
     * @return array
     */
    public function motives()
    {
        return [];
    }

    /**
     * Return all available postage.
     *
     * @return array
     */
    public function postage()
    {
        return static::$postage;
    }

    /**
     * @return array
     */
    public function rejectionCodes()
    {
        return [];
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
