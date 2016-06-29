# -*- encoding: utf-8 -*-
'''
  
  Created on: 2016
  Author: Mizael Martinez
  
'''
import sys,pygame
import io,os
#import Image
from math import*
import numpy
import time
from PIL import Image
from Estadisticas import Estadisticas
from Config import *
from pgmagick import Image as Image_PG
#import glymur
#import cv2
#from skimage import data, io

class JPEG_2000:
	def __init__(self):
		self.__tiempo=0
		print "JPEG_2000.__init__()"
	def convertirJPEG2000(self,nombre_imagen,nuevo_nombre,optimizado=True,calidad=100):
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
			print e
		#tiempo_fin=int(time.time())
		tiempo_fin=time.time()
		self.__tiempo=tiempo_fin-tiempo_inicio
		return resultado
	def getTiempo(self):
		return self.__tiempo
'''
o=JPEG_2000();
o.convertirJPEG2000("imagen.jpeg","JPEG_2000.jp2")

extensiones=[".jp2",".jls"]
nombre,extension=os.path.splitext('JPEG_2000.jp2')
print nombre
print extension in extensiones
print nombre in extensiones
'''


#ima = Image.open("imagen.jpg")
#ima.save("num.jpeg")

#ima = Image("/home/mizael/Descargas/relax.jp2")
#ima = Image("imagen.jpg")
#print ima.columns()
#print ima[0][0]
#ima.quality(50)
#ima.write("generado.bmp")
#print ima;

#jp2file = "pgmagick.jp2" # just a path to a JP2 file
#jp2 = glymur.Jp2k(jp2file)
#print jp2

#img_pil = Image.open("pgmagick.jp2")
#img_pil.show()

#ima = Image_PG("optimizado.jpeg")
#jpg_bytes = ds.pixel_array.astype('uint8').tostring()
#print Image_PG
#ima.write("optimizado.jls")
#e=Estadisticas();
#e.calcularEstadisticas("optimizado.jp2")

'''
ima = Image.open("imagen.jpg")
imagen=ima.load()
ancho, alto = ima.size
for i in range(ancho):
	for j in range(alto):
		(r,g,b)= ima.getpixel((i,j))
		pix = 255
		imagen[i,j]=(pix, pix, pix)
#ima=ima.convert("L")
nombre="optimizado_2.jpeg"
ima.save(nombre,optimize=True,quality=30)


e=Estadisticas();
e.calcularEstadisticas(nombre)
print RUTA_IMAGENES
'''

#ima = Image_PG("imagen.jpeg")
#ima.write("imagen.jp2")