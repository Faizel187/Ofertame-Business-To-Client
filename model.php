<?php
date_default_timezone_set('Europe/Madrid');
header("Content-Type: text/html;charset=ansi");
include_once("accesbd.php");

function obtenir_inicialitzacions_bd(&$servidor, &$usuari, &$contrasenya, &$bd)
  {
    $servidor    = "localhost";
    $usuari      = "root";
    $contrasenya = "usbw";
    $bd          = "test_proyecto";
  }

function CheckUser($email, $password)
  {
    $res = false;
    obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
    
    $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);

    $pass_hash = hash("md5","$password");

    if ($connexio)
      {
        $instruccio = "select count(*) from usuario where correo ='$email' and clave = '$pass_hash'";
        $quants     = consulta_dada($connexio, $instruccio);
        $res = ($quants > 0);
        desconnectar_bd($connexio);
      }
      
    return $res;
  }

function CheckNewUserEmail($email) //Comprobar que el email de un usuario nuevo ya esté introducido
{
  $res = false;
  obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
  
  $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);

  if ($connexio)
    {
      $instruccio = "select count(*) from usuario where correo ='$email'";
      $quants     = consulta_dada($connexio, $instruccio);
      $res = ($quants > 0);
      desconnectar_bd($connexio);
    }
    
  return $res;
}

function CheckNewUserDNI($dni) //Comprobar que el email de un usuario nuevo ya esté introducido
{
  $res = false;
  obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
  
  $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);

  if ($connexio)
    {
      $instruccio = "select count(*) from usuario where dni ='$dni'";
      $quants     = consulta_dada($connexio, $instruccio);
      $res = ($quants > 0);
      desconnectar_bd($connexio);
    }
    
  return $res;
}

function num_files($res)
{
  $quants = 0;
  if (isset($res) && $res != null)
    {
      $quants = mysqli_num_fields($res);
    }
  return ($quants);
}

function RestOfOffers($user)
{
  $res = false;
  obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
  $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);
  if ($connexio)
    {
      
      if($user != "")
      {
        $instruccio = "SELECT oferta . * , empresa.nombre
        FROM oferta
        INNER JOIN empresa ON oferta.nombre_empresa = empresa.nombre
        WHERE id_oferta NOT 
        IN (
        SELECT oferta.id_oferta
        FROM oferta
        INNER JOIN gusta ON oferta.categoria_oferta = gusta.nombre_categoria
        INNER JOIN usuario ON usuario.correo = gusta.correo_usuario
        WHERE usuario.correo =  '$user'
        AND oferta.fecha_final > CURDATE( )
        )
        AND oferta.id_oferta NOT 
        IN (
        SELECT oferta.id_oferta
        FROM reserva
        INNER JOIN oferta ON reserva.id_oferta = oferta.id_oferta
        WHERE reserva.activo =1
        AND reserva.correo_usuario =  '$user'
        AND oferta.fecha_final > CURDATE( )
        )
        AND fecha_final > CURDATE( )
        AND unidades > 0 
        ORDER BY categoria_oferta";
      }
      else
      {
        $instruccio = 
          "SELECT oferta.* , empresa.nombre
          FROM oferta
          INNER JOIN empresa ON oferta.nombre_empresa = empresa.nombre
          AND oferta.fecha_final > CURDATE( )
          AND oferta.unidades > 0 ";
      }

      $consulta   = consulta_multiple($connexio, $instruccio);
      $fila = obtenir_fila($consulta);
      
      while ($fila)
            {
             // echo "sebas sebas sebas";
                 echo "<div class='col-md-4'>";
                echo "<br>";
                echo "<div class='imgO boxShadow'>
                        <img src='$fila[9]'  height='100%' width='100%' style='border-radius:5px;'>
                        <p id ='offerID' class='tituloOfertaImg' hidden>$fila[0]</p>
                        <p id='tittle' class='tituloOfertaImg'>$fila[1]</p>
                        <div id='category' class='categoriaMain'><p class='ofertasPMain'>".$fila[2]."</p></div>
                        <div id='company' class='empresaMain'><p class='ofertasPMain'>".$fila[11]."</p></div><br>
                        <div id='remaining' class='ofertasRestantesMain'><p class='ofertasPMain'>QUEDAN ".$fila[5]." DISPONIBLES</p></div><br>
                        <div id='endDate' class='fechaMain'><p class='ofertasPMain'>DISPONIBLE HASTA ".$fila[8]."</p></div>
                        <p id='description' class='ofertasPMain' hidden>".$fila[4]."</p>
                        <p id='offerImage' class='ofertasPMain' hidden>".$fila[9]."</p>
                      </div> ";
                echo "<br></div>";
                $fila = obtenir_fila($consulta);
            }
        
      
      tancar_consulta_multiple($consulta);
    }
  desconnectar_bd($connexio);
  return ($res);
}


