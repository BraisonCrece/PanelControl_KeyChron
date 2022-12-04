<?php
// ARTIGO
function engadir_artigo($conexion, $datos, $imaxe_name)
{
    if (empty($datos["nome"]) || empty($datos["nome_longo"]) || empty($datos["detalles"]) || empty($datos["prezo"])) {
        alerta_red("Debes cubrir todos os campos");
    } else {
        try {
            $nome = $datos["nome"];
            $nome_longo = $datos["nome_longo"];
            $detalle = $datos["detalles"];
            $prezo = $datos["prezo"];
            $imaxe = $imaxe_name;

            $sql = "INSERT INTO artigo (nome, nome_longo, detalle, prezo, imaxe) VALUES(?,?,?,?,?)";
            $pdo_statement = $conexion->prepare($sql);
            $pdo_statement->bindParam(1, $nome);
            $pdo_statement->bindParam(2, $nome_longo);
            $pdo_statement->bindParam(3, $detalle);
            $pdo_statement->bindParam(4, $prezo);
            $pdo_statement->bindParam(5, $imaxe);

            $pdo_statement->execute();

            alerta_green("Artigo engadido correctamente");
        } catch (PDOException $e) {
            alerta_red("Erro" . $e->getMessage());
        }
    }
}

function eliminar_artigo($conexion, $datos)
{
    try {
        if (!isset($datos["artigos"])) {
            alerta_red("Debes seleccionar un artigo");
        } else {
            $id = explode(",", $datos["artigos"])[0];
            $sql = "DELETE FROM artigo WHERE ID_artigo = ?";
            $pdo_statement = $conexion->prepare($sql);
            $pdo_statement->bindParam(1, $id);

            $pdo_statement->execute();
            eliminar_imaxe($datos);
            alerta_green("Artigo eliminado correctamente");
        }
    } catch (PDOException $e) {
        alerta_red("Erro" . $e->getMessage());
    }
}

function alugar_artigo($conexion, $datos)
{
    if (!isset($datos["artigo"]) || !isset($datos["cliente"])) {
        alerta_red("Debes cubrir todos os campos");
    } else {
        try {
            $id_artigo = $datos["artigo"];
            $id_cliente = $datos["cliente"];
            $num_dias = $datos["dias"];
            $data = date('Y-m-d H:i:s');
            $sql_prezo = "SELECT prezo FROM artigo WHERE ID_artigo = ?";
            $pdo_prezo = $conexion->prepare($sql_prezo);
            $pdo_prezo->bindParam(1, $id_artigo);
            $pdo_prezo->execute();
            $prezo = $pdo_prezo->fetch();
            $devolto = 0;

            $sql = "INSERT INTO aluga (ID_artigo, ID_Cliente, data, num_dias_alugado, prezo, devolto) VALUES (?,?,?,?,?,?)";
            $pdo_statement = $conexion->prepare($sql);
            $pdo_statement->bindParam(1, $id_artigo);
            $pdo_statement->bindParam(2, $id_cliente);
            $pdo_statement->bindParam(3, $data);
            $pdo_statement->bindParam(4, $num_dias);
            $pdo_statement->bindParam(5, $prezo["prezo"]);
            $pdo_statement->bindParam(6, $devolto);

            $pdo_statement->execute();
            alerta_green("Alugado correctamente");
        } catch (PDOException $e) {
            alerta_red("Erro" . $e->getMessage());
        }
    }
}

function devolver_artigo($conexion, $datos)
{
    if (!isset($datos["artigo"])) {
        alerta_red("Selecciona un artigo");
    } else {
        try {
            $data = $datos["artigo"];
            $datos = explode(",", $data);
            $id_artigo = $datos[0];
            $id_cliente = $datos[1];
            $data = $datos[2];
            $devolto = 1;

            $sql = "UPDATE aluga SET devolto = ? WHERE ID_artigo = ? AND ID_Cliente = ? AND data = ?";
            $pdo_statement = $conexion->prepare($sql);
            $pdo_statement->bindParam(1, $devolto);
            $pdo_statement->bindParam(2, $id_artigo);
            $pdo_statement->bindParam(3, $id_cliente);
            $pdo_statement->bindParam(4, $data);

            $pdo_statement->execute();
            alerta_green("Artigo devolto correctamente");
        } catch (PDOException $e) {
            alerta_red("Erro" . $e->getMessage());
        }
    }
}

