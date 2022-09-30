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
                <h2>รายการ {{$income3Name->name}}</h2>
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
                <a class="btn btn-success" href="{{route('create003',['id'=>$id])}}"> เพิ่มรายการ</a>
                <a href="/pdfIncome3/{{$id}} ?>" target="_blank"  class="btn btn-success" > <span>Report</span></a>
                </div>


        <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>รูปภาพ</th>
                                <th>ชื่อ</th>
                                <th>รายละเอียด</th>
                                <th>วันที่</th>
                                <th>จำนวนเงิน</th>
                                <th>รายการ</th>
                                <th width="280px">แก้ไข</th>
                            </tr>
                        </thead>

        @foreach ($income3 as $i => $value)
        <tr>
            <td>{{ ++$i }}</td>

            <td><img src="/image_product/{{ $value->image_product }}" width="100px"></td>
            <td>{{ $value->name }}</td>
            <td>{{ \Str::limit($value->detail, 100) }}</td>
            <td>{{ $value->date }}</td>
            <td>{{ $value->price }}</td>
            <td>{{ $value->note }}</td>
            <!-- <td>{{ $value->created_at }}</td> -->
            <td>
                <form action="{{ route('income3.destroy',$value->id) }}" method="POST">
                <!-- <a class="btn btn-info" href="{{ route('income3.show',$value->id) }}"><i class="bi bi-eye"></i></a>     -->
                <a class="btn btn-primary" href="{{ route('income3.edit',$value->id) }}"><i class="bi bi-pencil-square"></i></a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure to want to delete it?')" class="btn btn-danger"><i class="bi bi-trash"></i></button>
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
                href="">IDEACLE CO.,LTD</a></p>
             </div>
            </div>
        </footer>
    </div>


{!! $income3->links() !!}
@endsection
