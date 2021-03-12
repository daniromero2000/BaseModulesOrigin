<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\WinkPost;
use Modules\Blog\WinkTag;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = WinkPost::with('tags')->where('published', 1)->orderBy('publish_date', 'DESC')->get();
        $tags = WinkTag::all();

        return view('blog.index', ['posts' => $data, 'tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blog::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data = WinkPost::with('tags')->where('slug', $id)->first();
        $tags = WinkTag::all();

        return view('blog.show', ['post' => $data, 'tags' => $tags]);
    }

    /**
     * 
     */
    public function tagShow($id)
    {
        $data = WinkTag::where('slug', $id)->first();
        $tags = WinkTag::all();


        return view('blog.index', ['posts' => $data->posts, 'tags' => $tags, 'origin' =>  $data]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('blog::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
