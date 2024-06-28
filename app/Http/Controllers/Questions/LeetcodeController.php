<?php

namespace App\Http\Controllers\Questions;

use App\Http\Controllers\Controller;
use App\Models\questions\leetcodebank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

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
        dd($res);
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
        $questions = leetcodebank::inRandomOrder()->paginate(16);
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
