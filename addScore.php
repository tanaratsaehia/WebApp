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
            if($_REQUEST['actionControl'] == "add" && isset($_REQUEST['stdName'])){
                $name = $_REQUEST['stdName'];
                $score = $_REQUEST['stdScore'];
                $dataArr = array("name"=>$name, "score"=>$score);
                $jData[] = $dataArr;
                $newJson = json_encode($jData);
                file_put_contents('grade.json', $newJson);
                $jData = readJsonfile();
            }
        }

        function cmp($s1, $s2){
            return $s2 -> score - $s1 -> score;
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
        <h2 align="center">??????????????????????????????</h2>
        <div class="table table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <div>????????????</div>
                        </th>
                        <th>
                            <div>???????????????</div>
                        </th>
                        <th>
                            <div>????????????</div>
                        </th>
                    </tr>
                </thead>
                
                <?php
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
                            </tr>
                        </tbody>";
                    }
                ?>
            </table>
        </div>

        <div class="row">
            <div class="col-lg-6> form-group">
                <h3>?????????????????????????????????</h3>
                <form method="post">
                    <input type="hidden" class="form-control" name="actionControl" value="add">
                    <input type="text" class="form-control" name="stdName" placeholder="????????????????????????????????????">
                    <input type="text" class="form-control" name="stdScore" placeholder="???????????????" require style="margin-top: 20px">
                    <div class="text-right">
                        <button class="btn btn-primary btn-block" style="margin-top: 20px;">?????????</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>

</body>
</html>