<?php

namespace SmartCNAB\Support\Bank;

use SmartCNAB\Contracts\Support\BankSupport;

/**
 * Bank Itau support class.
 */
class Itau implements BankSupport
{
    /**
     * Especies codes.
     *
     * @var array
     */
    protected static $especies = [
        '01' => 'Duplicata mercantil',
        '02' => 'Nota promissória',
        '03' => 'Nota de seguro',
        '04' => 'Mensalidade escolar',
        '05' => 'Recibo',
        '06' => 'Contrato',
        '07' => 'Cosseguros',
        '08' => 'Duplicata de serviço',
        '09' => 'Letra de câmbio',
        '13' => 'Nota de débitos',
        '15' => 'Documento de dívida',
        '16' => 'Encargos condominiais',
        '17' => 'Conta de prestação de serviços',
        // '18' => 'Boleto de proposta', // Not implemented
        '99' => 'Diversos',
    ];

    /**
     * Billing instruction.
     *
     * @var array
     */
    protected static $instructions = [
        '02' => 'Devolver após 05 dias do vencimento',
        '03' => 'Devolver após 30 dias do vencimento',
        '05' => 'Receber conforme instruções no próprio título',
        '06' => 'Devolver após 10 dias do vencimento',
        '07' => 'Devolver após 15 dias do vencimento',
        '08' => 'Devolver após 20 dias do vencimento',
        '09' => 'Protestar',
        '10' => 'Não protestar (inibe protesto, quando houver instrução permanente na conta corrente)',
        '11' => 'Devolver após 25 dias do vencimento',
        '12' => 'Devolver após 35 dias do vencimento',
        '13' => 'Devolver após 40 dias do vencimento',
        '14' => 'Devolver após 45 dias do vencimento',
        '15' => 'Devolver após 50 dias do vencimento',
        '16' => 'Devolver após 55 dias do vencimento',
        '17' => 'Devolver após 60 dias do vencimento',
        '18' => 'Devolver após 90 dias do vencimento',
        '19' => 'Não receber após 05 dias do vencimento',
        '20' => 'Não receber após 10 dias do vencimento',
        '21' => 'Não receber após 15 dias do vencimento',
        '22' => 'Não receber após 20 dias do vencimento',
        '23' => 'Não receber após 25 dias do vencimento',
        '24' => 'Não receber após 30 dias do vencimento',
        '25' => 'Não receber após 35 dias do vencimento',
        '26' => 'Não receber após 40 dias do vencimento',
        '27' => 'Não receber após 45 dias do vencimento',
        '28' => 'Não receber após 50 dias do vencimento',
        '29' => 'Não receber após 55 dias do vencimento',
        '30' => 'Importância de desconto por dia',
        '31' => 'Não receber após 60 dias do vencimento',
        '32' => 'Não receber após 90 dias do vencimento',
        '33' => 'Conceder abatimento ref. à PIS-PASEP/COFIN/CSSL, mesmo após vencimento',
        '34' => 'Protestar após xx dias corridos do vencimento',
        '35' => 'Protestar após xx dias úteis do vencimento',
        '37' => 'Receber até o último dia do mês de vencimento',
        '38' => 'Conceder desconto mesmo após vencimento',
        '39' => 'Não receber após o vencimento',
        '40' => 'Conceder desconto conforme nota de crédito',
        '42' => 'Protesto para fins falimentares',
        '43' => 'Sujeito a protesto se não for pago no vencimento',
        '44' => 'Importância por dia de atraso a partir de ddmmaa',
        '45' => 'Tem dia da graça',
        '47' => 'Dispensar juros/comissão de permanência',
        '51' => 'Receber somente com a parcela anterior quitada',
        '52' => 'Efetuar o pagamento somente através deste boleto e na rede bancária',
        '54' => 'Após vencimento pagável somente na empresa',
        '57' => 'Somar valor do título ao valor do campo mora/multa caso exista',
        '58' => 'Devolver após 365 dias de vencido',
        '59' => 'Cobrança negociada. pagável somente por este boleto na rede bancária',
        '61' => 'Título entregue em penhor em favor do beneficiário acima',
        '62' => 'Título transferido a favor do beneficiário',
        '66' => 'Entrada em negativação expressa (imprime: sujeito a negativação após o vencimento)',
        '67' => 'Não negativar (inibe a entrada em negativação expressa)',
        '78' => 'Valor da ida engloba multa de 10% pro rata',
        '79' => 'Cobrar juros após 15 dias da emissão (para títulos com vencimento à vista)',
        '80' => 'Pagamento em cheque: somente receber com cheque de emissão do pagador',
        '83' => 'Operação ref a vendor',
        '84' => 'Após vencimento consultar a agência beneficiário',
        '86' => 'Antes do vencimento ou após 15 dias, pagável somente em nossa sede',
        '88' => 'Não receber antes do vencimento',
        '90' => 'No vencimento pagável em qualquer agência bancária',
        '91' => 'Não receber após xx dias do vencimento',
        '92' => 'Devolver após xx dias do vencimento',
        '93' => 'Mensagens nos boletos com 30 posições',
        '94' => 'Mensagens nos boletos com 40 posições',
        '98' => 'Duplicata / Número fatura',
    ];

