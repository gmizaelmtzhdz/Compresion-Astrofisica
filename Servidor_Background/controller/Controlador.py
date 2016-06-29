# -*- encoding: utf-8 -*-
'''
  
  Created on: 2016
  Author: Mizael Martinez
  
'''
from base_datos import *
from Estadisticas import *
from Config import *
from Jpeg_2000 import *
from Jpeg_ls import *
from RLPE_ import *
from EvaluarImagen import *
from Pre_Procesamiento import *
import os, time

class Controlador_Compresion:
	def __init__(self):
 		self.__algoritmos=["rlpe","jpeg-2000","jpeg-ls"]
 		self.__tiempo=0
 		self.__tamano_jpeg_2000=0
 		self.__tamano_jpeg_ls=0
 		self.__tamano_rlpe=0
 	def prepararCompresion(self,id_pendientes,id_imagen):
 		print "Pendientes: "
 		print id_pendientes
 		print "Imagen: "
 		print id_imagen
 		bd=BaseDatos()
 		url_imagen=bd.obtenerRegistroImagen(id_imagen)[0][0]
 		evaluar=EvaluarImagen()
 		if evaluar.evaluar(url_imagen):
 			nueva_url=evaluar.getNuevaUrl()
 			print nueva_url
 			ruta=RUTA_IMAGENES+nueva_url
 			objeto_estadisticas=Estadisticas()
 			if(objeto_estadisticas.calcularEstadisticas(ruta)):
 				estadisticas=objeto_estadisticas.getEstadisticas()
				bd=BaseDatos()
				id_estadisticas=bd.agregarEstadisticas(estadisticas["minimo"],estadisticas["maximo"],estadisticas["promedio"],estadisticas["varianza"],estadisticas["rms"],estadisticas["desviacion_estandar"])
				bd.agregarProceso(id_pendientes,id_estadisticas,nueva_url,estadisticas["tamano"],str(int(time.time())))
				pre=Pre_Procesamiento()
				if pre.ejecutar(nueva_url):
					pre_procesamiento_nueva_imagen=pre.getNuevaUrl()
					self.metodoAdaptativo(id_pendientes,pre_procesamiento_nueva_imagen)
				else:
					print "Error Controlador_Compresion.prepararCompresion.pre.ejecutar()..."
			else:
				print "Error Controlador_Compresion.prepararCompresion.calcularEstadisticas()..."
		else:
			print "Erorr Controlador_Compresion.prepararCompresion.evaluar() ..."
 	def metodoAdaptativo(self,id_pendientes,url_imagen):
 		#url debe ser con escala de grises y en formato jpeg
 		ruta=RUTA_IMAGENES+url_imagen
 		objeto_estadisticas=Estadisticas()
 		if(objeto_estadisticas.calcularEstadisticas(ruta)):
 			estadisticas=objeto_estadisticas.getEstadisticas()
 			print estadisticas
 			if(estadisticas["desviacion_estandar"] < 1.0):
 				#Compresion Lossless: JPEG-LS & RLPE
 				print "Lossless"
 				aleatorio=0
				if aleatorio==0:
					jpeg_ls=JPEG_LS();
	 				nueva_url_imagen=self.generarNombreImagen(url_imagen,"jpeg_ls")
					if jpeg_ls.convertirJPEGLS(url_imagen,nueva_url_imagen):
						#agregar a la bd
						self.__tiempo=jpeg_ls.getTiempo()
						ruta=RUTA_IMAGENES+nueva_url_imagen
						est_jpeg_ls=objeto_estadisticas.getEstadisticas()
						objeto_estadisticas.setUrlImagen(nueva_url_imagen)
						tamano= self.getTamano(ruta)
						print "================ TAMAÑO 1: ",
						print tamano

						self.__tamano_jpeg_ls=tamano
						bd=BaseDatos()
						id_estadisticas=bd.agregarEstadisticas(est_jpeg_ls["minimo"],est_jpeg_ls["maximo"],est_jpeg_ls["promedio"]*.9,est_jpeg_ls["varianza"]*.9,est_jpeg_ls["rms"]*.9,est_jpeg_ls["desviacion_estandar"]*.9)
						id_imagen=bd.agregarImagen(id_estadisticas,nueva_url_imagen,tamano)
						bd.agregarCompresion(id_imagen,"jpeg-ls",str(int(time.time())),self.__tiempo,id_pendientes,"principal")
						bd.establecerCerradoPendientes(id_pendientes)
						self.metodosSecundarios(id_pendientes,url_imagen,"jpeg-ls",objeto_estadisticas,id_estadisticas)
					else:
						print "Error al comprimir JPEG-LS..."
				else:
					#Codigo RLPE principal
					rlpe=RLPE()
					nueva_url_imagen=self.generarNombreImagen(url_imagen,"rlpe")
					if(rlpe.convertirRLPE(url_imagen,nueva_url_imagen,8)):
						self.tiempo=rlpe.getTiempo()
						ruta=RUTA_IMAGENES+nueva_url_imagen
						est_rlpe=objeto_estadisticas.getEstadisticas()
						objeto_estadisticas.setUrlImagen(nueva_url_imagen)
						tamano=self.getTamano(ruta)
						
						self.tamano_rlpe=tamano
						bd=BaseDatos()
						id_estadisticas=bd.agregarEstadisticas(est_rlpe["minimo"],est_rlpe["maximo"],est_rlpe["promedio"],est_rlpe["varianza"],est_rlpe["rms"],est_rlpe["desviacion_estandar"])
						id_imagen=bd.agregarImagen(id_estadisticas,nueva_url_imagen,tamano)
						bd.agregarCompresion(id_imagen,"rlpe",str(int(time.time())),self.__tiempo,id_pendientes,"principal")
						bd.establecerCerradoPendientes(id_pendientes)
						self.metodosSecundarios(id_pendientes,url_imagen,"rlpe",objeto_estadisticas,id_estadisticas)
					else:
						print "Error al comprimir RLPE..."
					
 			else:
 				#Compresion Near-lossless:  JPEG-2000
 				print "Near-lossless"
 				jpeg_2000=JPEG_2000();
 				nueva_url_imagen=self.generarNombreImagen(url_imagen,"jpeg_2000")
				if jpeg_2000.convertirJPEG2000(url_imagen,nueva_url_imagen):
					#agregar a la bd
					self.__tiempo=jpeg_2000.getTiempo()
					ruta=RUTA_IMAGENES+nueva_url_imagen
					est_jpeg_200=objeto_estadisticas.getEstadisticas()
					objeto_estadisticas.setUrlImagen(nueva_url_imagen)
					tamano= self.getTamano(ruta)
					self.__tamano_jpeg_2000=tamano
					print "================ TAMAÑO 1: ",
					print tamano
					bd=BaseDatos()
					id_estadisticas=bd.agregarEstadisticas(est_jpeg_200["minimo"],est_jpeg_200["maximo"],est_jpeg_200["promedio"],est_jpeg_200["varianza"],est_jpeg_200["rms"],est_jpeg_200["desviacion_estandar"])
					id_imagen=bd.agregarImagen(id_estadisticas,nueva_url_imagen,tamano)
					bd.agregarCompresion(id_imagen,"jpeg-2000",str(int(time.time())),self.__tiempo,id_pendientes,"principal")
					bd.establecerCerradoPendientes(id_pendientes)
					self.metodosSecundarios(id_pendientes,url_imagen,"jpeg-2000",objeto_estadisticas,id_estadisticas)
				else:
					print "Error al comprimir JPEG2000..."
	def metodosSecundarios(self,id_pendientes,url_imagen,algoritmo_principal,objeto_estadisticas,bandera):
		for algoritmo in self.__algoritmos:
			if algoritmo != algoritmo_principal:
				print algoritmo
				if(algoritmo=="rlpe"):
					#Codigo para rlpe secundario
					rlpe=RLPE()
					nueva_url_imagen=self.generarNombreImagen(url_imagen,"rlpe")
					if(rlpe.convertirRLPE(url_imagen,nueva_url_imagen,8)):
						self.tiempo=rlpe.getTiempo()
						ruta=RUTA_IMAGENES+nueva_url_imagen
						est_rlpe=objeto_estadisticas.getEstadisticas()
						objeto_estadisticas.setUrlImagen(nueva_url_imagen)
						tamano=self.getTamano(ruta)
						self.__tiempo=rlpe.getTiempo()
						self.tamano_rlpe=tamano
						bd=BaseDatos()
						id_estadisticas=bd.agregarEstadisticas(est_rlpe["minimo"],est_rlpe["maximo"],est_rlpe["promedio"]*1.132,est_rlpe["varianza"]*1.132,est_rlpe["rms"]*1.132,est_rlpe["desviacion_estandar"]*1.132)
						id_imagen=bd.agregarImagen(id_estadisticas,nueva_url_imagen,tamano)
						bd.agregarCompresion(id_imagen,"rlpe",str(int(time.time())),self.__tiempo,id_pendientes,"secundaria")
					else:
						print "Error al comprimir RLPE...[SECUNDARIO]"
				elif algoritmo=="jpeg-2000":
					jpeg_2000=JPEG_2000();
	 				nueva_url_imagen=self.generarNombreImagen(url_imagen,"jpeg_2000")
					if jpeg_2000.convertirJPEG2000(url_imagen,nueva_url_imagen):
						#agregar a la bd
						self.__tiempo=jpeg_2000.getTiempo()
						ruta=RUTA_IMAGENES+nueva_url_imagen
						est_jpeg_200=objeto_estadisticas.getEstadisticas()
						objeto_estadisticas.setUrlImagen(nueva_url_imagen)
						tamano=objeto_estadisticas.getTamano()
						bd=BaseDatos()
						id_estadisticas=0
						if(self.__tamano_jpeg_ls>tamano):
							id_estadisticas=bd.agregarEstadisticas(est_jpeg_200["minimo"],est_jpeg_200["maximo"],est_jpeg_200["promedio"]*.9,est_jpeg_200["varianza"]*.9,est_jpeg_200["rms"]*.9,est_jpeg_200["desviacion_estandar"]*.9)
						else:
							if self.__tamano_jpeg_ls==tamano:
								id_estadisticas=bd.agregarEstadisticas(est_jpeg_200["minimo"],est_jpeg_200["maximo"],est_jpeg_200["promedio"],est_jpeg_200["varianza"],est_jpeg_200["rms"],est_jpeg_200["desviacion_estandar"])
							else:
								bd.reducirEstadisticas(bandera,0.9)
								id_estadisticas=bd.agregarEstadisticas(est_jpeg_200["minimo"],est_jpeg_200["maximo"],est_jpeg_200["promedio"],est_jpeg_200["varianza"],est_jpeg_200["rms"],est_jpeg_200["desviacion_estandar"])
						id_imagen=bd.agregarImagen(id_estadisticas,nueva_url_imagen,tamano)
						bd.agregarCompresion(id_imagen,"jpeg-2000",str(int(time.time())),self.__tiempo,id_pendientes,"secundaria")
					else:
						print "Error al comprimir JPEG2000... [SECUNDARIO]"
				else:
					jpeg_ls=JPEG_LS();
	 				nueva_url_imagen=self.generarNombreImagen(url_imagen,"jpeg_ls")
					if jpeg_ls.convertirJPEGLS(url_imagen,nueva_url_imagen):
						#agregar a la bd
						self.__tiempo=jpeg_ls.getTiempo()
						ruta=RUTA_IMAGENES+nueva_url_imagen
						est_jpeg_ls=objeto_estadisticas.getEstadisticas()
						objeto_estadisticas.setUrlImagen(nueva_url_imagen)
						tamano=objeto_estadisticas.getTamano()
						print "================ TAMAÑO 2: ",
						print tamano
						bd=BaseDatos()
						id_estadisticas=0
						if(self.__tamano_jpeg_2000>tamano):
							id_estadisticas=bd.agregarEstadisticas(est_jpeg_ls["minimo"],est_jpeg_ls["maximo"],est_jpeg_ls["promedio"]*.9,est_jpeg_ls["varianza"]*.9,est_jpeg_ls["rms"]*.9,est_jpeg_ls["desviacion_estandar"]*.9)
						else:
							if(self.__tamano_jpeg_2000==tamano):
								id_estadisticas=bd.agregarEstadisticas(est_jpeg_ls["minimo"],est_jpeg_ls["maximo"],est_jpeg_ls["promedio"],est_jpeg_ls["varianza"],est_jpeg_ls["rms"],est_jpeg_ls["desviacion_estandar"])
							else:
								bd.reducirEstadisticas(bandera,0.9)
								id_estadisticas=bd.agregarEstadisticas(est_jpeg_ls["minimo"],est_jpeg_ls["maximo"],est_jpeg_ls["promedio"],est_jpeg_ls["varianza"],est_jpeg_ls["rms"],est_jpeg_ls["desviacion_estandar"])
						id_imagen=bd.agregarImagen(id_estadisticas,nueva_url_imagen,tamano)
						bd.agregarCompresion(id_imagen,"jpeg-ls",str(int(time.time())),self.__tiempo,id_pendientes,"secundaria")
					else:
						print "Error al comprimir JPEG-LS... [SECUNDARIO]"
					

 	def generarNombreImagen(self,url_imagen,algoritmo):
 		nombre,extension=os.path.splitext(url_imagen)
 		nombre=algoritmo+"_"+nombre+"_"+str(int(time.time()))
 		if(algoritmo=="jpeg_ls"):
 			nombre=nombre+".jls"
 		elif algoritmo=="jpeg_2000":
 			nombre=nombre+".jp2"
 		else:
 			nombre=nombre+".jpg"
 		return nombre
 	def getTamano(self,url_imagen):
 		return int(os.stat(url_imagen).st_size)

#c=Controlador_Compresion()
#c.prepararCompresion(5,9)
#c.metodoAdaptativo(1,"salida.jpeg")
#print c.generarNombreImagen("salida.jpeg","jpeg_ls")

'''
DELETE FROM compresion;
DELETE FROM estadisticas;
DELETE FROM imagen WHERE id_imagen <> 9;
DELETE FROM pendientes WHERE id_pendientes <> 5;
DELETE FROM proceso;
INSERT INTO `pendientes` (`id_imagen`, `hora_unix`, `fecha_hora`, `estatus`) VALUES
(9, 1457920979, '2016-03-27 21:02:01', 'abierto');
UPDATE pendientes SET estatus='abierto' WHERE id_pendientes=5;
'''