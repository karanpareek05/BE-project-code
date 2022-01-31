<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>testing</title>
	<style type="text/css">
		#sumit{
			width: 400px;
			height: 400px;
			font-family: OCR A;
			font-size: 20px;
			background-color: lavender;
		}
	</style>
</head>
<body>
	<text id="sumit"></text>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
	<script type="text/javascript">
		$(document).ready(function(){
         $("#sumit").load("fetch.php");
            setInterval(function() {
                $("#sumit").load("fetch.php");
            }, 1000);
        });
	</script>
</body>
</html>