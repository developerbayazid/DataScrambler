<?php 
include_once "scramblerf.php";

$task = 'encode';
if(isset($_GET['task']) && !empty($_GET['task'])){
    $task = $_GET['task'];
}
$key = 'abcdefghijklmnopqrstuvwxyz1234567890';
if('key' == $task){
    $originalKey = str_split($key);
    shuffle($originalKey);
    $key = join('', $originalKey);
}else if(isset($_POST['key']) && !empty($_POST['key'])){
    $key = $_POST['key'];
}

$scrambledData = '';
if('encode' == $task){
    $data = $_POST['data']??'';
    if($data != ''){
        $scrambledData = scrambleData($data, $key);
    }
}

if('decode' == $task){
	$data = $_POST['data']??'';
	if($data != ''){
		$scrambledData = decodeData($data, $key);
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Application With PHP</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
</head>
<style>
    body{
        margin-top: 40px;
        margin-bottom: 80px;
    }
    #data{
        width: 100%;
        height: 120px;
    }
    #result{
        width: 100%;
        height: 120px;
    }
</style>
<body>
<div class="container">
  <div class="row">
    <div class="column">
    </div>
    <div class="column">
        <div>
            <h3>Data Scrambler</h3>
            <p>Using the application to scrambler your data</p>
            <p>
                <a href="scrambler.php?task=encode">Encode |</a>
                <a href="scrambler.php?task=decode">Decode |</a>
                <a href="scrambler.php?task=key">Generat Key</a>
            </p>
        </div>
        <form method="POST" action="scrambler.php<?php if('decode'== $task) { echo "?task=decode"; } ?>">
            <fieldset>
               <label for="key">Key</label>
               <input type="text" name="key" id="key" value="<?php displayKey($key); ?>">
               <label for="data">Data</label>
               <textarea name="data" id="data"><?php if(isset($_POST['data'])) { echo $_POST['data']; } ?></textarea>
               <label for="result">Result</label>
               <textarea name="result" id="result"><?php echo $scrambledData; ?></textarea>
                
               <input class="button-primary" type="submit" value="Do It For Me">
            </fieldset>
        </form>
    </div>
    <div class="column">
    </div>
  </div>
</div>
</body>
</html>
