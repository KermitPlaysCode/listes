<html>
    <head>
        <script type='text/javascript' src="test.js"></script>
        <link rel="icon" type="image/png" href="/favicon.png">
    </head>
<body>
    <input type="text" name="txt1" id="n"><br>
    <input type="text" name="txt2" id="p"><br>
    <select id="s">
        <option value="1">1</option>
        <option value="2">2</option>
    </select><br>
    <span onclick="postme('<?php echo $_SERVER['PHP_SELF']; ?>')">This is to post</span><br>
<div id="std">
</div>
<div id ="custo">
</div>
</body></html>