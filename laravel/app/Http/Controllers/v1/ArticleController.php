<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::where('confirmed', true)->get();
        if (count($articles) > 0) {
            return response()->json([
                'error' => false,
                'message' => null,
                'data' => $articles
            ]);
        }else{
            return response()->json([
                'error' => false,
                'message' => 'No Active Articles',
                'data' => null
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validator($request);
        if ($validate->passes()) {
            $articles = Article::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $request->image,
                'created_by' => $request->author
            ]);
            if ($articles) {
                return response()->json([
                    'error' => false,
                    'message' => 'Article saved!',
                    'data' => $articles
                ], 201);
            }else{
                return response()->json([
                    'error' => true,
                    'message' => 'Article NOT Saved!',
                    'data' => $articles
                ]);
            }
        }else{
            return response()->json([
                'error' => true,
                'message' => $validate->errors()->all(),
                'data' => $request->all()
            ], 404);
        }
    }

    /**
     * Validate the request
     */
    public function validator($request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
        return $validator;
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
