<?php

namespace App\Http\Controllers\internship;

use App\Http\Controllers\Controller;
use DOMDocument;
use DOMXPath;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Careerjet_API;
use Exception;

class TechController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Retrieve user preferences
    public function index(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'city' => 'required'
        ]);

        $location = $request->input('city');
        $title = $request->input('title');
        $code = NULL;
        if ($request->input('country') == "USA") {
            $code = "en_US";
        } else {
            $code = "en_CA";
        }

        return redirect()->route('internships.fetch', [1, $code, $title, $location, $request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function fetch($page, $code, $title, $location)
    {
        $api = new Careerjet_API($code);
        $result = $api->search(array(
            'keywords' => $title,
            'location' => $location,
            'page' => $page ,
            'pagesize' => 50,
            'affid' => '678bdee048',
        ));
        if ( $result->type == 'JOBS' ) {
            $jobs = $result->jobs;
            $hits = $result->hits;
            $pages = $result->pages;
            $next_page = true;
            $prev_page = false;
            $curr_page = $page;

            # Basic paging code
            if( $page > 1 && $page <= $result->pages ){
                //echo "Use \$page - 1 to link to previous page\n";
                $prev_page = true;
            }
            if ( $page < $result->pages ){
                //echo "Use \$page + 1 to link to next page\n" ;
                $next_page = true;
            }
            if ($page > $result->pages || $page < 1) {
                return ['no_jobs' => 'No jobs found on this page'];
            }

            return ['jobs' => $jobs, 'hits' => $result->hits, 'pages' => $pages,
                    'next_page' => $next_page, 'prev_page' => $prev_page, 'curr_page' => $curr_page,
                    'location' => $location, 'code' => $code, 'title' => $title];
        }

        return view('internship.display', ['invalid' => "Error fetching jobs"]);

        // Resolve location to do later....
        # When location is ambiguous
        if ( $result->type == 'LOCATIONS' ) {
            $locations = $result->solveLocations ;
            foreach ( $locations as $loc ) {
            echo $loc->name."\n" ; # For end user display
            ## Use $loc->location_id when making next search call
            ## as 'location_id' parameter
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($page, $code, $title, $location)
    {
        // Fetch location from req
        try {
            $ret = $this->fetch($page, $code, $title, $location);
            return view('internship.displayInternship', $ret);
        }
        catch (Exception $e) {
            return view('internship.displayInternship', ['invalid' => "Error fetching jobs"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
