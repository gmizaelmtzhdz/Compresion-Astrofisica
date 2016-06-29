# -*- encoding: utf-8 -*-
'''
  
  Created on: 2016
  Author: Mizael Martinez
  
'''
import time
from base_datos import *
from Controlador import *
class Controlador_Principal:
	def __init__(self):
		self.bd=BaseDatos(False)
		print "Constructor..."
	def procesarPendiente(self,pendiente):
		id_pendientes=pendiente[0]
		id_imagen=pendiente[1]
		self.bd.establecerProcesoPendientes(id_pendientes)
		c=Controlador_Compresion()
		c.prepararCompresion(id_pendientes,id_imagen)
	def iniciar(self):
		pendientes=self.bd.obtenerPendientes()
		print pendientes
		if pendientes != 0:
			if len(pendientes) > 0:
				self.procesarPendiente(pendientes[0])
	def cron(self):
		self.bd.agregarCron(str(time.time()))