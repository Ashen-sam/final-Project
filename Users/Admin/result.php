<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
</head>

<body>
    <a href="/" id="paragraph"></a>
    <a href="index.html">go to index page</a>

    <script>
        const paragraph = document.querySelector('#paragraph');

        const params = new URLSearchParams(window.location.search);

        params.forEach((value, key) => {
            paragraph.append(`${key} = ${value}`);
            paragraph.append(document.createElement('br'));
        });
        
        document.getElementById("logout").addEventListener("click", function() {
            location.href = "../logout.php";
        });
    </script>
</body>

</html>