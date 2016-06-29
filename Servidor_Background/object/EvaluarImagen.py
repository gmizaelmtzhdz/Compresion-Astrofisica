# -*- encoding: utf-8 -*-
'''
  
  Created on: 2016
  Author: Mizael Martinez
  
'''
from pgmagick import Image as Image_PG
from PIL import Image
from Config import *
import os, time
class EvaluarImagen:
	def __init__(self):
		self.__extensiones=[".jp2",".jls"]
		self.__nueva_url=None
	def evaluar(self,url_imagen):
		resultado=True
		self.__nueva_url=url_imagen
		try:	
			nombre,extension=os.path.splitext(url_imagen)
			if(extension in self.__extensiones):
				self.__nueva_url=nombre+str(int(time.time()))+".jpeg"
				imagen = Image_PG( RUTA_IMAGENES + url_imagen)
				imagen.write(RUTA_IMAGENES+ self.__nueva_url)
			imagen=Image.open(RUTA_IMAGENES+self.__nueva_url)
			imagen=self.escalaGrises(imagen)
			self.__nueva_url="grises"+self.__nueva_url
			imagen.save(RUTA_IMAGENES+self.__nueva_url,optimize=True,quality=100)
		except Exception as e:
			print "Error EvaluarImagen.evaluar..."
			print e
			resultado=False
		return resultado
	def escalaGrises(self,imagen):
		x, y = imagen.size
		px = imagen.load()
		imagenGrises = Image.new('RGB',(x,y))
		for i in range(x):
			for j in range(y):
				pixeles = px[i,j]
				prom = sum(pixeles) / 3
				imagenGrises.putpixel((i,j),(prom,prom,prom))
		return imagenGrises
	def getNuevaUrl(self):
		return self.__nueva_url

#o=EvaluarImagen()
#print o.evaluar("pgmagick.jp2")
#print o.evaluar("pgmagick.bmp")
#print o.getNuevaUrl()