    /**
     * Remittance occurrences codes.
     *
     * @var array
     */
    protected static $remittanceOccurrences = [
        '01' => 'Remessa',
        '02' => 'Pedido de baixa',
        '04' => 'Concessão de abatimento (indicador 12.5)',
        '05' => 'Cancelamento de abatimento',
        '06' => 'Alteração do vencimento',
        '07' => 'Alteração do uso da empresa',
        '08' => 'Alteração do seu número',
        '09' => 'Protestar',
        '10' => 'Não protestar',
        '11' => 'Protesto para fins falimentares',
        '18' => 'Sustar o protesto',
        '30' => 'Exclusão de sacador avalista',
        '31' => 'Alteração de outros dados',
        '34' => 'Baixa por ter sido pago diretamente ao beneficiário',
        '35' => 'Cancelamento de instrução',
        '37' => 'Alteração do vencimento e sustar protesto',
        '38' => 'Beneficiário não concorda com alegação do pagador',
        '47' => 'Beneficiário solicita dispensa de juros',
        '49' => 'Alteração de dados extras (registro de multa)',
        '66' => 'Entrada em negativação expressa',
        '67' => 'Não negativar (inibe a entrada em negativação expressa)',
        '68' => 'Excluir negativação expressa (até 15 dias corridos após a entrada em negativação expressa)',
        '69' => 'Cancelar negativação expressa (após título ter sido negativado)',
        '93' => 'Descontar títulos encaminhados no dia',
    ];

