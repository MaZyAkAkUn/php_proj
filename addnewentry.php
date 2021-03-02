<?php
include "conn.php";
// [ter_otd] => 001 [prib_name] => 0 [izg_date] => [check_date] => [srok_slb] =>
$msg = "";
if(empty($_POST)){

}else {
    if (isset($_POST['ter_otd'])) {
        $ter_otd = $_POST['ter_otd'];
        if ($ter_otd == 'Выберите ТО') {
            ($ter_otd == '');
        }
    }
    if (isset($_POST['prib_name']))//пока не определена
    {
        $prib_name = $_POST['prib_name'];
        if ($prib_name == 'Типы приборов') {
            ($prib_name == '');
        }
    }
    if (isset($_POST['izg_date']))//пока не определена
    {
        $izg_date = $_POST['izg_date'];
        if ($izg_date == '') {
            ($izg_date == ' ');
        }
    }
    if (isset($_POST['check_date']))//пока не определена
    {
        $check_date = $_POST['check_date'];
        if ($check_date == '') {
            ($check_date == ' ');
        }
    }
    if (isset($_POST['srok_slb']))//пока не определена
    {
        $srok_slb = $_POST['srok_slb'];
        if ($srok_slb == '') {
            ($srok_slb = 0);
        }
    }
    $ins_sql = "INSERT INTO mto_schetchiki (id_otd, id_pribor,dateIzg,dateZam,srok) VALUES ('" . $ter_otd . "',' " . $prib_name . "','" . $izg_date . "','" . $check_date . "','" . $srok_slb . "')";
    if (mysqli_query($conn, $ins_sql)) {
        $msg = "Запись успешно добавлена!";
    }
}
//   while( $row = mysqli_fetch_assoc($result) ){
$sql_to = "SELECT * FROM mtoTO ";
$sql_prib = "SELECT * FROM mtopribor ";

$result_to = mysqli_query($conn,$sql_to);  //запрос
$result_prib = mysqli_query($conn,$sql_prib);  //запрос





?>

<style>
    .button {
        background-color: #4CAF50; /* Green */
        padding: 16px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        color: white;
        border: 2px solid #4CAF50;
    }

    .button:hover {
        background-color: white;
        color: #4CAF50;
    }
    #edit_menu {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #edit_menu td, #edit_menu th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #edit_menu tr:nth-child(even){background-color: #f2f2f2;}

    #edit_menu tr:hover {background-color: #ddd;}

    #edit_menu th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
    h1{
        text-align: left;
        text-transform: uppercase;
        color: #0aaf48;}
    #msg {
        color: darkgreen;
        background: lightgreen;

    }
</style>
<h2>Добавить Прибор</h2>
<?php echo '<p id="msg">' . $msg . '</p>'; ?>
<form action="addnewentry.php" method="post">
    <table id="edit_menu">
        <tr>
            <td>
                <p><label for="ter_otd">Выбрать Тер. Отдел:</label></p>

            </td>
            <td>
               <select name="ter_otd" id="ter_otd" required >
                   <?php while( $row = mysqli_fetch_assoc($result_to) ){
                       echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                   };
                   ?>
               </select>
            </td>
        </tr>
        <tr>
            <td>
                <p><label for="prib_name">Наименование прибора:</label></p>

            </td>
            <td>
                <select name="prib_name" id="prib_name" required>
                    <?php while( $row = mysqli_fetch_assoc($result_prib) ){
                        echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                    };
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <p><label for="izg_date">Дата изготовления:</label></p>

            </td>
            <td>
                <p><input type="date" name="izg_date" id="izg_date" required></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><label for="check_date">Дата замены/поверки:</label></p>

            </td>
            <td>
                <p><input type="date" name="check_date" id="check_date" required></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><label for="srok_slb">Срок службы:</label></p>

            </td>
            <td>
                <p><input type="number" name="srok_slb" id="srok_slb" required></p>
            </td>
        </tr>
    </table>
    <button class="button" type="submit">Добавить</button>
</form>