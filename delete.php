<?php
include('config.php');

if(isset($_POST['id'])) {
	$ids = explode(',', $_POST['id']);
	$inQuery = implode(',', array_fill(0, count($ids), '?'));
	$stmt = $db->prepare("DELETE FROM people WHERE id IN ($inQuery)");
	foreach ($ids as $k => $id) {
    	$stmt->bindValue(($k+1), $id);
	}
	$stmt->execute();
	if(count($ids) == 1) {
		$_SESSION['msg'] = "Įrašas sėkmingai pašalintas";
	} else if(count($ids) > 1) {
		$_SESSION['msg'] = "Įrašai sėkmingai pašalinti";
	}
}