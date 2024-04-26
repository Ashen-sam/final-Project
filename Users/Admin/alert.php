<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message</title>
</head>

<style>
    body {


        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .form {
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        padding: 2rem;
        box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
    }

    button {

        width: 100%;
        background-color: #1CAC78;
        border: none;
        padding: 0.7rem;
        color: white;
        border-radius: 6px;
        font-size: 1.2rem;

    }

    input {
        max-width: 600px;
        margin: 1rem 0;
        font-size: 0.8srem;
        padding: 0.6rem;
        border: none;
        border: 1px solid lightgray;
        border-radius: 5px;
        width: auto;
    }

    label {
        font-size: 2rem;
    }
</style>

<body>
    <form class="form" action="/train/homes/index.php" method="post">
        <label for="message">Enter Alert message</label>
        <p style='text-align:center'>send alerts for delays in Trains</p>
        <input type="text" id="message" name="message" placeholder="Enter Alert.." />
        <button type="submit">Send Message</button>
    </form>
</body>

</html>