<?php

namespace App\Http\Controllers\Questions;

use App\Http\Controllers\Controller;
use App\Models\questions\leetcodebank;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LeetcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function fetch() {
        $url = "https://leetcode.com/api/problems/algorithms/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        if ($e = curl_error($ch)) {
            curl_close($ch);
            return $e;
        }
        $decoded = json_decode($res, true);
        curl_close($ch);
        return $decoded;
    }

    public function index(Request $request)
    {
        $questions = leetcodebank::inRandomOrder()->paginate(64);
        return view('userAccess.techbank.leetcode', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function retrieveUser()
    {
        //
    }

    public function store()
    {
        $url = "https://alfa-leetcode-api.onrender.com/problems?limit=3045";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        if ($e = curl_error($ch)) {
            curl_close($ch);
            return $e;
        }
        $decoded = json_decode($res, true);
        curl_close($ch);
        $questions = $decoded['problemsetQuestionList'];
        foreach ($questions as $question) {
            $names = json_encode(array_map(function($tag) {
                return $tag['name'];
            }, $question['topicTags']));
            if ($question['isPaidOnly'] == false) {
                leetcodebank::updateOrCreate(
                    [
                        'title' => $question['title'],
                    ], 
                    [
                        'question_slug' => $question['titleSlug'],
                        'topic_tags' => $names ,
                        'difficulty' => $question['difficulty'],
                        'acRate' => round($question['acRate'], 2),
                    ]
                );
            }
        }
        return 'hi';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->input('query');
        $diff = $request->input('difficulty');
        $questions = LeetcodeBank::where(function ($query) use ($search, $diff) {
            if ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%');
            }
            if ($diff != "nothing") {
                $query->where('difficulty', $diff);
            }
        })->get();

        return view('userAccess.techbank.search', ['questions' => $questions]);
    }

    // commands for analytics
    public function analytics()
    {
        $username = Auth::user()->leetcodename;
        if ($username == null) {
            return redirect()->route('analytics.setname');
        }
        //fetch user results from api
        $url = "https://alfa-leetcode-api.onrender.com/userProfile/" . $username;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        if ($e = curl_error($ch)) {
            curl_close($ch);
            return $e;
        }
        $decoded = json_decode($res, true);
        curl_close($ch);

        if (empty($decoded)) {
            return redirect()->route('analytics.setname')->with('invalid', "$username is an invalid username");
        }

        $data = [
            "totalSolved" => $decoded['totalSolved'],
            "totalSubmissions" => $decoded['totalSubmissions'],
            "easySolved" => $decoded['easySolved'],
            "totalEasy" => $decoded['totalEasy'],
            "mediumSolved" => $decoded['mediumSolved'],
            "totalMedium" => $decoded['totalMedium'],
            "hardSolved" => $decoded['hardSolved'],
            "totalHard" => $decoded['totalHard'],
            "ranking" => $decoded['ranking'],
            "submissionCalendar" => $decoded['submissionCalendar'],
            "recentSubmissions" => $decoded['recentSubmissions'],
        ];

        return view('analytics.graphs', ['data' => $data]);
    }

    public function changeName(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        // change the thingy
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->leetcodename = $request->input('name');
        $user->save();
        return redirect()->route('analytics', ['success' => "Set name to $user->leetcodename"]);
    }

    // end analytics commands


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
