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
$rows = $db->arraybuilder()->paginate('users', $page, $select);
$total_pages = $db->totalPages;

include BASE_PATH . '/includes/header.php';
?>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Users</h1>
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
	            <th scope="col">Firstname</th>
	            <th scope="col">Lastname</th>
	            <th scope="col">Email</th>
	            <th scope="col">Mobile No</th>
	            <th scope="col">Date Of Birth</th>
	            <th scope="col">Car Registration</th>
	            <th scope="col">Car Color</th>
	            <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo xss_clean($row['firstname']); ?></td>
                <td><?php echo xss_clean($row['lastname']); ?></td>
                <td><?php echo xss_clean($row['email']); ?></td>
                <td><?php echo xss_clean($row['mobileno']);?></td>
                <td><?php echo xss_clean(date('d-m-Y', strtotime($row['user_dob'])));?></td>
                <td><?php echo xss_clean($row['car_reg']);?></td>
                <td><?php echo xss_clean($row['car_color']);?></td>
                <td><?php echo xss_clean($row['status'] ==1)?'Active':'In-Active';?></td>
		        
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
