@extends('layouts.master')
@section('menu')
@extends('sidebar.usermanagement')
@endsection
@section('content')

<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <!-- Datepicker -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Datatables -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
    </script>
    <!-- Momentjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    
    
    
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
                
                    <h1> รายการ รายรับ - รายจ่าย </h1>
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
                <a class="btn btn-success" href="incomes"> เพิ่มรายการ</a>
                </div>
    
        <div class="card-body">
        <div> ยอดเงินทั้งหมด : </div><div id="sum" ></div>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                            <th>ลำดับ</th>
                                <th>ชื่อ</th>
                                <th>รายละเอียด</th>
                                <th>วันที่</th>
                                <th>จำนวนเงิน</th>
                                <th>รายการ</th>
                                <th width="280px">แก้ไข</th>
                            </tr>    
                        </thead>

        @foreach ($income2page as $i => $value)
        <tr>
            <td>{{ ++$i }}</td>
            <td><a href="{{route('income3.show', $value->id)}}" class="inster" >{{ $value->name }}</a></td>
            <td>{{ \Str::limit($value->detail, 100) }}</td>
            <td>{{ $value->date }}</td>
            <td>{{ $value->price }}</td>
            <td>{{ $value->note }}</td>
            <td>
           
                
                <form action="{{ route('income2.destroy',$value->id) }}" method="POST">   
                <!-- <a class="btn btn-info" href="{{ route('income2.show',$value->id) }}"><i class="bi bi-eye"></i></a>     -->
                <a class="btn btn-primary" href="{{ route('income2.edit',$value->id) }}"><i class="bi bi-pencil-square"></i></a>  
                    @csrf
                    @method('DELETE')  
                    <button type="submit" onclick="return confirm('Are you sure to want to delete it?')" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                </form>
               
            </td>
           
        </tr>
        @endforeach
    </table>  

    <!-- <footer>
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
    </div> -->
<!-- -------------------------------- -->


        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            
                            <input type="text" class="date form-control" id="start_date" placeholder="Start Date" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="date form-control" id="end_date" placeholder="End Date" readonly>
                            
                        </div>
                    </div>
                </div>
                <div>
                    <button id="filter" class="btn btn-outline-info btn-sm">Filter</button>
                    <button id="reset" class="btn btn-outline-warning btn-sm">Reset</button>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-borderless display nowrap" id="records" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการ</th>
                                        <th>จำนวนเงิน</th>
                                        <th>รายการ</th>
                                        <th>วันที่</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <div class="row">
             <div class="col"> ยอดเงินทั้งหมด : </div><div id="sum_filter" ></div>
             <div class="col"> ยอดเงินรายรับ : </div><div id="sum_income" ></div>
             <div class="col"> ยอดเงินรายจ่าย : </div><div id="sum_buy" ></div>
        </div>
    

    <script>
        $(function() {
            $("#start_date").datepicker({
                "dateFormat": 'dd-mm-yy'
            });
            $("#end_date").datepicker({
                "dateFormat": 'dd-mm-yy'
            });
        });

        // Fetch records
        function fetch(start_date, end_date) {
            $.ajax({
                url: "{{ route('students/records') }}",
                type: "GET",
                data: {
                    start_date: start_date,
                    end_date: end_date
                }, 
                dataType: "json",
                success: function(data) {
                    $("#sum").html(data.sum);
                    $("#sum_filter").html(data.sum_filter);
                    $("#sum_income").html(data.sum_income);
                    $("#sum_buy").html(data.sum_buy);

                    // Datatables
                    var i = 1;
                    $('#records').DataTable({
                        "data": data.students,
                        // responsive
                        "responsive": true,
                        "columns": [{
                                "data": "id",
                                "render": function(data, type, row, meta) {
                                    return i++;
                                }
                            },
                            {
                                "data": "name"
                            },
                            {
                                "data": "price",
                                "render": function(data, type, row, meta) {
                                    return `${row.price} บาท`;
                                }
                            },
                            {
                                "data": "note",
                                "render": function(data, type, row, meta) {
                                    return `${row.note}`;
                                }
                            },
                            {
                                "data": "date",
                                "render": function(data, type, row, meta) {
                                    return `${row.date}`;
                                }
                            },
                           
                           
                        ]
                    });
                }
            });
        }

        fetch();

        // Filter
        $(document).on("click", "#filter", function(e) {
            e.preventDefault();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            if (start_date == "" || end_date == "") {
                alert("Both date required");
            } else {
                $('#records').DataTable().destroy();
                fetch(start_date, end_date);
            }
        });

        // Reset
        $(document).on("click", "#reset", function(e) {
            e.preventDefault();
            $("#start_date").val(''); // empty value
            $("#end_date").val('');
            $('#records').DataTable().destroy();
            fetch();
        });

        
        $('.increment').on('click', function(e) {
        e.preventDefault();
        let total = parseFloat($(this).val()) *  quantity;
        $("#total").val(total);
    });

    </script>

{!! $income2page->links() !!} 
@endsection

