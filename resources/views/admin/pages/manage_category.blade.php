@extends('admin/admin_master')
@section('admin_main_content')
             
                     <div id='model' class="myModal">
                        <div class="modalContent">
                            <p>Are You Sure to Delete This?</p>
                            
                        </div>
                        <span id='yes' class="riku-btn btn-primary"><a href='#'>Yes</a></span>
                            <span id='no' class="riku-btn btn-primary"><a href='#'>No</a></span>
                     </div>

                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget orange">
                               <!--Modal to Delete Notice-->



                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Advanced Table</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">

                                <table class="table table-striped table-bordered table-advance table-hover">
                                    <thead>
                                    <tr>
                                        <th><i class="icon-bullhorn"></i> Category ID</th>
                                        <th class="hidden-phone"><i class="icon-question-sign"></i>Category Name</th>
                                        
                                        <th></i> Status</th>
                                        <th><i class=" icon-edit"></i> Action</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                         /*echo "<pre>";
                                          print_r($all_category_info);//Be Carefully with this syntax its define as variable here but on controller SuperAdminController it is a string name     
                                        */
                                        foreach($all_category_info as $vcategory){

                                        
                                      ?>  
                                    <tr>
                                        <td><a href="#">{{$vcategory->category_id}}</a></td>
                                        <td class="hidden-phone">{{$vcategory->category_name}}</td>

                                      <td> 
                                      <?php 
                                      
                                      if($vcategory->publication_status === 1)
                                      {
                                       
                                       ?>

                                        <span class="label label-success label-mini">Publish</span>

                                       <?php }

                                       else { 
                                      ?>

                                        <span class="label label-important label-mini">Unpublish</span>
                                         
                                        <?php } ?>
                                         </td>
                                        <td>
                                            <?php  

                                            if($vcategory->publication_status ==1){


                                            ?>
                                            <a  class="btn btn-danger" href="{{URL::to('/unpublish-category/'.$vcategory->category_id)}}"><i class="icon-thumbs-down"></i></a>
                                           

                                            <?php
                                            } else {
                                            ?>
                                          <a class="btn btn-success" href="{{URL::to('/publish-category/'.$vcategory->category_id)}}"><i class="icon-thumbs-up"></i></a>

                                            <?php
                                             } 
                                            ?>
                                                <a class="btn btn-success" href="{{URL::to('/edit-category/'.$vcategory->category_id)}}"><i class="icon-pencil"></i></a>
                                            <a  class="btn btn-danger" href="{{URL::to('/delete-category/'.$vcategory->category_id)}}" onclick="return deleteCheck()"><i class="icon-trash "></i></a>
                                        </td>

                                       <?php }?>
                                    </tr>

                                    
                                   
                                   
                                   
                                  
                                   
                                  
                                  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END BASIC PORTLET-->
                    </div>
                </div>

    
@endsection
