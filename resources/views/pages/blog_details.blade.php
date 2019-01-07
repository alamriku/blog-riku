@extends('master')
@section('content_test')
<?php
use Illuminate\Support\Facades\DB;
?>
        <article class="blog-post">
            <div class="blog-post-image">
                <a href=""><img src="{{asset($blog_detail->blog_image)}}" alt="" style=" display: inline-block;margin-top: 100px;"></a>
            </div>
            <div class="blog-post-body">
                <h2><a href="post.html">{{$blog_detail->blog_title}}</a></h2>
                <div class="post-meta">
                                <span>by <a href="#">{{$blog_detail->author_name}}</a>
                                </span>/<span>
                                    <i class="fa fa-clock-o"></i>{{$blog_detail->created_at}}</span>
                    /
                    <span>
                                    <i class="fa fa-comment-o"></i> <a href="#">343</a>
                                </span>
                </div>

                <p>
                    <?php echo $blog_detail->blog_long_description ?>
                </p>

                
            </div>
            @guest
            
            <h1 class="display-3">You need to <a href="{{route('login')}}">Login</a> for comment</h1>
           
            @else
            <table class="table table-hover table-dark" style="margin-top:30px;">
                <h1 class="display-4">Comments </h1>
                
                <?php 
                $message = Session::get('message');
                if($message)
                {
                    echo "<h3>" .$message. "</h3>";
                    Session::put('message','');
                    
                }
    
                ?>
                <tbody>
                <form action = '{{ URL::to("/comment/".$blog_detail->blog_id) }}' method="post">
                  <tr>
                      @csrf
                      <td><input type="text" class=" no-border input-riku" name='user_name' value="" placeholder="Name"></td>
                  </tr>
                  <tr>
                    
                    <td><textarea type="text" id="form7" class="md-textarea form-control" name='user_comment' rows="6" placeholder="Comment"></textarea></td>
                  </tr>
                  <tr>
                  <input type='hidden' name='publication_status' value='0' />
                    <td colspan="2"><input class="btn btn-primary" type="submit" name='btn' value="Post Comment"></td>
                  </tr>
                  </form>
                </tbody>
               </table>
            @endguest
            <h4><b>COMMENTS(
                <?php
                       $count = DB::table('comments')
                      ->where(['blog_id'=>$blog_detail->blog_id,'publication_status'=>1])
                          ->count();
                     echo $count;
                       
                 ?>)</b></h4>
        </article>
        
        <section class="comment-section">
                        <?php
                        
                        $comments = DB::table('comments')
                                ->where('blog_id',$blog_detail->blog_id)
                                ->get();
                        //var_dump($comment);
                        ?>
            <?php foreach($comments as $comment){ 
                 if($comment->publication_status== 1)
                 {
                ?>
            
                    <div class="commnets-area ">

                      <div class="comment">

                          <div class="post-info">

                                  <div class="left-area">
                                          <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                                  </div>

                                  <div class="middle-area">
                                          <a class="name" href="#"><b> <?php echo $comment->user_name; ?></b></a>
                                          <h6 class="date" style="color:red;letter-spacing: 2px;margin-left: 11px;font-family: sans-serif;">
                                              <?php echo $comment->created_at; ?>
                                          </h6>
                                  </div>

                                  <div class="right-area">
                                          <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                                  </div>

                          </div><!-- post-info -->

                          <p>
                              <?php echo $comment->comment; ?>
                          </p>

                  </div>

              </div>    
                 <?php }}?>
        </section>




@endsection
