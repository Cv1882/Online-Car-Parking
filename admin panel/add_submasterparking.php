<?php
if(!isset($_SESSION)){
    session_start();
}
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//serve POST method, After successful insert, redirect to customers.php page.
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    $data_to_store = array_filter($_POST);
  
    $db = getDbInstance();
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    $data_to_store['master_parking_id'] = $id;
    $last_id = $db->insert('master_parking_sub_location', $data_to_store);

    if($last_id)	
    {
    	$_SESSION['success'] = "Master Parking Sub Location added successfully!";
    	header('location: submasterparking.php?id='.$id.'&operation=edit');
    	exit();
    }
    else
    {
        echo 'insert failed: ' . $db->getLastError();
        exit();
    }
}

//We are using same form for adding and editing. This is a create form so declare $edit = false.
$edit = false;
$db = getDbInstance();

$select = array('*');
$rows = $db->arraybuilder()->paginate('master_table', 1, $select);

require_once 'includes/header.php'; 
?>
<div id="page-wrapper">
<div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Add Master Parking Sub Location</h2>
        </div>
        
</div>
    <form class="form" action="" method="post"  id="masterparking_aublocation_form" enctype="multipart/form-data">
       <?php  include_once('./forms/submasterparking_form.php'); ?>
    </form>s
</div>


<script type="text/javascript">
$(document).ready(function(){
   $("#masterparking_form").validate({
       rules: {
            f_name: {
                required: true,
                minlength: 3
            },
            l_name: {
                required: true,
                minlength: 3
            },   
        }
    });
});
</script>

<?php include_once 'includes/footer.php'; ?>