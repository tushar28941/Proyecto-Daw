<?php
require "../php/conn.php";
if(isset($_POST["usuario"])){
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];
    $clave = hash_hmac("sha512",$clave,"andro");

    $sql = "SELECT * FROM admin WHERE usuario='".$usuario."' AND clave='".$clave."'";
    $r = mysqli_query($conn, $sql);
    $n = mysqli_num_rows($r);
    if($n==1){
        session_start();
        $_SESSION['admin']=$usuario;
        header("location:productos.php");
    } else {
        $error = "Usuario o contraseña incorrecata";
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Login de Administrador</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/de3b316a2b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        </div>
    </nav>
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav">
            </div>
            <div class="col-sm-8 text-center">
                <div class="card-body" id="conten">
                <?php if(isset($error)): ?>
                            <div class="alert alert-danger">
                                <strong>
                                    <?php echo $error  ?>
                                </strong>
                            </div>
                <?php endif; ?>
                    <h2>Iniciar Sesión Admin</h2>
                    <form method="POST" action="index.php" class="text-left">
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Escribe el usuario">
                        </div>
                        <div class="form-group">
                            <label for="email">Contraseña:</label>
                            <input type="password" name="clave" id="clave" class="form-control" placeholder="Escribe la contraseña">
                        </div>
                        <div class="form-group text-left">
                            <label for="entrar"></label>
                            <input type="submit" name="entrar" value="Entrar" class="btn btn-success" role="button">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-2 sidenav">
                
            </div>
        </div>
    </div>

    <br>
    <br>

    <footer class="container-fluid text-center">
    </footer>
</body>
</html>