function MyFavs($user)
{
  $res = false;
  obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
  $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);
  if ($connexio)
    {
      $instruccio = "SELECT oferta. * , empresa.nombre
        FROM oferta
        INNER JOIN empresa ON oferta.nombre_empresa = empresa.nombre
        INNER JOIN gusta ON oferta.categoria_oferta = gusta.nombre_categoria
        INNER JOIN usuario ON usuario.correo = gusta.correo_usuario
        WHERE usuario.correo =  '$user'
        AND oferta.id_oferta NOT 
        IN (
        SELECT oferta.id_oferta
        FROM reserva
        INNER JOIN oferta ON reserva.id_oferta = oferta.id_oferta
        WHERE reserva.activo =1
        AND reserva.correo_usuario =  '$user'
        AND oferta.fecha_final > CURDATE( )
        )
        AND oferta.fecha_final > CURDATE( ) 
        AND oferta.unidades > 0
        LIMIT 0 , 30";

      $consulta   = consulta_multiple($connexio, $instruccio);
      $fila = obtenir_fila($consulta);
      
      while ($fila)
            {
             // echo "sebas sebas sebas";
                echo "<div class='col-md-4'>";
                echo "<br>";
                echo "<div class='imgO boxShadow'>
                        <img src='$fila[9]' height='100%' width='100%' style='border-radius:5px;'>
                        <p id ='offerID' class='tituloOfertaImg' hidden>$fila[0]</p>
                        <p id ='tittle' class='tituloOfertaImg'>$fila[1]</p>
                        <div id='category' class='categoriaMain'><p class='ofertasPMain'>".$fila[2]."</p></div>
                        <div id= 'company' class='empresaMain'><p class='ofertasPMain'>".$fila[11]."</p></div><br>
                        <div id='remaining' class='ofertasRestantesMain'><p class='ofertasPMain'>QUEDAN ".$fila[5]." DISPONIBLES</p></div>
                        <div id='endDate' class='fechaMain'><p class='ofertasPMain'>DISPONIBLE HASTA ".$fila[8]."</p></div>
                        <p id='description' class='ofertasPMain' hidden>".$fila[4]."</p>
                        <p id='offerImage' class='ofertasPMain' hidden>".$fila[9]."</p>
                      </div> ";
                echo "<br></div>";
                $fila = obtenir_fila($consulta);
            }
        
      
      tancar_consulta_multiple($consulta);
    }
  desconnectar_bd($connexio);
  return ($res);
}

function CountFavs($user)
  {
    obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
    
    $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);

    if ($connexio)
      {
        $instruccio = "SELECT COUNT( * ) 
        FROM oferta
        INNER JOIN empresa ON oferta.nombre_empresa = empresa.nombre
        INNER JOIN gusta ON oferta.categoria_oferta = gusta.nombre_categoria
        INNER JOIN usuario ON usuario.correo = gusta.correo_usuario
        WHERE usuario.correo =  '$user'
        AND oferta.id_oferta NOT 
        IN (
        
        SELECT oferta.id_oferta
        FROM reserva
        INNER JOIN oferta ON reserva.id_oferta = oferta.id_oferta
        WHERE reserva.activo =1
        AND reserva.correo_usuario =  '$user'
        AND oferta.fecha_final > CURDATE( )
        )
        AND oferta.fecha_final > CURDATE( ) 
        AND oferta.unidades >0";
        
        $quants = consulta_dada($connexio, $instruccio);
        desconnectar_bd($connexio);
      }
      
    return $quants;
  }


