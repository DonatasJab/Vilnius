<?php
include('config.php');

if(isset($_POST['update'])) {
	extract($_POST);
	if(!is_numeric(intval($birth))) {
		$msg = "Gimimo metus gali sudaryti tik skaičiai!";
	} else if(empty($country)) {
		$msg = "Valstybės laukelis negali būti paliktas tuščias!";
	} else if(!isset($kids) || !is_numeric(intval($kids))) {
		$msg = "Vaikų skaičius neįvestas arba neteisingai įvestas!";
	} else {
		$stmt = $db->prepare("UPDATE people SET GIMIMO_METAI = ?, GIMIMO_VALSTYBE = ?, LYTIS = ?, SEIMOS_PADETIS = ?, KIEK_TURI_VAIKU = ?, SENIUNIJA = ?, GATVE = ?, SENIUNNR = ?, TER_REJ_KODAS = ?, GATV_K = ?, GAT_ID = ? WHERE id = $id");
		$stmt->execute(array($birth, $country, $sex, $family, $kids, $eldership, $street, $eldershipnr, $districtcode, $streetcode, $streetid));
		$msg = "Įrašas sėkmingai atnaujintas!";
	}
	$_SESSION['msg'] = $msg;
	header('Location: edit.php?id='.$id);
} else {
	header('Location: index.php');
}