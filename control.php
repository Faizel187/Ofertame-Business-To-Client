<?php
header("Content-Type: text/html;charset=ansi");
include_once("model.php");
include_once("control_vista.php");

if (isset($_POST["opcion"]))
  {
    $opcion = $_POST["opcion"];
    switch ($opcion)
    {
        case "login":

          /*$email = $_POST["email"];
          $password = $_POST["password"];

          if(CheckUser($email,$password))
          {
            //Start the session
            session_start();
            $_SESSION['email']=$email;
            $_SESSION['password']=$password;

            //go to "reservas" page
            header("Location: mis-reservas.html");
            
          }
          else
          {
            header("Location: registro.html");
          }*/
        break;

        case "register":
      
          $email = $_POST["inputEmail"];

          if (!CheckNewUserEmail($email))
          {
            
            $dni = $_POST["inputDNI"];

            if(!CheckNewUserDNI($dni))
            {
              
              $password = $_POST["inputPassword"];    
              $name = $_POST["inputNombre"];
              $lastName = $_POST["inputApellido"];
              $phone = $_POST["inputTelefono"];
              $birthdate = $_POST["inputFecha"];

              AddUser($email, $password, $dni, $name, $lastName, $phone, $birthdate);
          //    $_SESSION['email']=$email;
              header("Location: main.html");

            }
            else
            {
              
              
            }


          }
          else
          {  
               
            // Error de ya hay un correo igual registrado.
          }

        break;
        
        case "land_airplane":
        
            if (isset($_POST["id_avio"]))
              {

                $id_avio = $_POST["id_avio"];
                if (isset($_POST["aeroport"]))
                  {
					          $nom_aeroport = $_POST["aeroport"];
                    $res =  updateAirplane($id_avio, $nom_aeroport);
                    if ($res == 1)
                    {
                      show_message("Airplane succesfully landed");
                    }
                  }
                else
                  {
                    show_error(-5);
                  }
              }
            else
              {
                show_error(-4);
              }
            break;

    }

   // include_once("vista.html");
   //header("Refresh:0");
//   include_once("index.php");
   
  }
else
  {
    show_error(-6);
  }
?>