<?php 
    # ------------ Importar variables
    require_once 'api/config/app.php';

    $page = isset($_GET['page']) ? $_GET['page'] : constant('PAGE');
    $limit = isset($_GET['limit']) ? $_GET['limit'] : constant('LIMIT');

    require './handlerData.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- META TARGETS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOTSTRAP FILES -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    
    <!-- ANIMATECSS FILES -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> -->
    
    <!-- LOCAL FILES -->
    <link rel="stylesheet" href="public/css/index.css">
    <link rel="shortcut icon" href="public/assets/logoMonza-min.jpg" type="image/jpg">

    <!-- TITLE -->
    <title>Monza</title>
</head>
<body data-bs-theme="dark">

    <?php require 'layouts/menu.php' ?>

    <section class="container-fluid mt-5">
        <div class="row">

            <div class="row col-12 col-md-3 mt-2 Filters" style="height:fit-content">
                <form class="col-12">
                    <!-- SORT SELECT -->
                    <div class="mb-3">
                        <label for="sortSelect" class="form-label mb-0 ms-1">Ordenar por:</label>
                        <select name="sort" class="form-select" id="sortSelect">
                            <option selected value="default">Predeterminado</option>
                            <option value="M-asc">Modelo: menor a mayor</option>
                            <option value="M-desc">Modelo: mayor a menor</option>
                            <option value="P-asc">Precio: menor a mayor</option>
                            <option value="P-desc">Precio: mayor a menor</option>
                        </select>
                    </div>

                    <!-- MARK SELECT -->
                    <select class="form-select mb-3" name="mark">
                        <option selected>Marca</option>
                        <option value="1">Toyota</option>
                        <option value="2">Ford</option>
                        <option value="3">Fiat</option>
                        <option value="4">Nissan</option>
                        <option value="5">Peugeot</option>
                    </select>
                    
                    <!-- FUEL SELECT -->
                    <select class="form-select mb-3" name="fuel">
                        <option selected>Tipo de combustible</option>
                        <option value="Nafta">Nafta</option>
                        <option value="Diésel">Diésel</option>
                        <option value="GNC">GNC</option>
                    </select>

                     <!-- TYPE SELECT -->
                     <div class=" mb-3">
                        <label class="form-label mb-0 ms-1 mb-1">Tipo de vehiculo:</label>
                        <div class="form-check ms-2 ">
                            <input class="form-check-input" type="radio" name="type" value="all" id="input-type" checked>
                            <label class="form-check-label" for="input-type">Todos</label>
                        </div>
                        <div class="form-check ms-2 ">
                            <input class="form-check-input" type="radio" name="type" value="Auto" id="input-type2">
                            <label class="form-check-label" for="input-type2">Autos</label>
                        </div>
                        <div class="form-check ms-2 ">
                            <input class="form-check-input" type="radio" name="type" value="Camioneta" id="input-type3">
                            <label class="form-check-label" for="input-type3">Camionetas</label>
                        </div>
                        <div class="form-check ms-2 ">
                            <input class="form-check-input" type="radio" name="type" value="other" id="input-type4">
                            <label class="form-check-label" for="input-type4">Otros</label>
                        </div>
                     </div>

                    <!-- BUTTONS -->
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3 me-1">Filtrar</button>
                        <button class="btn btn-secondary mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                            </svg>
                            Restablecer
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-12 col-md-9 gx-4 row justify-content-center ">
                <?php foreach ($vehicles as $key => $vehicle) { ?>
                    <div class="col-lg-4 col-md-6 col-10 mb-4 VehicleCard scale-up-center">
                        <div>
                            <img src="<?= $vehicle->image ?>" class="card-img-top">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-0 mt-1 text-body-secondary"><?= $marks[$vehicle->id_mark] ?></h6>
                                <h5 class="card-title mb-2"><?= $vehicle->version." ".$vehicle->model ?></h5>
                                <div class="d-flex justify-content-between align-items-end">
                                    <a href="/vehiculo?id=<?= $vehicle->id_vehicle ?>" class="btn btn-primary">Ver mas</a>
                                    <h6 class="card-subtitle text-body-secondary">
                                        <!-- Depende el formato para imprimir USD o ARS -->
                                        <?= ($vehicle->price < 100000) ? 'USD ' : 'ARS ' ?>
                                        <?= number_format($vehicle->price, 0) ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
        
    </section>
    
</body>
</html>