<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    var page =0;
    $(document).ready(function(){
        loadData();
    })    

     function page_click(page_no)
    {
            page = page_no;
            loadData();
    }

    function loadData(){

        var current_page =page;
         if (current_page == '0')
        {
            var pagee = '1';
        }
        var base_url ="<?php echo base_url(); ?>index.php/crud/readAll";
        $.ajax({
            type:'POST',
            data:{
                current_page:current_page
            },
            url:base_url,
            success:function(data){
                var json_obj = $.parseJSON(data);
                var length = json_obj.student_list.length;
                var output ='';
                output +="<table>";
                for (var i = 0; i < json_obj.student_list.length; i++) {
                    output +="<tr>";
                    output +="<td>"+ json_obj.student_list[i].student_firstname +"</td>";
                    output +="<td>"+ json_obj.student_list[i].student_lastname +"</td>";
                    output +="<td>"+ json_obj.student_list[i].student_email +"</td>";
                    output +="<td>"+ json_obj.student_list[i].student_mobile +"</td>";
                    output +="<td>";
                    output +="<a href='<?php echo base_url() ?>crud/edit'>Edit</a>";
                    output +="<a href='javascript:void(0);' onclick='delete();';>Delete</a>";
                    output +="<a href='<?php echo base_url() ?>crud/view'>View</a>";
                    output +="</td>";
                    output +="</tr>";
                }
                output +="</table>";
                $('#pagetable').html(output);
                var pagination ='';
                var no =json_obj.total_pages;
                pagination +="<ul class='pagination'>";
                if(current_page > 1){
                    pagination +="<li onclick='return page_click(" + i +")'><a href=''>&laquo;</a></li>";

                }

                for (var i = 1; i <= no ; i++) {
                    if(current_page==i){
                        pagination +="<li onclick='return page_click(" + i +")'><a href='' class='active'>"+ i +"</a></li>";         
                    }else{
                        pagination +="<li onclick='return page_click(" + i +")'><a href=''>"+ i +"</a></li>";         
                    }
                }

                if(current_page < no){
                    pagination +="<li onclick='return page_click(" + i +")'><a href=''>&raquo;</a></li>";
                }
                pagination +="</ul'>";
                $('#page').html(pagination);
            },
            error : function(data){
                console.log(data);
            }
        })
    }
  </script>
</head>
<body>
<!-- Content Section -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Demo: PHP and MySQL CRUD Operations using Jquery</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Record</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Records:</h3>
 
            <div class="records_content" id='pagetable'></div>
            <div id='page'></div>
        </div>
    </div>
</div>
<!-- /Content Section -->

<!-- Modal - Update User details -->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="update_first_name">First Name</label>
                    <input type="text" id="update_first_name" placeholder="First Name" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="update_last_name">Last Name</label>
                    <input type="text" id="update_last_name" placeholder="Last Name" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="update_email">Email Address</label>
                    <input type="text" id="update_email" placeholder="Email Address" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="update_mobile">Mobile Number</label>
                    <input type="text" id="update_mobile" placeholder="Mobile Number" class="form-control"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Save Changes</button>
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modals -->
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
            </div>
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" placeholder="First Name" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" placeholder="Last Name" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" id="email" placeholder="Email Address" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="email">Molile</label>
                    <input type="text" id="mobile" placeholder="Mobile Number" class="form-control"/>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addRecord()">Add Record</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->
</body>
</html>
