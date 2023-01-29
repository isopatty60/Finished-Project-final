<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">


    <title>Invoice</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .text-right {
            text-align: right;
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        body {
            font-family: "THSarabunNew";
        }
    </style>
</head>

<body class="login-page" style="background: white">
    <strong>รายการ {{ $invDetailsName->name }}</strong>
    <div>
        <div class="row">
            <div class="col-xs-7">
                <strong>Company IDEACLE</strong><br>
                94 Moo 16.
                Pa Phai sub district,<br>
                San Sai district,
                Chiang Mai 50290
                <!-- P: (416) 123-4567 <br>
                E: copmany@company.com <br> -->

                <br>
            </div>

            <div class="col-xs-4">
                <img src="assets/images/logo/logo.png" style="height: 8%">
            </div>
        </div>

        <table style="width: 100%; margin-bottom: 20px">

            <tbody>

                <tr class="well" style="padding: 5px">
                    <!-- <th style="padding: 5px"><div> Balance Due (CAD) </div></th> -->
                    <!-- <td style="padding: 5px" class="text-right"><strong> $600 </strong></td> -->
                </tr>
            </tbody>
        </table>
    </div>
    </div>

    <table class="table">
        <thead style="background: #F5F5F5;">
            <tr>
                <th>ชื่อ</th>
                <th>รายลเอียด</th>
                <th>ราคา</th>
                <th>วันที่</th>
            </tr>
        </thead>
        <tbody>
            @php
                $sum_total = 0;
            @endphp
            @foreach ($invItemExpenses as $i => $value)
                <tr>
                    @php
                        $sum_total = $sum_total + $value->price;
                    @endphp
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->detail }}</td>
                    <td>{{ number_format($value->price, 2) }} </td>
                    <td>{{ $value->date }}</td>

                    </div>
                </tr>
            @endforeach
            <tr>
                <td colspan="2">รวม</td>
                <td>{{ number_format($sum_total, 2) }}</td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-xs-6"></div>
        <div class="col-xs-5">
            <table style="width: 100%">

            </table>
        </div>
    </div>




</body>

</html>
