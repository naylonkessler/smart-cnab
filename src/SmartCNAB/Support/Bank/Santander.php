<?php

namespace SmartCNAB\Support\Bank;

use SmartCNAB\Contracts\Support\BankSupportInterface;

/**
 * Bank Santander support class.
 */
class Santander implements BankSupportInterface
{
    /**
     * Especies codes.
     *
     * @var array
     */
    protected static $especies = [
        '01' => 'Duplicata',
        '02' => 'Nota promissória',
        '03' => 'Apólice / Nota de seguro',
        '05' => 'Recibo',
        '06' => 'Duplicata de serviço',
        '07' => 'Letra de cambio',
    ];

    /**
     * Billing instruction.
     *
     * @var array
     */
    protected static $instructions = [
        '00' => 'Não há instruções',
        '02' => 'Baixar após quinze dias do vencimento',
        '03' => 'Baixar após 30 dias do vencimento',
        '04' => 'Não baixar',
        '06' => 'Protestar',
        '07' => 'Não protestar',
        '08' => 'Não cobrar juros de mora',
    ];

    /**
     * Returning rejection codes.
     *
     * @var array
     */
    protected static $rejectionCodes = [
        '001' => 'Nosso número não númerico',
        '002' => 'Valor do abatimento não númerico',
        '003' => 'Data vencimento não númerica',
        '004' => 'Conta cobrança não númerica',
        '005' => 'Código da carteira não númerico',
        '006' => 'Código da carteira inválido',
        '007' => 'Espécie do documento inválida',
        '008' => 'Unidade de valor não númerica',
        '009' => 'Unidade de valor inválida',
        '010' => 'Código primeira instrução não númerica',
        '011' => 'Código segunda instrução não númerica',
        '012' => 'Valor do título em outra unidade',
        '013' => 'Valor do título não númerico',
        '014' => 'Valor de mora não númerico',
        '015' => 'Data emissão não númerica',
        '016' => 'Data de vencimento inválida',
        '017' => 'Código da agência cobradora não númerica',
        '018' => 'Valor do IOC não númerico',
        '019' => 'Número do CEP não númerico',
        '020' => 'Tipo inscrição não númerico',
        '021' => 'Número do CNPJ ou CPF não númerico',
        '022' => 'Código ocorrência inválido',
        '023' => 'Nosso número inválido para modalidade',
        '024' => 'Total parcela não númerico',
        '025' => 'Valor desconto não númerico',
        '026' => 'Código banco cobrador inválido',
        '027' => 'Número parcelas carnê não númerico',
        '028' => 'Número parcelas carnê zerado',
        '029' => 'Valor de mora inválido',
        '030' => 'Data vencimento menor de 15 dias da data processamento',
        '038' => 'Movimento excluído por solicitação',
        '039' => 'Perfil não aceita título em banco correspondente',
        '040' => 'Cobrança rápida não aceita-se banco correspondente',
        '041' => 'Agência cobradora não encontrada',
        '042' => 'Conta cobrança inválida',
        '043' => 'Não baixar, compl. informado inválido',
        '044' => 'Não protestar, compl. informado inválido',
        '045' => 'Quantidade de dias de baixa não preenchido',
        '046' => 'Quantidade de dias protesto não preenchido',
        '047' => 'Total parcelas informadas não bate cl otd parc ger',
        '048' => 'Carnê com parcelas com erro',
        '049' => 'Seu número não confere com o carnê',
        '050' => 'Número do título igual a zero',
        '051' => 'Titulo não encontrado',
        '052' => 'Ocorrência não acatada, título liquidado',
        '053' => 'Ocorrência não acatada, título baixado',
        '054' => 'Titulo com ordem de protesto já emitida',
        '055' => 'Ocorrência não acatada, título já protestado',
        '056' => 'Ocorrência não acatada, título não vencido',
        '057' => 'CEP do sacado incorreto',
        '058' => 'CNPJ/CPF incorreto',
        '059' => 'Instrução aceita só para cobrança simples',
        '060' => 'Espécie documento não protestável',
        '061' => 'Cedente sem carta de protesto',
        '062' => 'Sacado não protestável',
        '063' => 'CEP não encontrado na tabela de praças',
        '064' => 'Tipo de cobrança não permite protesto',
        '065' => 'Pedido sustação já solicitado',
        '066' => 'Sustação protesto fora de prazo',
        '067' => 'Cliente não transmite reg. de ocorrência',
        '068' => 'Tipo de vencimento inválido',
        '069' => 'Produto diferente de cobrança simples',
        '070' => 'Data prorrogação menor que data vencimento',
        '071' => 'Data antecipação maior que data vencimento',
        '072' => 'Data documento superior a data instrução',
        '073' => 'Abatimento maior/igual ao valor título',
        '074' => 'Primeiro desconto maior/igual valor título',
        '075' => 'Segundo desconto maior/igual valor título',
        '076' => 'Terceiro desconto maior/igual valor título',
        '077' => 'Desconto por antecipação maior/igual valor título',
        '078' => 'Não existe abatimento para cancelar',
        '079' => 'Não existe primeiro desconto para cancelar',
        '080' => 'Não existe segundo desconto para cancelar',
        '081' => 'Não existe terceiro desconto para cancelar',
        '082' => 'Não existe desconto por antecipação para cancelar',
        '083' => 'Não existe multa por atraso para cancelar',
        '084' => 'Já existe segundo desconto',
        '085' => 'Já existe terceiro desconto',
        '086' => 'Data segundo desconto inválida',
        '087' => 'Data terceiro desconto inválida',
        '088' => 'Data instrução inválida',
        '089' => 'Data multa menor/igual que vencimento',
        '090' => 'Já existe desconto por dia antecipação',
        '091' => 'Já existe concessao de desconto',
        '092' => 'Nosso número já cadastrado',
        '093' => 'Valor do título não informado',
        '094' => 'Valor título em outra moeda não informado',
        '095' => 'Perfil não aceita valor título zerado',
        '096' => 'Espécie documento não permite protesto',
        '097' => 'Espécie documento não permite IOC zerado',
        '098' => 'Data emissão inválida',
        '099' => 'Registro duplicado no movimento diário',
        '100' => 'Data emissão maior que a data vencimento',
        '101' => 'Nome do sacado não informado',
        '102' => 'Endereço do sacado não informado',
        '103' => 'Município do sacado não informado',
        '104' => 'Unidade da federação não informada',
        '105' => 'Tipo inscrição não existe',
        '106' => 'CNPJ/CPF não informado',
        '107' => 'Unidade da federação incorreta',
        '108' => 'Dígito CNPJ/CPF incorreto',
        '109' => 'Valor mora tem que ser zero (título = zero)',
        '110' => 'Data primeiro desconto inválida',
        '111' => 'Data desconto não númerica',
        '112' => 'Valor desconto não informado',
        '113' => 'Valor desconto inválido',
        '114' => 'Valor abatimento não informado',
        '115' => 'Valor abatimento maior valor título',
        '116' => 'Data multa não númerica',
        '117' => 'Valor desconto maior valor título',
        '118' => 'Data multa não informada',
        '119' => 'Data multa maior que data de vencimento',
        '120' => 'Percentual multa não númerico',
        '121' => 'Percentual multa não informado',
        '122' => 'Valor IOF maior que valor título',
        '123' => 'CEP do sacado não númerico',
        '124' => 'CEP sacado não encontrado',
        '125' => 'Complemento da instrução não númerico',
        '126' => 'Código para baixa/devolução inválido',
        '127' => 'Código para baixa/devolução não númerica',
        '128' => 'Código protesto inválido',
        '129' => 'Espécie de documento não númerica',
        '130' => 'Forma de cadastramento não númerica',
        '131' => 'Forma de cadastramento inválida',
        '132' => 'Forma cadast. 2 inválida para carteira 3',
        '133' => 'Forma cadast. 2 inválida para carteira 4',
        '134' => 'Código do movimento remessa não númerico',
        '135' => 'Código do movimento remessa inválido',
        '136' => 'Código banco na compensação não númerico',
        '137' => 'Código banco na compensação inválido',
        '138' => 'Número lote remessa(detalhe) não númerico',
        '139' => 'Tipo de registro inválido',
        '140' => 'Código sequecial do registro detalhe inválido',
        '141' => 'Número sequecial registro do lote não númerico',
        '142' => 'Número agência cedente/dígito não númerico',
        '143' => 'Número conta cedente/dígito não númerico',
        '144' => 'Tipo de documento não númerico',
        '145' => 'Tipo de documento inválido',
        '146' => 'Código para protesto não númerico',
        '147' => 'Quantidade de dias para protesto inválido',
        '148' => 'Quantidade de dias para protesto não númerico',
        '149' => 'Código de mora inválido',
        '150' => 'Código de mora não númerico',
        '151' => 'Valor mora igual a zeros para código mora 1',
        '152' => 'Valor taxa mora igual a zeros para código mora 2',
        '153' => 'Valor mora diferente de zeros para código mora 3',
        '154' => 'Valor mora não númerico para código mora 2',
        '155' => 'Valor mora inválido para código mora 4',
        '156' => 'Quantidade dias para baixa/devolução não númerico',
        '157' => 'Quantidade dias baixa/devolução inválido para código 1',
        '158' => 'Quantidade dias baixa/devolução inválido para código 2',
        '159' => 'Quantidade dias baixa/devolução inválido para código 3',
        '160' => 'Bairro do sacado não informado',
        '161' => 'Tipo inscrição CPF/CNPJ sacador/avalista não numérico',
        '162' => 'Indicador de carnê não númerico',
        '163' => 'Número total de parcelas carnê não númerico',
        '164' => 'Número do plano não númerico',
        '165' => 'Indicador de parcelas carnê inválido',
        '166' => 'Número sequencial parcela inválido para indic. maior 0',
        '167' => 'Número sequencial parcela inválido para indic. diferente de zeros',
        '168' => 'Número total parcelas inválido para  indic. maior que zeros',
        '169' => 'Número total parcelas inválido para  indic. diferente de zeros',
        '170' => 'Forma de cadastramento 2 inválido para carteira 5',
        '199' => 'Tipo inscrição CNPJ/CPF sacador/avalista inválido',
        '200' => 'Número inscrição (CNPJ) sacador/avalista não númerico',
        '201' => 'Alteração do contrato participante inválido',
        '202' => 'Alteração do seu número inválida',
        '212' => 'Data do juros de mora não númerico (d3p)',
        '218' => 'Banco compensação não númerico (d30)',
        '219' => 'Banco compensação inválido (d30)',
        '220' => 'Número do lote remessa não númerico (d30)',
        '221' => 'Número sequencial registro no lote (d30)',
        '222' => 'Tipo inscrição sacado não númerico (d30)',
        '223' => 'Tipo inscrição sacado inválido (d30)',
        '224' => 'Número inscrição sacado não númerico (d30)',
        '225' => 'Número inscrição sacado inválido para tipo inscrição (d30)',
        '226' => 'Número banco compensação não númerico (d3r)',
        '227' => 'Número banco compensação inválido (d3r)',
        '228' => 'Número lote remessa não númerico (d3r)',
        '229' => 'Número sequencial registro lote não númerico (d3r)',
        '241' => 'Data desc3 não númerica (d3r)',
        '242' => 'Código da multa não númerico (d3r)',
        '243' => 'Código multa inválido (d3r)',
        '244' => 'Valor da multa não númerico (d3r)',
        '245' => 'Data da multa não númerico (d3r)',
        '246' => 'Código banco compensação não númerico (d3s)',
        '247' => 'Código banco compensação inválido (d3s)',
        '248' => 'Número lote remessa não númerico (d3s)',
        '249' => 'Número sequencial do registro lote não númerico (d3s)',
        '250' => 'Número identificador de impressão não númerico (d3s)',
        '251' => 'Número identificador de impressão inválido (d3s)',
        '252' => 'Número linha impressa não númerico (d3s)',
        '253' => 'Código messagem para rec. sacado não númerico (d3s)',
        '254' => 'Código messagem para rec. sacado inválido (d3s)',
        '258' => 'Valor mora não númerico para cod 4 (d3p)',
        '259' => 'Cadastro de taxa de permanência inválido para código mora 4 (d3p)',
        '260' => 'Valor título (real) inválido para código mora 1 (dep)',
        '261' => 'Valor outros inválido para código mora 1 (d3p)',
        '262' => 'Cadastro de taxa de permanência inválido para código mora 3 (d3p)',
        '263' => 'Instrução para título não registrado',
        '264' => 'Código de aceite (A/N) inválido',
        '265' => 'Título com mais de 3 instruções financeiras',
        '266' => 'Código de cedente não cadastrado',
        '267' => 'Título sem ordem de protesto automática',
        '268' => 'Data de juros de tolerância inválido',
        '269' => 'Data de tolerância menor data vencimento',
        '270' => 'Percentual de juros de tolerância inválido',
        '371' => 'Titulo rejeitado - operação de desconto',
        '372' => 'Título rejeitado - horário limite operação desconto',
    ];

