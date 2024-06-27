<x-user>
    @section('sidebar-items')
    <ul class="nav">
        <li class="active ">
          <a href="{{route('user.home')}}">
            <i class="tim-icons icon-chart-pie-36"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li>
            <a href="#">
              <i class="tim-icons icon-bell-55"></i>
              <p>Analytics</p>
            </a>
          </li>
        <li>
          <a href="#">
            <i class="tim-icons icon-atom"></i>
            <p>Question bank</p>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="tim-icons icon-pin"></i>
            <p>Job List</p>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="tim-icons icon-single-02"></i>
            <p>User Profile</p>
          </a>
        </li>
      </ul>
    @endsection
    @section('content')
        
    @endsection
</x-user>