function mostrar_artigos($conexion, $query)
{
    try {
        $pdo_statement = $conexion->prepare($query);
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
        $output = '';
        if ($pdo_statement->rowCount() > 0) {
            foreach ($result as $row) {
                // mostrar una card por cada artigo
                $output .= '
                    <button class="no_button" name="opt" value=' . $row["ID_artigo"] . ' >
                        <div class="card_articulo">
                            <h5 class="card-title pt-3 ps-3">' . $row["nome"] . '</h5>
                            <img src="../assets/imaxes/' . $row["imaxe"] . '" class="card-img-top" alt="...">
                            <span hidden>' . $row["ID_artigo"] . '</span>
                        </div>
                    </button>
                ';
            }
        } else {
            $output .= '
            <tr>
                <td colspan="8" align="center">Non existen rexistros</td>
            </tr>
            ';
        }
        echo $output;
    } catch (PDOException $e) {
        alerta_red("Erro" . $e->getMessage());
    }
}

function imprimir_detalles($id)
{
    try {
        // query para saber si o artigo está alugado
        $sql = "SELECT * FROM aluga WHERE ID_artigo = ? AND devolto = 0";
        $pdo_statement = $GLOBALS["conexion"]->prepare($sql);
        $pdo_statement->bindParam(1, $id);
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
        $dispo = "";

        if ($pdo_statement->rowCount() > 0) {
            $dispo = "<span class='badge text-bg-warning'>Alugado</span>";
            // query para obter os datos do cliente mais o artigo que ten alugado mais o número de días que ten alugado
            $query = $GLOBALS["conexion"]->prepare("SELECT art.*,art.ID_artigo,alu.ID_Cliente, cli.email, alu.num_dias_alugado, alu.devolto, cli.ID_Cliente, alu.ID_artigo FROM artigo art, cliente cli, aluga alu WHERE alu.ID_artigo = art.ID_artigo AND alu.ID_Cliente = cli.ID_Cliente having alu.ID_artigo = ? and alu.devolto = 0");
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch();
            echo '
            <div class="container mt-5 mb-5 d-flex justify-content-center">
                <div class="card mb-5 shadow" style="width: 750px;">
                  <img src="../../assets/imaxes/' . $result["imaxe"] . '" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h2 class="card-title">' . $result["nome"] . '</h2>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">' . $result["detalle"] . '</li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><strong>Prezo: </strong>' . $result["prezo"] . '€</span>
                        ' . $dispo . '
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><strong>Email cliente: </strong>' . $result["email"] . '</span>
                        <span><strong>Dias alugado: </strong>' . $result["num_dias_alugado"] . '</span>
                    </li>
                  </ul>
                  <div class="card-body">
                    <a href="./aluga.php" class="card-link">Alugar Artigo</a>
                    <a href="./eliminar.php" class="card-link">Eliminar Artigo</a>
                  </div>
                </div>
            </div>';
        } else {
            $dispo = "<span class='badge text-bg-success'>Dispoñible</span>";

            $query = "SELECT * FROM artigo WHERE ID_artigo = ?";
            $pdo_statement = $GLOBALS["conexion"]->prepare($query);
            $pdo_statement->bindParam(1, $id);
            $pdo_statement->execute();
            $result = $pdo_statement->fetch();

            echo '
            <div class="container mt-5 mb-5 d-flex justify-content-center">
            <div class="card mb-5 shadow" style="width: 750px;">
              <img src="../../assets/imaxes/' . $result["imaxe"] . '" class="card-img-top" alt="...">
              <div class="card-body">
                <h2 class="card-title">' . $result["nome"] . '</h2>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">' . $result["detalle"] . '</li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><strong>Prezo: </strong>' . $result["prezo"] . '€</span>
                    ' . $dispo . '
                </li>
              </ul>
              <div class="card-body">
                <a href="./aluga.php" class="card-link">Alugar Artigo</a>
                <a href="./eliminar.php" class="card-link">Eliminar Artigo</a>
              </div>
            </div>
          </div>';
        }
    } catch (PDOException $e) {
        alerta_red("Erro" . $e->getMessage());
    }
}

