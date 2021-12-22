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
$db->join('master_parking','master_parking.id=master_inventory.master_parking_id');
$db->join('users','users.id=master_inventory.user_id');
$select = array('master_inventory.*','master_parking.location_name','CONCAT(users.firstname," ",lastname) as user_name');

// Set pagination limit
$db->pageLimit = $pagelimit;

// Get result of the query.
$rows = $db->arraybuilder()->paginate('master_inventory', $page, $select);
$total_pages = $db->totalPages;

include BASE_PATH . '/includes/header.php';
?>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Master Inventory</h1>
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
	            <th scope="col">Reference Id</th>
	            <th scope="col">Parking Name</th>
	            <th scope="col">User Name</th>
	            <th scope="col">From Date</th>
	            <th scope="col">To Date</th>
	            <th scope="col">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo xss_clean($row['ref_no']); ?></td>
                <td><?php echo xss_clean($row['location_name']); ?></td>
                <td><?php echo xss_clean($row['user_name']); ?></td>
                <td><?php echo xss_clean(date('d-m-Y H:i',strtotime($row['from_date'])));?></td>
                <td><?php echo xss_clean(date('d-m-Y H:i',strtotime($row['to_date'])));?></td>
                	<td><?php echo xss_clean($row['final_amount']); ?></td>
                <!--<td><?php echo xss_clean($row['status'] ==1)?'Active':'In-Active';?></td>
		         <td> 
		           <a href="edit_mastercities.php?id=<?php echo $row['id']; ?>&operation=edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit" title="edit"></i></a>
		         </td> -->
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <!-- //Table -->

    <!-- Pagination -->
    <div class="text-center">
    <?php echo paginationLinks($page, $total_pages, 'mastercities.php'); ?>
    </div>
    <!-- //Pagination -->
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php';?>
