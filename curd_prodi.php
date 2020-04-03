<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

	<title>css</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="bg">


<?php 
require ("koneksi.php");


$hub =open_connection();
$a = @$_GET["a"];
$id = @$_GET["id"];
$sql = @$_POST["sql"];
switch ($sql) {
	case "create":
		create_prodi();
		break;
	case "update":
		update_prodi();
		break;
	case "delete":
		delete_prodi();
		break;
}
switch ($a){
	case "list":
	read_data();
	break;
	case "input":
	input_data();
	break;
	case "edit":
	edit_data($id);
	break;
	case "hapus":
	hapus_data($id);
	break;
	default:
	read_data();
	break;
}
mysqli_close($hub) ;
?>
<?php 
function read_data() {
	global $hub;
	$query ="select * from dt_prodi";
	$result =mysqli_query($hub, $query); ?>
<div class="container">

	<div class ="header">
	<h1 align="center" >Data Program Studi</h1>
	</div>
	<br>
	<div class="middle">
	<table border=1 cellpadding="2" align="center">
	<tr bgcolor="cream">
		<td colspan="5"><a href="curd_prodi.php?a=input"> INPUT </a></td>
	</tr>
	<tr bgcolor="cream" align="center">
		<td >ID</td>
		<td>KODE</td>
		<td>NAMA PRODI</td>
		<td>AKREDITASI</td>
		<td>AKSI</td>
	</tr>
	<?php while($row =mysqli_fetch_array($result)) {?>
	<tr bgcolor="white">
		<td><?php echo $row['idprodi']; ?></td>
		<td><?php echo $row['kdprodi']; ?></td>
		<td><?php echo $row['nmprodi']; ?></td>
		<td><?php echo $row['akreditasi']; ?></td>
		<td>
			<a href ="curd_prodi.php?a=edit&id= <?php echo $row ['idprodi']; ?>" > EDIT </a>
			<br>
			<a href ="curd_prodi.php?a=hapus&id= <?php echo $row ['idprodi']; ?>" > HAPUS </a>
		</td>
	</tr>
	<?php } ?>
	</table>
	</div>

</div>
<?php } ?>

<?php  
function input_data() {
	$row = array(
		"kdprodi" => "",
		"nmprodi" => "",
		"akreditasi" => "-"
		); ?>
	<div class="header">
	<h2 align="center"> Input Data Program Studi</h2>
	</div>
	<br>
	<form action ="curd_prodi.php?a=list" method="post">
	<input type="hidden" name="sql" value="create">

	<table border=1 cellpadding="2" align="center">
	<tr>
		<td>Kode Prodi</td>
		<td><input type ="text" name="kdprodi" maxlength="6" value="<?php echo trim($row["kdprodi"]) ?>" />
		</td>
	</tr>
	<tr>
		<td>Nama Prodi</td>
		<td><input type ="text" name="nmprodi" maxlength="70" value="<?php echo trim($row["nmprodi"]) ?>" />
		</td>
	</tr>
	<tr>
		<td>Akreditasi Prodi</td>
		<td> <input type ="radio" name="akreditasi" value="-" <?php if ($row["akreditasi"]=='-' || $row["akreditasi"]=='') {echo "checked=\"checked\"";} else {echo "";} ?>> -
		<input type ="radio" name="akreditasi" value="A" <?php if ($row["akreditasi"]=='A') {echo "checked=\"checked\"";} else {echo "";} ?>> A
		<input type ="radio" name="akreditasi" value="B" <?php if ($row["akreditasi"]=='B') {echo "checked=\"checked\"";} else {echo "";} ?>> B
		<input type ="radio" name="akreditasi" value="C" <?php if ($row["akreditasi"]=='C') {echo "checked=\"checked\"";} else {echo "";} ?>> C
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
		<input type ="submit" name="action" value="Simpan">
		<input type="submit" name="action" value="Batal"><a href="curd_prodi.php?a=list"></a>
		</td>
	</tr>

	</table>
	</form>

<?php } ?>


