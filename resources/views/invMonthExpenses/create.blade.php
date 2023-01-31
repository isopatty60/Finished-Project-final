@extends('layouts.master')
@section('menu')
    @extends('sidebar.income2page')
@endsection
@section('content')

    <div id="main">
        <style>
            .avatar.avatar-im .avatar-content,
            .avatar.avatar-xl img {
                width: 40px !important;
                height: 40px !important;
                font-size: 1rem !important;
            }

            .form-group[class*=has-icon-].has-icon-lefts .form-select {
                padding-left: 2rem;
            }
        </style>

        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>เพิ่มรายการ</h3>
                        <p class="text-subtitle text-muted">ใบเสร็จรับเงินตรวจสอบรายการ</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
                                <li class="breadcrumb-item active" aria-current="page">เพิ่มรายการ</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>


        @section('content')

            <head>
                <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/> -->
                <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
                    rel="stylesheet">
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
                <link rel="stylesheet" href="<?php echo asset('css/SelectBox.css'); ?>" type="text/css">


            </head>


            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('invMonthExpenses.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>ชิ่อ:</strong>
                            {{-- <input type="text"  name="name" class="form-control" placeholder="Enter name"> --}}
                            <select id="pickdate" class="form-select" name="name">
                                <option value="1">มกราคม</option>
                                <option value="2">กุมพาพันธ์</option>
                                <option value="3">มีนาคม</option>
                                <option value="4">เมษายน</option>
                                <option value="5">พฤษภาคม</option>
                                <option value="6">มิถุนายน</option>
                                <option value="7">กรกฎาคม</option>
                                <option value="8">สิงหาคม</option>
                                <option value="9">กันยายน</option>
                                <option value="10">ตุลาคม</option>
                                <option value="11">พฤศจิกายน</option>
                                <option value="12">ธันวาคม</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>รายละอียด:</strong>
                            <textarea class="form-control" style="height:150px" name="detail" placeholder="รายละอียด"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                        <div class="form-group">
                            <strong>fiscal_year_id_expenses:</strong>
                            <input type="number" name="fiscal_year_id_expenses" class="form-control"
                                value={{ $id }}>
                        </div>
                    </div>
                    <br>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary" onclick="sentEvent()">ตกลง</button>
                        <a class="btn btn-primary" href="javascript:history.back()"> กลับ</a>
                    </div>
                </div>

            </form>
        @endsection
