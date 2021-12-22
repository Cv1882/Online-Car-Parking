<?php 
if(!isset($_SESSION)){
    session_start();
}
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

	if(!isset($_SESSION['adminid'])){
		$_SESSION['failure'] = "You don't have permission to perform this action";
    	header('location: users.php');
        exit;

	}
    $city_id = $del_id;

    $db = getDbInstance();
    $db->where('id', $city_id);
    $status = $db->delete('master_table');
    
    if ($status) 
    {
        $_SESSION['info'] = "City deleted successfully!";
        header('location: mastercities.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete customer";
    	header('location: mastercities.php');
        exit;

    }
    
}