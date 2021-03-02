<?php
include "conn.php";
// [ter_otd] => 001 [prib_name] => 0 [izg_date] => [check_date] => [srok_slb] =>
$msg = "";

if(empty($_POST)){

}else {
    if (isset($_POST['prib_name']))//пока не определена
    {
        $prib_name = $_POST['prib_name'];
    }else{
        $prib_name ='';
    }
    $gid_sql = "SELECT id FROM `mtopribor` ORDER BY id DESC LIMIT 1 "; //получаем последний айди
    $gid = mysqli_fetch_assoc(mysqli_query($conn, $gid_sql))["id"];
    $ins_sql = "INSERT INTO mtopribor (`id`, `name`) VALUES ('" . ($gid+1) . "',' " . $prib_name . "')";
    if (mysqli_query($conn, $ins_sql)) {
        $msg = "Запись успешно добавлена!";
    }
}
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
<form action="addnewprib.php" method="post">
    <table id="edit_menu">
        <tr>
            <td>
                <p><label for="prib_name">Наименование прибора:</label></p>

            </td>
            <td>
                <input type="text" id="prib_name" name="prib_name">
            </td>
        </tr>
    </table>
    <button class="button" type="submit">Добавить</button>
</form>