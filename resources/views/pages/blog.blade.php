@extends('master')
@section('content_test')



    @foreach($published_blog as $v_blog)
        <article class="blog-post">
            <div class="blog-post-image">
                <a href="#"><img src="{{asset($v_blog->blog_image)}}" alt="" style=" display: inline-block;margin-top: 100px;"></a>
            </div>
            <div class="blog-post-body">
                <h2><a href="post.html">{{$v_blog->blog_title}}</a></h2>
                <div class="post-meta">
                                <span>by <a href="#">{{$v_blog->author_name}}</a>
                                </span>/<span>
                                    <i class="fa fa-clock-o"></i>{{$v_blog->created_at}}</span>
                    /
                    <span>
                                    <i class="fa fa-comment-o"></i> <a href="#">343</a>
                                </span>
                </div>

                <p>
                    <?php $v_blog->blog_short_description ?>
                </p>

                <div class="read-more"><a href="{{URL::to('/blog-details/'.$v_blog->blog_id)}}">Continue Reading</a></div>
            </div>
        </article>
    @endforeach



@endsection
