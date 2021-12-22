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
$select = array('*');

// Set pagination limit
$db->pageLimit = $pagelimit;
// Get result of the query.
$rows = $db->arraybuilder()->paginate('master_parking', $page, $select);
$total_pages = $db->totalPages;


include BASE_PATH . '/includes/header.php';
?>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Master Parking</h1>
        </div>
        <div class="col-lg-6">
            <div class="page-action-links text-right">
                <a href="add_masterparking.php?operation=create" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add new</a>
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
	            <th scope="col">Total Slots</th>
                <th scope="col">Slots Available</th>
	            <th scope="col">Location Address</th>
	            <th scope="col">Mobile No</th>
	            <th scope="col">Email</th>
	            <th scope="col">Amount</th>
	            <th scope="col">Status</th>
	            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): 
                $db = getDbInstance();
                $select = array('count(*) as cnt');
                $db->where('master_parking_id='.$row['id'].' and status="0"');
                $booked_slot = $db->arraybuilder()->paginate('master_inventory', $page, $select);
                $row['booked_slot'] =$row['no_of_slots']-$booked_slot[0]['cnt'];
 ?> 
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo xss_clean($row['location_name']); ?></td> 
                <td><?php echo xss_clean($row['no_of_slots']); ?></td>
                <td><?php echo xss_clean($row['booked_slot']); ?></td>
                <td><?php echo xss_clean($row['location_address']); ?></td>
                <td><?php echo xss_clean($row['mobile_no']); ?></td>
                <td><?php echo xss_clean($row['email']); ?></td>
                <td><?php echo xss_clean($row['amount']); ?></td>
                <td><?php echo xss_clean($row['status'] ==1)?'Active':'In-Active';?></td>
		        <td> 
		           <a href="edit_masterparking.php?id=<?php echo $row['id']; ?>&operation=edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit" title="Edit"></i></a>
		           <a href="submasterparking.php?id=<?php echo $row['id']; ?>&operation=edit" class="btn btn-primary"><i class="glyphicon glyphicon-export" title="Sub Location"></i></a>
                   <a href="#" class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-trash"></i></a>
		         </td>
            </tr>
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="confirm-delete-<?php echo $row['id']; ?>" role="dialog">
                <div class="modal-dialog">
                    <form action="delete_masterparking.php" method="POST">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Confirm</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="del_id" id="del_id" value="<?php echo $row['id']; ?>">
                                <p>Are you sure you want to delete this row?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default pull-left">Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- //Delete Confirmation Modal -->
            <?php endforeach;?>
        </tbody>
    </table>
    <!-- //Table -->

    <!-- Pagination -->
    <div class="text-center">
    <?php echo paginationLinks($page, $total_pages, 'masterparking.php'); ?>
    </div>
    <!-- //Pagination -->
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php';?>
