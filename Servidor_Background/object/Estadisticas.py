# -*- encoding: utf-8 -*-
'''
  
  Created on: 2016
  Author: Mizael Martinez
  
'''
from PIL import Image
import inspect, sys, os,numpy, math
from Config import * 
class Estadisticas:
	def __init__(self):
		self.__url_imagen=None
		self.__arreglo_imagen=None
		self.__tamano=None
		self.__minimo=None
		self.__maximo=None
		self.__promedio=None
		self.__varianza=None
		self.__desviacion_estandar=None
		self.__rms=lambda V, axis=None: numpy.sqrt(numpy.mean(numpy.square(V), axis))
	def calcularEstadisticas(self,url_imagen):
		resultado=True
		print url_imagen
		try:
			if(url_imagen!="" or url_imagen!=''):
				self.__url_imagen=url_imagen
				imagen=Image.open(url_imagen)
				imagen.load()
				self.__arreglo_imagen=numpy.asarray(imagen,dtype="int32")
				self.__tamano=self.calcularTamano()
				self.__minimo=self.calcularMinimo()
				self.__maximo=self.calcularMaximo()
				self.__promedio=self.calcularPromedio()
				self.__varianza=self.calcularVarianza()
				self.__desviacion_estandar=self.calcularDesviacionEstandar()
				self.__rms=self.calcularRMS()
		except Exception as e:
			print "Error en Estadisticas.calcularEstadisticas()..."
			print e
			resultado=False
		return resultado
	def calcularTamano(self):
		return int(os.stat(self.__url_imagen).st_size)
	def calcularMinimo(self):
		return numpy.amin(self.__arreglo_imagen)
	def calcularMaximo(self):
		return numpy.amax(self.__arreglo_imagen)
	def calcularPromedio(self):
		return numpy.nanmean(self.__arreglo_imagen)
	def calcularVarianza(self):
		return numpy.nanvar(self.__arreglo_imagen)
	def calcularDesviacionEstandar(self):
		return numpy.nanstd(self.__arreglo_imagen)
	def calcularRMS(self):
		return self.__rms(self.__arreglo_imagen)
		'''
		if self.__promedio == 0:
			self.__rms=0
		else:
			self.__rms=math.sqrt(self.__promedio)
		return self.__rms
		'''
	def getTamano(self):
		return self.__tamano
	def getMinimo(self):
		return self.__minimo
	def getMaximo(self):
		return self.__maximo
	def getPromedio(self):
		return self.__promedio
	def getVarianza(self):
		return self.__varianza
	def getDesviacionEstandar(self):
		return self.__desviacion_estandar
	def getRMS(self):
		return self.__rms
	def getEstadisticas(self):
		return {"tamano":self.getTamano(),"minimo":self.getMinimo(),"maximo":self.getMaximo(),"promedio":self.getPromedio(),"varianza":self.getVarianza(),"desviacion_estandar":self.getDesviacionEstandar(),"rms":self.getRMS()}
	def setUrlImagen(self,url_imagen):
		self.__url_imagen=url_imagen
'''
o=Estadisticas()
print o.calcularEstadisticas("imagen.jpeg")
print o.getMinimo()
print o.getMaximo()
print o.getPromedio()
print o.getVarianza()
print o.getDesviacionEstandar()
print o.getRMS()
print o.getEstadisticas()["maximo"]
'''