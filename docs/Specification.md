# Smart-CNAB specifications


## Rules for detail data for occurrenceCodes on REMITTANCE

### Banco do Brasil

- If occurrenceCode is 09 then instruction1 must be set according rules of this
    field;
- If occurrenceCode is 16 then positions 174, 175 and 181 must be set according
    normalization;
- If occurrenceCode in 35, 36 then positions 174, 175 and 181 must be set
    according normalization;
- If occurrenceCode in 38, 39 then positions 174, and 177 must be set according
    normalization;
- If occurrenceCode is 40 then billingType must be set according rules of this
    field. See normalization;
- See normalization and bank documentation if needed.

### Bradesco

- If occurrenceCode is 31 then instruction1 and instruction2 must be 99 and 99
    for canceling automatic protest;
- If occurrenceCode is 01;
    - If instruction1 is 06 then instruction2 must have the number of days to
        protest (min 5);
    - If instruction1 is 05 then instruction2 must have the number of days to
        protest by break (min 5);
    - If instruction1 is 18 then instruction2 must have the number of days to
        time lapse (min 5);
    - For protest instructions document and address of payer must be correct;
- See normalization and bank documentation if needed.

### Caixa

- if occurrenceCode is 02 then registryType, companyCode, ourNumber, portfolio
    and value must be set;
- if occurrenceCode in 03, 04 then registryType, companyCode, ourNumber,
    portfolio, value and rebate must be set;
- if occurrenceCode is 05 then registryType, companyCode, ourNumber, portfolio,
    value and expiration must be set;
- if occurrenceCode is 06 then registryType, companyCode, ourNumber, portfolio,
    value and companyUse must be set;
- if occurrenceCode in 07, 08, 11, 12 then registryType, companyCode, ourNumber,
    portfolio, value and deadline must be set;
    - instruction1 must be set with appropriate code;
- if occurrenceCode in 09, 10 then see rules on normalization;
- See nomalization and bank documentation if needed.

### Itau

- if occurrenceCode in 10, 18, 30, 34, 47, 49, 67, 68, 69, 93 then registryType,
    portfolio, branch, account, portfolioCode, ourNumber and value must be set;
- if occurrenceCode in 04, 05 then registryType, portfolio, branch, account,
    portfolioCode, ourNumber, value and rebate must be set;
- if occurrenceCode in 06, 37 then registryType, portfolio, branch, account,
    portfolioCode, ourNumber, value and expiration must be set;
- if occurrenceCode is 07 then registryType, portfolio, branch, account,
    portfolioCode, ourNumber, value and companyUse must be set;
- if occurrenceCode is 08 then registryType, portfolio, branch, account,
    portfolioCode, ourNumber, value and yourNumber must be set;
- if occurrenceCode in 09, 66 then registryType, portfolio, branch, account,
    portfolioCode, ourNumber, value must be set;
    - See positions for setting the deadline on normalization;
- if occurrenceCode is 11 then registryType, portfolio, branch, account,
    portfolioCode, ourNumber, value must be set;
    - See positions for setting the deadline on normalization;
- if occurrenceCode is 31 then registryType, portfolio, branch, account,
    portfolioCode, ourNumber and value must be set;
    - The other fields for update must be set according normalization and bank
        documentation;
- if occurrenceCode is 35 then registryType, portfolio, branch, account,
    portfolioCode, ourNumber and value must be set;
    - See positions for canceled instruction on normalization;
- if occurrenceCode is 38 then registryType, portfolio, branch, account,
    portfolioCode, ourNumber,value and motive must be set;
    - See position for motive code on normalization;
- See nomalization and bank documentation if needed.

### SICOOB

- All basic data must be set;
    - According the occurrenceCode the related data must be set, example: if
        occurrenceCode is 04 then rebate must be set and so on;
- See nomalization and bank documentation if needed.

### Santander

- All basic data must be set;
    - According the occurrenceCode the related data must be set, example: if
        occurrenceCode is 04 then rebate must be set and so on;
- See nomalization and bank documentation if needed.

## Rules for entries, payments, discharges and protests on RETURN

### Banco do Brasil

|            | occurrenceCode          |
|------------|-------------------------|
| Entry      | 02                      |
| Payment    | 05, 06, 07, 08, 15      |
| Discharge  | 09                      |
| Protest    | 19                      |

### Bradesco

|            | occurrenceCode          |
|------------|-------------------------|
| Entry      | 02                      |
| Payment    | 06, 15, 17              |
| Discharge  | 09, 10                  |
| Protest    | 19, 25                  |

### Caixa

|            | occurrenceCode          |
|------------|-------------------------|
| Entry      | 02                      |
| Payment    | 21, 22                  |
| Discharge  | 02, 23                  |
| Protest    | 25                      |

### Itau

|            | occurrenceCode          |
|------------|-------------------------|
| Entry      | 02, 64                  |
| Payment    | 06, 07, 08, 10          |
| Discharge  | 09, 47, 59, 72          |
| Protest    | 32                      |

### SICOOB

|            | occurrenceCode          |
|------------|-------------------------|
| Entry      | 02                      |
| Payment    | 05, 06, 15              |
| Discharge  | 09, 10                  |
| Protest    | 23                      |

### Santander

|            | occurrenceCode          |
|------------|-------------------------|
| Entry      | 02                      |
| Payment    | 06, 07, 08, 17          |
| Discharge  | 09, 10                  |
| Protest    | 15                      |


## Rules for development of structure

- All banks support classes must implement the BankSupport interface;
- The Bank class must be updated if needed.

## Rules for output

### All banks

- All banks must have getters for status of error, entry, payment, discharge and protest;
    - These getters must be generalized when possible;
    - For errors the getter must be was_an_error for error occurrence codes or
        rejection codes;
    - For entry the getter must be was_entry_confirmed for entry occurrence codes;
    - For payment the getter must be was_paid for payment occurrence codes;
    - For discharge the getter must be was_discharged for discharge occurrence
        codes;
    - For protest the getter must be was_protested for protest occurrence codes;
- All banks must have a getter for messages and motives on detail records;
    - Messages will return the messages associated with motive codes;
    - Motives will return the motives codes returned by bank;
    - To see what the fields are associated with messages and motive see the
        normalization.