    /**
     * Return occurrences codes.
     *
     * @var array
     */
    protected static $returnOccurrences = [
        '02' => 'Entrada confirmada com possibilidade de mensagem',
        '03' => 'Entrada rejeitada',
        '04' => 'Alteração de dados – nova entrada ou alteração/exclusão de dados acatada',
        '05' => 'Alteração de dados – baixa',
        '06' => 'Liquidação normal',
        '07' => 'Liquidação parcial – cobrança inteligente (b2b)',
        '08' => 'Liquidação em cartório',
        '09' => 'Baixa simples',
        '10' => 'Baixa por ter sido liquidado',
        '11' => 'Em ser (só no retorno mensal)',
        '12' => 'Abatimento concedido',
        '13' => 'Abatimento cancelado',
        '14' => 'Vencimento alterado',
        '15' => 'Baixas rejeitadas',
        '16' => 'Instruções rejeitadas',
        '17' => 'Alteração/exclusão de dados rejeitados',
        '18' => 'Cobrança contratual – instruções/alterações rejeitadas/pendentes',
        '19' => 'Confirma recebimento de instrução de protesto',
        '20' => 'Confirma recebimento de instrução de sustação de protesto /tarifa',
        '21' => 'Confirma recebimento de instrução de não protestar',
        '23' => 'Título enviado a cartório/tarifa',
        '24' => 'Instrução de protesto rejeitada/sustada/pendente',
        '25' => 'Alegações do pagador',
        '26' => 'Tarifa de aviso de cobrança',
        '27' => 'Tarifa de extrato posição (b40x)',
        '28' => 'Tarifa de relação das liquidações',
        '29' => 'Tarifa de manutenção de títulos vencidos',
        '30' => 'Débito mensal de tarifas (para entradas e baixas)',
        '32' => 'Baixa por ter sido protestado',
        '33' => 'Custas de protesto',
        '34' => 'Custas de sustação',
        '35' => 'Custas de cartório distribuidor',
        '36' => 'Custas de edital',
        '37' => 'Tarifa de emissão de boleto/tarifa de envio de duplicata',
        '38' => 'Tarifa de instrução',
        '39' => 'Tarifa de ocorrências',
        '40' => 'Tarifa mensal de emissão de boleto/tarifa mensal de envio de duplicata',
        '41' => 'Débito mensal de tarifas – extrato de posição (b4ep/b4ox)',
        '42' => 'Débito mensal de tarifas – outras instruções',
        '43' => 'Débito mensal de tarifas – manutenção de títulos vencidos',
        '44' => 'Débito mensal de tarifas – outras ocorrências',
        '45' => 'Débito mensal de tarifas – protesto',
        '46' => 'Débito mensal de tarifas – sustação de protesto',
        '47' => 'Baixa com transferência para desconto',
        '48' => 'Custas de sustação judicial',
        '51' => 'Tarifa mensal ref a entradas bancos correspondentes na carteira',
        '52' => 'Tarifa mensal baixas na carteira',
        '53' => 'Tarifa mensal baixas em bancos correspondentes na carteira',
        '54' => 'Tarifa mensal de liquidações na carteira',
        '55' => 'Tarifa mensal de liquidações em bancos correspondentes na carteira',
        '56' => 'Custas de irregularidade',
        '57' => 'Instrução cancelada',
        '59' => 'Baixa por crédito em c/c através do sispag',
        '60' => 'Entrada rejeitada carnê',
        '61' => 'Tarifa emissão aviso de movimentação de títulos (2154)',
        '62' => 'Débito mensal de tarifa – aviso de movimentação de títulos (2154)',
        '63' => 'Título sustado judicialmente',
        '64' => 'Entrada confirmada com rateio de crédito',
        '65' => 'Pagamento com cheque – aguardando compensação',
        '69' => 'Cheque devolvido',
        '71' => 'Entrada registrada, aguardando avaliação',
        '72' => 'Baixa por crédito em c/c através do sispag sem título correspondente',
        '73' => 'Confirmação de entrada na cobrança simples – entrada não aceita na cobrança contratual',
        '74' => 'Instrução de negativação expressa rejeitada',
        '75' => 'Confirmação de recebimento de instrução de entrada em negativação expressa',
        '76' => 'Cheque compensado',
        '77' => 'Confirmação de recebimento de instrução de exclusão de entrada em negativação expressa',
        '78' => 'Confirmação de recebimento de instrução de cancelamento de negativação expressa',
        '79' => 'Negativação expressa informacional',
        '80' => 'Confirmação de entrada em negativação expressa – tarifa',
        '82' => 'Confirmação do cancelamento de negativação expressa – tarifa',
        '83' => 'Confirmação de exclusão de entrada em negativação expressa por liquidação – tarifa',
        '85' => 'Tarifa por boleto (até 03 envios) cobrança ativa eletrônica',
        '86' => 'Tarifa email cobrança ativa eletrônica',
        '87' => 'Tarifa sms cobrança ativa eletrônica',
        '88' => 'Tarifa mensal por boleto (até 03 envios) cobrança ativa eletrônica',
        '89' => 'Tarifa mensal email cobrança ativa eletrônica',
        '90' => 'Tarifa mensal sms cobrança ativa eletrônica',
        '91' => 'Tarifa mensal de exclusão de entrada de negativação expressa',
        '92' => 'Tarifa mensal de cancelamento de negativação expressa',
        '93' => 'Tarifa mensal de exclusão de negativação expressa por liquidação',
    ];

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
            'instruction1' => '02',
            'instruction2' => '00',
        ];
    }

    /**
     * @return array
     */
    public function documentsPrefixes()
    {
        return [];
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
     * @return array
     */
    public function motives()
    {
        return [];
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
