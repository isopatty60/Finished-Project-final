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

            <form action="{{ route('invDetailExpenses.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>ชื่อ:</strong>
                            <input type="text" name="name" class="form-control" placeholder="ชื่อ">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>รายละเอียด:</strong>
                            <textarea class="form-control" style="height:150px" name="detail" placeholder="รายละเอียด"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>วันที่:</strong>
                            <input class="date form-control" name="date" type="text" placeholder="วันที่">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>ราคา:</strong>
                            <input type="number" name="price" class="form-control" placeholder="ราคา" step="0.01">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <strong>หมายเหตุ:</strong>
                        <div class="select">
                            <select name="note" class="form-select">
                                <option selected disabled>เลือกรายการ</option>
                                <option value="รายรับ">รายรับ</option>
                                <option value="รายจ่าย">รายจ่าย</option>
                            </select>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $('.date').datepicker({
                        format: 'dd-mm-yyyy'
                    });
                </script>
                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                    <div class="form-group">
                        <strong>month_expenses_id:</strong>
                        <input type="number" name="month_expenses_id" class="form-control" value={{ $id }}>
                    </div>
                </div>
                <br>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">ตกลง</button>
                    <a class="btn btn-primary" href="javascript:history.back()"> กลับ</a>
                </div>
        </div>

        </form>
    @endsection
