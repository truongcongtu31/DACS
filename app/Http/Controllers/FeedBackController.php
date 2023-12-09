<?php

namespace App\Http\Controllers;

use App\Models\FeedBack;
use Illuminate\Http\Request;

class FeedBackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $feedback;
    public function __construct()
    {
        $this->feedback = new FeedBack();
    }

    public function showFeedbackAjax(Request $request){
        if($request->ajax()){
            $feedback = $this->feedback->getFeedBack($request);
            $output = view('frontend.products.feedback',compact('feedback'))->render();
            return response()->json(['html'=>$output]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->feedback->addFeedback($request);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FeedBack $feedBack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeedBack $feedBack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeedBack $feedBack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeedBack $feedBack)
    {
        //
    }
}
