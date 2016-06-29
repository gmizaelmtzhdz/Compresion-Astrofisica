# -*- encoding: utf-8 -*-
'''
  
  Created on: 2016
  Author: Mizael Martinez
  
'''
import numpy
import time
from pgmagick import Image as Image_PG
from Config import * 
class JPEG_LS:
	def __init__(self):
		self.__tiempo=0
		print "Hola mundo"
	def convertirJPEGLS(self,nombre_imagen,nuevo_nombre,optimizado=True,calidad=100):
		#tiempo_inicio=int(time.time())
		tiempo_inicio=time.time()
		print "convert"
		resultado=False
		try:
			imagen = Image_PG(RUTA_IMAGENES+nombre_imagen)
			imagen.write(RUTA_IMAGENES+nuevo_nombre)
			resultado=True
		except Exception as e:
			print "Error...."
		#tiempo_fin=int(time.time())
		tiempo_fin=time.time()
		self.__tiempo=tiempo_fin-tiempo_inicio
		return resultado
	def getTiempo(self):
		return self.__tiempo		
#o=JPEG_LS();
#o.convertirJPEGLS("imagen.jpeg","JPEG_Ls.jls")