function MyReservations($user)
{
    $res = false;
    obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
    $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);
    if ($connexio)
      {
        $instruccio = "SELECT reserva. * , oferta.nombre_oferta, oferta.fecha_final, oferta.ruta_imagen, oferta.categoria_oferta, empresa.nombre, oferta.descripcion, reserva.id_reserva, usuario.dni, usuario.fecha_nacimiento, usuario.nombre, usuario.apellidos
        FROM reserva
        INNER JOIN oferta ON reserva.id_oferta = oferta.id_oferta
        INNER JOIN usuario ON reserva.correo_usuario = usuario.correo
        INNER JOIN empresa ON oferta.nombre_empresa = empresa.nombre
        WHERE reserva.activo =1
        AND reserva.correo_usuario =  '$user'
        AND oferta.fecha_final > CURDATE()";

        $consulta   = consulta_multiple($connexio, $instruccio);
        $fila = obtenir_fila($consulta);
        
        while ($fila)
              {
               // echo "sebas sebas sebas";
                echo "<div class='col-md-4'>";
                echo "<br>";
                echo "<div class='imgO boxShadow'>
                        <img src='$fila[7]' height='100%' width='100%' style='border-radius:5px;'>
                        <p id ='tittle' class='tituloOfertaImg'>$fila[5]</p>
                        <center>
                        <div id='category' class='categoriaMain'><p class='ofertasPMain'>".$fila[8]."</p></div>
                        <div id= 'company' class='empresaMain'><p class='ofertasPMain'>".$fila[9]."</p></div><br>
                        <div id='endDate' class='fechaMain'><p class='ofertasPMain'>DISPONIBLE HASTA ".$fila[6]."</p></div>
                        <p id='description' class='ofertasPMain' hidden>".$fila[10]."</p>
                        <p id='offerImage' class='ofertasPMain' hidden>".$fila[7]."</p>
                        <p id='reservationID' class='ofertasPMain' hidden>".$fila[11]."</p>
                        <p id='dni' class='ofertasPMain' hidden>".$fila[12]."</p>
                        <p id='birthday' class='ofertasPMain' hidden>".$fila[13]."</p>
                        <p id='username' class='ofertasPMain' hidden>".$fila[14]."</p>
                        <p id='lastname' class='ofertasPMain' hidden>".$fila[15]."</p>
                        </center>
                      </div> ";
                echo "<br></div>";
                  $fila = obtenir_fila($consulta);
              }
          
        
        tancar_consulta_multiple($consulta);
      }
    desconnectar_bd($connexio);
    return ($res);
  }

function historial($user)
{
    $res = false;
    obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
    $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);
    if ($connexio)
      {
        $instruccio = "SELECT reserva. * , oferta.nombre_oferta, oferta.fecha_final, oferta.ruta_imagen, oferta.categoria_oferta, empresa.nombre, oferta.descripcion, reserva.id_reserva, usuario.dni, usuario.fecha_nacimiento, usuario.nombre, usuario.apellidos
        FROM reserva
        INNER JOIN oferta ON reserva.id_oferta = oferta.id_oferta
        INNER JOIN usuario ON reserva.correo_usuario = usuario.correo
        INNER JOIN empresa ON oferta.nombre_empresa = empresa.nombre
        AND reserva.correo_usuario =  '$user'";

        $consulta   = consulta_multiple($connexio, $instruccio);
        $fila = obtenir_fila($consulta);
        
        while ($fila)
              {
               // echo "sebas sebas sebas";
                echo "<div class='col-md-4'>";
                echo "<br>";
                echo "<div class='imgO boxShadow'>
                        <img src='$fila[7]' height='100%' width='100%' style='border-radius:5px;'>
                        <p id ='tittle' class='tituloOfertaImg'>$fila[5]</p>
                        <center>
                        <div id ='category' class='categoriaMain'><p class='ofertasPMain'>".$fila[8]."</p></div>
                        <div id ='company' class='empresaMain'><p class='ofertasPMain'>".$fila[9]."</p></div><br>
                        <div id ='endDate' class='fechaMain'><p class='ofertasPMain'>DISPONIBLE HASTA ".$fila[6]."</p></div>
                        <p id='description' class='ofertasPMain' hidden>".$fila[10]."</p>
                        <p id='offerImage' class='ofertasPMain' hidden>".$fila[7]."</p>
                        <p id='reservationID' class='ofertasPMain' hidden>".$fila[11]."</p>
                        <p id='dni' class='ofertasPMain' hidden>".$fila[12]."</p>
                        <p id='birthday' class='ofertasPMain' hidden>".$fila[13]."</p>
                        <p id='username' class='ofertasPMain' hidden>".$fila[14]."</p>
                        <p id='lastname' class='ofertasPMain' hidden>".$fila[15]."</p>
                        </center>
                      </div> ";
                echo "<br></div>";
                  $fila = obtenir_fila($consulta);
              }
          
        
        tancar_consulta_multiple($consulta);
      }
    desconnectar_bd($connexio);
    return ($res);
  }



