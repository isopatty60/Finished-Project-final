@extends('layouts.master')
@section('menu')
@extends('sidebar.usermanagement')
@endsection
@section('content')
<div id="main">
    <style>
        .avatar.avatar-im .avatar-content, .avatar.avatar-xl img {
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
                    <h3>User Management View</h3>
                    <p class="text-subtitle text-muted">For user to check they list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Mangement View</li>
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
       
  
    <form action="{{ route('posts.update',$post->id) }}" method="POST">
        @csrf
        @method('PUT')
   
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">User View Detial</h4>
            </div>
                <div class="card-content">
                    <div class="card-body">
        <div class="col-md-4">
            <label>Email Address</label>
                </div>
                    <div class="col-md-8">
                        <div class="form-group has-icon-left">
                            <div class="position-relative">
                                <input type="title" class="form-control"
                                        placeholder="Title" id="first-name-icon" name="title" value="{{ $post->title }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
         
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Detail">{{ $post->description }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Date:</strong>
                    <input value="{{ $post->date }}" class="date form-control" name="date" type="text" placeholder="Date">
                </div>
            </div>
            <script type="text/javascript">
                $('.date').datepicker({  
                format: 'dd-mm-yyyy'
                });  
            </script> 
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
@endsection