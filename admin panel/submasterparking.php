<?php
if(!isset($_SESSION)){
    session_start();
}
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';



// Per page limit for pagination.
$pagelimit = 15;

// Get current page.
$page = filter_input(INPUT_GET, 'page');
if (!$page) {
	$page = 1;
}

//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$db->where('master_parking_id',$id);
$select = array('master_parking_sub_location.*','master_table.id as master_id','CONCAT(master_table.location_name," ,",master_table.location_type) as master_location_name','master_parking.location_name as location_name' );

// Set pagination limit
$db->pageLimit = $pagelimit;
$db->join('master_table','master_table.id=master_parking_sub_location.master_table_id');
$db->join('master_parking','master_parking.id=master_parking_sub_location.master_parking_id');
// Get result of the query.
$rows = $db->arraybuilder()->paginate('master_parking_sub_location', $page, $select);
$total_pages = $db->totalPages;

include BASE_PATH . '/includes/header.php';
?>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Master Parking Sub Location</h1>
        </div>
        <div class="col-lg-6">
            <div class="page-action-links text-right">
                <a href="add_submasterparking.php?id=<?php echo $id; ?>&operation=create" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add new</a>
            </div>
        </div>
    </div>
    <?php include BASE_PATH . '/includes/flash_messages.php';?>

    <!-- <div id="export-section">
        <a href="export_customers.php"><button class="btn btn-sm btn-primary">Export to CSV <i class="glyphicon glyphicon-export"></i></button></a>
    </div> -->

    <!-- Table -->
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th scope="col">#S.No</th>
	            <th scope="col">Location Name</th>
	            <th scope="col">Parking Location</th>
	            <th scope="col">Distance (KM)</th>
	            <th scope="col">Status</th>
	            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row_key => $row): ?>
            <tr>
                <td><?php echo ($row_key+1); ?></td>
                <td><?php echo xss_clean($row['master_location_name']); ?></td>
                <td><?php echo xss_clean($row['location_name']); ?></td>
                <td><?php echo xss_clean($row['distance']); ?></td>
                <td><?php echo xss_clean($row['status'] ==1)?'Active':'In-Active';?></td>
		        <td> 
		           <a href="edit_submasterparking.php?id=<?php echo $row['id']; ?>&master_table=<?php echo $row['master_id'];?>&subloc_id=<?php echo $id;?>&operation=edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
		         </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <!-- //Table -->

    <!-- Pagination -->
    <div class="text-center">
    <?php echo paginationLinks($page, $total_pages, 'submasterparking.php'); ?>
    </div>
    <!-- //Pagination -->
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php';?>
