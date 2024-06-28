<?php

namespace App\Http\Controllers\internship;

use App\Http\Controllers\Controller;
use DOMDocument;
use DOMXPath;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TechController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function fetch()
    {
        // Place from where internships are fetched
        $url = "https://github.com/SimplifyJobs/Summer2025-Internships/blob/dev/README.md";

        $httpClient = new Client();
        $response = $httpClient->request('get', $url, [
            'timeout' => 100, // Adjust timeout as needed
            'verify' => false, // Set to true to verify SSL
        ]);
        $htmlString = (string)$response->getBody();

        // Testing html string
        /* $htmlString = '
        <table>
            <tbody>
                <tr>
                    <td>PwC</td>
                    <td>Products &amp; Technology Intern 🛂</td>
                    <td>
                    <details>
                        <summary><strong>4 locations</strong></summary>
                        Dallas, TX<br>Tampa, FL<br>Chicago, IL<br>New York, NY
                    </details>
                    </td>
                    <td><a href="https://jobs.us.pwc.com/job/-/-/932/66835864048?utm_source=Simplify&amp;ref=Simplify" rel="nofollow"><img src="./Summer2025-Internships_README.md at dev · SimplifyJobs_Summer2025-Internships_files/68747470733a2f2f692e696d6775722e636f6d2f75314b4e55387a2e706e67" width="118" alt="Apply" data-canonical-src="https://i.imgur.com/u1KNU8z.png" style="max-width: 100%;"></a></td>
                    <td>Jun 26</td>
                </tr>
            </tbody>
        </table>
        '; */

        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->loadHTML($htmlString);
        $xpath = new DOMXPath($doc);

        $rows = $xpath->query('//table/tbody/tr');
        foreach ($rows as $row) {
            $title = $xpath->query('./td[1]', $row)->item(0)->textContent;
            echo $title;
        }

        /* $rows = $xpath->evaluate('//tbdoy/tr');
        foreach ($rows as $row) {
            $company = $xpath->query('td[1]', $row)->item(0)->textContent;
            $role = $xpath->query('td[2]', $row)->item(0)->textContent;
            $location = $xpath->query('td[3]', $row)->item(0)->textContent;
            $application = $xpath->query('td[4]', $row)->item(0)->textContent;
            //$anchor = $xpath->query('/a', $application)->item(0);
            if (!$application) {
                $application = " Test";
            }
            $datePosted = $xpath->query('td[5]', $row)->item(0)->textContent;
            echo $company;
        } */

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->fetch();
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