<?php 
function edit_data ($id) {
	global $hub;
	$query ="select * from dt_prodi where idprodi= $id";
	$result = mysqli_query($hub, $query);
	$row = mysqli_fetch_array($result); ?>

	<div class="header">
	<h2 align="center"> Edit Data Program Studi</h2>
	</div>
	<br>

	<form action="curd_prodi.php?a=list" method="post">
	<input type="hidden" name="sql" value="update">
	<input type="hidden" name="idprodi" value="<?php echo trim ($id) ?>">

	<table border=1 cellpadding="2" align="center">
	<tr>
	<td>Kode Prodi</td>
	<td><input type ="text" name="kdprodi" maxlength="6" value="<?php echo trim($row["kdprodi"]) ?>" />
	</td>
	</tr>
	<tr>
	<td>Nama Prodi</td>
	<td><input type ="text" name="nmprodi" maxlength="70" value="<?php echo trim($row["nmprodi"]) ?>" />
	</td>
	</tr>
	<tr>
	<td>Akreditasi Prodi</td>
	<td> <input type ="radio" name="akreditasi" value="-" <?php if ($row["akreditasi"]=='-' || $row["akreditasi"]=='') {echo "checked=\"checked\"";} else {echo "";} ?>> -

		<input type ="radio" name="akreditasi" value="A" <?php if ($row["akreditasi"]=='A') {echo "checked=\"checked\"";} else {echo "";} ?>> A

		<input type ="radio" name="akreditasi" value="B" <?php if ($row["akreditasi"]=='B') {echo "checked=\"checked\"";} else {echo "";} ?>> B

		<input type ="radio" name="akreditasi" value="C" <?php if ($row["akreditasi"]=='C') {echo "checked=\"checked\"";} else {echo "";} ?>> C
	</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
		<input type ="submit" name="action" value="Simpan">
		<input type="submit" name="action" value="Batal"><a href="curd_prodi.php?a=list"></a>
		</td>
	</tr>
	</table>
	</form>
<?php } ?>

<?php 
function hapus_data($id){
	global $hub;
	global $_POST;
	$query ="select * from dt_prodi where idprodi =$id";
	$result = mysqli_query($hub, $query);
	$row = mysqli_fetch_array($result); ?>
	<div class="header">
	<h2 align="center"> Hapus Data Program Studi </h2>
	</div>
	<br>
	<form action="curd_prodi.php?a=list" method="post">
		<input type="hidden" name="sql" value="delete">
		<input type="hidden" name="idprodi" value="<?php echo trim ($id) ?>">
		<table border=1 cellpadding="2" align="center">
			<tr>
				<td width="100">Kode</td>
				<td><?php echo trim ($row["kdprodi"]) ?></td>
			</tr>
			<tr>
				<td>Nama Prodi</td>
				<td><?php echo trim ($row["nmprodi"]) ?></td>
			</tr>
			<tr>
				<td>Akreditasi</td>
				<td><?php echo trim ($row["akreditasi"]) ?></td>
			</tr>
			<tr>
			<td colspan="2" align="center"><input type="submit" name="action" value="Hapus">
			<input type="submit" name="action" value="Batal"><a href="curd_prodi.php?a=list"></a>
			</td>
			</tr>
		</table>
	</form>
<?php } ?>

<?php 
function create_prodi() {
	global $hub;
	global $_POST;
	$query ="INSERT INTO dt_prodi (kdprodi, nmprodi, akreditasi) values";
	$query .="('".$_POST["kdprodi"]."', '".$_POST["nmprodi"]. "', '".$_POST["akreditasi"]."')";
	mysqli_query($hub, $query) or die (mysql_error());
}
function update_prodi(){
	global $hub;
	global $_POST;
	$query ="UPDATE dt_prodi";
	$query .=" SET kdprodi='" .$_POST["kdprodi"]."' , nmprodi='" .$_POST["nmprodi"]."' , akreditasi='" .$_POST["akreditasi"]."'";
	$query .=" WHERE idprodi = ".$_POST["idprodi"];
	mysqli_query($hub, $query) or die (mysql_error());
}
function delete_prodi(){
	global $hub;
	global $_POST;
	$query ="DELETE from dt_prodi";
	$query .=" WHERE idprodi=".$_POST["idprodi"];
	mysqli_query($hub, $query) or die (mysql_error());
}
?>


</body>
</html>
