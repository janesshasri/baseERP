<?php
include('header.php');

include("database/db_conection.php");//make connection here

?>

<!-- End Sidebar -->


<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">


            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">User Registration</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Create User</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <!--div class="alert alert-success" role="alert">
<h4 class="alert-heading">Parsley JavaScript form validation library</h4>
<p>You can find examples and documentation about Parsley form validation library here: <a target="_blank" href="http://parsleyjs.org/">Parsley documentation</a></p>
</div-->


            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">						
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3><i class="fa fa-hand-pointer-o"></i>Create User</h3>
                        </div>

                        <div class="card-body" id="addUserCard">

                            <form data-parsley-validate novalidate method="POST" enctype="multipart/form-data" id="addUserForm">
                                <div class="form-group" >
                                    <label>User Name<span class="text-danger">*</span></label>
                                    <input type="text" name="user_name" data-parsley-trigger="change" required placeholder="Enter user name" class="form-control" >
                                    <small class="form-text text-danger err_msg" id="usrnme_msg">   </small>
                                </div>
                                <div class="form-group">
                                    <label for="firstname">Firstname<span class="text-danger">*</span></label>
                                    <input type="text" name="firstname" data-parsley-trigger="change" required placeholder="Enter user name" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="Lastname">Lastname<span class="text-danger">*</span></label>
                                    <input type="text" name="lastname" data-parsley-trigger="change" required placeholder="Enter user name" class="form-control" >
                                </div>
								
								<div class="form-group">
                                    <label for="Lastname">Designation<span class="text-danger">*</span></label>
                                    <input type="text" name="designation" data-parsley-trigger="change" required placeholder="Enter designation" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="">- Open Gender-</option>

                                        <option  value="1">Male</option>
                                        <option  value="2">Female</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                                    <input type="email" name="email" data-parsley-trigger="change" required placeholder="Enter email" class="form-control" id="emailAddress">
                                    <small class="form-text text-danger err_msg" id="email_msg">   </small>

                                </div>
                                <div class="form-group">
                                    <label for="pass1">Password<span class="text-danger">*</span></label>
                                    <input id="pass1" type="password" name="password" placeholder="Password" required class="form-control">
                                    <small class="form-text text-danger err_msg" id="pwd_msg"></small>

                                </div>
                                <div class="form-group">
                                    <label for="passWord2">Confirm Password <span class="text-danger">*</span></label>
                                    <input data-parsley-equalto="#pass1" type="password" name="repassword" required placeholder="Password" class="form-control" id="passWord2">
                                </div>
                                <div class="form-group">
                                    <label>Mobile<span class="text-danger">*</span></label>
                                    <div>
                                        <input data-parsley-type="number" step="any" name="mobile" type="text" class="form-control" required placeholder="Enter only numbers"/>
                                        <small class="form-text text-danger err_msg" id="mobile_msg"></small>

                                    </div>
                                </div>                                                    
                                <div class="form-group">
                                    <label>Address<span class="text-danger">*</span></label>
                                    <div>
                                        <textarea name="address" class="form-control" data-parsley-trigger="change" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Organization ID<span class="text-danger">*</span></label>
                                    <select id="compcode" onchange="oncompcode(this);" class="form-control" required name="compcode">
                                        <option selected>Open Org ID</option>
                                        <?php 
                                        include("database/db_conection.php");//make connection here
                                        $sql = mysqli_query($dbcon,"SELECT orgid FROM comprofile ORDER BY id ASC							
																				");
                                        while ($row = $sql->fetch_assoc()){	
                                            echo $orgid=$row['orgid'];
                                            echo '<option onchange="'.$row[''].'" value="'.$orgid.'" >'.$orgid.'</option>';

                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="inputState">Groups<span class="text-danger">*</span></label>
                                    <select id="groupname" onchange="ongroup(this)" class="form-control"  name="groupname">
                                        <option selected>Open Groups</option>
                                        <?php 
                                        include("database/db_conection.php");//make connection here

                                        $sql = mysqli_query($dbcon, "SELECT groupname FROM groups");
                                        while ($row = $sql->fetch_assoc()){	
                                            echo $groupname=$row['groupname'];
                                            echo '<option onchange="'.$row[''].'" value="'.$groupname.'" >'.$groupname.'</option>';
                                        }
                                        ?>
                                    </select>


                                    <!-- Button trigger modal -->
                                    <!--a role="button" href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
User Group
</a-->

                                    <a href="#custom-modal" data-target="#customModal" data-toggle="modal"> 
                                        <i class="fa fa-user-plus" aria-hidden="true"></i>Add User Group/Role</a><br></br>

                                <!-- Modal -->
                                <div class="modal fade custom-modal" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel2">Add User Group/Role</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="#" enctype="multipart/form-data" method="post">									

                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="addgroupname"  id="addgroupname"  placeholder="groupname">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="adddescription" id="adddescription"  placeholder="description">
                                                    </div>
                                                    </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" name="submitgroup" id="submitgroup" class="btn btn-primary">Save & Associate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <div class="fa-hover col-md-12 col-sm-12">
                                                <i class="fa fa-folder-open bigfonts" aria-hidden="true"></i>Upload User Profile Image</div></label> 
                                        <input type="file" name="image" id="fileinput" class="form-control">
                                    </div>


                                    <div class="form-group text-right m-b-0">
                                        <button class="btn btn-primary" name="submit" type="submit">
                                            Submit
                                        </button>
                                        <button type="reset" name="cancel" class="btn btn-secondary m-l-5">
                                            Cancel
                                        </button>
                                    </div>

                                    </form>

                                </div>														
                        </div><!-- end card-->					
                    </div>





                    <script >$(function () {
                            var $sections = $('.form-section');

                            function navigateTo(index) {
                                // Mark the current section with the class 'current'
                                $sections
                                    .removeClass('current')
                                    .eq(index)
                                    .addClass('current');
                                // Show only the navigation buttons that make sense for the current section:
                                $('.form-navigation .previous').toggle(index > 0);
                                var atTheEnd = index >= $sections.length - 1;
                                $('.form-navigation .next').toggle(!atTheEnd);
                                $('.form-navigation [type=submit]').toggle(atTheEnd);
                            }

                            function curIndex() {
                                // Return the current index by looking at which section has the class 'current'
                                return $sections.index($sections.filter('.current'));
                            }

                            // Previous button is easy, just go back
                            $('.form-navigation .previous').click(function() {
                                navigateTo(curIndex() - 1);
                            });

                            // Next button goes forward iff current block validates
                            $('.form-navigation .next').click(function() {
                                $('.demo-form').parsley().whenValidate({
                                    group: 'block-' + curIndex()
                                }).done(function() {
                                    navigateTo(curIndex() + 1);
                                });
                            });

                            // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
                            $sections.each(function(index, section) {
                                $(section).find(':input').attr('data-parsley-group', 'block-' + index);
                            });
                            navigateTo(0); // Start at the beginning
                        });
                        //# sourceURL=pen.js
                    </script>


                </div>														
            </div><!-- end card-->					
        </div>


    </div>





</div>
<!-- END container-fluid -->

</div>
<!-- END content -->

</div>
<!-- END content-page -->

<footer class="footer">
    <span class="text-right">
        Copyright@2021<a target="_blank" href="#">Thuli Ice Creams,</a>
    </span>
    <span class="float-right">
        Powered by <a target="_blank" href=""><span>e-Schoolz</span> </a>
    </span>
</footer>

</div>
<!-- END main -->

<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>

<!-- App js -->
<script src="assets/js/pikeadmin.js"></script>

<!-- BEGIN Java Script for this page -->
<script src="assets/plugins/parsleyjs/parsley.min.js"></script>
<script>
    $('#form').parsley();
</script>
<!-- END Java Script for this page -->

<!-- BEGIN Java Script for this page -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function(){

        $('#example1').click(function(){
            swal("Hello world!");
        });

        $('#example2').click(function(){
            swal("Here's the title!", "...and here's the text!");
        });

        $('#submit').click(function(){
            swal("User Created Successfully!", "Click OK button", "success");
        });

        $('#example4').click(function(){
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                if (willDelete) {
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
        });

        $('#example5').click(function(){
            swal("Write something here:", {
                content: "input",
            })
                .then((value) => {
                swal(`You typed: ${value}`);
            });
        });

        $('#example6').click(function(){
            swal({
                text: 'Search for a movie. e.g. "Titanic".',
                content: "input",
                button: {
                    text: "Search!",
                    closeModal: false,
                },
            })
                .then(name => {
                if (!name) throw null;

                return fetch(`https://itunes.apple.com/search?term=${name}&entity=movie`);
            })
                .then(results => {
                return results.json();
            })
                .then(json => {
                const movie = json.results[0];

                if (!movie) {
                    return swal("No movie was found!");
                }

                const name = movie.trackName;
                const imageURL = movie.artworkUrl100;

                swal({
                    title: "Top result:",
                    text: name,
                    icon: imageURL,
                });
            })
                .catch(err => {
                if (err) {
                    swal("Oh noes!", "The AJAX request failed!", "error");
                } else {
                    swal.stopLoading();
                    swal.close();
                }
            });
        });

    });
</script>
<script>
    function oncompcode(){

        console.log(this);
    }
</script>

<!-- END Java Script for this page -->
<script>
    function ongroup(){

        console.log(this);
    }
</script>

<script>
    $('document').ready(function(){
        //addGroupnames_ajax.php
        $('#submitgroup').click(function(){
            var description = $('#adddescription').val();
            var groupname = $('#addgroupname').val();
            //alert(groupname+description);
            $.ajax ({
                url: 'addGroupnames_ajax.php',
                type: 'post',
                data: {
                    groupname:groupname,
                    description:description
                },
                //dataType: 'json',
                success:function(response){
                    if(response!=0){
                        var new_option ="<option>"+response+"</option>";
                        $('#groupname').append(new_option);
                        $('#customModal').modal('toggle');
                    }else{
                        alert('Error in inserting new Group,try another group');
                    }
                }

            });

        });

        function getFormData($form){
            var unindexed_array = $form.serializeArray();
            var indexed_array = {};

            $.map(unindexed_array, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            return indexed_array;
        }

        function check_form(data,field){
            var status = '';
            $.ajax ({
                url: 'workers/getters/form_checker.php',
                type: 'post',
                async: false,
                data: { value: data, field: field},
                dataType: 'json',
                success:function(response){
                    if(response.status){
                        status = response.flag;

                    }
                }

            });

            return status;
        }

        function hasNumber(myString) {
            return /\d/.test(myString);
        }

        function hasUpperCase(str) {
            return (/[A-Z]/.test(str));
        }


        function validate_mobile(mobile)
        {
            if (/^\d{10}$/.test(mobile)) {
                // value is ok, use it
                return true;
            } else {

                return false;
            }
        }


        $("form").submit(function(e){
            e.preventDefault();
            var $form = $("#addUserForm");
            var data = getFormData($form);

            if(data.user_name.length < 3 || data.user_name > 16){
                //    if (strlen($user_name) < 3 || strlen($user_name) > 16) {
                $('#usrnme_msg').html('Username must be between 3 and 16 characters');
                $('html, body').animate({
                    scrollTop: $("#addUserCard").offset().top
                }, 1000);
                return false;
            }else{
                $('.err_msg').html('');
            }

            if(!isNaN(data.user_name.charAt(0))){
                //    if (strlen($user_name) < 3 || strlen($user_name) > 16) {
                $('#usrnme_msg').html('Username must begin with a letter');
                $('html, body').animate({
                    scrollTop: $("#addUserCard").offset().top
                }, 1000);
                return false;

            }else{
                $('.err_msg').html('');

            }

            if(check_form(data.user_name,'username')){
                $('.err_msg').html('');

            }else{
                //    if (strlen($user_name) < 3 || strlen($user_name) > 16) {
                $('#usrnme_msg').html('Username already exists');
                $('html, body').animate({
                    scrollTop: $("#addUserCard").offset().top
                }, 1000);
                return false;
            }

            if(check_form(data.email,'useremail')){
                $('.err_msg').html('');

            }else{
                //    if (strlen($user_name) < 3 || strlen($user_name) > 16) {
                $('#email_msg').html('Email already exists');
                $('html, body').animate({
                    scrollTop: $("#addUserCard").offset().top
                }, 1000);
                return false;
            }

            if(!hasNumber(data.password)){
                $('#pwd_msg').html('Password Should contain atleast one number');
                $('html, body').animate({
                    scrollTop: $("#addUserCard").offset().top
                }, 1000);
                return false;
            }else{

                $('.err_msg').html('');

            }

            if(!hasUpperCase(data.password)){
                $('#pwd_msg').html('Password Should contain atleast one Uppercase letter');
                $('html, body').animate({
                    scrollTop: $("#addUserCard").offset().top
                }, 1000);
                return false;
            }else{
                $('.err_msg').html('');

            }


            if(data.password.length<8){
                $('#pwd_msg').html('Minimum pssword length should be atleast 8');
                $('html, body').animate({
                    scrollTop: $("#addUserCard").offset().top
                }, 1000);
                return false;
            }else{
                $('.err_msg').html('');

            }


            if(validate_mobile(data.mobile)){
                $('.err_msg').html('');

            }else{
                $('#mobile_msg').html('invalid mobile number');
                $('html, body').animate({
                    scrollTop: $("#addUserCard").offset().top
                }, 1000);
                return false;
            }


            var formData = new FormData(this);

            $.ajax({
                url: 'workers/setters/save_users.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    location.href="listUsers.php";
                },
                cache: false,
                contentType: false,
                processData: false
            });


        });
    });

</script>			

</body>
</html>