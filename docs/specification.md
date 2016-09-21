# Smart-CNAB specifications


## Rules for entries, payments, discharges and protests

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


## Rules for output

### All banks

- All banks must have getters for status of entry, payment, discharge and protest
    - For entry the getter must be was_entry_confirmed for entry occurrence codes
    - For payment the getter must be was_paid for payment occurrence codes
    - For discharge the getter must be was_discharged for discharge occurrence codes
    - For protest the getter must be was_protested for protest occurrence codes
- All banks must have a getter for messages and motives on detail records
    - Messages will return the messages associated with motive codes
    - Motives will return the motives codes returned by bank
    - To see what the fields are associated with messages and motive see the normalization