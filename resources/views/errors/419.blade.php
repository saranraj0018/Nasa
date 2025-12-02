<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Expired</title>
    <style>
        /* Center everything */
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h1 {
            font-size: 72px;
            color: #dc3545; /* Red */
            margin: 0;
        }

        h2 {
            font-size: 24px;
            margin: 10px 0 20px;
        }

        p {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
        }

        button {
            padding: 12px 30px;
            font-size: 16px;
            background-color: #AD1FAC;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #9F3895;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>Sorry, your session has expired. Please refresh and try again.</p>
        <button onclick="window.location='{{ url()->previous() }}';">Refresh Page</button>
    </div>
</body>
</html>
