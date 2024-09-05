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
    @section('content')
        <div class="cotainer mx-md-5 px-md-5 mx-sm-2 px-sm-2">
            <div class="card p-3 mt-5" style="border-radius: 1rem;">
                <div class="card-header">
                    <h4 class="title">Search Internships</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('internships.retrieve')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="title">Job Title (need to specify internship)</label>
                                    <input type="text" class="form-control mb-1" placeholder="Software Engineering Intern....." id="title"
                                        name="title" value="{{ old('title') }}">
                                    @error('title')
                                        <span style="color:#E14ECA" class="ml-1">{{$message}}</span>    
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-md-1">
                                <div class="form-group mb-3">
                                    <label>City/State</label>
                                    <input type="text" class="form-control mb-1"" name="city" placeholder="West Lafayaette, IN"
                                        value="{{ old('city') }}">
                                    @error('city')
                                        <span style="color:#E14ECA" class="ml-1">{{$message}}</span>    
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 px-md-1">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" class="form-control" name="country" style="color: #E14ECA"
                                        placeholder="Country" value="USA" readonly>
                                    <button class="btn btn-secondary btn-sm" name="toggle"
                                        style="font-size: 0.8rem">Toggle</button>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-6">
                                <button type="submit" class="btn btn-fill btn-primary">Save</button>
                            </div>
                            <div class="col-6 text-right">
                                <p style="color: #E14ECA;">Powered by CareerJet</p>
                                <div>
                                    <p style="font-size: 0.7rem;">Results may take time to load</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('button[name="toggle"]').click(function(event) {
                    event.preventDefault(); // Prevent the default form submission behavior
                    var countryInput = $('input[name="country"]');
                    var currentValue = countryInput.val();
                    countryInput.val(currentValue === "USA" ? "CA" : "USA");
                });
            });
        </script>
    @endsection
</x-user>
