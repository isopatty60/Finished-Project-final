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
                        <h3>ใบเสร็จรับเงิน</h3>
                        <p class="text-subtitle text-muted">ออกใบเสร็จให้ลูกค้า</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">ออกใบเสร็จให้ลูกค้า</li>
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
                        <a class="btn btn btn-info" href="{{ route('invReceiptLists.create') }}"> เพิ่มรายชื่อลูกค้า </a>
                        <a class="btn btn-success" href="{{ route('fiscal_years.index') }}"> รายรับ </a>
                        <a class="btn btn-success" href="{{ route('invFiscalYearExpenses.index') }}"> รายจ่าย </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>รายการ</th>
                                    <th>ที่อยู่</th>
                                    <th>วันที่</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    <th>รหัสไปรษณีย์</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>

                            @foreach ($invReceiptLists as $key => $value)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td><a href="{{ route('invReceiptDetails.show', $value->id) }}"
                                            class="inster">{{ $value->title }}</a></td>
                                    <td>{{ $value->address }}</td>
                                    <td>{{ $value->tel }}</td>
                                    <td>{{ $value->postcode }}</td>
                                    <td>{{ date('d-m-Y', strtotime( $value->date)) }}</td>
                                    <td>
                                        <form action="{{ route('invReceiptLists.destroy', $value->id) }}" method="POST">
                                            <!-- <a class="btn btn-info" href="{{ route('invReceiptLists.show', $value->id) }}"><i class="bi bi-eye"></i></a>     -->
                                            <a class="btn btn-primary"
                                                href="{{ route('invReceiptLists.edit', $value->id) }}"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure to want to delete it?')"
                                                class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>

                                    </td>

                                </tr>
                            @endforeach
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


                    {!! $invReceiptLists->links() !!}
                @endsection