function misgustosTotal($user)
{
    $res = false;
    obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
    $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);
    if ($connexio)
      {
        $instruccio = "SELECT nombre_categoria FROM gusta WHERE correo_usuario = '$user'";

        $consulta   = consulta_multiple($connexio, $instruccio);
        $fila = obtenir_fila($consulta);
        
        while ($fila)
              {
               echo"<option value=".$fila[0].">".$fila[0]."</option>";
                  $fila = obtenir_fila($consulta);
              }
          
        
        tancar_consulta_multiple($consulta);
      }
    desconnectar_bd($connexio);
    return ($res);
  }

function misgustos_Resto($user)
{
    $res = false;
    obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
    $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);
    if ($connexio)
      {
        $instruccio = "SELECT *  
        FROM categoria
        WHERE nombre_categoria not in 
        (
        SELECT nombre_categoria 
        FROM gusta
        WHERE correo_usuario = '$user')";

        $consulta   = consulta_multiple($connexio, $instruccio);
        $fila = obtenir_fila($consulta);
        
        while ($fila)
              {
               echo"<option value=".$fila[0].">".$fila[0]."</option>";
                  $fila = obtenir_fila($consulta);
              }
          
        
        tancar_consulta_multiple($consulta);
      }
    desconnectar_bd($connexio);
    return ($res);
  }



  function FilterOffers($category)
  {
      if(isset($_SESSION["email"]))
      {
        $email = $_SESSION["email"];
      }
      else
      {
        $email = "";
      }
      
      $res = false;
      obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
      $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);
      if ($connexio)
        {
          $instruccio = "SELECT oferta . * , empresa.nombre
          FROM oferta
          INNER JOIN EMPRESA ON EMPRESA.nombre = oferta.nombre_empresa
          WHERE oferta.categoria_oferta =  '$category'
          AND oferta.unidades >0
          AND oferta.fecha_final > CURDATE( ) 
          AND oferta.id_oferta NOT 
          IN (

          SELECT id_oferta
          FROM reserva
          WHERE correo_usuario =  '$email'
          );";
  

          $consulta = consulta_multiple($connexio, $instruccio);
          $fila = obtenir_fila($consulta);
          
          while ($fila)
                {
                  echo "";
                  echo "<div class='col-md-4'>";
                  echo "<br>";
                  echo "<div class='imgO boxShadow'>
                          <img src='$fila[9]' height='100%' width='100%' style='border-radius:5px;'>
                          <p id ='offerID' class='tituloOfertaImg' hidden>$fila[0]</p>
                          <p id ='tittle' class='tituloOfertaImg'>$fila[1]</p>
                          <div id='remaining' class='ofertasRestantesMain'><p class='ofertasPMain'>QUEDAN ".$fila[5]." DISPONIBLES</p></div>
                          <div id ='company' class='empresaMain'><p class='ofertasPMain'>".$fila[11]."</p></div><br>
                          <div id= 'endDate' class='fechaMain'><p class='ofertasPMain'>DISPONIBLE HASTA ".$fila[8]."</p></div>
                          <p id='description' class='ofertasPMain' hidden>".$fila[4]."</p>
                          <p id='offerImage' class='ofertasPMain' hidden>".$fila[9]."</p>
                        </div> ";
                  echo "<br></div>";
                    $fila = obtenir_fila($consulta);
                }
            
          
          tancar_consulta_multiple($consulta);
        }
      desconnectar_bd($connexio);
      return ($res);
    }


    function SearchOffer($tittle)
  {
      $res = false;
      obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
      $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);
      if ($connexio)
        {
          $instruccio = "SELECT * 
          FROM oferta
          INNER JOIN EMPRESA
          ON EMPRESA.nombre = oferta.nombre_empresa
          WHERE nombre_oferta LIKE  '%$tittle%'";
  
          $consulta   = consulta_multiple($connexio, $instruccio);
          $fila = obtenir_fila($consulta);
          
          while ($fila)
                {
                 // echo "sebas sebas sebas";
                  echo "<div class='col-md-4'>";
                  echo "<br>";
                  echo "<div class='imgO boxShadow'>
                          <img src='$fila[9]' height='100%' width='100%' style='border-radius:5px;'>
                          <p class='tituloOfertaImg'>$fila[1]</p>
                          <div class='categoriaMain'><p class='ofertasPMain'>".$fila[2]."</p></div>
                          <div class='empresaMain'><p class='ofertasPMain'>".$fila[11]."</p></div>
                          <div class='fechaMain'><p class='ofertasPMain'>DISPONIBLE HASTA ".$fila[8]."</p></div>
                        </div> ";
                  echo "<br></div>";
                    $fila = obtenir_fila($consulta);
                }
            
          
          tancar_consulta_multiple($consulta);
        }
      desconnectar_bd($connexio);
      return ($res);
    }

  function footerCategorys()
  {

    $res = false;
    obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
    $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);
    if ($connexio)
      {
        
        $instruccio = "SELECT * FROM categoria";

        $consulta   = consulta_multiple($connexio, $instruccio);
        $fila = obtenir_fila($consulta);        
        while ($fila)
              {
               // echo "sebas sebas sebas";
                echo "<li style='color:white;'><a href=''>".$fila[0]."</li>";
                $fila = obtenir_fila($consulta);
              }
          
        
        tancar_consulta_multiple($consulta);
      }
    desconnectar_bd($connexio);
    return ($res);
  }

 function menuCategorys()
 {
      $res = false;
    obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
    $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);
    if ($connexio)
      {
        
        $instruccio = "SELECT * from categoria ";

        $consulta   = consulta_multiple($connexio, $instruccio);
        $fila = obtenir_fila($consulta);  
        while ($fila)
              {
                echo("<div class='col-xs-4 visible-sm hidden-md hidden-lg hidden-xl'>
                  <center>
                       <li class='datosFiltrar' style='list-style:none;'><a id='tittle' class='menu_s'>$fila[0]</a></li>
                       </center>
                     </div>");
                  echo("<div class='col-xs-3 hidden-sm visible-md visible-lg visible-xl'>
                  <center>
                       <li class='datosFiltrar' style='list-style:none;'><a id='tittle' class='menu_s'>$fila[0]</a></li>
                       </center>
                     </div>");
                $fila = obtenir_fila($consulta);
              }
        
        tancar_consulta_multiple($consulta);
      }
    desconnectar_bd($connexio);
    return ($res);
 }


function menuCategorysBoostrap()
{
    $res = false;
    obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
    $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);
    if ($connexio)
      {
        
        $instruccio = "SELECT * from categoria ";

        $consulta   = consulta_multiple($connexio, $instruccio);
        $fila = obtenir_fila($consulta);  
        while ($fila)
              {
                echo("<a id='tittle' class='datosFiltrar dropdown-item'>$fila[0]</a>");
                $fila = obtenir_fila($consulta);
              }
          
        
        tancar_consulta_multiple($consulta);
      }
    desconnectar_bd($connexio);
    return ($res);
}