// IMAXES
function gardar_imaxe()
{
    try {
        $tmp_imaxe = $_FILES["imaxe"]["tmp_name"];
        if (is_uploaded_file($tmp_imaxe)) {
            $img_name = $_FILES["imaxe"]["name"];
            $img_type = $_FILES["imaxe"]["type"];
            if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") ||
                strpos($img_type, "jpg")) || strpos($img_type, "png") || strpos($img_type, "webp"))) {
                move_uploaded_file($tmp_imaxe, "../../assets/imaxes/" . $img_name);
            }
        }
    } catch (Exception $e) {
        alerta_red("Erro ao gardar a imaxe. " . $e->getMessage());
    }
}

function eliminar_imaxe($datos)
{
    try {
        $imaxe = explode(",", $datos["artigos"])[1];
        unlink("../../assets/imaxes/" . $imaxe);
    } catch (Exception $e) {
        alerta_red("Erro ao eliminar a imaxe. " . $e->getMessage());
    }
}

// CLIENTE
function engadir_cliente($conexion, $datos)
{
    try {
        $nome = $datos["nome"];
        $apelidos = $datos["apelidos"];
        $email = $datos["email"];
        $sql = "INSERT INTO cliente (nome, apelidos, email) VALUES(?,?,?)";
        $pdo_statement = $conexion->prepare($sql);
        $pdo_statement->bindParam(1, $nome);
        $pdo_statement->bindParam(2, $apelidos);
        $pdo_statement->bindParam(3, $email);

        $pdo_statement->execute();
        alerta_green("Cliente engadido correctamente");
    } catch (PDOException $e) {
        alerta_red("Erro ao engadir o cliente. " . $e->getMessage());
    }
}

function eliminar_cliente($conexion, $datos)
{
    try {
        $id = $datos["clientes"];
        $sql = "DELETE FROM cliente WHERE ID_Cliente = ?";
        $pdo_statement = $conexion->prepare($sql);
        $pdo_statement->bindParam(1, $id);

        $pdo_statement->execute();
        alerta_green("Cliente eliminado correctamente");
    } catch (PDOException $e) {
        alerta_red("Erro ao eliminar o cliente. " . $e->getMessage());
    }
}

// COMUN BUSQUEDA
function print_buscar($conexion, $criterio)
{
    try {
        $query = "SELECT * FROM artigo WHERE nome LIKE ? OR detalle LIKE ?";
        $pdo_statement = $conexion->prepare($query);
        $pdo_statement->bindValue(1, '%' . $criterio . '%');
        $pdo_statement->bindValue(2, '%' . $criterio . '%');
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();

        $output = '';
        if ($pdo_statement->rowCount() > 0) {
            foreach ($result as $row) {
                // mostrar una card por cada artigo
                $output .= '
                    <button class="no_button" name="opt" value=' . $row["ID_artigo"] . ' >
                        <div class="card_articulo">
                            <h5 class="card-title pt-3 ps-3">' . $row["nome"] . '</h5>
                            <img src="../assets/imaxes/' . $row["imaxe"] . '" class="card-img-top" alt="...">
                            <span hidden>' . $row["ID_artigo"] . '</span>
                        </div>
                    </button>
                ';
            }
        } else {
            $output .= '
            <tr>
                <td colspan="8" align="center">Non existen rexistros</td>
            </tr>
            ';
        }
        echo $output;
    } catch (PDOException $e) {
        alerta_red("Erro" . $e->getMessage());
    }
}

// ALERTAS
function alerta_green($mensaje)
{
    echo "<div class='alert alert-success alert-dismissible fade show shadow' role='alert' style='z-index: 1; position: absolute; top: 5%; left: calc(50% - 195.5px);'>
            <strong>Correcto!</strong> $mensaje
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

function alerta_red($mensaje)
{
    echo "<div class='alert alert-danger alert-dismissible fade show shadow' role='alert' style='z-index: 1; position: absolute; top: 5%; left: calc(50% - 195.5px);'>
            <strong>Erro!</strong> $mensaje
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}
