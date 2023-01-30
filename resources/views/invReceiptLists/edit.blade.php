@extends('layouts.master')
@section('menu')
    @extends('sidebar.income2page')
@endsection
@section('content')

    <head>
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/> -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
            rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    </head>
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
                        <h3>แก้ไขรายชื่อลูกค้า</h3>
                        <p class="text-subtitle text-muted">ออกใบเสร็จให้ลูกค้า</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">แก้ไขรายชื่อลูกค้า</li>
                            </ol>

                        </nav>
                    </div>
                </div>
            </div>


            <form action="{{ route('invReceiptLists.update', $invReceiptLists->id) }}" method="POST">
                @csrf
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>รายการ :</strong>
                                        <input type="text" class="form-control" placeholder="โปรดใส่รายการ"
                                            id="first-name-icon" name="title" value="{{ $invReceiptLists->title }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>ที่อยู่:</strong>
                                        <textarea class="form-control" style="height:150px" name="address" placeholder="โปรดใส่ที่อยู่">{{ $invReceiptLists->address }}</textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>เบอร์โทรศัพท์ :</strong>
                                        <input type="number" class="form-control" placeholder="โปรดใส่เบอร์โทรศัพท์"
                                            id="first-name-icon" name="tel" value="{{ $invReceiptLists->tel }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>รหัสไปรษณีย์:</strong>
                                        <input type="number" class="form-control" placeholder="โปรดใส่รหัสไปรษณีย์"
                                            id="first-name-icon" name="postcode" value="{{ $invReceiptLists->postcode }}">
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>วันที่:</strong>
                                            <input value="{{ date('d-m-Y', strtotime($invReceiptLists->date)) }}"
                                                class="date form-control" name="date" type="text" placeholder="Date">
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $('.date').datepicker({
                                            format: 'dd-mm-yyyy'
                                        });
                                    </script>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a class="btn btn-primary" href="javascript:history.back()"> กลับ</a>

                                    </div>
                                </div>
            </form>
        @endsection
