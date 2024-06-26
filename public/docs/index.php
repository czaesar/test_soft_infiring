<!DOCTYPE html>
<html>
<head>
    <title>Conte API docs</title>
    <!-- needed for adaptive design -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--
    ReDoc doesn't change outer page styles
    -->
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        api-logo{
            padding: 20px;
        }
    </style>
</head>
<body>
<redoc spec-url='/docs/swagger.yaml?<?= hash_file('md5', __DIR__.'/swagger.yaml')?>'></redoc>
<script src="https://rebilly.github.io/ReDoc/releases/latest/redoc.min.js"> </script>
</body>
</html>