    /**
     * Remittance occurrences codes.
     *
     * @var array
     */
    protected static $remittanceOccurrences = [
        '01' => 'Entrada de título',
        '02' => 'Baixa de título',
        '04' => 'Concessão de abatimento',
        '05' => 'Cancelamento abatimento',
        '06' => 'Prorrogação de vencimento',
        '07' => 'Alteração de número da conta cedente',
        '08' => 'Alteração do seu número',
        '09' => 'Protestar',
        '18' => 'Sustar protesto',
    ];

    /**
     * Return occurrences codes.
     *
     * @var array
     */
    protected static $returnOccurrences = [
        '01' => 'Título não existe',
        '02' => 'Entrada título confirmada',
        '03' => 'Entrada título rejeitada',
        '06' => 'Liquidação',
        '07' => 'Liquidação por conta',
        '08' => 'Liquidação por saldo',
        '09' => 'Baixa automática',
        '10' => 'Título baixa confirmada instrução',
        '11' => 'Em ser',
        '12' => 'Abatimento concedido',
        '13' => 'Abatimento cancelado',
        '14' => 'Prorrogação de vencimento',
        '15' => 'Confirmação de protesto',
        '16' => 'Título já baixado / liquidado',
        '17' => 'Liquidado em cartório',
        '21' => 'Título enviado a cartório',
        '22' => 'Título retirado de cartório',
        '24' => 'Custas de cartório',
        '25' => 'Protestar título',
        '26' => 'Sustar protesto',
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
     * Return all available postage.
     *
     * @return array
     */
    public function postage()
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
     * @return array
     */
    public function motives()
    {
        return [];
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
