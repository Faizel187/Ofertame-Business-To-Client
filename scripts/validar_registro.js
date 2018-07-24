var control = true;
 
function cargarDatos()
{
    var xmlhttp=null;;

    if (window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
    }else{
     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            ponerDatos(xmlhttp.responseText);
        }

    }
    
    xmlhttp.open('POST','php/devolver_datos_formulario.php',true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
    
}

function ponerDatos(response) // Ponemos cada valor de la fila seleccionnada en su respectivo input
{   
    var arr = JSON.parse(response);

    document.getElementById("email").value = arr[0].correo;
    document.getElementById("password").value = arr[0].clave;
    document.getElementById("dni").value = arr[0].dni;     
    document.getElementById("nombre").value = arr[0].nombre;
    document.getElementById("apellido").value = arr[0].apellidos;
    document.getElementById("telefono").value = arr[0].telefono;
    document.getElementById("fecha").value = arr[0].fecha_nacimiento;
    
}

/*function validarTelefono()
{
    var telefono = document.getElementById("inputTelefono").value;
 
    if (telefono.length != 9)
    {
        alert("El teléfono ha de ser de 9 digitos");
        control = false;
    }
     
}

function validarDNI()
{
    var dni = document.getElementById("inputDNI").value;
    var expresion_regular_dni;
 
    expresion_regular_dni = /^\d{8}[a-zA-Z]$/;
 
    if(expresion_regular_dni.test (dni) == true){
        numero = dni.substr(0,dni.length-1);
        letr = dni.substr(dni.length-1,1);
        numero = numero % 23;
        letra='TRWAGMYFPDXBNJZSQVHLCKET';
        letra=letra.substring(numero,numero+1);
 
        if (letra!=letr.toUpperCase()) {
             
            control = false;
            alert("DNI formato incorrecto");
        }
    }
    else{
        control = false;
        alert("DNI formato incorrecto");
    }
 
}
 
function validarFormulario()
{
    control = true;
    validarTelefono();
    validarDNI();
     
    if (control)
    {   
        return true;
    }
    else
    {
        return false;
    }
 
 
}*/