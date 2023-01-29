@extends('layouts.master')
@section('menu')
    @extends('sidebar.income2page')
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.11.5/api/sum().js"></script>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h2>เดือน {{ $invDetailsName->name }}<h2 id="valueIncome2"></h2>
                        </h2>
                        <p class="text-subtitle text-muted">ใบเสร็จรับเงินตรวจสอบรายการ</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
                                <li class="breadcrumb-item active" aria-current="page">รายการ</li>

                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-success" href="{{ route('createInvDetails', ['id' => $id]) }}">
                            เพิ่มรายการรายละเอียด</a>
                        <a href="/pdfInvDetails/{{ $id }} ?>" target="_blank" class="btn btn-success">
                            <span>รายงานรายละเอียด</span></a>
                        <a href="/InvMonths/{{ $invDetailsName->Fiscal_year_id }}" class="btn btn-success">
                            <span>กลับ</span></a>

                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่อ</th>
                                    <th>รายละเอียด</th>
                                    <th>วันที่</th>
                                    <th>จำนวนเงิน</th>
                                    <th>รายการ</th>
                                    <th width="280px">แก้ไข</th>
                                </tr>
                            </thead>
                            @php
                                $sum_total = 0;
                            @endphp
                            @foreach ($invDetails as $i => $value)
                                @php
                                    $sum_total = $sum_total + $value->price;
                                @endphp
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td><a href="{{ route('invItems.show', $value->id) }}"
                                            class="inster">{{ $value->name }}</a></td>
                                    <td>{{ \Str::limit($value->detail, 100) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($value->date)) }}</td>
                                    <td> {{ number_format($value->price, 2) }} </td>
                                    <td>{{ $value->note }}</td>
                                    <td>
                                        <form action="{{ route('invDetails.destroy', $value->id) }}" method="POST">
                                            <!-- <a class="btn btn-info" href="{{ route('invDetails.show', $value->id) }}"><i class="bi bi-eye"></i></a>     -->
                                            <a class="btn btn-primary" href="{{ route('invDetails.edit', $value->id) }}"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure to want to delete it?')"
                                                class="btn btn-danger"><i class="bi bi-trash"></i></button>

                                        </form>
                                        <div class="col-12 col-md-6 order-md-1 order-last">

                                            </h2>

                                    </td>

                                </tr>

                                <script type=text/javascript>
                                    // console.log({{ $invDetailsName->name }});
                                    var monthNames = [
                                        "-", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน",
                                        "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม.",
                                        "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
                                    ];
                                    // var result = monthNames[{{ $value->name }}];
                                    // var value = document.getElementById("valueIncome1").value;
                                    // document.getElementById("valueIncome2").value = monthNames[ value ];
                                    var text = "";
                                    var jo = {{ $invDetailsName->name }};
                                    text = monthNames[jo];
                                    document.getElementById("valueIncome2").innerHTML = text;
                                    // console.log(text);
                                </script>
                            @endforeach
                            <tr>
                                <td colspan="4">รวม</td>
                                <td>{{ number_format($sum_total, 2) }}</td>
                            </tr>
                            @if ($invDetailsName != null && count($invDetails) > 1)
                                <script type=text/javascript>
                                    var monthNames = [
                                        "-", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน",
                                        "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม.",
                                        "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
                                    ];
                                    // var result = monthNames[{{ $value->name }}];
                                    // var value = document.getElementById("valueIncome1").value;
                                    // document.getElementById("valueIncome2").value = monthNames[ value ];
                                    var text = "";
                                    var jo = {{ $invDetailsName->name }};
                                    text = monthNames[jo];
                                    document.getElementById("valueIncome2").innerHTML = text;
                                </script>
                            @endif
                        </table>
                        <footer>
                            <div class="footer clearfix mb-0 text-muted ">
                                <div class="float-start">
                                    <p>2022 &copy; IDEACLE</p>
                                </div>
                                <div class="float-end">
                                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                            href="">IDEACLE</a></p>
                                </div>
                            </div>
                        </footer>
                    </div>





                    {!! $invDetails->links() !!}
                @endsection
