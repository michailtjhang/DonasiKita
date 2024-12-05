@extends('Backend.layouts.app')

@section('preloader')
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{ asset('img/icon.svg') }}" alt="AdminLTELogo" height="60" width="60">
    </div>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-4 col-4">

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

            <div class="col-lg-4 col-4">

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

            <div class="col-lg-4 col-4">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $total_donation }}</h3>
                        <p>Total Donations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('donation.index') }}" class="small-box-footer">View <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
                
            </div>

        </div>

        <!-- Cards Articles -->
        <div class="row">
            <div class="col-lg-4 col-4">
                <h4>Latest Articles</h4>
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
                                <td>{{ $row->created_at }}</td>
                                <td>
                                    <a href="{{ route('article.show', $row->id) }}" class="btn btn-secondary btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Cards Events -->
            <div class="col-lg-4 col-4">
                <h4>Latest Events</h4>
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
                                <td>{{ $row->created_at }}</td>
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

            <!-- Cards Donations -->
            <div class="col-lg-4 col-4">
                <h4>Latest Donations</h4>
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
                                    <a href="{{ route('donation.show', $row->id) }}" class="btn btn-secondary btn-sm">
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
@endsection
