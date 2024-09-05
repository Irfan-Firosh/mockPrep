<x-user>
    @section('content')
        <div class="container d-flex justify-content-center mt-5 px-5">
            <div class="card mx-5 py-3" style="border-radius: 1rem;">
                <div class="flex-grow-1">
                    <div class="card-header mx-5">
                        <h4 style="color: #E14ECA;">Set your leetcode username</h4>
                    </div>
                    <div class="card-body mx-5">
                        <form action="{{ route('analytics.setname') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>
                                    <h6>Enter username:</h6>
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control mb-0"
                                    style="height: 50; font-size: 1rem;">
                                @error('name')
                                    <span style="color:#E14ECA" class="ml-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if (session()->has('invalid'))
            <div class="px-5 container">
                <div class="mt-5 mx-5">
                    <div class="alert alert-primary">
                        {{ session('invalid') }}
                    </div>
                </div>
            </div>

            <!-- jQuery script to fade out the div -->
            <script>
                $(document).ready(function() {
                    $(".alert").fadeOut(8000);
                });
            </script>
        @endif
    @endsection
</x-user>
