'''
  
  Created on: 2016
  Author: Mizael Martinez
  
'''
import numpy
from PIL import Image
import pywt
import os, time
from Config import * 
class Pre_Procesamiento:
	def __init__(self):
		self.__nueva_url=None
	def ejecutar(self,url_imagen):
		resultado=True
		try: 
			nombre,extension=os.path.splitext(url_imagen)
			self.__nueva_url=nombre+str(int(time.time()))+extension
			imagen=Image.open(RUTA_IMAGENES+url_imagen)
			array = self.convertirImagenAMatriz(imagen)
			inversa = self.wavelet(array)
			imagen=self.crearImagen(inversa,imagen.size,RUTA_IMAGENES+self.__nueva_url)
		except Exception as e:
			print "Error Pre_Procesamiento.ejecutar..."
			print e
			resultado=False
		return resultado

	def convertirImagenAMatriz(self,imagen_compresion):
		x,y = imagen_compresion.size
		cargar = imagen_compresion.load()
		matriz = list()
		for j in range(y):
			fila = list()
			for i in range(x):
				fila.append(cargar[i,j][0])
			matriz.append(fila)
		nuevo_array = numpy.array(matriz)
		return nuevo_array

	def wavelet(self,array):
		umbral=20
		umbral_negativo = -umbral
		wavelet_haar = pywt.Wavelet('haar')
		coeficientes = pywt.wavedec2(array, wavelet_haar, level=2)
		vector_1, vector_2, coheficientes = coeficientes
		nueva_lista=list()
		for item in coheficientes:
			nueva = numpy.where(((item<umbral_negativo) | (item>umbral)), item, 0)
			nueva_lista.append(nueva)
		final = list()
		final.append(vector_1)
		final.append(vector_2)
		final.append(tuple(nueva_lista))
		compresion_t = pywt.waverec2(final, 'haar')
		compresion_b = compresion_t.astype(int)
		return compresion_b

	def crearImagen(self,arreglo,tamano,nueva_url):
		ancho,largo = tamano
		lista = list()
		for e in arreglo:
			fila = list()
			for valor in e:
				fila.append((int(valor),int(valor),int(valor)))
			lista.append(fila)

		nueva = Image.new('RGB',(ancho,largo))
		for j in range(largo):
			for i in range(ancho):
				nueva.putpixel((i,j),lista[j][i])
		nueva.save(nueva_url)
		return nueva
	def getNuevaUrl(self):
		return self.__nueva_url

#o=Pre_Procesamiento()
#print o.ejecutar("imagen.jpeg")
#print o.getNuevaUrl()