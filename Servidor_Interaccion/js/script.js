/*
  
  Created on: 2016
  Author: Mizael Martinez

*/
function Notificacion()
{
	var background_intervalo=undefined;
	var url="http://localhost/Compresion/Servidor_Interaccion/index.php/Controlador/";
	var id_pendientes=-1;
	var datos_compresion=undefined;

	this.eventos_=function()
	{
		eventos();
	}
	this.setUrl=function(url_)
	{
		if(url_!==undefined)
		{
			if(url_!="" || url_!='')
				url=url_;
		}
	}
	var eventos=function()
	{
		$("#modal_generico_ver").off();

		$("#modal_generico_ver").click(function(e){
			if(datos_compresion!==undefined)
			{
				window.location.href =url+"Historial/"+datos_compresion["id_compresion"];
			}
		});
	}
	this.iniciarNotificacion=function(pendientes)
	{
		id_pendientes=pendientes;
		establecerIntervalo();
	}
	var establecerIntervalo=function()
	{
		if(background_intervalo!=undefined)	
		{
			clearTimeout(background_intervalo);
		}
		background_intervalo=setTimeout(peticion_notificaciones,2000);
	}
	var peticion_notificaciones=function()
	{
		var peticion=url+"notificaciones?id_pendientes="+id_pendientes;
		console.log("Peticion: "+peticion);
		$.ajax({
				type:"GET",
				async: false,
				cache: false,
    			dataType: "jsonp",
    			jsonpCallback: 'callbacknotificaciones',
				url:peticion,
				success: function(data){
					console.log(data);
					if(data["resultado"])
					{
						if(data["listo"])
						{
							if(data["url_imagen"]!="" && data["url_imagen"]!='')
							{
								console.log("Imagen lista...");
								mostrar_imagen_compresion(data);
								datos_compresion=data;
							}
							else
								establecerIntervalo();
						}
						else
							establecerIntervalo();
					}
					else
						establecerIntervalo();
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
         			console.log("error..."+XMLHttpRequest+","+textStatus+","+errorThrown);
         			establecerIntervalo();
    			}
		}).always(function() {
  		});
	}
	/* Inicio modal generico */
	var mostrar_imagen_compresion=function(datos)
	{
		$("#exito").hide();
		$("#error").hide();
		var cadena="";
		cadena=cadena+"<table class='table'>";
		cadena=cadena+"<tr>";
			cadena=cadena+"<td>";
			cadena=cadena+"Nombre";
			cadena=cadena+"</td>";
			cadena=cadena+"<td>";
			cadena=cadena+"Original";
			cadena=cadena+"</td>";
			cadena=cadena+"<td>";
			cadena=cadena+"Comprimida";
			cadena=cadena+"</td>";
		cadena=cadena+"</tr>";
		cadena=cadena+"<tr>";
			cadena=cadena+"<td>";
			cadena=cadena+"Tamaño";
			cadena=cadena+"</td>";
			cadena=cadena+"<td>"+datos["tamano_original"]+"</td>";
			cadena=cadena+"<td>"+datos["tamano"]+"</td>";
		cadena=cadena+"</tr>";
		cadena=cadena+"<tr>";
			cadena=cadena+"<td>";
			cadena=cadena+"Link";
			cadena=cadena+"</td>";
			cadena=cadena+"<td>"+"<a href='"+datos["url_imagen_original"]+"' download>Descargar Imagen</a>"+"</td>";
			cadena=cadena+"<td>"+"<a href='"+datos["url_imagen"]+"' download>Descargar Imagen</a>"+"</td>";
		cadena=cadena+"</tr>";
		cadena=cadena+"</table>";
		mostrar_modal_generico("Imagen Comprimida",cadena);
	}
	var mostrar_modal_generico=function(titulo,contenido)
	{
		$("#modal_generico_titulo").html(titulo);
		$("#modal_generico_body").html(contenido);
		$("#modal_generico").modal("show");
	}
	var ocultar_modal_generico=function()
	{
		$("#modal_generico_titulo").html("");
		$("#modal_generico_body").html("");
		$("#modal_generico").modal("hide");
	}
	/* Fin modal generico */
}