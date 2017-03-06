<?php

namespace SmartCNAB\Support\Bank;

use SmartCNAB\Support\Bank\Bank;

/**
 * Bank Bradesco support class.
 */
class Bradesco extends Bank
{
    /**
     * Constants for returning occurrences statuses.
     */
    const OCCURRENCES_DEBITS = [28];
    const OCCURRENCES_DISCHARGED = [9, 10];
    const OCCURRENCES_DISUSED_AUTO_DEBIT = [35];
    const OCCURRENCES_ENTRY = [2];
    const OCCURRENCES_ERROR = [3, 24, 27, 30, 32];
    const OCCURRENCES_PAID = [6, 15, 17];
    const OCCURRENCES_PAYER_CLAIMS = [29];
    const OCCURRENCES_PROTESTED = [19, 25];

    /**
     * Motives for debits occurrence code that has irregular size.
     */
    const MOTIVES_DEBITS_IRREGULAR = [100, 101, 102, 105, 106, 107];

    /**
     * Channels codes.
     *
     * @var array
     */
    protected static $channels = [
        '001' => 'CICS (AT00)',
        '007' => 'Terminal gerência CBCA PF8',
        '010' => 'Terminal gerência CBCA senhas',
        '074' => 'Boca do caixa',
        '075' => 'Retaguarda',
        '076' => 'Subcentro',
        '002' => 'BDN multi saque',
        '024' => 'Terminal multi função',
        '027' => 'Pagamento contas',
        '014' => 'Internet',
        '035' => 'Net empresa',
        '052' => 'Shop credit',
        '073' => 'Pag for',
        '013' => 'Fone fácil',
        '067' => 'Débito automático',
        '077' => 'Cartão de crédito',
        '078' => 'Compensação eletrônica',
        '082' => 'Bradesco expresso',
    ];

    /**
     * Emission codes.
     *
     * @var array
     */
    protected static $emission = [
        '1' => 'Banco emite',
        '2' => 'Cliente emite',
    ];

    /**
     * Especies codes.
     *
     * @var array
     */
    protected static $especies = [
        '01' => 'Duplicata',
        '02' => 'Nota promissória',
        '03' => 'Nota de seguro',
        '04' => 'Cobrança seriada',
        '05' => 'Recibo',
        '10' => 'Letras de câmbio',
        '11' => 'Nota de débito',
        '12' => 'Duplicata de serviço',
        '99' => 'Outros',
    ];

    /**
     * Billing instruction.
     *
     * @var array
     */
    protected static $instructions = [
        '00' => 'Nenhuma instrucão',
        '05' => 'Protestar (falimentar)',
        '06' => 'Protestar',
        '18' => 'Baixa por decurso de prazo',
    ];

