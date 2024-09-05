<x-user>
    <style>
        .cust-card {
            border-radius: 2rem;
        }

        . :hover {
          background-color: black;
        }
    </style>
    @section('sidebar-items')
        <ul class="nav">
            <li class="active2 nav-item">
                <a href="{{ route('user.home') }}">
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
                <a href="{{ route('techbank.display') }}">
                    <i class="tim-icons icon-atom"></i>
                    <p class="h5" style="color: white">Question bank</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('internships.display') }}">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <p class="h5" style="color: white">Job List</p>
                </a>
            </li>
        </ul>
    @endsection
    @section('content')
        <div class="container d-flex justify-content-center px-0">
            <ul style="list-style-type: none;" class="ml-2">
                <li>
                  <a href="{{route('techbank.display')}}">
                    <div class="d-flex justify-content-center">
                        <div class="card p-3 mx-0 cust-curd d-flex flex-row align-items-center">
                            <div class="icon-container d-flex align-items-center mx-4" style="height: 100%;">
                                <i class="fa-solid fa-book" style="font-size: 3rem; color: rgb(152, 19, 247);"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="card-header">
                                    <h3 style="color:rgb(152, 19, 247)">Techbank</h3>
                                </div>
                                <div class="card-body" style="color:white;">
                                    <h4>Our questionbank from leetcode to help you with your learning activities.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </li>
                <li>
                  <a href="{{route('landing')}}">
                    <div class="d-flex justify-content-center">
                        <div class="card p-3 mx-0 cust-curd d-flex flex-row align-items-center">
                            <div class="icon-container d-flex align-items-center mx-4" style="height: 100%;">
                                <i class="fa-solid fa-chart-simple" style="font-size: 3rem; color: rgb(152, 19, 247);"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="card-header">
                                    <h3 style="color:rgb(152, 19, 247)">Analytics</h3>
                                </div>
                                <div class="card-body" style="color:white;">
                                    <h4>Provides with you with insights into your leetcode perfomance.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </li>
                <li>
                  <a href="{{route('internships.display')}}">
                    <div class="d-flex justify-content-center">
                        <div class="card p-3 mx-0 cust-curd d-flex flex-row align-items-center">
                            <div class="icon-container d-flex align-items-center mx-4" style="height: 100%;">
                                <i class="fa-solid fa-suitcase" style="font-size: 3rem; color: rgb(152, 19, 247);"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="card-header">
                                    <h3 style="color:rgb(152, 19, 247)">Internship Find</h3>
                                </div>
                                <div class="card-body" style="color:white;">
                                    <h4>Delivers internships that you are searching for.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </li>
            </ul>
        </div>
    @endsection
</x-user>
