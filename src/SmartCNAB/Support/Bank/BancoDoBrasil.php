<?php

namespace SmartCNAB\Support\Bank;

use SmartCNAB\Contracts\Support\BankSupportInterface;

/**
 * Bank BancoDoBrasil support class.
 */
class BancoDoBrasil implements BankSupportInterface
{
    /**
     * Constants for returning occurrences statuses.
     */
    const OCCURRENCES_DISCHARGED = [9];
    const OCCURRENCES_ENTRY = [2];
    const OCCURRENCES_PAID = [5, 6, 7, 8, 15];
    const OCCURRENCES_PROTESTED = [19];

    /**
     * Channels codes.
     *
     * @var array
     */
    protected static $billing = [
        '04DSC' => 'Solicitação de registro na Modalidade Descontada',
        '08VDR' => 'Solicitação de registro na Modalidade BBVendor',
        '02VIN' => 'Solicitação de registro na Modalidade Vinculada',
    ];

    /**
     * Channels codes.
     *
     * @var array
     */
    protected static $channels = [
        '00' => 'Não é sacado eletrônico no DDA',
        '01' => 'Terminal de auto-atendimento',
        '02' => 'Internet',
        '03' => 'Central de atendimento (URA)',
        '04' => 'Gerenciador financeiro',
        '05' => 'Central de atendimento',
        '06' => 'Outro canal de auto-atendimento',
        '07' => 'Correspondente bancário',
        '08' => 'Guichê de caixa',
        '09' => 'Arquivo-eletrônico',
        '10' => 'Compensação',
        '11' => 'Outro canal eletrônico',
        '50' => 'Sacado eletrônico no DDA',
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
     * Motives codes.
     *
     * @var array
     */
    protected static $motives = [
        '05, 06, 07, 08, 15, 46' => [
            '01' => 'Liquidação normal',
            '02' => 'Liquidação parcial',
            '03' => 'Liquidação por saldo',
            '04' => 'Liquidação com cheque a compensar',
            '05' => 'Liquidação de título sem registro',
            '07' => 'Liquidação na apresentação',
            '09' => 'Liquidação em cartório',
            '10' => 'Liquidação parcial com cheque a compensar',
            '11' => 'Liquidação por saldo com cheque a compensar',
        ],
        '02' => [
            '00' => 'Por meio magnético',
            '11' => 'Por via convencional',
            '16' => 'Por alteração do código do cedente',
            '17' => 'Por alteração da variação',
            '18' => 'Por alteração da carteira',
        ],
        '09, 10, 20' => [
            '00' => 'Solicitada pelo cliente',
            '15' => 'Protestado',
            '18' => 'Por alteração da carteira',
            '19' => 'Débito automático',
            '31' => 'Liquidado anteriormente',
            '32' => 'Habilitado em processo',
            '33' => 'Incobrável por nosso intermédio',
            '34' => 'Transferido para créditos em liquidação',
            '46' => 'Por alteração da variação',
            '47' => 'Por alteração da variação',
            '51' => 'Acerto',
            '90' => 'Baixa automática',
        ],
        '03' => [
            '01' => 'Identificação inválida',
            '02' => 'Variação da carteira inválida',
            '03' => 'Valor dos juros por um dia inválido',
            '04' => 'Valor do desconto inválido',
            '05' => 'Espécie de título inválida para carteira/variação',
            '06' => 'Espécie de valor invariável inválido',
            '07' => 'Prefixo da agência usuária inválido',
            '08' => 'Valor do título/apólice inválido',
            '09' => 'Data de vencimento inválida',
            '10' => 'Fora do prazo/só admissível na carteira',
            '11' => 'Inexistência de margem para desconto',
            '12' => 'O banco não tem agência na praça do sacado',
            '13' => 'Razões cadastrais',
            '14' => 'Sacado interligado com o sacador',
            '15' => 'Titulo sacado contra órgão do poder público',
            '16' => 'Titulo preenchido de forma irregular',
            '17' => 'Titulo rasurado',
            '18' => 'Endereço do sacado não localizado ou incompleto',
            '19' => 'Código do cedente inválido',
            '20' => 'Nome/endereço do cliente não informado (ECT)',
            '21' => 'Carteira inválida',
            '22' => 'Quantidade de valor variável inválida',
            '23' => 'Faixa nosso-numero excedida',
            '24' => 'Valor do abatimento inválido',
            '25' => 'Novo número do título dado pelo cedente inválido (seu número)',
            '26' => 'Valor do iof de seguro inválido',
            '27' => 'Nome do sacado/cedente inválido',
            '28' => 'Data do novo vencimento inválida',
            '29' => 'Endereço não informado',
            '30' => 'Registro de título já liquidado',
            '31' => 'Numero do borderô inválido',
            '32' => 'Nome da pessoa autorizada inválido',
            '33' => 'Nosso número já existente',
            '34' => 'Numero da prestação do contrato inválido',
            '35' => 'Percentual de desconto inválido',
            '36' => 'Dias para fichamento de protesto inválido',
            '37' => 'Data de emissão do título inválida',
            '38' => 'Data do vencimento anterior à data da emissão do título',
            '39' => 'Comando de alteração indevido para a carteira',
            '40' => 'Tipo de moeda inválido',
            '41' => 'Abatimento não permitido',
            '42' => 'CEP/UF inválido/não compatíveis (ECT)',
            '43' => 'Código de unidade variável incompatível com a data de emissão do título',
            '44' => 'Dados para débito ao sacado inválidos',
            '45' => 'Carteira/variação encerrada',
            '46' => 'Convenio encerrado',
            '47' => 'Titulo tem valor diverso do informado',
            '48' => 'Motivo de baixa invalido para a carteira',
            '49' => 'Abatimento a cancelar não consta do título',
            '50' => 'Comando incompatível com a carteira',
            '51' => 'Código do convenente invalido',
            '52' => 'Abatimento igual ou maior que o valor do titulo',
            '53' => 'Titulo já se encontra na situação pretendida',
            '54' => 'Titulo fora do prazo admitido para a conta 1',
            '55' => 'Novo vencimento fora dos limites da carteira',
            '56' => 'Titulo não pertence ao convenente',
            '57' => 'Variação incompatível com a carteira',
            '58' => 'Impossível a variação única para a carteira indicada',
            '59' => 'Titulo vencido em transferência para a carteira 51',
            '60' => 'Titulo com prazo superior a 179 dias em variação única para carteira 51',
            '61' => 'Titulo já foi fichado para protesto',
            '62' => 'Alteração da situação de débito inválida para o código de responsabilidade',
            '63' => 'DV do nosso número inválido',
            '64' => 'Titulo não passível de débito/baixa - situação anormal',
            '65' => 'Titulo com ordem de não protestar - não pode ser encaminhado a cartório',
            '66' => 'Número do documento do sacado (CNPJ/CPF) inválido',
            '67' => 'Titulo/carne rejeitado',
            '69' => 'Valor/percentual de juros inválido',
            '70' => 'Título já se encontra isento de juros',
            '71' => 'Código de juros inválido',
            '72' => 'Prefixo da ag. cobradora inválido',
            '73' => 'Numero do controle do participante inválido',
            '74' => 'Cliente não cadastrado no ciope (desconto/vendor)',
            '75' => 'Quantidade de dias do prazo limite para recebimento de título vencido inválido',
            '76' => 'Titulo excluído automaticamente por decurso de prazo ciope (desconto/vendor)',
            '77' => 'Titulo vencido transferido para a conta 1 - carteira vinculada',
            '84' => 'Título não localizado na existência/baixado por protesto',
            '80' => 'Nosso numero inválido',
            '81' => 'Data para concessão do desconto inválida. gerada nos seguintes casos',
            '82' => 'CEP do sacado inválido',
            '83' => 'Carteira/variação não localizada no cedente',
            '84' => 'Titulo não localizado na existência',
            '85' => 'Recusa do comando 41 - parâmetro de liquidação parcial',
            '99' => 'Outros motivos',
        ],
        '72' => [
            '00' => 'Transferência de título de cobrança simples para descontada ou vice-versa',
            '52' => 'Reembolso de título vendor ou descontado',
        ],
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
        '02' => 'Confirmação de entrada de título',
        '03' => 'Comando recusado',
        '05' => 'Liquidado sem registro',
        '06' => 'Liquidação normal',
        '07' => 'Liquidação por conta/parcial',
        '08' => 'Liquidação por saldo',
        '09' => 'Baixa de titulo',
        '10' => 'Baixa solicitada',
        '11' => 'Títulos em ser',
        '12' => 'Abatimento concedido',
        '13' => 'Abatimento cancelado',
        '14' => 'Alteração de vencimento do título',
        '15' => 'Liquidação em cartório',
        '16' => 'Confirmação de alteração de juros de mora',
        '19' => 'Confirmação de recebimento de instruções para protesto',
        '20' => 'Débito em conta',
        '21' => 'Alteração do nome do sacado',
        '22' => 'Alteração do endereço do sacado',
        '23' => 'Indicação de encaminhamento a cartório',
        '24' => 'Sustar protesto',
        '25' => 'Dispensar juros de mora',
        '26' => 'Alteração do número do título dado pelo cedente (seu número)',
        '28' => 'Manutenção de titulo vencido',
        '31' => 'Conceder desconto',
        '32' => 'Não conceder desconto',
        '33' => 'Retificar desconto',
        '34' => 'Alterar data para desconto',
        '35' => 'Cobrar multa',
        '36' => 'Dispensar multa',
        '37' => 'Dispensar indexador',
        '38' => 'Dispensar prazo limite para recebimento',
        '39' => 'Alterar prazo limite para recebimento',
        '41' => 'Alteração do número do controle do participante',
        '42' => 'Alteração do número do documento do sacado (CNPJ/CPF)',
        '44' => 'Título pago com cheque devolvido',
        '46' => 'Título pago com cheque, aguardando compensação',
        '72' => 'Alteração de tipo de cobrança',
        '73' => 'Confirmação de instrução de parâmetro de pagamento parcial',
        '96' => 'Despesas de protesto',
        '97' => 'Despesas de sustação de protesto',
        '98' => 'Débito de custas antecipadas',
    ];

    /**
     * @return array
     */
    public function billing()
    {
        return static::$billing;
    }

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
            'instruction1' => '00',
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
     * Return all available emission.
     *
     * @return array
     */
    public function emission()
    {
        return [];
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
     * Return all motives codes.
     *
     * @return array
     */
    public function motives()
    {
        return static::$motives;
    }

    /**
     * Return all available postage.
     *
     * @return array
     */
    public function postage()
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
