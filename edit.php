<?php
include "conn.php";
$msg = '';
if(isset($_POST["wtd"])){
    if($_POST["wtd"] == "edit"){
        $edit_data = "SELECT * FROM `mto_schetchiki` WHERE `id`=" . $_POST["entry_id"];
        $data = mysqli_fetch_assoc(mysqli_query($conn, $edit_data));

        //do edit
    }elseif ($_POST["wtd"] == "delete"){
        print("ENTER to DELETED ");
        $del_sql = 'DELETE FROM `mto_schetchiki` WHERE `mto_schetchiki`.`id` ='. $_POST["entry_id"];
        if(mysqli_query($conn, $del_sql)){
            header ('Location: index.php');
            exit();
        }
    }elseif($_POST["wtd"] == "update"){

        $updt_sql = 'UPDATE mto_schetchiki SET id_otd=' . $_POST["ter_otd"] . ', id_pribor=' . $_POST["prib_name"] . ', dateIzg="' . $_POST["izg_date"] . '", dateZam="' . $_POST["check_date"] . '", srok=' . $_POST["srok_slb"]. ' WHERE id=' . $_POST["entry_id"];
        if(mysqli_query($conn, $updt_sql)){
            $msg = "Запись успешно сохранена!";
        }
    }

}

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
<h2>Редактировать запись</h2>
<?php echo '<p id="msg">' . $msg . '</p>'; ?>
<form action="edit.php" method="post">
    <table id="edit_menu">
        <tr>
            <td>
                <p><label for="ter_otd">Выбрать Тер. Отдел:</label></p>

            </td>
            <td>
               <select name="ter_otd" id="ter_otd" required >
                   <?php while( $row = mysqli_fetch_assoc($result_to) ){
                       $selected = '';
                       if($row["id"] == $data["id_otd"]){
                           $selected = 'selected="selected"';}
                       echo '<option value="' . $row["id"] . '" ' . $selected . '>' . $row["name"] . '</option>';
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
                        $selected = '';
                        if($row["id"] == $data["id_pribor"]){
                            $selected = 'selected="selected"';}
                        echo '<option value="' . $row["id"] . '" ' . $selected . '>' . $row["name"] . '</option>';
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
                <p><input type="date" name="izg_date" id="izg_date" value="<?php echo $data["dateIzg"];?>" required ></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><label for="check_date">Дата замены/поверки:</label></p>

            </td>
            <td>
                <p><input type="date" name="check_date" id="check_date" value="<?php echo $data["dateZam"];?>" required></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><label for="srok_slb">Срок службы:</label></p>

            </td>
            <td>
                <p><input type="number" name="srok_slb" id="srok_slb" value="<?php echo $data["srok"];?>" required></p>
            </td>
        </tr>
    </table>
    <input type="hidden" name="entry_id" value="<?php echo $_POST["entry_id"]; ?>">
    <button class="button" type="submit" name="wtd" value="update">Сохранить</button>
</form>