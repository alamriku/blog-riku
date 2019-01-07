@extends('admin/admin_master')
@section('admin_main_content')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{asset('public/admin_assets/assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/admin_assets/assets/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/admin_assets/assets/bootstrap/css/bootstrap-fileupload.css')}}" rel="stylesheet" />
    <link href="{{asset('public/admin_assets/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link href="{{asset('public/admin_assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('public/admin_assets/css/style-responsive.css')}}" rel="stylesheet" />
    <link href="{{asset('public/admin_assets/css/style-default.css')}}" rel="stylesheet" id="style_color" />
</head>
<body>
<div class="widget-body">
<?php

$message= Session::get('message');
if($message)
{
    echo  "<h3 style='
                        color: #000000;
                        background: #cab6b6;
                        height: 50px;


                       ''>".$message."</h3>";
    Session::put('message',"");
}


?>     <!-- BEGIN FORM-->
    {!!Form::open(['url'=>'/save-blog','method'=>'post','enctype'=>'multipart/form-data'])!!}


    <div class="control-group">
        <label class="control-label">Blog Title</label>
        <div class="controls">
            <input type="text" class="span6"  name='blog_title' placeholder="Blog Title">

        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Category Name</label>
        <div class="controls">
            <select name = 'category_id'>

                @foreach($all_category as $vcategory)
                <option value="{{$vcategory->category_id}}">{{$vcategory->category_name}}</option>
                @endforeach
            </select>

        </div>
    </div>

    <div class="control-group">
        <label class="control-label ">Short Description</label>
        <div class="controls">
            <textarea class="span6 textarea" name='blog_short_description' type="text" placeholder="Short Description" ></textarea>

        </div>
    </div>



    <div class="control-group">
        <label class="control-label ">Long Description</label>
        <div class="controls">
            <textarea class="span6 textarea" name='blog_long_description' type="text" placeholder="Long Description" ></textarea>

        </div>
    </div>




    <div class="control-group">
        <label class="control-label">Images</label>
        <div class="controls">
            <input type="file" class="span6"  name='blog_image' placeholder="image">

        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Publication Status</label>
        <div class="controls">
            <select class="span6 " type="text" name='publication_status' placeholder="Blog Publication" >
                <option value="">Status</option>
                <option value="1" >publish</option>
                <option value="0" >unpublish</option>
            </select>

        </div>
    </div>

    <div class="controls">



    </div>

    <input class="span3 " type="submit"  value="submit" placeholder="">
    <input class="span3 " type="reset"   value='cancel'   placeholder="">

{!!Form::close()!!}
</div>
</body>
</html>

@endsection
