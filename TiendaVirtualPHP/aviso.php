<?php require "php/sesion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Contacto enviado</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/de3b316a2b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Móviles Andromeda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="moviles.php">Móviles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="graficas.php">Tarjetas Gráficas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="acercade.php">Acerca de</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacto.php">Contacto</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <?php require "php/navbar.php"; ?>
            </ul>
        </div>
    </nav>

    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <h4>Productos relacionados</h4>
                <div class="card-body">Moviles
                    <a href="producto.php"><img src="imagenes/moviles.jpg" alt="moviles" class="media-object" width="100%"></a>
                </div>
                <div class="card-body">Tablets
                    <a href="producto.php"><img src="imagenes/tablet.jpg" alt="tablet" class="media-object" width="100%"></a>
                </div>
                <div class="card-body">Consolas
                    <a href="producto.php"><img src="imagenes/consola.jpg" alt="consola" class="media-object" width="100%"></a>
                </div>
            </div>
            <div class="col-sm-8 text-center">
                <div class="card-body">
                    <h2>Aviso de privacidad</h2>
                    <p>A través de este sitio web no se recaban datos de carácter personal de los usuarios sin su conocimiento, ni se ceden a terceros. Con la finalidad de ofrecerle el mejor servicio y con el objeto de facilitar el uso, se analizan el número
                        de páginas visitadas, el número de visitas, así como la actividad de los visitantes y su frecuencia de utilización. A estos efectos, la Agencia Española de Protección de Datos (AEPD) utiliza la información estadística elaborada
                        por el Proveedor de Servicios de Internet. La AEPD no utiliza cookies para recoger información de los usuarios, ni registra las direcciones IP de acceso. Únicamente se utilizan cookies propias, de sesión, con finalidad técnica
                        (aquellas que permiten al usuario la navegación a través del sitio web y la utilización de las diferentes opciones y servicios que en ella existen). El portal del que es titular la AEPD contiene enlaces a sitios web de terceros,
                        cuyas políticas de privacidad son ajenas a la de la AEPD. Al acceder a tales sitios web usted puede decidir si acepta sus políticas de privacidad y de cookies. Con carácter general, si navega por internet usted puede aceptar o
                        rechazar las cookies de terceros desde las opciones de configuración de su navegador.
                    </p>
                    <br><br>
                    <h2>Condiciones de Uso</h2>
                    <p>
                        La utilización del sitio Web le otorga la condición de Usuario, e implica la aceptación completa de todas las cláusulas y condiciones de uso incluidas en las páginas:
                        <ul class="text-left">
                            <li>Aviso Legal</li>
                            <li>Política de Privacidad</li>
                            <li>Política de Cookies</li>
                        </ul>
                        Si no estuviera conforme con todas y cada una de estas cláusulas y condiciones absténgase de utilizar este sitio Web. El acceso a este sitio Web no supone, en modo alguno, el inicio de una relación comercial con el Titular. A través de este sitio Web,
                        el Titular le facilita el acceso y la utilización de diversos contenidos que el Titular o sus colaboradores han publicadon por medio de Internet. A tal efecto, usted está obligado y comprometido a NO utilizar cualquiera de los
                        contenidos del sitio Web con fines o efectos ilícitos, prohibidos en este Aviso Legal o por la legislación vigente, lesivos de los derechos e intereses de terceros, o que de cualquier forma puedan dañar, inutilizar, sobrecargar,
                        deteriorar o impedir la normal utilización de los contenidos, los equipos informáticos o los documentos, archivos y toda clase de contenidos almacenados en cualquier equipo informático propios o contratados por el Titular, de otros
                        usuarios o de cualquier usuario de Internet.
                    </p>
                    <a href="index.php" class="btn btn-success" role="button">Volver al inicio</a>
                </div>
            </div>
            <div class="col-sm-2 sidenav">
                <h4>Productos relacionados</h4>
                <div class="card-body">Moviles
                    <a href="producto.php"><img src="imagenes/moviles.jpg" alt="moviles" width="100%"></a>
                </div>
                <div class="card-body">Tablets
                    <a href="producto.php"><img src="imagenes/tablet.jpg" alt="tablet" width="100%"></a>
                </div>
                <div class="card-body">Consolas
                    <a href="producto.php"><img src="imagenes/consola.jpg" alt="consola" width="100%"></a>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>

    <footer class="container-fluid text-center">
        <a href="aviso.php">Aviso de privacidad</a>
    </footer>
</body>

</html>