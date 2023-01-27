@extends('layouts.master')
@section('menu')
    @extends('sidebar.income2page')
@endsection
@section('content')
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
                        <h2>รายการ {{ $monthsName->title }}</h2>
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
                        <a class="btn btn-success" href="{{ route('createInvMonthsExpenses', ['id' => $id]) }}">
                            เพิ่มรายการ</a>
                        <a class="btn btn-success" href="javascript:history.back()"> กลับ</a>

                    </div>


                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่อ</th>
                                    <th>รายละเอียด</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            @foreach ($invMonthExpenses as $i => $value)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td hidden>
                                        <input value="{{ $value->name }}" id="valueIncome1" name="valueIncome1">
                                    </td>
                                    {{-- <td>
                                            <a id="valueIncome2" name="valueIncome2"></a>
                                        </td> --}}
                                    <td><a href="{{ route('invDetailExpenses.show', $value->id) }}" class="inster"
                                            id="valueIncome2"name="valueIncome2"></a></td>
                                    <td>{{ \Str::limit($value->detail, 100) }}</td>
                                    <td>
                                        <!-- <a class="btn btn-info" href="{{ route('InvMonths.show', $value->id) }}"><i class="bi bi-eye"></i></a>     -->
                                        <form action="{{ route('InvMonths.destroy', $value->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            {{-- <button type="submit"
                                                    onclick="return confirm('Are you sure to want to delete it?')"
                                                    class="btn btn-danger"><i class="bi bi-trash"></i></button> --}}
                                            <input type="submit" class="btn btn-danger" value="ลบ"></input>
                                        </form>
                                        {{-- <td><a href="{{ route('income1s.destroy', $value->id) }}"><i
                                                    class="bi bi-trash"></i></a></td> --}}
                                    </td>
                                </tr>
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
                                    var i;
                                    var jo = document.getElementsByName("valueIncome1");
                                    if (jo.length != 0) {
                                        for (i = 0; i < jo.length; i++) {
                                            text = monthNames[jo[i].value];
                                            document.getElementsByName("valueIncome2")[i].innerHTML = text;
                                        }
                                    } else {
                                        document.getElementsByName("valueIncome2").innerHTML = '';
                                    }
                                </script>
                            @endforeach
                        </table>
                        <footer>
                            <div class="footer clearfix mb-0 text-muted ">
                                <div class="float-start">
                                    <p>2022 &copy; IDEACLE</p>
                                </div>
                                <div class="float-end">
                                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                            href="">IDEACLE CO.,LTD</a></p>
                                </div>
                            </div>
                        </footer>
                    </div>
                    {!! $invMonthExpenses->links() !!}
                @endsection
