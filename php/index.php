<?php

?>
<html lang="es">
	
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	
	<body>
		
		<div class="container">
			<div class="row">
				<h2 style="text-align:center">Consulta de Citas - INE</h2>
			</div>
			
			<div class="row">		
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
				</form>
			</div>
			
			<br>
			
			<div class="row table-responsive">
				<table id="table" class="table align-items-center mb-0">
					<thead>
						<tr>
							<th>Id</th>
							<th>Folio</th>
							<th>Ciudadano</th>
							<th>Fecha</th>
							<th>Documento</th>
							<th>Comprobante</th>
							<th>Modulo</th>
							<th>Tramite</th>
							<th>Estado</th>
						</tr>
					</thead>
				<tbody>

				</tbody>	
					
				</table>
			</div>
		</div>	
	</body>
</html>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
          	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		  	<link href="css/bootstrap.min.css" rel="stylesheet">
			<link href="css/bootstrap-theme.css" rel="stylesheet">
<script>
	var url ="http://localhost/apicita/public/api";   

$.ajax({   //iniciar ajax para crar token   
    url: url+'/citas',
    data: { },
    type: "GET",
    dataType: "json",
    headers:{
      token: localStorage.getItem("token")
    }
})
 .done(function( data, textStatus, jqXHR ) { // lo que regresamos desde la API esta en data
   
  var rows="";
    console.log("info tabla")
    console.log(data) 

    if(!data){
      rows="<h2 style='color:red; text-align:center;'>No hay registros</h2>";
    }else{ 
      data.citas.forEach(r => {
        rows+=`
               <tr>
                    <td>${r.id}</td>
                    <td>${r.folio}</td>
                    <td>${r.ciudadano}</td>
                    <td>${r.fecha}</td>
                    <td>${r.documento}</td>
                    <td>${r.comprobante}</td>
                    <td>${r.Modulo.nombre}</td>
                    <td>${r.Tramite.nombre}</td>
					<td>${r.estado}</td>
                </tr>
        `;
      });
  }
  	console.log(rows);
    $("#table tbody").html(rows);
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="js/jquery-3.1.1.min.js"></script> 
			<script src="js/bootstrap.min.js"></script>	