    /**
     * Returning motives codes.
     *
     * @var array
     */
    protected static $motives = [
        '02' => [
            '00' => 'Ocorrência aceita',
            '01' => 'Código do banco inválido',
            '04' => 'Código do movimento não permitido para a carteira',
            '15' => 'Características da cobrança incompatíveis',
            '17' => 'Data de vencimento anterior a data de emissão',
            '21' => 'Espécie do título inválido',
            '24' => 'Data da emissão inválida',
            '27' => 'Valor/taxa de juros mora inválido',
            '38' => 'Prazo para protesto inválido',
            '39' => 'Pedido para protesto não permitido para título',
            '43' => 'Prazo para baixa e devolução inválido',
            '45' => 'Nome do pagador inválido',
            '46' => 'Tipo/número de inscrição do pagador inválidos',
            '47' => 'Endereço do pagador não informado',
            '48' => 'CEP inválido',
            '50' => 'CEP referente a banco correspondente',
            '53' => 'Número de inscrição do pagador/avalista inválidos (CPF/CNPJ)',
            '54' => 'Pagador/avalista não informado',
            '67' => 'Débito automático agendado',
            '68' => 'Débito não agendado - erro nos dados de remessa',
            '69' => 'Débito não agendado - pagador não consta no cadastro de autorizante',
            '70' => 'Débito não agendado - beneficiário não autorizado pelo pagador',
            '71' => 'Débito não agendado - beneficiário não participa da modalidade de débito automático',
            '72' => 'Débito não agendado - código de moeda diferente de R$',
            '73' => 'Débito não agendado - data de vencimento inválida/vencida',
            '75' => 'Débito não agendado - tipo do número de inscrição do pagador debitado inválido',
            '76' => 'Pagador eletrônico dda',
            '86' => 'Seu número do documento inválido',
            '89' => 'Email pagador não enviado – título com débito automático',
            '90' => 'Email pagador não enviado – título de cobrança sem registro',
        ],
        '03' => [
            '02' => 'Código do registro detalhe inválido',
            '03' => 'Código da ocorrência inválida',
            '04' => 'Código de ocorrência não permitida para a carteira',
            '05' => 'Código de ocorrência não numérico',
            '07' => 'Agência/conta/dígito - inválido',
            '08' => 'Nosso número inválido',
            '09' => 'Nosso número duplicado',
            '10' => 'Carteira inválida',
            '13' => 'Identificação da emissão do bloqueto inválida',
            '16' => 'Data de vencimento inválida',
            '18' => 'Vencimento fora do prazo de operação',
            '20' => 'Valor do título inválido',
            '21' => 'Espécie do título inválida',
            '22' => 'Espécie não permitida para a carteira',
            '24' => 'Data de emissão inválida',
            '28' => 'Código do desconto inválido',
            '38' => 'Prazo para protesto inválido',
            '44' => 'Agência beneficiário não prevista',
            '45' => 'Nome do pagador não informado',
            '46' => 'Tipo/número de inscrição do pagador inválidos',
            '47' => 'Endereço do pagador não informado',
            '48' => 'CEP inválido',
            '50' => 'CEP irregular - banco correspondente',
            '63' => 'Entrada para título já cadastrado',
            '65' => 'Limite excedido',
            '66' => 'Número autorização inexistente',
            '68' => 'Débito não agendado - erro nos dados de remessa',
            '69' => 'Débito não agendado - pagador não consta no cadastro de autorizante',
            '70' => 'Débito não agendado - beneficiário não autorizado pelo pagador',
            '71' => 'Débito não agendado - beneficiário não participa do débito automático',
            '72' => 'Débito não agendado - código de moeda diferente de R$',
            '73' => 'Débito não agendado - data de vencimento inválida',
            '74' => 'Débito não agendado - conforme seu pedido, título não registrado',
            '75' => 'Débito não agendado – tipo de número de inscrição do debitado inválido',
        ],
        '06' => [
            '00' => 'Título pago com dinheiro',
            '15' => 'Título pago com cheque',
            '42' => 'Rateio não efetuado, código cálculo 2',
        ],
        '09' => [
            '00' => 'Ocorrência aceita',
            '10' => 'Baixa comandada pelo cliente',
        ],
        '10' => [
            '00' => 'Baixado conforme instruções da agência',
            '14' => 'Título protestado',
            '15' => 'Título excluído',
            '16' => 'Título baixado pelo banco por decurso prazo',
            '17' => 'Titulo baixado transferido carteira',
            '20' => 'Titulo baixado e transferido para desconto',
        ],
        '15, 17' => [
            '00' => 'Título pago com dinheiro',
            '15' => 'Título pago com cheque',
        ],
        '24' => [
            '48' => 'CEP inválido',
        ],
        '27' => [
            '04' => 'Código de ocorrência não permitido para a carteira',
            '07' => 'Agência/conta/dígito inválidos',
            '08' => 'Nosso número inválido',
            '10' => 'Carteira inválida',
            '15' => 'Carteira/agência/conta/nosso número inválidos',
            '40' => 'Título com ordem de protesto emitido',
            '42' => 'Código para baixa/devolução via tele bradesco inválido',
            '60' => 'Movimento para título não cadastrado',
            '77' => 'Transferência para desconto não permitido para a carteira',
            '85' => 'Título com pagamento vinculado',
        ],
        '28' => [
            '02' => 'Tarifa de permanência título cadastrado',
            '03' => 'Tarifa de sustação',
            '04' => 'Tarifa de protesto',
            '05' => 'Tarifa de outras instruções',
            '06' => 'Tarifa de outras ocorrências',
            '08' => 'Custas de protesto',
            '12' => 'Tarifa de registro',
            '13' => 'Tarifa título pago no bradesco',
            '14' => 'Tarifa título pago compensação',
            '15' => 'Tarifa título baixado não pago',
            '16' => 'Tarifa alteração de vencimento',
            '17' => 'Tarifa concessão abatimento',
            '18' => 'Tarifa cancelamento de abatimento',
            '19' => 'Tarifa concessão desconto',
            '20' => 'Tarifa cancelamento desconto',
            '21' => 'Tarifa título pago CICS',
            '22' => 'Tarifa título pago internet',
            '23' => 'Tarifa título pago terminal gerencial serviços',
            '24' => 'Tarifa título pago pág-contas',
            '25' => 'Tarifa título pago fone fácil',
            '26' => 'Tarifa título débito postagem',
            '27' => 'Tarifa impressão de títulos pendentes',
            '28' => 'Tarifa título pago BDN',
            '29' => 'Tarifa título pago terminal multi função',
            '30' => 'Impressão de títulos baixados',
            '31' => 'Impressão de títulos pagos',
            '32' => 'Tarifa título pago pagfor',
            '33' => 'Tarifa reg/pgto – guichê caixa',
            '34' => 'Tarifa título pago retaguarda',
            '35' => 'Tarifa título pago subcentro',
            '36' => 'Tarifa título pago cartão de crédito',
            '37' => 'Tarifa título pago comp eletrônica',
            '38' => 'Tarifa título baixado/pago cartório',
            '39' => 'Tarifa título baixado acerto banco',
            '40' => 'Baixa registro em duplicidade',
            '41' => 'Tarifa título baixado decurso prazo',
            '42' => 'Tarifa título baixado judicialmente',
            '43' => 'Tarifa título baixado via remessa',
            '44' => 'Tarifa título baixado rastreamento',
            '45' => 'Tarifa título baixado conf. pedido',
            '46' => 'Tarifa título baixado protestado',
            '47' => 'Tarifa título baixado para devolução',
            '48' => 'Tarifa título baixado franco pagto',
            '49' => 'Tarifa título baixado sust/ret/cartório',
            '50' => 'Tarifa título baixado sus/sem/rem/cartório',
            '51' => 'Tarifa título transferido desconto',
            '52' => 'Cobrado baixa manual',
            '53' => 'Baixa por acerto cliente',
            '54' => 'Tarifa baixa por contabilidade',
            '55' => 'Tarifa tentativa cons deb aut',
            '56' => 'Tarifa credito online',
            '57' => 'Tarifa reg/pagto bradesco expresso',
            '58' => 'Tarifa emissão papeleta',
            '59' => 'Tarifa fornec papeleta semi preenchida',
            '60' => 'Acondicionador de papeletas (rpb)s',
            '61' => 'Acondicionador de papelatas (rpb)s personal',
            '62' => 'Papeleta formulário branco',
            '63' => 'Formulário A4 serrilhado',
            '64' => 'Fornecimento de softwares transmiss',
            '65' => 'Fornecimento de softwares consulta',
            '66' => 'Fornecimento micro completo',
            '67' => 'Fornecimento moden',
            '68' => 'Fornecimento de máquina fax',
            '69' => 'Fornecimento de máquinas óticas',
            '70' => 'Fornecimento de impressoras',
            '71' => 'Reativação de título',
            '72' => 'Alteração de produto negociado',
            '73' => 'Tarifa emissão de contra recibo',
            '74' => 'Tarifa emissão 2a via papeleta',
            '75' => 'Tarifa regravação arquivo retorno',
            '76' => 'Arq. títulos a vencer mensal',
            '77' => 'Listagem auxiliar de crédito',
            '78' => 'Tarifa cadastro cartela instrução permanente',
            '79' => 'Canalização de crédito',
            '80' => 'Cadastro de mensagem fixa',
            '81' => 'Tarifa reapresentação automática título',
            '82' => 'Tarifa registro título déb. automático',
            '83' => 'Tarifa rateio de crédito',
            '84' => 'Emissão papeleta sem valor',
            '85' => 'Sem uso',
            '86' => 'Cadastro de reembolso de diferença',
            '87' => 'Relatório fluxo de pagto',
            '88' => 'Emissão extrato mov. carteira',
            '89' => 'Mensagem campo local de pagto',
            '90' => 'Cadastro concessionária serv. publ.',
            '91' => 'Classif. extrato conta corrente',
            '92' => 'Contabilidade especial',
            '93' => 'Realimentação pagto',
            '94' => 'Repasse de créditos',
            '96' => 'Tarifa reg. pagto outras mídias',
            '97' => 'Tarifa reg/pagto – net empresa',
            '98' => 'Tarifa título pago vencido',
            '99' => 'Tarifa título baixado por decurso prazo',
            '100' => 'Arquivo retorno antecipado',
            '101' => 'Arq retorno hora/hora',
            '102' => 'Tarifa agendamento déb aut',
            '105' => 'Tarifa agendamento rat. crédito',
            '106' => 'Tarifa emissão aviso rateio',
            '107' => 'Extrato de protesto',
        ],
        '29' => [
            '78' => 'Pagador alega que faturamento e indevido',
            '95' => 'Pagador aceita/reconhece o faturamento',
        ],
        '30' => [
            '01' => 'Código do banco inválido',
            '04' => 'Código de ocorrência não permitido para a carteira',
            '05' => 'Código da ocorrência não numérico',
            '08' => 'Nosso número inválido',
            '15' => 'Característica da cobrança incompatível',
            '16' => 'Data de vencimento inválido',
            '17' => 'Data de vencimento anterior a data de emissão',
            '18' => 'Vencimento fora do prazo de operação',
            '24' => 'Data de emissão inválida',
            '26' => 'Código de juros de mora inválido',
            '27' => 'Valor/taxa de juros de mora inválido',
            '28' => 'Código de desconto inválido',
            '29' => 'Valor do desconto maior/igual ao valor do título',
            '30' => 'Desconto a conceder não confere',
            '31' => 'Concessão de desconto já existente (desconto anterior)',
            '32' => 'Valor do iof inválido',
            '33' => 'Valor do abatimento inválido',
            '34' => 'Valor do abatimento maior/igual ao valor do título',
            '38' => 'Prazo para protesto inválido',
            '39' => 'Pedido de protesto não permitido para o título',
            '40' => 'Título com ordem de protesto emitido',
            '42' => 'Código para baixa/devolução inválido',
            '46' => 'Tipo/número de inscrição do pagador inválidos',
            '48' => 'CEP inválido',
            '53' => 'Tipo/número de inscrição do pagador/avalista inválidos',
            '54' => 'Pagadorr/avalista não informado',
            '57' => 'Código da multa inválido',
            '58' => 'Data da multa inválida',
            '60' => 'Movimento para título não cadastrado',
            '79' => 'Data de juros de mora inválida',
            '80' => 'Data do desconto inválida',
            '85' => 'Título com pagamento vinculado.',
            '88' => 'E-mail pagador não lido no prazo 5 dias',
            '91' => 'E-mail pagador não recebido',
        ],
        '32' => [
            '01' => 'Código do banco inválido',
            '02' => 'Código do registro detalhe inválido',
            '04' => 'Código de ocorrência não permitido para a carteira',
            '05' => 'Código de ocorrência não numérico',
            '07' => 'Agência/conta/dígito inválidos',
            '08' => 'Nosso número inválido',
            '10' => 'Carteira inválida',
            '15' => 'Características da cobrança incompatíveis',
            '16' => 'Data de vencimento inválida',
            '17' => 'Data de vencimento anterior a data de emissão',
            '18' => 'Vencimento fora do prazo de operação',
            '20' => 'Valor do título inválido',
            '21' => 'Espécie do título inválida',
            '22' => 'Espécie não permitida para a carteira',
            '24' => 'Data de emissão inválida',
            '28' => 'Código de desconto via telebradesco inválido',
            '29' => 'Valor do desconto maior/igual ao valor do título',
            '30' => 'Desconto a conceder não confere',
            '31' => 'Concessão de desconto - já existe desconto anterior',
            '33' => 'Valor do abatimento inválido',
            '34' => 'Valor do abatimento maior/igual ao valor do título',
            '36' => 'Concessão abatimento - já existe abatimento anterior',
            '38' => 'Prazo para protesto inválido',
            '39' => 'Pedido de protesto não permitido para o título',
            '40' => 'Título com ordem de protesto emitido',
            '41' => 'Pedido cancelamento/sustação para título sem instrução de protesto',
            '42' => 'Código para baixa/devolução inválido',
            '45' => 'Nome do pagador não informado',
            '46' => 'Tipo/número de inscrição do pagador inválidos',
            '47' => 'Endereço do pagador não informado',
            '48' => 'CEP inválido',
            '50' => 'CEP referente a um banco correspondente',
            '53' => 'Tipo de inscrição do pagador avalista inválidos',
            '60' => 'Movimento para título não cadastrado',
            '85' => 'Título com pagamento vinculado',
            '86' => 'Seu número inválido',
            '94' => 'Título penhorado – instrução não liberada pela agência',
        ],
        '35' => [
            '81' => 'Tentativas esgotadas, baixado',
            '82' => 'Tentativas esgotadas, pendente',
            '83' => 'Cancelado pelo pagador e mantido pendente, conforme negociação',
            '84' => 'Cancelado pelo pagador e baixado, conforme negociação',
        ],
    ];

