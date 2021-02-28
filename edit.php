<?php
$servername = "localhost";
$username = "user";
$password = "password";
$dbname = "mto_db";


$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {

    if (isset($_POST)) {
        if (isset($_POST["action"])) {
            //
        } else {
            $stmt1 =  $conn->prepare("INSERT INTO `mtopribor` (`name`) VALUES (:prib_type)");
            $stmt1->bindParam(":prib_type", $_POST["prib_type"]);
            $stmt1->execute();

            $stmt2 =  $conn->prepare("INSERT INTO `mtoto` (`kod`, `name`, `address`) VALUES (:kod, :name, :address)");
            $stmt2->bindParam(":kod", $_POST["kod"]);
            $stmt2->bindParam(":name", $_POST["ot_name"]);
            $stmt2->bindParam(":address", $_POST["ot_address"]);
            $stmt2->execute();

            $stmt3 =  $conn->prepare("INSERT INTO `mto_schetchiki` (`id_otd`,`id_pribor`,`dateIzg`,`dateZam`,`srok`) VALUES (:id_otd, :id_pribor, :dateIzg, :dateZam, :srok)");
            $stmt3->bindParam(":id_otd", $_POST["prib_type"]);
            $stmt3->execute();

            echo "New records created successfully";
        }

    }


    }catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
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
</style>

<h1>Добавить запись</h1>
<form action="edit.php" method="post">
    <table id="edit_menu">
        <tr>
            <td>
                <p><label for="kod">Код отдела:</label></p>

            </td>
            <td>
                <p><input type="text" name="kod" id="kod"></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><label for="ot_name">Наименование ТО:</label></p>

            </td>
            <td>
                <p><input type="text" name="ot_name" id="ot_name"></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><label for="ot_address">Адрес ТО:</label></p>

            </td>
            <td>
                <p ><input type="text" name="ot_address" id="ot_address"></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><label for="prib_type">Тип прибора:</label></p>

            </td>
            <td>
                <p><input type="text" name="prib_type" id="prib_type"></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><label for="date_izg">Дата изготовления:</label></p>

            </td>
            <td>
                <p><input type="date" name="date_izg" id="date_izg"></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><label for="date_check">Дата проверки:</label></p>

            </td>
            <td>
                <p><input type="date" name="date_check" id="date_check"></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> <label for="srok">Срок службы:</label></p>

            </td>
            <td>
                <p> <input type="number" name="srok" id="srok"></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> <label for="id_pribor">ID прибора:</label></p>

            </td>
            <td>
                <p> <input type="number" name="id_pribor" id="id_pribor"></p>
            </td>
        </tr>
        <tr>
            <td>
                <p> <label for="id_schet">ID счётчика:</label></p>

            </td>
            <td>
                <p> <input type="number" name="id_schet" id="id_schet"></p>
            </td>
        </tr>


    </table>
    <button class="button" type="submit">Применить</button>
</form>



