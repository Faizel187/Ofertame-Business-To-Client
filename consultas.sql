-------  B2C --------
---------------------

Mostrar cuantos usuarios, han reservado la oferta que le digamos

SELECT COUNT( * ) 
FROM reserva 
WHERE id_oferta =3


Saber el numero de categorias que tenemos, para hacer el menu, dinamicamente

SELECT COUNT( * ) 
FROM categoria


Saber cuantas ofertas tiene cada categoria

SELECT COUNT( * ) ,
categoria_oferta 
FROM oferta 
GROUP BY categoria_oferta


Saber que categorias le gusta a un usuario

SELECT nombre_categoria 
FROM gusta
WHERE correo_usuario =  "davidespier@gmail.com"

Saber el resto de categorias que aun no tengo en gustos

SELECT *  
FROM categoria
WHERE nombre_categoria not in 
(
    SELECT nombre_categoria 
    FROM gusta
    WHERE correo_usuario =  "davidespier@gmail.com" 

)


Saber cual es la categoria que mas le gusta a los usuarios

SELECT nombre_categoria, COUNT( * ) AS c 
FROM gusta 
GROUP BY nombre_categoria 
ORDER BY c DESC 


Buscar una oferta que contenga palabras puestas en el buscador

SELECT * 
FROM oferta
WHERE nombre_oferta LIKE  '%en%'

Buscar las ofertas de una categoria

SELECT * 
FROM oferta
WHERE categoria_oferta= 'moda'


Historico de ofertas que ya no estan activas 

SELECT * 
FROM reserva
WHERE activo =0
AND correo_usuario = 'davidespier@gmail.com'


Ofertas activas

SELECT * 
FROM reserva
WHERE activo = 1
AND correo_usuario = 'davidespier@gmail.com'


Historico de ofertas (Historial de ofertas reservadas (que ya ha caducado) para un usuario)

SELECT oferta . * 
FROM oferta
INNER JOIN reserva ON oferta.id_oferta = reserva.id_oferta
INNER JOIN usuario ON usuario.correo = reserva.correo_usuario
WHERE oferta.fecha_final < CURDATE( ) 
AND reserva.correo_usuario =  'cristiangase5@gmail.com'


Ofertas tengo reservadas ahora mismo (cuya fecha final aún no haya finalizado)

SELECT reserva. * , oferta.fecha_final
FROM reserva
INNER JOIN oferta ON reserva.id_oferta = oferta.id_oferta
WHERE reserva.activo =1
AND reserva.correo_usuario =  'cristiangase5@gmail.com'
AND oferta.fecha_final > CURDATE() 


ofertas de las categorias que me gustan

SELECT oferta. * 
FROM oferta
INNER JOIN gusta ON oferta.categoria_oferta = gusta.nombre_categoria
INNER JOIN usuario ON usuario.correo = gusta.correo_usuario
where usuario.correo = "sebesortiz@gmail.com"
ORDER BY oferta.categoria_oferta


resto de ofertas que no le gusten a un usuario

SELECT * 
FROM oferta
WHERE id_oferta NOT 
IN (

SELECT oferta.id_oferta
FROM oferta
INNER JOIN gusta ON oferta.categoria_oferta = gusta.nombre_categoria
INNER JOIN usuario ON usuario.correo = gusta.correo_usuario
WHERE usuario.correo =  "sebesortiz@gmail.com"
)
order by categoria_oferta



