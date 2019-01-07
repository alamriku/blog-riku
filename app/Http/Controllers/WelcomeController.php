<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $published_blog = DB::table('blogs')
                        ->where('publication_status',1)
                        ->orderBy('blog_id',"desc")
                        ->get();

        $slider = view('pages/blog')//pages is dir name in Resourse->view->pages and slider is file name
                    ->with('published_blog',$published_blog);
        return view('master')//crucial part we are adding the content of contact and slide to master file by this technique
                ->with('content_test',$slider);
                 
    }

    public function contact()
    {
          $slider = view('pages/contact');
          return view('master')
                 ->with('content_test',$slider);
    }

    public function lifeStyle()
    {
        return view('pages/lifeStyle');
    }

    public function travel()
    {
        return view('pages/travel');
    }

    public function fashion()
    {
        return view('pages/fashion');
    }

    public function aboutMe()
    {
        return view('pages/aboutMe');
    }

    public function  blogDetail($blog_id)
    {
        $blog_detail = DB::table('blogs')
                    ->where('blog_id',$blog_id)
                    ->first();

        $hit_counter['hit_counter'] = $blog_detail->hit_counter +1;
                     DB::table('blogs')
                     ->where('blog_id',$blog_id)
                         ->update($hit_counter);

        $blog_page = view('pages/blog_details')
                    ->with('blog_detail',$blog_detail);
        return view('master')
                ->with('blog_page',$blog_page);
    }

    public  function  categoryBlog($category_id)
    {
        $published_blog = DB::table('blogs')
            ->where('publication_status',1)
            ->where('category_id',$category_id)
            ->orderBy('blog_id',"desc")
            ->get();

        $slider = view('pages/blog')//pages is dir name in Resourse->view->pages and slider is file name
        ->with('published_blog',$published_blog);
        return view('master')//crucial part we are adding the content of contact and slide to master file by this technique
        ->with('content_test',$slider);
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
        //
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
