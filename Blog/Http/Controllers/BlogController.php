<?php

namespace Modules\Blog\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\WinkPosts\Repositories\Interfaces\WinkPostRepositoryInterface;
use Modules\Blog\WinkPost;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Blog\WinkTag;


class BlogController extends Controller
{
    private $winkPostInterface;

    public function __construct(
        WinkPostRepositoryInterface $winkPostRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    )
    {
        $this->winkPostInterface = $winkPostRepositoryInterface;
        $this->toolsInterface    = $toolRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();
        $tags = WinkTag::all();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->winkPostInterface->searchWinkPost(request()->input('q'), $skip * 15);
            $paginate = $this->winkPostInterface->countWinkPosts(request()->input('q'), '');
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->winkPostInterface->searchWinkPost(request()->input('q'), $skip * 15, $from, $to);
            $paginate = $this->winkPostInterface->countWinkPosts(request()->input('q'), $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $paginate = $this->winkPostInterface->countWinkPosts('');
            $list = $this->winkPostInterface->listWinkPosts($skip * 15);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip, 15);

        return view('blog.index', [
            'posts'         => $list,
            'tags'          => $tags,
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit'],
            'skip'          => $skip,
            'optionsRoutes' => request()->segment(1)
        ]);
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
