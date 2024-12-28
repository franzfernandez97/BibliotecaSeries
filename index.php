<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <!-- Nav Bar-->  
    <?php include 'includes\navbar.php';?> 

    <!-- Main Info-->  
    <div class="container text-center mt-5 content">
        <h1 class="display-3">Biblioteca de Series</h1>
        <div class="row mt-4">
            <!-- Button 1 -->
            <div class="col-md-6">
                <a href="views\platforms\list.php" class="btn btn-primary btn-lg w-100">Plataformas</a>
                <p class="mt-2">Listado y gestión de las plataformas</p>
            </div>
            <!-- Button 2 -->
            <div class="col-md-6">
                <a href="views\series\list.php" class="btn btn-primary btn-lg w-100">Series</a>
                <p class="mt-2">Listado y gestión de series</p>
            </div>
            <!-- Button 3 -->
            <div class="col-md-6">
                <a href="views\directors\list.php" class="btn btn-primary btn-lg w-100">Directores</a>
                <p class="mt-2">Listado y gestión de directores</p>
            </div>
            <!-- Button 4 -->
            <div class="col-md-6">
                <a href="views\actors\list.php" class="btn btn-primary btn-lg w-100">Actores</a>
                <p class="mt-2">Listado y gestión de actores</p>
            </div>
            <!-- Button 5 -->
            <div class="col-md-6">
                <a href="views\lenguages\list.php" class="btn btn-primary btn-lg w-100">Idiomas</a>
                <p class="mt-2">Listado y gestión de idiomas</p>
            </div>
        </div>
    </div>

    <!-- Footer-->  
    <?php include 'includes\footer.php';?> 

</body>
</html>
