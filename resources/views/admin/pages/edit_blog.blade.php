@extends('admin/admin_master')
@section('admin_main_content')


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
    {!!Form::open(['url'=>'/update-blog/'.$blog_by_id->blog_id,'method'=>'post','name'=>'edit_blog','enctype'=>'multipart/form-data'])!!}


    <div class="control-group">
        <label class="control-label">Blog Title</label>
        <div class="controls">
            <input type="text" class="span6"  name='blog_title' value="{{$blog_by_id->blog_title}}" placeholder="Blog Title">
            <input type="hidden" name="blog_id" value="{{ $blog_by_id->blog_id}}"/>
            <input type="hidden" name="old_blog_image" value="{{ $blog_by_id->blog_image }}">

        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Category Name</label>
        <div class="controls">
            <select name = 'category_id'>

                    @foreach($published_category as $v_category)
                        {
                    <option value="{{$v_category->category_id}}">{{$v_category->category_name}}</option>
                        }
                        @endforeach
            </select>

        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Short Description</label>
        <div class="controls">
            <textarea class="span6 textarea" name='blog_short_description' type="text" placeholder="Short Description" >
                <?php echo $blog_by_id->blog_short_description ?>
            </textarea>

        </div>
    </div>



    <div class="control-group">
        <label class="control-label">Long Description</label>
        <div class="controls">
            <textarea class="span6 textarea" name='blog_long_description' type="text" placeholder="Long Description" >
                <?php echo $blog_by_id->blog_long_description ?>
            </textarea>

        </div>
    </div>




    <div class="control-group">
        <label class="control-label">Images</label>
        <div class="controls">
            <input type="file" class="span6"  name='blog_image' placeholder="image">
            <span>
                <img src=" {{ asset($blog_by_id->blog_image) }} " width="50px" height="50px"/>
            </span>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Publication Status</label>
        <div class="controls">
            <select class="span6 " type="text" name='publication_status' placeholder="Blog Publication" >
                <option value="" >Status</option>
                <option value="1" <?php //if($blog_by_id->publication_status == 1) {echo "selected ='selected'";}?> >publish</option>
                <option value="0" <?php //if($blog_by_id->publication_status == 0) { echo "selected = 'selected'"; } ?> >unpublish</option>
            </select>

        </div>
    </div>

    <div class="controls">



    </div>

    <input class="span3 " type="submit"  value="submit" placeholder="">
    <input class="span3 " type="reset"   value='cancel'   placeholder="">

    {!!Form::close()!!}
</div>
<script>
    document.forms['edit_blog'].elements['category_id'].value="<?php echo $blog_by_id->category_id ?>"
    document.forms['edit_blog'].elements['publication_status'].value="<?php echo $blog_by_id->publication_status ?>"
</script>


@endsection
