<?php

    /*function enviarDatos($data) {

        $url = 'https://6480e3fff061e6ec4d4a019d.mockapi.io/Informacion';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { / Handle error / }
        //var_dump($result);
    }*/

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['enviar'])) {
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

        $url = 'https://6480e3fff061e6ec4d4a019d.mockapi.io/Informacion';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */ }
        
    }
}

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
                    <input type="text" placeholder="Nombre" name="nombre">
                </div>
                <div class="col-4">
                    CampusLands
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-4">
                    <input type="text" placeholder="Apellidos" name="apellidos">
                </div>
                <div class="col-4">
                    <input type="number" placeholder="Edad" name="edad">
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-4">
                    <input type="text" placeholder="Dirección" name="dirección">
                </div>
                <div class="col-4">
                    <input type="email" placeholder="Email" name="email">
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
                    <input type="submit" value="❌">
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-4">
                    <input type="text" placeholder="Team" name="team">
                </div>
                <div class="col-2">
                    <input type="submit" value="🖍">
                </div>
                <div class="col-2">
                    <input type="submit" value="🔍">
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-4">
                    <input type="text" placeholder="Trainer" name="trainer">
                </div>
                <div class="col-4">
                    <input type="number" placeholder="Cédula" name="cedula">
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

            </tbody>
        </table>
    </div>
</body>
</html>