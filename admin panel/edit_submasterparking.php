<?php
if(!isset($_SESSION)){
    session_start();
}
require_once './config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$subloc_id = filter_input(INPUT_GET, 'subloc_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get customer id form query string parameter.
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);
    
    $data_to_update['updated_at'] = date('Y-m-d H:i:s');
    $db = getDbInstance();
    $db->where('id',$id);
    $stat = $db->update('master_parking_sub_location', $data_to_update);

    if($stat)
    {
        $_SESSION['success'] = "Master Parking Sub Location updated successfully!";
        //Redirect to the listing page,
        header('location: submasterparking.php?id='.$subloc_id.'&operation=edit');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    }
}


//If edit variable is set, we are performing the update operation.
if($edit)
{
    $db->where('id', $id);
    //Get data to pre-populate the form.
    $data = $db->getOne("master_parking_sub_location");

    $select = array('*');
	$rows = $db->arraybuilder()->paginate('master_table', 1, $select);
}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Update Master Parking Sub Location</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
            //Include the common form for add and edit  
            require_once('./forms/submasterparking_form.php'); 
        ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>