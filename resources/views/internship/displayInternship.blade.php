<x-user>
    @section('sidebar-items')
    <ul class="nav">
        <li class="nav-item">
          <a href="{{route('user.home')}}">
            <i class="tim-icons icon-chart-pie-36"></i>
            <p class="h5" style="color: white">Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
            <a href="#">
              <i class="fa-regular fa-chart-bar"></i>
              <p class="h5" style="color: white">Analytics</p>
            </a>
          </li>
        <li class="nav-item">
          <a href="{{route('techbank.display')}}">
            <i class="tim-icons icon-atom"></i>
            <p class="h5" style="color: white">Question bank</p>
          </a>
        </li>
        <li class="nav-item active2">
          <a href="{{route('internships.display')}}">
            <i class="fa-solid fa-magnifying-glass"></i>
            <p class="h5" style="color: white">Job List</p>
          </a>
        </li>
      </ul>
    @endsection
        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        .table-dark-custom {
            background-color: #636363;
            color: white;
            border-radius: 10px;
        }

        .table-dark-custom th {
            background: linear-gradient(45deg, indigo, purple);
            color: white;
        }

        .table-dark-custom tbody tr {
            margin-bottom: 1rem;
            /* Increase gap between rows */
        }

        .table-dark-custom tbody td {
            margin-bottom: 10rem;
            margin-top: 10rem;
        }

        .table-dark-custom tbody tr:hover {
            background-color: purple;
        }

        .table-dark-custom tbody tr td a {
            color: white;
            text-decoration: none;
        }

        .table-dark-custom tbody tr td a:hover {
            color: lightgray;
        }

        .apply-button {
            background-color: rgb(59, 3, 57);
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            /* Increase padding for larger button */
            font-size: 1.25rem;
            /* Increase font size */
        }
    </style>
    @section('content')
        <div>
            @if (isset($invalid))
            <div class="alert alert-danger"><h4>Error fetching jobs</h4></div>
            @endif
            @if (isset($no_jobs))
                <div class="alert alert-danger"><h4>No jobs found on this page</h4></div>
            @endif
            @if (isset($jobs))
                <div class="row">
                    <div class="col">
                        <a href="{{route('internships.display')}}"><button class="btn btn-secondary">Back to Search</button></a>
                    </div>
                    <div class="col">
                        <div class="container d-flex justify-content-end">
                            @if($prev_page == true)
                                <a href="{{route('internships.fetch', [$curr_page - 1, $location, $title, $code])}}"><button class="btn btn-primary">Previous</button></a>
                            @endif
                            @if($next_page == true) 
                                <a href="{{route('internships.fetch', [$curr_page + 1, $location, $title, $code])}}"><button class="btn btn-primary px-5 ml-2">Next</button></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <div class="col">

                        </div>
                    </div>
                    <div class="container mt-5">
                        <table class="table table-dark-custom table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Locations</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    if (!isset($jobs)) {
                                        echo "<h4 style='color: purple'>Error fetching jobs please try again</h4>";
                                    }
                                @endphp
                                @if(isset($jobs))
                                @foreach ($jobs ?? ('' ?? '') as $job)
                                        @php
                                            if ($job->company == null) {
                                                continue;
                                            }
                                        @endphp
                                        @include('internship.job')
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    @endsection
</x-user>
