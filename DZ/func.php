<?php
function drawTable2($data) {

    $result = '';
    $result .= '
    <table border="1" cellpadding="10">
        <tr>
    ';
    foreach($data[0] as $key => $val) {
        $result .= '<th>'.$key.'</th>';
    }
    $result .= '<th>'."Изменение таблицы".'</th>';
    $result .= '
        </tr>
    ';
    foreach($data as $k => $row){
        $result .= '<tr>';
        foreach($row as $key => $val) {
            $result .= '<td>'.$val.'</td>';
            
        }
        $result .= '<td>'.'<a href="delete.php">'.'Удалить'.'</a>'.'  '.'<a href="create.php">'.'Создать'.'</a>'.'  '.'<a href="edit.php">'.'Редактировать'.'</a>' .'</td>';
 
        $result .= '</tr>';
    }
    $result .= '</table>';

    return $result;
}


?>

