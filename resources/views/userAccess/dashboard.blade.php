<x-user>
    @section('sidebar-items')
    <ul class="nav">
        <li class="active2 nav-item">
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
        <li class="nav-item">
          <a href="#">
            <i class="tim-icons icon-pin"></i>
            <p class="h5" style="color: white">Job List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#">
            <i class="tim-icons icon-single-02"></i>
            <p class="h5" style="color: white">User Profile</p>
          </a>
        </li>
      </ul>
    @endsection
    @section('content')
        
    @endsection
</x-user>