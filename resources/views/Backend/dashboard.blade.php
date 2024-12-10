@extends('Backend.layouts.app')

@section('css')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection

@section('preloader')
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{ asset('img/icon.svg') }}" alt="AdminLTELogo" height="60" width="60">
    </div>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-4 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $total_article }}</h3>
                        <p>Total Articles</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('article.index') }}" class="small-box-footer">View <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $total_event }}</h3>
                        <p>Total Events</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('category.index') }}" class="small-box-footer">View <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $total_user }}</h3>
                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('user.index') }}" class="small-box-footer">View <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>

            </div>

        </div>

        <!-- Cards Articles -->
        <div class="row">
            <div class="col-lg-4 col-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="mb-0">Latest Articles</h4>
                            <a href="{{ route('article.index') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-arrow-right"></i> See All
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Created At</th>
                                    <th style="width: 40px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($last_article as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->title }}</td>
                                        <td>{{ $row->category->name }}</td>
                                        <td>{{ $row->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('article.show', $row->id) }}"
                                                class="btn btn-secondary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Cards Events -->
            <div class="col-lg-4 col-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="mb-0">Latest Events</h4>
                            <a href="{{ route('event.index') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-arrow-right"></i> See All
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Created At</th>
                                    <th style="width: 40px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($last_event as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->title }}</td>
                                        <td>{{ $row->category->name }}</td>
                                        <td>{{ $row->created_at->format('d F Y') }}</td>
                                        <td>
                                            <a href="{{ route('event.show', $row->id) }}" class="btn btn-secondary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Cards Donations -->
            <div class="col-lg-4 col-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="mb-0">Latest Donations</h4>
                            <a href="{{ route('donation.index') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-arrow-right"></i> See All
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Title</th>
                                    <th>Days Left</th>
                                    <th style="width: 40px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($last_donation as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->title }}</td>
                                        <td>{{ $row->days_left->locale('id')->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('donation.show', $row->id) }}"
                                                class="btn btn-secondary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- AREA CHART -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4>Visitors</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span id="currentVisitors" class="text-bold text-lg">{{ $currentMonthVisitors }}</span>
                                <span>Visitors This Month</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                @if ($percentageChange > 0)
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> {{ $percentageChange }}%
                                    @else
                                        <span class="text-danger">
                                            <i class="fas fa-arrow-down"></i> {{ $percentageChange }}%
                                @endif
                                </span>
                                <span class="text-muted">Since last week</span>
                            </p>
                        </div>
                        <div class="position-relative mb-4">
                            <canvas id="visitors-chart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->


    </div>
@endsection

@section('js')
    <!-- jQuery -->
    <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
    <!-- ChartJS -->
    <script src="https://adminlte.io/themes/v3/plugins/chart.js/Chart.min.js"></script>

    <script>
        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        $(function() {
            const ctx = $('#visitors-chart').get(0).getContext('2d');

            // Fetch data from the API
            $.ajax({
                url: 'api/visitor-stats', // Ganti dengan URL API Anda
                method: 'GET',
                success: function(response) {
                    const currentMonth = response.currentMonth;
                    const lastMonth = response.lastMonth;

                    // Extract labels and datasets
                    const currentLabels = currentMonth.map(item => item.date);
                    const currentData = currentMonth.map(item => item.count);

                    const lastLabels = lastMonth.map(item => item.date);
                    const lastData = lastMonth.map(item => item.count);

                    // Combine labels for consistent X-Axis
                    const labels = [...new Set([...lastLabels, ...currentLabels])];

                    // Map last month and current month data to the combined labels
                    const lastMonthData = labels.map(label => {
                        const entry = lastMonth.find(item => item.date === label);
                        return entry ? entry.count : 0;
                    });

                    const currentMonthData = labels.map(label => {
                        const entry = currentMonth.find(item => item.date === label);
                        return entry ? entry.count : 0;
                    });

                    // Create the chart
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                    label: 'This Month',
                                    data: currentMonthData,
                                    borderColor: 'rgba(60,141,188,0.8)',
                                    backgroundColor: 'rgba(60,141,188,0.4)',
                                    fill: true,
                                },
                                {
                                    label: 'Last Month',
                                    data: lastMonthData,
                                    borderColor: 'rgba(210, 214, 222, 1)',
                                    backgroundColor: 'rgba(210, 214, 222, 0.4)',
                                    fill: true,
                                }
                            ]
                        },
                        options: {
                            maintainAspectRatio: false,
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                },
                error: function(error) {
                    console.error('Error fetching visitor stats:', error);
                }
            });
        });
    </script>
@endsection