function adminUsers(){
  $res = false;
  obtenir_inicialitzacions_bd($servidor, $usuari, $contrasenya, $bd);
  $connexio = connectar_BD($servidor, $usuari, $contrasenya, $bd);
  if ($connexio)
    {
      
      $instruccio = "SELECT * from usuario where correo != 'admin@admin.com' and activo = 1";

      $consulta   = consulta_multiple($connexio, $instruccio);
      $fila = obtenir_fila($consulta);  
      
      echo "<table id='adminUsersT' style='text-align:center;'>";
      echo "<tr><th style='text-align:center; '>CORREO</th><th style='text-align:center;'>DNI</th><th class='hidden-xs' style='text-align:center;'>NOMBRE</th><th class=' hidden-xs hidden-sm' style='text-align:center;'>APELLIDOS</th><th class='hidden-xs' style='text-align:center;'>TELEFONO</th><th class='hidden-xs hidden-sm' style='text-align:center;'>FECHA ALTA</th>";
      echo("</tr>");
      echo("<tr>");
      while ($fila)
            {
              echo("<tr class='userID'>");                
              echo("<td >".$fila[0]."</td><td>".$fila[2]."</td><td class='hidden-xs'>".$fila[3]."</td><td class='hidden-xs hidden-sm'>".$fila[4]."</td><td class='hidden-xs'>".$fila[5]."</td><td class='hidden-xs hidden-sm'>".$fila[6]."</td><td><button class='bt_eliminar_user_table'>ELIMINAR</button> <p id='userIDtext' hidden>".$fila[0]."</p></td>");
              echo "</tr>";
              $fila = obtenir_fila($consulta);
            }
        echo "</table><br>";
      
      tancar_consulta_multiple($consulta);
    }
  desconnectar_bd($connexio);
  return ($res);
}

function CheckSession()
{
  if(!isset($_SESSION['email']))
  {
    header("Location: main.html");
  }
}

?>