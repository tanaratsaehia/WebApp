<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        $jData = readJsonfile();
        if(isset($_REQUEST['actionControl'])){
            if($_REQUEST['actionControl'] == "remove" && isset($_REQUEST['arrIndex'])){
                $arrIndex = $_REQUEST['arrIndex'];
                unset($jData[$arrIndex]);
                sort($jData);
                $newjson = json_encode($jData);
                file_put_contents('grade.json', $newjson);
                $jData = readJsonfile();
            }
        }
        function cmp($s1, $s2){
            return $s2->score - $s1->score;
        }
        function readJsonfile(){
            $data = file_get_contents('grade.json');
            $jData = json_decode($data);
            usort($jData, "cmp");
            return $jData;
        }
        function grading($score){
            if($score >= 85){
                return "A+";
            }
            elseif($score >= 80){
                return "A";
            }
            elseif($score >= 75){
                return "B+";
            }
            elseif($score >= 70){
                return "B";
            }
            elseif($score >= 65){
                return "C+";
            }
            elseif($score >= 60){
                return "C";
            }
            elseif($score >= 55){
                return "D+";
            }
            elseif($score >= 50){
                return "D";
            }
            else{
                return "F";
            }
        }
    ?>

    <nav class="navbar">
        <div class="container" style="display: flex; flex-direction: row; justify-content: space-evenly;">
            <a class="navbar-brand" href="index.php">Home</a>
            <a class="navbar-brand" href="addScore.php">AddScore</a>
            <a class="navbar-brand" href="delete.php">DeleteData</a>
            <a class="navbar-brand" href="update.php">UpdateData</a>
        </div>
    </nav>

    <div class="container">
        <div class="row"></div>
        <div class="col-lg-12"></div>
        <h2 align="center">ผลการเรียน</h2>
        <div class="table table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <div>ชื่อ</div>
                        </th>
                        <th>
                            <div>คะแนน</div>
                        </th>
                        <th>
                            <div>เกรด</div>
                        </th>
                        <th>
                            <div>แก้ไขข้อมูล</div>
                        </th>
                    </tr>
                </thead>

                <?php
                    $i = 0;
                    foreach($jData as $rowData){
                        echo
                            "<tbody>
                                <tr>
                                    <td>
                                        <div>
                                            ".$rowData->name."
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            ".$rowData->score."
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            ".grading($rowData->score)."
                                        </div>
                                    </td>
                                    <td>
                                        <form method=\"post\">
                                            <input type=\"hidden\" name=\"actionControl\" value=\"remove\">
                                            <input type=\"hidden\" name=\"arrIndex\" value=".$i.">
                                            <button class=\"btn btn-danger\">delete</button>
                                        </form>
                                        
                                    </td>
                                </tr>
                            </tbody>"
                        ;
                        $i++;
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>