
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

$return =array();
$userid ="";
$prefix = "THULI-0";

$user_name=$_POST['user_name'];//here getting result from the post array after submitting the form.
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$designation=$_POST['designation'];
$gender = $_POST['gender'];
$user_email=$_POST['email'];//same
$user_password=$_POST['password'];//same
$user_repassword = $_POST['repassword'];//same
$user_mobile = $_POST['mobile'];
$user_address = $_POST['address']; 
$groupname = $_POST['groupname'];
$groupname = $_POST['groupname'];
$compcode = $_POST['compcode'];

$insertImage = "";

$target_dir = "../../upload/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$insertImage = "upload/". basename($_FILES["image"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if($check !== false) {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

} else {
    echo "File is not an image.";
    $uploadOk = 0;
}


//Generating Userid
$sql="SELECT MAX(id) as latest_id FROM userprofile ORDER BY id DESC";
if($result = mysqli_query($dbcon,$sql)){
    $row   = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        $maxid = $row['latest_id'];
        $maxid+=1;

        $userid = $prefix.$maxid;
    }else{
        $maxid = 0;
        $maxid+=1;
        $userid = $prefix.$maxid;
    }
}


$insert_userprofile="insert into userprofile (userid,username,firstname,lastname,designation,gender,useremail,userpassword,repass,mobile,address,groupname,compcode,image_name) 
	VALUE ('$userid','$user_name','$firstname','$lastname','$designation','$gender','$user_email','$user_password','$user_repassword','$user_mobile','$user_address','$groupname','$compcode','$insertImage')";
//echo $insert_userprofile;
if(mysqli_query($dbcon,$insert_userprofile))
{
    $return['status'] = true;
} else {
    $return['false'] = true;

}

echo json_encode($return);
?>
