<x-user>
    @section('content')
    <style>

        .card {
            border: none;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 0.75rem;
            width: 90%;
        }

        .card:hover {
            transform: translateZ(10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .c-details span {
            font-weight: 300;
            font-size: 14px
        }

        .badge span {
            width: 60px;
            height: 25px;
            padding-bottom: 3px;
            border-radius: 5px;
            display: flex;
            color: #9dfe5d;
            justify-content: center;
            align-items: center
        }

        .progress {
            height: 10px;
            border-radius: 10px
        }

        .progress div {
            background-color: linear-gradient(100deg, #5c2d91, #471f73, #371859, #2a1245, #1f0e35)
        }

        .text1 {
            font-size: 14px;
            font-weight: 600
        }
        .heading {
            font-size: 1.25rem;
        }

        .mt-3, .mt-5 {
            margin-top: 1rem;
        }

    </style>
    <div class="container mt-5 mb-3">
        <div class="row">
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
                    <li class="nav-item active2">
                        <a href="#">
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
                <style>
            
                    .card {
                        border: none;
                        border-radius: 10px;
                        padding: 1rem;
                        margin-bottom: 0.75rem;
                        width: 90%;
                        height: 320px;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                        transition: transform 0.3s, box-shadow 0.3s;
                    }
            
                    .card:hover {
                        transform: scale(1.025);
                        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
                    }
            
                    .c-details span {
                        font-weight: 300;
                        font-size: 14px
                    }
            
                    .badge span {
                        width: 60px;
                        height: 25px;
                        padding-bottom: 3px;
                        border-radius: 5px;
                        display: flex;
                        justify-content: center;
                        align-items: center
                    }

                    .Easy {
                        color: #7aca45;
                    }

                    .Medium {
                        color: rgb(201, 201, 0);
                    }

                    .Hard {
                        color: rgb(203, 0, 0);
                    }

                    .progress {
                        height: 10px;
                        border-radius: 10px
                    }
            
                    .progress div {
                        background-color: linear-gradient(100deg, #5c2d91, #471f73, #371859, #2a1245, #1f0e35)
                    }
            
                    .text1 {
                        font-size: 14px;
                        font-weight: 600
                    }
                    .heading {
                        font-size: 1.25rem;
                    }
            
                    .mt-3, .mt-5 {
                        margin-top: 1rem;
                    }

                    .no-gutters {
                        margin-left: -5px;
                        margin-right: -5px;
                    }

                    .tag:hover .tag-info {
                        display: block;
                    }
            
                </style>
                <script type="text/javascript">
                    $(function() {
                        $('.scrolling-pagination').jscroll({
                            autoTrigger: true,
                            padding: 0,
                            nextSelector: '.pagination li.active + li a',
                            contentSelector: 'div.scrolling-pagination',
                            callback: function() {
                                $('ul.pagination').remove(); // Remove pagination after loading new content
                            }
                        });
                    });
                </script>
                <div class="container mt-5 mb-3">
                    <div class="row no-gutters scrolling-pagination">
                        @foreach ($questions as $question )
                        <div class="col-lg-4 col-md-5 mt-3 col-xl-3">
                            <a href={{"https://leetcode.com/problems/" . $question->question_slug}} target="_blank">
                                <div class="card p-3 mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row align-items-center">
                                            <div class="ms-2 c-details">
                                                <h6 class="mb-0"></h6> <span>
                                                    @php
                                                        $i = 0;
                                                        foreach (json_decode($question->topic_tags) as $x => $tag) {
                                                            $i += strlen($tag);
                                                            if ($i > 30) {
                                                                echo '<i class="fa-solid fa-ellipsis"></i>';
                                                                break;
                                                            }
                                                            echo "<div class='tag'>$tag, </div>";
                                                        }
                                                        if ($i == 0) {
                                                            echo "<div class='tag'>No Tags Available</div>";
                                                        }
                                                    @endphp
                                                </span>
                                            </div>
                                        </div>
                                        <div class="badge"> <span class="{{$question->difficulty}}" style="font-size:13px">{{$question->difficulty}}</span> </div>
                                    </div>
                                    <div class="mt-2">
                                        <h3 class="heading">
                                            @php
                                                $text = $question->title;
                                                if (strlen($question->title) > 40) {
                                                    $text = substr($text, 0 , 39);
                                                    echo $text . '<i class="fa-solid fa-ellipsis ml-2"></i>';
                                                } else {
                                                    echo $text;
                                                }
                                            @endphp
                                        </h3>
                                        <div class="mt-5">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{$question->acRate}}%" aria-valuenow="{{$question->acRate}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="mt-3"> <span class="text1">{{$question->acRate}}%</span></span> </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                        {{$questions->links()}}
                    </div>
                </div>
                @endsection
            </x-user>
        </div>
    </div>
    @endsection
</x-user>