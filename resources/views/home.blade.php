@extends('layouts.master')
@section('menu')
    @extends('sidebar.dashboard')
@endsection
@section('content')
    <style>
        #records_filter label {
            display: flex;
            justify-content: end;
        }

        #records_filter label input {
            margin-left: .3rem;
            width: 10rem;
        }

        #records_length label {
            display: flex;
        }

        #records_length label select {
            margin: 0 .3rem;
            width: 3rem;
        }

        @media only screen and (max-width: 768px) {
            #records_filter label {
                justify-content: start;
                margin-top: 1rem;
            }
        }
    </style>

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
    <!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <div id="main">
        {{-- header --}}
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>Profile Statistics</h3>
        </div>

        {{-- message --}}
        {!! Toastr::message() !!}
        <div class="page-content">
            <section class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon purple">
                                                <i class="iconly-boldShow"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Activity Log</h6>
                                            <h6 class="font-extrabold mb-0">{{ $activity_logs }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon blue">
                                                <i class="iconly-boldProfile"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">User Activity log</h6>
                                            <h6 class="font-extrabold mb-0">{{ $user_activity_logs }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon green">
                                                <i class="iconly-boldAdd-User"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">User Total</h6>
                                            <h6 class="font-extrabold mb-0">{{ $users }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon red">
                                                <i class="iconly-boldBookmark"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Saved Record</h6>
                                            <h6 class="font-extrabold mb-0">{{ $staff }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-md-flex justify-content-between">
                                    <h4>สรุปยอดการใช้จ่าย</h4>
                                    <div class="form-group">
                                        <label for="chart_year" class="label-control">ปี พ.ศ. </label>
                                        <select id="chart_year" name="chart_year" class="form-control">
                                            <?php
                                        $years = date('Y');
                                        for ($year=$years; $year > $years-10; $year--) {
                                        ?>
                                            <option value="{{ $year + 543 }}" {{ $year == date('Y') ? 'selected' : '' }}>
                                                {{ $year + 543 }}</option>
                                            <?php
                                         }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="chart-profile-visit" class="w-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>ค้นหารายรับ-รายจ่าย</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mt-3">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="label-control">วันที่</label>
                                                    <div class="input-group mb-3 mb-md-0">
                                                        <input type="date" name="start_date" class="form-control"
                                                            id="start_date">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-info text-white"
                                                                id="basic-addon1"><i class="fas fa-calendar-alt"
                                                                    style="height: 1.5rem;"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" id="end_date"
                                                            name="end_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="note" class="label-control">รายได้</label>
                                                    <select id="note" name="note" class="form-control">
                                                        <option value="">ทั้งหมด</option>
                                                        <option value="รายรับ">รายรับ</option>
                                                        <option value="รายจ่าย">รายจ่าย</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button id="filter" class="btn btn-outline-info ml-3">Filter</button>
                                                    <button id="reset" class="btn btn-outline-warning">Reset</button>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <!-- Table -->
                                                    <table class="table table-borderless display nowrap" id="records"
                                                        style="width:100%">
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
                                    <div class="row">
                                        <div class="col"> ยอดเงินทั้งหมด : </div>
                                        <div id="sum_filter"></div>
                                        <div class="col"> ยอดเงินรายรับ : </div>
                                        <div id="sum_income"></div>
                                        <div class="col"> ยอดเงินรายจ่าย : </div>
                                        <div id="sum_buy"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        {{-- footer --}}
        <footer>
            <div class="footer clearfix mb-0 text-muted ">
                <div class="float-start">
                    <p>2022 &copy; IDEACLE</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                            href="">IDEACLE
                            CO.,LTD</a></p>
                </div>
            </div>
        </footer>
    </div>
    <script>
        // default
        const base_url = $('#base_url').val();

        $("#chart_year").change(function() {
            $(".apexcharts-canvas").remove();
            deshboardHome();
        });

        // Filter
        $(document).on("click", "#filter", function(e) {
            e.preventDefault();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var note = $("#note").val();
            start_date = dateFormat(start_date, 'dd-mm-yyyy')
            end_date = dateFormat(end_date, 'dd-mm-yyyy')

            if (start_date == "" || end_date == "" || start_date == "NaN-NaN-NaN" || end_date == "NaN-NaN-NaN") {
                alert("Both date required");
                return false;
            } else if (start_date >= end_date) {
                alert("wrong date entered");
                return false;
            } else {
                $('#records').DataTable().destroy();
                fetch(start_date, end_date, note);
                return true;
            }
        });

        // Reset
        $(document).on("click", "#reset", function(e) {
            e.preventDefault();
            $("#start_date").val(''); // empty value
            $("#end_date").val('');
            $("#note").val('');
            $('#records').DataTable().destroy();
            fetch("", "", "");
        });

        $('.increment').on('click', function(e) {
            e.preventDefault();
            let total = parseFloat($(this).val()) * quantity;
            $("#total").val(total);
        });

        function dateFormat(inputDate, format) {
            //parse the input date
            const date = new Date(inputDate);

            //extract the parts of the date
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();

            //replace the month
            format = format.replace("mm", month.toString().padStart(2, "0"));

            //replace the year
            if (format.indexOf("yyyy") > -1) {
                format = format.replace("yyyy", year.toString());
            } else if (format.indexOf("yy") > -1) {
                format = format.replace("yy", year.toString().substr(2, 2));
            }
            //replace the day
            format = format.replace("dd", day.toString().padStart(2, "0"));
            return format;
        }

        // Fetch records
        function fetch(start_date, end_date, note) {
            $.ajax({
                url: "{{ url('/api/students/records') }}",
                type: "GET",
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    note: note
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
                        ],
                    });
                }
            });
        }

        function deshboardHome() {
            // Line chart
            let chart_year = $('#chart_year').val();

            $.ajax({
                url: "{{ url('/api/dashboard') }}",
                type: "GET",
                data: {
                    chart_year: chart_year,
                },
                dataType: "json",
                success: function(response) {
                    var optionsLineChart = {
                        series: [{
                                name: 'รายรับ',
                                data: response.inv_expenses_price
                            },
                            {
                                name: 'รายจ่าย',
                                data: response.inv_price
                            }
                        ],
                        labels: response.month,
                        chart: {
                            type: 'area',
                            width: "100%",
                            height: 360
                        },
                        tooltip: {
                            fillSeriesColor: false,
                            onDatasetHover: {
                                highlightDataSeries: false,
                            },
                            theme: 'light',
                            style: {
                                fontSize: '12px',
                                fontFamily: 'Inter',
                            },
                        },
                    };

                    var lineChartEl = document.getElementById('chart-profile-visit');
                    if (lineChartEl) {
                        var lineChart = new ApexCharts(lineChartEl, optionsLineChart);
                        lineChart.render();
                    }
                }
            });
        }

        fetch();
        deshboardHome();
    </script>
@endsection
