<?php

    function enviarDatos() {
            $data = [
                "nombre" => $_POST['nombre'],
                "apellido"=> $_POST['apellidos'],
                "edad"=> $_POST['edad'],
                "direccion"=> $_POST['dirección'],
                "email"=> $_POST['email'],
                "hora"=> $_POST['hora'],
                "team"=> $_POST['team'],
                "trainer"=> $_POST['trainer'],
                "cedula"=> $_POST['cedula']
            ];
        $credenciales["http"]["method"] = "POST";
        $credenciales["http"]["header"] = "Content-type: application/json";
        $data = json_encode($data);
        $credenciales["http"]["content"] = $data;
        $config = stream_context_create($credenciales);
        $_DATA = file_get_contents("https://6480e3fff061e6ec4d4a019d.mockapi.io/Informacion", false, $config);

    }

    function eliminarDatos() {
        if (!isset($_POST['cedula'])) {
            echo "No se ha ingresado una cedula";
            return;
        }
        $cedula = $_POST['cedula'];
        $data = file_get_contents('https://6480e3fff061e6ec4d4a019d.mockapi.io/Informacion');
        $data = json_decode($data, true);
        $id = null;
        foreach ($data as $key => $value) {
            if ($value['cedula'] == $cedula) {
                $id = $value['id'];
                break;
            }
        }
        $credencialesD["http"]["method"] = "DELETE";
        $credencialesD["http"]["header"] = "Content-type: application/json";
        $config = stream_context_create($credencialesD);
        $url = "https://6480e3fff061e6ec4d4a019d.mockapi.io/Informacion/$id";
        $resultado = file_get_contents($url, false, $config);
    }
    

    function buscarDatos($cedula){
        $data = file_get_contents('https://6480e3fff061e6ec4d4a019d.mockapi.io/Informacion');
        $data = json_decode($data, true);
        $id = null;
        foreach ($data as $key => $value) {
            if ($value['cedula'] == $cedula) {
                $id = $value['id'];
                break;
            }
        }
        $credencialesG["http"]["method"] = "GET";
        $credencialesG["http"]["header"] = "Content-type: application/json";
        $config = stream_context_create($credencialesG);
        $url = "https://6480e3fff061e6ec4d4a019d.mockapi.io/Informacion/$id";
        $resultado = file_get_contents($url, false, $config);
        $data = json_decode($resultado, true);
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['apellido'] = $data['apellido'];
        $_SESSION['edad'] = $data['edad'];
        $_SESSION['direccion'] = $data['direccion'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['hora'] = $data['hora'];
        $_SESSION['team'] = $data['team'];
        $_SESSION['trainer'] = $data['trainer'];
        $_SESSION['cedula'] = $data['cedula'];
    }

    function editarDatos(){
        $dataC = [
            "nombre" => $_POST['nombre'],
            "apellido"=> $_POST['apellidos'],
            "edad"=> $_POST['edad'],
            "direccion"=> $_POST['dirección'],
            "email"=> $_POST['email'],
            "hora"=> $_POST['hora'],
            "team"=> $_POST['team'],
            "trainer"=> $_POST['trainer'],
            "cedula"=> $_POST['cedula']
        ];
        $cedula = $_POST['cedula'];
        $data = json_encode($data);
        $data = file_get_contents('https://6480e3fff061e6ec4d4a019d.mockapi.io/Informacion');
        $data = json_decode($data, true);
        $id = null;
        foreach ($data as $key => $value) {
            if ($value['cedula'] == $cedula) {
                $id = $value['id'];
                break;
            }
        }
        $dataC = json_encode($dataC);
        $credenciales["http"]["method"] = "PUT";
        $credenciales["http"]["header"] = "Content-type: application/json";
        $credenciales["http"]["content"] = $dataC;
        $config = stream_context_create($credenciales);
        $url = "https://6480e3fff061e6ec4d4a019d.mockapi.io/Informacion/$id";
        $resultado = file_get_contents($url, false, $config);
    }

    session_start();
    if (isset($_POST['seleccionar'])) {
        buscarDatos($_POST['seleccionado']);
        header("Location: index.php");
        exit();
    } elseif (isset($_POST['enviar'])) {
        enviarDatos();
        session_unset();
        header("Location: index.php");
        exit();
    } elseif (isset($_POST['editar'])) {
        editarDatos();
        session_unset();
        header("Location: index.php");
        exit();
    } elseif (isset($_POST['eliminar'])) {
        eliminarDatos();
        session_unset();
        header("Location: index.php");
        exit();
    } elseif (isset($_POST['buscar'])) {
        buscarDatos($_POST['cedula']);
        session_unset();
        header("Location: index.php");
        exit();
    }

    global $dataCookie;
    $dataCookie = [
        "nombre" => isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '',
        "apellido"=> isset($_SESSION['apellido']) ? $_SESSION['apellido'] : '',
        "edad"=> isset($_SESSION['edad']) ? $_SESSION['edad'] : '',
        "direccion"=> isset($_SESSION['direccion']) ? $_SESSION['direccion'] : '',
        "email"=> isset($_SESSION['email']) ? $_SESSION['email'] : '',
        "hora"=> isset($_SESSION['hora']) ? $_SESSION['hora'] : '',
        "team"=> isset($_SESSION['team']) ? $_SESSION['team'] : '',
        "trainer"=> isset($_SESSION['trainer']) ? $_SESSION['trainer'] : '',
        "cedula"=> isset($_SESSION['cedula']) ? $_SESSION['cedula'] : ''
    ];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container text-center mt-2">
        <form method="POST">
            <div class="row justify-content-center mt-2">
                <div class="col-4">
                    <input type="text" placeholder="Nombre" name="nombre" value="<?php echo $GLOBALS["dataCookie"]['nombre'] ?>">
                </div>
                <div class="col-4">
                    CampusLands
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-4">
                    <input type="text" placeholder="Apellidos" name="apellidos" value="<?php echo $GLOBALS["dataCookie"]['apellido'] ?>">
                </div>
                <div class="col-4">
                    <input type="number" placeholder="Edad" name="edad" value="<?php echo $GLOBALS["dataCookie"]['edad'] ?>">
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-4">
                    <input type="text" placeholder="Dirección" name="dirección" value="<?php echo $GLOBALS["dataCookie"]['direccion'] ?>">
                </div>
                <div class="col-4">
                    <input type="email" placeholder="Email" name="email" value="<?php echo $GLOBALS["dataCookie"]['email'] ?>">
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-4">
                    <input type="time" placeholder="Horario de entrada" name="hora">
                </div>
                <div class="col-2">
                    <input type="submit" value="✅" name="enviar">
                </div>
                <div class="col-2">
                    <input type="submit" value="❌" name="eliminar">
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-4">
                    <input type="text" placeholder="Team" name="team" value="<?php echo $GLOBALS["dataCookie"]['team'] ?>">
                </div>
                <div class="col-2">
                    <input type="submit" value="🖍" name="editar">
                </div>
                <div class="col-2">
                    <input type="submit" value="🔍" name="buscar">
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-4">
                    <input type="text" placeholder="Trainer" name="trainer" value="<?php echo $GLOBALS["dataCookie"]['trainer'] ?>">
                </div>
                <div class="col-4">
                    <input type="number" placeholder="Cédula" name="cedula" value="<?php echo $GLOBALS["dataCookie"]['cedula'] ?>">
                </div>
            </div>
        </form>
        <table class="table mt-3">
            <thead>
              <tr>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Direccion</th>
                <th scope="col">Edad</th>
                <th scope="col">Email</th>
                <th scope="col">Hora Entrada</th>
                <th scope="col">Team</th>
                <th scope="col">Trainer</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    $data = file_get_contents('https://6480e3fff061e6ec4d4a019d.mockapi.io/Informacion');
                    $data = json_decode($data, true);
                    foreach ($data as $row) {
                        echo "<form action='index.php' method='post'>";
                        echo "<tr>";
                        echo "<td>".$row['nombre']."</td>";
                        echo "<td>".$row['apellido']."</td>";
                        echo "<td>".$row['direccion']."</td>";
                        echo "<td>".$row['edad']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['hora']."</td>";
                        echo "<td>".$row['team']."</td>";
                        echo "<td>".$row['trainer']."</td>";
                        echo "<td><input type='submit' name='seleccionar' value='🔝'></td>";
                        echo "<input type='hidden' name='seleccionado' value=" . $row["cedula"] . ">";
                        echo "</tr>";
                        echo "</form>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>