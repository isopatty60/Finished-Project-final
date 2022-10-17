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
                        <h2>รายการ {{ $income1Name->title }}</h2>
                        <p class="text-subtitle text-muted">For Receipt to check they list</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Receipt Control</li>

                            </ol>
                            <p>Date/Time: <span id="datetime"></span></p>
                            <script>
                                var dt = new Date();
                                document.getElementById("datetime").innerHTML = (("0" + dt.getDate()).slice(-2)) + "." + (("0" + (dt.getMonth() +
                                    1)).slice(-2)) + "." + (dt.getFullYear()) + " " + (("0" + dt.getHours()).slice(-2)) + ":" + (("0" + dt
                                    .getMinutes()).slice(-2));
                            </script>
                        </nav>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <section class="section">
                <div class="card">
                    <div class="card-header">

                        <a class="btn btn-success" href="{{ route('create001', ['id' => $id]) }}"> เพิ่มรายการ</a>
                    </div>


                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Details</th>
                                    <th>Date</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                                @foreach ($income1 as $i => $value)
                            <form id="ConvertMonth">

                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td hidden>
                                            <input value="{{ $value->name }}" id="valueIncome1" name="valueIncome1" >
                                        </td>
                                        <td>
                                            <a id="valueIncome2" name="valueIncome2"></a>

                                        </td>
                                        {{-- <td><a href="{{ route('income2.show', $value->id) }}"
                                                class="inster">{{ $value->name }}</a></td> --}}
                                        <td>{{ \Str::limit($value->detail, 100) }}</td>
                                        <td>{{ $value->date }}</td>
                                        <td>
                                            <form action="{{ route('income1.destroy', $value->id) }}" method="POST">
                                                <!-- <a class="btn btn-info" href="{{ route('income1.show', $value->id) }}"><i class="bi bi-eye"></i></a>     -->
                                                <a class="btn btn-primary"
                                                    href="{{ route('income1.edit', $value->id) }}"><i
                                                        class="bi bi-pencil-square"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure to want to delete it?')"
                                                    class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>

                                        </td>

                                    </tr>

                            </form>

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

                    {!! $income1->links() !!}
                    <script >
                        let monthNames = [
                            "-", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน",
                            "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม.",
                            "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
                        ];

                        // var result = monthNames[{{ $value->name }}];
                        // var value = document.getElementById("valueIncome1").value;
                        // document.getElementById("valueIncome2").value = monthNames[ value ];


                        var formM = document.getElementsByName("form");
                        var text = "";
                        var i;

                        var jo =  document.getElementsByName("valueIncome1");
                        for (i = 0; i < jo.length; i++) {
                            text = monthNames[jo[i].value] ;
                            document.getElementsByName("valueIncome2")[i].innerHTML = text;

                        }
                        // document.getElementsByTagName("p")[0].innerHTML = "Hello World!";
                        // console.log( document.getElementsByName("valueIncome2") );

                    </script>

                @endsection
