<?php
    function generatePath(){
        // Assuming the base directory of your app is /BibliotecaSeries/
        $absolutePath = '/BibliotecaSeries/';
        return $absolutePath;
    }
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo generatePath() . 'index.php'; ?>">Biblioteca de Series</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo generatePath() . 'views/platforms/list.php'; ?>">Plataformas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo generatePath() . 'views/series/list.php'; ?>">Series</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo generatePath() . 'views/directors/list.php'; ?>">Directores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo generatePath() . 'views/actors/list.php'; ?>">Actores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo generatePath() . 'views/languages/list.php'; ?>">Idiomas</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
