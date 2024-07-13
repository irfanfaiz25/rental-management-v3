<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentals Report</title>

    <style>
        body {
            font-size: 12px;
            margin: 0px;
        }

        .table-border {
            border: 1.5px solid #292929;
        }

        .table-space-right {
            margin-right: 0px;
        }

        .table-space-left {
            margin-top: 20px;
        }

        .table-text-center {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .column-6 {
            flex: 1;
            padding: 7px;
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-header {
            margin-top: -13px;
        }

        .text-first-header {
            margin-top: 0px;
        }

        .header-bottom {
            margin-bottom: -7px;
            padding-bottom: 0px;
        }

        .kode-row {
            width: fit-content;
        }

        .table-patroli {
            height: 30px;
        }

        .table-sign {
            height: 75px;
        }

        .date-footer {
            margin-top: -32px;
        }

        .footer-note {
            margin-top: -10px;
        }

        .footer-name {
            margin-top: 25px;
            margin-bottom: -20px;
        }

        .footer {
            display: flex;
            flex-wrap: wrap;
        }

        .note-1 {
            position: fixed;
            left: 69.7% !important;
        }

        .footer-head-1 {
            position: fixed;
            margin-top: -18px;
            left: 68% !important;
        }

        .note-2 {
            position: fixed;
            left: 79.7% !important;
        }

        .footer-head-2 {
            position: fixed;
            margin-top: -18px;
            left: 78% !important;
        }

        .title {
            display: flex;
            justify-content: center;
            text-align: center;
            font-size: 20px;
            line-height: 2rem;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .mother-box {
            justify-items: center;
            margin: 5px 10px 5px;
            text-transform: capitalize;
            font-weight: 300;
        }

        .box {
            width: 100%;
            height: 10px;
            background-color: #e5e7eb;
            border-radius: 9999px;
        }

        .box-inner-red {
            background-color: #ef4444;
            height: 10px;
            border-radius: 9999px;
            width: 40%;
        }

        .box-inner-green {
            background-color: #22c55e;
            height: 10px;
            border-radius: 9999px;
            width: 100%;
        }

        .mb-2 {
            margin-bottom: 5px;
        }

        .table-header {
            padding: 10px 5px 10px;
        }

        .flex {
            display: flex;
        }

        .justify-center {
            justify-content: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .bg-gray {
            background-color: #4d4d4d;
            color: white;
        }

        .py-5 {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .px-5 {
            padding-left: 2.5rem;
            padding-right: 2.5rem;
        }

        .rounded-md {
            border-radius: 0.2rem;
        }

        .w-full {
            width: 100%;
        }

        .finance-info {
            display: flex;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-right: 0px;
            padding-left: 0px;
            width: full;
            justify-content: space-evenly;
            font-size: 15px;
            font-weight: 500;
        }

        .currency-number {
            padding-left: 5px;
            font-size: 30px;
            font-weight: 600;
        }

        .table-content {
            display: flex;
            justify-content: space-evenly;
        }

        .text-total {
            font-size: 15px;

        }

        .number-total {
            font-size: 15px;
            font-weight: 500;
        }

        body {
            padding: 10px;
        }
    </style>
</head>

<body>
    <div>
        <p>@justDate($dateStart) - @justDate($dateEnd)</p>
    </div>
    <div class="flex bg-gray py-5 rounded-md w-full mb-2 justify-center">
        <h2 class="title">
            Rentals Report Data
        </h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>
                    <div class="flex">
                        <p>Incomes</p>
                        <p class="currency-number">
                            @currency($incomeTotal)
                        </p>
                    </div>
                </th>
                <th>
                    <div class="flex">
                        <p>Expenditure</p>
                        <p class="currency-number">
                            @currency($expenditureTotal)
                        </p>
                    </div>
                </th>
                <th>
                    <div class="flex">
                        <p>Profits</p>
                        <p class="currency-number">
                            @currency($profitTotal)
                        </p>
                    </div>
                </th>
            </tr>
        </thead>
    </table>

    <div class="table-content">
        <h2 class="title">
            Incomes Data
        </h2>
        <table class="table-border table-space-right">
            <thead>
                <tr class="table-border table-text-center">
                    <th class="table-border table-header">
                        No
                    </th>
                    <th class="table-border table-header">
                        Date
                    </th>
                    <th class="table-border table-header">
                        Source
                    </th>
                    <th class="table-border table-header">
                        Amount
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $num = 1;
                @endphp
                @foreach ($incomes as $income)
                    <tr class="table-border table-text-center">
                        <td class="table-border table-text-center">
                            <span>{{ $num++ }}</span>
                        </td>
                        <td class="table-border text-left">
                            <span>
                                @justDate($income->reporting_date)
                            </span>
                        </td>
                        <td class="table-border table-text-center">
                            <span>
                                {{ $income->source }}
                            </span>
                        </td>
                        <td class="table-border table-text-center">
                            <span>
                                @currency($income->amount)
                            </span>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="table-text-center table-border text-total">
                        <p>Total</p>
                    </td>
                    <td class="table-text-center number-total">
                        <p>
                            @currency($incomeTotal)
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <h2 class="title">
            Expenditure Data
        </h2>
        <table class="table-border table-space-left">
            <thead>
                <tr class="table-border table-text-center">
                    <th class="table-border table-header">
                        No
                    </th>
                    <th class="table-border table-header">
                        Date
                    </th>
                    <th class="table-border table-header">
                        Items
                    </th>
                    <th class="table-border table-header">
                        Amount
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $num = 1;
                @endphp
                @foreach ($expenditures as $expenditure)
                    <tr class="table-border table-text-center">
                        <td class="table-border table-text-center">
                            <span>{{ $num++ }}</span>
                        </td>
                        <td class="table-border text-left">
                            <span>
                                {{ $expenditure->expend_date }}
                            </span>
                        </td>
                        <td class="table-border table-text-center">
                            <span>
                                {{ $expenditure->name }}
                            </span>
                        </td>
                        <td class="table-border table-text-center">
                            <span>
                                @currency($expenditure->amount)
                            </span>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="table-text-center table-border text-total">
                        <p class="info-total">Total</p>
                    </td>
                    <td class="table-text-center number-total">
                        <p class="info-total">
                            @currency($expenditureTotal)
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
