<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-PosAja Report</title>

    <style>
        body {
            font-size: 12px;
            margin: 0px;
        }

        .table-border {
            border: 1.5px solid #292929;
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
    </style>
</head>

<body>
    <h2 class="title">
        Hasil Analisa Evaluasi Pengalaman Penggunaan Aplikasi PosAja
    </h2>
    <table class="table-border">
        <thead>
            <tr class="table-border table-text-center">
                <th class="table-border table-header">
                    NO
                </th>
                <th class="table-border table-header">
                    Pertanyaan
                </th>
                <th class="table-border table-header">
                    Variable
                </th>
                <th class="table-border table-header">
                    Total Skor
                </th>
                <th class="table-border table-header">
                    AVG Skor (%)
                </th>
                <th class="table-border table-header">
                    Analisa
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $num = 1;
            @endphp
            @foreach ($analysisResults as $index => $result)
                <tr class="table-border table-text-center">
                    <td class="table-border table-text-center">
                        <span>{{ $num++ }}</span>
                    </td>
                    <td class="table-border text-left">
                        <span>
                            <ul>
                                @foreach ($result['questions'] as $question)
                                    <li>
                                        {{ $question }}
                                    </li>
                                @endforeach
                            </ul>
                        </span>
                    </td>
                    <td class="table-border table-text-center">
                        <span>{{ $result['variable'] }}</span>
                    </td>
                    <td class="table-border table-text-center">
                        <span>{{ $result['total_score'] }}</span>
                    </td>
                    <td class="table-border table-text-center">
                        <span>{{ $result['average_score'] }}</span>
                    </td>
                    <td class="table-border table-text-center">
                        <div class="mother-box">
                            <p class="mb-2">
                                {{ $result['category_score'] }}
                            </p>
                            <div class="box">
                                @if ($result['category_score'] === 'kurang baik')
                                    <div class="box-inner-red"></div>
                                @elseif ($result['category_score'] === 'sangat baik')
                                    <div class="box-inner-green"></div>
                                @else
                                    <div></div>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
