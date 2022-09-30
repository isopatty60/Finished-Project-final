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
                    <h3>Receipt Control</h3>
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
                        document.getElementById("datetime").innerHTML = (("0"+dt.getDate()).slice(-2)) +"."+ (("0"+(dt.getMonth()+1)).slice(-2)) +"."+ (dt.getFullYear()) +" "+ (("0"+dt.getHours()).slice(-2)) +":"+ (("0"+dt.getMinutes()).slice(-2));
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
                <a class="btn btn-success" href="{{ route('incomes.create') }}"> Create New Receipt </a>
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

        @foreach ($income as $key => $value)
        <tr>
            <td>{{ ++$i }}</td>
            <td><a href="{{route('income1.show', $value->id)}}" class="inster" >{{ $value->title }}</a></td>
            <td>{{ \Str::limit($value->description, 100) }}</td>
            <td>{{ $value->date }}</td>
            <td>
                <form action="{{ route('incomes.destroy',$value->id) }}" method="POST">
                <!-- <a class="btn btn-info" href="{{ route('incomes.show',$value->id) }}"><i class="bi bi-eye"></i></a>     -->
                <a class="btn btn-primary" href="{{ route('incomes.edit',$value->id) }}"><i class="bi bi-pencil-square"></i></a>
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


{!! $income->links() !!}
@endsection
