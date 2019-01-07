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
    {!!Form::open(['url'=>'/edit-category/'.$category_by_id->category_id,'method'=>'post'])!!}

    <input type="hidden" name="id" value="{{$category_by_id->category_id}}">
    <div class="control-group">
        <label class="control-label">Category Name</label>
        <div class="controls">
            <input type="text" class="span6 " value="{{$category_by_id->category_name}}" name='name' placeholder="Category Name">

        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Category Description</label>
        <div class="controls">
            <textarea class="span6 " name='description' type="text" placeholder="Category Description" ><?php echo $category_by_id->category_description ?></textarea>

        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Publication Status</label>
        <div class="controls">
            <select class="span6 " type="text" name='publication_status' placeholder="Category Publication" >
                <option value="">Status</option>
                <option value="1" <?php if($category_by_id->publication_status == 1) {echo 'selected="selected"'; } ?>>publish</option>
                <option value="0" <?php if($category_by_id->publication_status == 0)  {echo 'selected="selected"';} ?>>unpublish</option>
            </select>

        </div>
    </div>

    <div class="controls">



    </div>

    <input class="span3 " type="submit"  value="Update" placeholder="">
    <input class="span3 " type="reset"   value='cancel'   placeholder="">

{!!Form::close()!!}
</div>



@endsection
