<?php
//including the database connection file
include_once("config.php");
include_once("includes.php");
include_once("header.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM alerts ORDER BY id DESC"); // using mysqli_query instead


?>

<html>
<head>	
    <?=$includes?>

      
    </head>
	<title>Homepage</title>
</head>

<body>

<?=$header?>

<div class="container">
    <div class="card" >
        <div class="card-body">
            <h4 class="card-title"><center>Quote:</h4>
            <p class="card-text"><div id="quotes"><div id="msg">Quotes loading...</div></div></p>
        </div>
    </div> 
    <br><br>
 <a href="add.html" class="btn btn-small btn-primary">Add New Data</a><br/><br/>

	<table width='80%' border=0 class="table thead-dark">

	<tr bgcolor='#CCCCCC'>
		<td>Ticker</td>
		<td>Bear/Bull</td>
		<td>Target 1</td>
		<td>Target 2</td>
		<td>Target 3</td>
		<td>Target 4</td>
		<td>Target 5</td>
		<td>~</td>
		
	</tr>
	<?php 

	while($res = mysqli_fetch_array($result)) {
        $tickers[] = $res['ticker'];	
		echo "<tr>";
		echo "<td>".$res['ticker']."</td>";
		echo "<td>".$res['bullbear']."</td>";
		echo "<td>".$res['t1']."</td>";	
		echo "<td>".$res['t2']."</td>";	
		echo "<td>".$res['t3']."</td>";	
		echo "<td>".$res['t4']."</td>";	
		echo "<td>".$res['t5']."</td>";	
		echo "<td><a href=\"edit.php?id=$res[id]\" class=\"btn btn-success\">Edit</a> &nbsp; <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\" class=\"btn btn-danger\">Delete</a></td>";		
    }
    $tickers = array_unique($tickers);
    foreach ($tickers as $ticker) {
        $fmt_tickers[] = "{$ticker}";
    }
    $tickers=$fmt_tickers;
    // print_r($fmt_tickers);exit;
    // $tickers = ['AAPL', 'TSLA', 'BYND', 'SPCE', 'XOM','AAL', 'JD','BIDU'];//oren
	?>
    </table>
    <br>

   <!--  <a href="add.html" class="btn btn-small btn-primary">Add New Data</a><br/><br/>
 -->


</div><!---container--->
<script>

let phpUrl = 'https://oepstein.a2hosted.com/pythonapi/';
let remoteUrl = 'https://oepstein.a2hosted.com/pu1';


    $( document ).ready(function() {
        //ready
  
        callQuote('AAPL');
        $('#quotes').html('');
        
        setInterval(function() {

            callQuote('AAPL');

        }, 10 * 1700);
    });   


    var old_price;
    function callQuote(passed_ticker) {

        // var ticker = passed_ticker == '' || passed_ticker == undefined ? '<?//ticker?>' : passed_ticker;
        // console.log('Getting Quote '+ ticker)

        getQuote().then((data) => 
        {
           console.log('queueing next ticker...');

        });
    }

    async function getQuote() {

        let result;

        let ajaxurl = remoteUrl +'/quote';

        let tickers = JSON.parse(`<?= json_encode($tickers) ?>`)
        console.log(tickers) // Object { 1: "one", 2: "two", 3: "three" }


        try {
            for(let i=0;i<=tickers.length -1;i++) {console.log('yo')
                console.log('yoyo '+tickers[i])

            result = await $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {type: 'quote', ticker: tickers[i]},
            
        });
            

        $.ajax({
            url: 'check_price.php',
            type:'POST',
            async: true,
            data: {price: result, ticker: tickers[i]},
            
            success: function(result)
            {
                console.log('---success---')
                console.log(result)

            },
            error: function()
            {
                console.log('ERROR')
                
            }
        });
        console.log(result)

        var status = 'success';

        if (old_price > result) {
            status = 'danger';
        } else {
            status = 'success';
        }
        old_price = result;
        
        $('#quotes').html('<span style="width:100%;" readonly class="btn btn-'+status+'">' +tickers[i]+' '+parseFloat(result).toFixed(2)+'</span>');
    }     
    
    return result;

} catch (error) {
    console.error(error);
}
}
    </script>
</body>
</html>
