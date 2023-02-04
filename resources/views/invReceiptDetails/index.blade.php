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
                        <h2>รายการ {{ $invReceiptDetailsName->title }}</h2>
                        <p class="text-subtitle text-muted">For Receipt to check they list</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Receipt Control</li>
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

                        <a class="btn btn-success" href="{{ route('createInvReceiptDetails', ['id' => $id]) }}">
                            เพิ่มรายการ</a>
                        <a href="/pdf/{{ $id }} ?>" class="btn btn-success"> <span>Report</span></a>
                        <a class="btn btn-success" href="{{ route('invReceiptLists.index') }}"> Back</a>

                    </div>


                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>รายละเอียด</th>
                                    <th>จำนวน(หน่วย)</th>
                                    <th>ราคา</th>
                                    <th>วันที่</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            @foreach ($invReceiptDetails as $i => $value)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    {{-- <td>{{ $value->name }}</td> --}}
                                    <td>{{ \Str::limit($value->detail, 100) }}</td>
                                    <td>{{ $value->amount }}</td>
                                    <td> {{ number_format($value->price, 2) }} </td>
                                    <td>{{ date('d-m-Y', strtotime($value->date)) }}</td>
                                    <td>
                                        <form action="{{ route('invReceiptDetails.destroy', $value->id) }}" method="POST">
                                            <!-- <a class="btn btn-info" href="{{ route('invReceiptDetails.show', $value->id) }}"><i class="bi bi-eye"></i></a>     -->
                                            <a class="btn btn-primary"
                                                href="{{ route('invReceiptDetails.edit', $value->id) }}"><i
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


                    {!! $invReceiptDetails->links() !!}
                @endsection