    /**
     * Remittance occurrences codes.
     *
     * @var array
     */
    protected static $remittanceOccurrences = [
        '01' => 'Remessa',
        '02' => 'Pedido de baixa',
        '03' => 'Pedido de protesto falimentar',
        '04' => 'Concessão de abatimento',
        '05' => 'Cancelamento de abatimento concedido',
        '06' => 'Alteração de vencimento',
        '07' => 'Alteração do controle do participante',
        '08' => 'Alteração de seu número',
        '09' => 'Pedido de protesto',
        '18' => 'Sustar protesto e baixar título',
        '19' => 'Sustar protesto e manter em carteira',
        '22' => 'Transferência cessão crédito ID produto 10',
        '23' => 'Transferência entre carteiras',
        '24' => 'Dev. transferência entre carteiras',
        '31' => 'Alteração de outros dados',
        '68' => 'Acerto nos dados do rateio de crédito',
        '69' => 'Cancelamento do rateio de crédito',
    ];

    /**
     * Return occurrences codes.
     *
     * @var array
     */
    protected static $returnOccurrences = [
        '02' => 'Entrada confirmada',
        '03' => 'Entrada rejeitada',
        '06' => 'Liquidação normal',
        '09' => 'Baixado automaticamente via arquivo',
        '10' => 'Baixado conforme instruções da agência',
        '11' => 'Em ser - arquivo de títulos pendentes',
        '12' => 'Abatimento concedido',
        '13' => 'Abatimento cancelado',
        '14' => 'Vencimento alterado',
        '15' => 'Liquidação em cartório',
        '16' => 'Título pago em cheque – vinculado',
        '17' => 'Liquidação após baixa ou título não registrado',
        '18' => 'Acerto de depositária',
        '19' => 'Confirmação recebimento instrução de protesto',
        '20' => 'Confirmação recebimento instrução sustação de protesto',
        '21' => 'Acerto do controle do participante',
        '22' => 'Título com pagamento cancelado',
        '23' => 'Entrada do título em cartório',
        '24' => 'Entrada rejeitada por CEP irregular',
        '25' => 'Confirmação recebimento instrução de protesto falimentar',
        '27' => 'Baixa rejeitada',
        '28' => 'Débito de tarifas/custas',
        '29' => 'Ocorrências do pagador',
        '30' => 'Alteração de outros dados rejeitados',
        '32' => 'Instrução rejeitada',
        '33' => 'Confirmação pedido alteração outros dados',
        '34' => 'Retirado de cartório e manutenção carteira',
        '35' => 'Desagendamento do débito automático',
        '40' => 'Estorno de pagamento',
        '55' => 'Sustado judicial',
        '68' => 'Acerto dos dados do rateio de crédito',
        '69' => 'Cancelamento dos dados do rateio',
    ];

    /**
     * Return the default state of info.
     *
     * @return \StdClass
     */
    public function defaults()
    {
        return (object) [
            'especie' => '01',
            'instruction1' => '00',
            'instruction2' => '00',
        ];
    }
}
