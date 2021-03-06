<?php
include "conn.php";

$to_sql = "SELECT id, kod, name, address FROM `mtoto` order by id";
$prib_sql = "SELECT id, name FROM `mtopribor`";


$all_data_sql = "SELECT * FROM `v_mtopribor` order by kod";

/*
if($_POST["ter_otd"] != 0 ){
    $all_data_sql .= " WHERE kod=" . $_POST["ter_otd"];
    if($_POST["pribors"] != 0){
        $all_data_sql .= " AND id_pribor=" . $_POST["pribors"];
    }
    if(isset($_POST["check_date"])){
        $all_data_sql .= " AND dateZam<'" . $_POST["check_date"] . "'";
    }
}else{
    if($_POST["pribors"] != 0){
        $all_data_sql .= "WHERE id_pribor=" . $_POST["pribors"];
        if(isset($_POST["check_date"])){
            $all_data_sql .= " AND dateZam<'" . $_POST["check_date"] . "'";
        }
    }else{
        if(isset($_POST["check_date"])){
            $all_data_sql .= " WHERE dateZam<'" . $_POST["check_date"] . "'";
        }
    }

}
*/
$to_list = $conn->query($to_sql);
$prib_list = $conn->query($prib_sql);
$all_data = $conn->query($all_data_sql);
global $data_dump;

?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"  charset=utf-8">

    <style>
        #uchet_priborov {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 13px;
            word-wrap: break-word;
            
        }

        #uchet_priborov td, #uchet_priborov th {
            border: 1px solid #ddd;
            padding: 6px;

        }

        #uchet_priborov tr:nth-child(even){background-color: #f2f2f2;}

        #uchet_priborov tr:hover {background-color: #ddd;}

        #uchet_priborov th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
        .raw_red{background-color: red;}
        .raw_orange{background-color: orange;}
        .raw_yellow{background-color: yellow;}
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
        h1{
            text-align: center;
            text-transform: uppercase;
            color: #0aaf48;}

        .filters{
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }

    </style>
</head>
<body>





<p><h1>Учёт приборов</h1></p>
<form action="index.php" method="post">
    <p class="filters"><label for="ter_otd">Тер. отдел: </label>
        <select class="custom-select" name="ter_otd" id="ter_otd" style="width:300px;">   <!--верхний фильтр  -->
            <option value="0">Выберите ТО</option>          
       
            <?php while ($row = $to_list->fetch_assoc()){
                echo '<option value="' . $row["0"] . '">'.$row["kod"].' '. $row["name"] . '</option>';
            } ?>
        </select>
        <label for="pribors">Приборы: </label>
        <select class="custom-select" name="pribors" id="pribors" style="width:200px;">
            <option value="0">Типы приборов</option>
            <?php while ($row = $prib_list->fetch_assoc()){
                echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
            } ?>
        </select>
        <label for="check_date">Дата проверки: </label>
        <input name="check_date" type="date" value="2035-01-01" />
    </p>


    <button class="button" type="reset">Снять фильтр</button>
    <button class="button" type="submit">Применить</button>
</form>

<form name="exp_form" action="export.php" target="_blank" method="post">
    <button class="button" type="submit">Выгрузка в Excel</button>
</form>


<table id="uchet_priborov">
    <tr>
        <th>Код отдела</th>
        <th>Наименование ТО</th>
        <th>Адрес</th>
        <th>Тип приборов</th>
        <th>Дата изготовления</th>
        <th>Дата проверки</th>
        <th>Срок службы</th>
        <th>Действие</th>
    </tr>
    <?php while ($row = $all_data->fetch_assoc()){
        $day_diff = date_diff(date_create($row["dateZam"]), date_create(date("Ymd")))->format("%a% <br>");//
        $raw_class = "raw_default";
        if( (1 <= $day_diff) && ($day_diff <= 90)){
            $raw_class = "raw_red";
        }elseif ((91 <= $day_diff) && ($day_diff <= 180)){
            $raw_class = "raw_orange";
        }elseif ((181 <= $day_diff) && ($day_diff <= 365)){
            $raw_class = "raw_yellow";
        }

        $data_dump = '<tr><td style="width: 5%">' . $row["kod"].' </td><td style="width: 7%">' . $row["nameOtd"] . '</td><td style="width: 12%">' . $row["address"].'</td><td style="width: 12%">' . $row["pribor"].'</td><td style="width: 12%">' . $row["dateIzg"].'</td><td style="width: 12%" class="' . $raw_class .'">' . $row["dateZam"].'</td><td style="width: 5%">' . $row["srok"].'</td><td style="width: 7%">' . '<form method="post"> <input type="hidden" name="entry_id" value="' . $row["id_schet"]. '"> <button formaction="edit.php" formtarget="_blank" name="wtd" value="edit">Ред</button> <button formaction="edit.php"  name="wtd" value="delete">Удл</button></form>' .'</tr>';
        echo $data_dump;
    } ?>
    <tr>
    </tr>
</table>
<form  method="post" target="_blank">  <!--action="edit.php"   -->
   <!--<input type="hidden" id="addnewentry" name="addnewentry" value="1">-->
    <button class="button" type="submit" formaction="addnewentry.php">Добавить запись</button>
    <button class="button" type="submit" formaction="addnewprib.php">Добавить новый прибор</button>
    <button class="button" type="submit" formaction="addnewotd.php">Добавить новый отдел</button>
</form>

</body>
</html>