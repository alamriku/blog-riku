<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File;
//backwarding browser does not create a session in laravel so Riku use session start
session_start();// Riku this session is used to check a user if log or not in case of backwarding the browser
use Illuminate\Support\Facades\Session;// This session is used to load any kind of link that is given in url
use Illuminate\Support\Facades\Redirect;
class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->AuthCheck();
        $admin_home = view('admin/pages/admin_main_content');
        return view('admin/admin_master')
                 ->with('admin_main_content',$admin_home);
    }



    public function addCategory()
    {
        $this->AuthCheck();
        $add_category = view('admin/pages/category');
        return view('admin/admin_master')
                ->with('admin_main_content',$add_category);
    }

    public function saveCategory(Request $request)
    {

        $data = array();
        $data['category_name']=$request->name;
        $data['category_description']=$request->description;
        $data['publication_status']=$request->publication_status;

        DB::table('category')->insert($data);
        Session::put('message','Your Category added successfully');
        return Redirect::to('/add-category');
    }

    public function manageCategory()
    {
        $this->AuthCheck();
        $all_category = DB::table('category')
                        ->get();
        $manageCategory = view('admin/pages/manage_category')
                        ->with('all_category_info',$all_category);//all_category_info is a variable in manage.blade.php file
        return view('admin/admin_master')
                ->with('admin_main_content',$manageCategory);
    }

    public function unpublishCategory($category_id)
    {
        DB::table('category')
            ->where('category_id',$category_id)
            ->update(['publication_status'=>0]);
            return Redirect::to('/manage-category');
    }

    public function publishCategory($category_id)//Here $category_id contains the passing value $vcategory->category
    {
        DB::table('category')
            ->where('category_id',$category_id)
            ->update(['publication_status'=>1]);
        return Redirect::to('/manage-category');
    }
    
    public function deleteCategory($id)// Here $id contains the passing value $vcategory->category
    {
        DB::table('category')
            ->where('category_id',$id)
            ->delete();
            return Redirect::to('/manage-category');
    }
    public function fetchCategory($category_id)
    {
              $result = DB::table('category')
               ->where('category_id',$category_id)
              ->first();

        $specific_category = view('admin/pages/edit_category')
                            ->with('category_by_id',$result);//category_by_id is a varibale in category blade file
        return view('admin/admin_master')
                ->with('admin_main_content',$specific_category);

    }

    public function  editCategory(Request $request)
    {
        $id = $request->id;
        $data = [];
        $data['category_name'] = $request->name;
        $data['category_description'] = $request->description;
        $data['publication_status'] = $request->publication_status;
        DB::table('category')
            ->where('category_id',$id)
            ->update(['category_name'=>$data['category_name'],'category_description'=>$data['category_description'],'publication_status'=>$data['publication_status']]);
       Session::put('message','data has been changed');
        return Redirect::to('/edit-category/'.$id);
    }

    public function addBlog()
    {
        $published_category = DB::table('category')
            ->where('publication_status',1)
            ->get();
        $this->AuthCheck();
        $blog = view('admin/pages/blog')
            ->with("all_category",$published_category);
        return view('admin/admin_master')
            ->with('admin_main_content',$blog);
    }

    public function  saveBlog(Request $request)
    {

        $data=[];
        $data['category_id'] = $request->category_id;
        $data['blog_title']=$request->blog_title;
        $data['blog_short_description']=$request->blog_short_description;
        $data['blog_long_description']=$request->blog_long_description;
        $data['author_name']=Session::get('admin_name');
        $data['blog_image']=' ';
        $data['publication_status']= $request->publication_status;

        /*
         * Image Upload
         */
        $files = $request->file('blog_image');
        if(! $files == NULL)
        {
            $fileName = $files->getClientOriginalName();
            $fileExtension = $files->getClientOriginalExtension();
            $fileSize = $files->getSize();

            if($fileExtension == 'jpg' || $fileExtension == 'jpeg' || $fileExtension == 'png')

            {
                if($fileSize <= 126020)
                {
                    $picture =Date('His').$fileName;
                    $image_url = 'public/blog_image/'.$picture;
                    $destination_path = base_path()."/public/blog_image/";
                    $success = $files->move($destination_path,$picture);
                    foreach ($data as $value)
                    {
                        if($value == Null)
                        {

                            unlink($image_url);
                            Session::put('message','Input Can not be empty');
                            return Redirect::to('/add-blog');
                        }
                    }
                    if($success)
                    {
                        $data['blog_image'] =$image_url;
                        $data_inserted = DB::table('blogs')->insert($data);
                        if($data_inserted){
                            Session::put('message','Your blog added successfully');
                            return Redirect::to('/add-blog');
                        }
                        else
                        {
                            if(file_exists($destination_path))
                            {
                                unlink($destination_path);
                                Session::put('message','Your fail To add blog');
                                return Redirect::to('/add-blog');
                            }
                        }
                    }
                }
                else
                {
                    Session::put('message','file size can not be larger than 120kb');
                    return Redirect::to('/add-blog');
                }


            }
            else
            {
                Session::put('message','Image format should be jpeg or png or jpg');
                return Redirect::to('/add-blog');
            }

        }
        else
        {
             DB::table('blogs')->insert($data);
            Session::put('message','Your blog added successfully');
            return Redirect::to('/add-blog');

        }

        return Redirect::to('');
    }

    public function manageBlog()
    {
        $this->AuthCheck();
        $all_blog = DB::table('blogs')
            ->get();
        $manageBlog = view('admin/pages/manage_blog')
            ->with('all_blog_info',$all_blog);//all_category_info is a variable in manage.blade.php file
        return view('admin/admin_master')
            ->with('admin_main_content',$manageBlog);
    }

    public function unpublishBlog($blog_id)
    {
        DB::table('blogs')
            ->where('blog_id',$blog_id)
            ->update(['publication_status'=>0]);
        return Redirect::to('/manage-blog');
    }

    public function publishBlog($blog_id)//Here $category_id contains the passing value $vcategory->category
    {
        DB::table('blogs')
            ->where('blog_id',$blog_id)
            ->update(['publication_status'=>1]);
        return Redirect::to('/manage-blog');
    }

    public function deleteBlog($blog_id)// Here $id contains the passing value $vcategory->category
    {
        DB::table('blogs')
            ->where('blog_id',$blog_id)
            ->delete();
        return Redirect::to('/manage-blog');
    }

    public function fetchBlog($blog_id)
    {
        $result = DB::table('blogs')
            ->where('blog_id',$blog_id)
            ->first();
        $published_category = DB::table('category')
                            ->get();

        $specific_blog = view('admin/pages/edit_blog')
            ->with('blog_by_id',$result)//blog_by_id is a array type variable in category blade file
            ->with('published_category',$published_category);

        return view('admin/admin_master')
            ->with('admin_main_content',$specific_blog);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBlog(Request $request)
    {
        $data=[];
        $data['category_id'] = $request->category_id;
        $data['blog_title'] = $request->blog_title;
        $blog_id = $request->blog_id;
        $data['blog_short_description'] = $request->blog_short_description;
        $data['blog_long_description'] =$request->blog_long_description;
        $data['author_name'] = Session::get('admin_name');
        $data['publication_status'] =$request->publication_status;
        $old_image = $request->old_blog_image;

        if($_FILES['blog_image']['name'] == "")
        {
            if(!$old_image == NULL)
            {
                $data['blog_image'] = $old_image;//this is old image which is stays , because new image is not assign
                $data_updated = DB::table('blogs')
                    ->where('blog_id',$blog_id)
                    ->update($data);
                if(isset($data_updated))
                {
                    Session::put('message',"blog updated successfully");
                    return Redirect::to('/edit-blog/'.$blog_id);
                }
                else
                {
                    unlink($old_image);
                    Session::put('message',"blog update fail");
                    return Redirect::to('/edit-blog/'.$blog_id);
                }
            }
            else
            {
                DB::table('blogs')
                    ->where('blog_id',$blog_id)
                    ->update($data);
                Session::put('message',"blog updated successfully");
                return Redirect::to('/edit-blog/'.$blog_id);
            }


        }

        else
            {
                $files = $request->file('blog_image');
                $fileName = $files->getClientOriginalName();
                $fileExtension = $files->getClientOriginalExtension();
                $fileSize = $files->getSize();
                if($fileExtension == 'jpg' || $fileExtension == 'jpeg' || $fileExtension == 'png')
                {
                    if($fileSize <= 126020 )
                    {
                        $picture = Date('His').$fileName;
                        $image_url = 'public/blog_image/'.$picture;
                        $destination_path = base_path().'/public/blog_image/';
                        $file_moved = $files->move($destination_path,$picture);

                        if(isset($file_moved))
                        {
                            $data['blog_image'] =$image_url;
                            $data_updated = DB::table('blogs')
                                ->where('blog_id',$blog_id)
                                ->update($data);

                            if(isset($data_updated))
                            {
                                if( !$old_image == NULL)
                                {
                                    unlink($old_image);
                                }
                                // this is old image that is going to be delete because new image is assign
                                Session::put('message',"Blog has been updated successfully");

                                return Redirect::to('/edit-blog/'.$blog_id);
                            }
                            else
                            {
                                unlink('public/blog_image/'.$picture);
                                Session::put('message','blog can not be updated ,data insertion error');
                                return Redirect::to('/edit-blog/'.$blog_id);
                            }

                        }
                    }
                    else
                    {
                        Session::put('message',"file size can not be larger than 315kb");
                        return Redirect::to('/edit-blog/'.$blog_id);
                    }

                }
                else
                {
                    Session::put('message',"Image format should be jpeg or png or jpg");
                    return Redirect::to('/edit-blog/'.$blog_id);
                }



            }
            return Redirect::to('/edit-blog/'.$blog_id);
    }
    
    public function manageComment()
    {
      $all_comment = DB::table('comments')
                    ->get();
      
      $manage_comment = view('admin/pages/manage_comment')
                        ->with('all_comment',$all_comment);
      
      return view('admin/admin_master')
               ->with('admin_main_content',$manage_comment);
    }
    
    public function unpublishComment($id)
    {
        DB::table('comments')
                ->where('id',$id)
                ->update(['publication_status'=>0]);
        return Redirect::to('/manage-comment');
    }
    
    public function publishComment($id)
    {
        DB::table('comments')
                ->where('id',$id)
                ->update(['publication_status'=>1]);
        return Redirect::to('/manage-comment');
    }

    public function logout()
    {
        Session::put('admin_name','');
        Session::put('id','');
        Session::put('message','Your are logout Successfully');
        return Redirect::to('/admin');
       
    }
    
    public function AuthCheck()
    {
        $admin_id = Session::get('id');
        if($admin_id)
        {
            return;
        }
        else
        {
           return Redirect::to('/admin')->send();
           
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
