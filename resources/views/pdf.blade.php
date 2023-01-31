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


    <div>
        <div class="row">
            <div class="col-xs-7">
                วันที่ {{ $invDetailsName->date }}<br>
                เลขที่ใบเสร็จ {{ $invDetailsName->id }}<br>
            </div>
            <div class="col-xs-4">
                <img src="assets/images/logo/logo.png" style="height: 7.5%">
            </div>
        </div>
        <div style="margin-bottom: 0px">&nbsp;</div>
        <div class="row">
            <div class="col-xs-6">
                <strong>จาก :</strong> <br>
                <strong>Company IDEACLE</strong><br>
                94 Moo 16.
                Pa Phai sub district,<br>
                San Sai district,
                Chiang Mai 50290
                P: (416) 123-4567 <br>
                E: copmany@company.com <br>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <strong>ถึง:</strong>
                    <address>
                        คุณ {{ $invDetailsName->title }}<br>
                        ที่อยู่ {{ $invDetailsName->description }}<br>
                        เบอร์โทร {{ $invDetailsName->tel }}<br>
                        ที่อยู่ {{ $invDetailsName->postcode }}<br>
                    </address>
                </div>


            </div><br>

            <table class="table">
                <thead style="background: #F5F5F5;">
                    <tr>
                        <th>ลำดับ</th>
                        <th>รายการ</th>
                        <th>รายละเอียด</th>
                        <th>จำนวน(หน่วย)</th>
                        <th>ราคา</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sum_total = 0;
                    @endphp
                    @foreach ($inv_receipt_details as $i => $value)
                        @php
                            $sum_total_vat = $sum_total + ($value->price * 7) / 100;
                            $sum_total = $sum_total + $sum_total_vat + $value->price;

                        @endphp
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->detail }}</td>
                            <td>{{ $value->amount }}</td>
                            <td> {{ number_format($value->price, 2) }} </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">ภาษีมูลค่าเพิ่ม</th>
                        <th>{{ number_format($sum_total_vat, 2) }} บาท</th>
                    </tr>
                    <tr>
                        <th colspan="4">รวม</th>
                        <th>{{ number_format($sum_total, 2) }} บาท</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    </div>
</body>

</html>
