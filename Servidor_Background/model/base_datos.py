# -*- encoding: utf-8 -*-
#import sys
#sys.path.append("../")
'''
  
  Created on: 2016
  Author: Mizael Martinez
  
'''
import MySQLdb
from Config import *
class BaseDatos:
	def __init__(self,hilo=False):
		self.__hilo=hilo
		self.__host=MYSQL_HOST
		self.__usuario=MYSQL_USER
		self.__contrasena=MYSQL_PASSWORD
		self.__baseDatos=MYSQL_DATABASE
		self.__conexion=None
		self.__cursor=None
		self.__query=""
		if(self.__hilo):
			self.conectar()

	def conectar(self):
		self.__conexion=MySQLdb.connect(*[self.__host,self.__usuario,self.__contrasena,self.__baseDatos])
	def consultaGenerica(self,query):
		if(not self.__hilo):
			self.conectar()
			#print "Conectar de nuevo"
		self.__cursor=self.__conexion.cursor()
		self.__cursor.execute(query)
		datos=self.__cursor.fetchall()
		if not datos:
			datos=self.__conexion.insert_id()
		self.__cursor.close()
		self.__conexion.commit()
		if not self.__hilo:
			self.__conexion.close()
		return datos
	def agregarCron(self,texto):
		query="INSERT INTO cronos(texto) VALUES('%s')"%(texto)
		return self.consultaGenerica(query) 
	def agregarCompresion(self,id_imagen,algoritmo,hora_unix,tiempo,id_pendientes,compresion_principal):
		query="INSERT INTO compresion(id_imagen,algoritmo,hora_unix,tiempo,id_pendientes,compresion_principal) VALUES('%s','%s','%s','%s','%s','%s')"%(id_imagen,algoritmo,hora_unix,tiempo,id_pendientes,compresion_principal)
		return self.consultaGenerica(query) 
	def agregarImagen(self,id_estadisticas,url,tamano):
		query="INSERT INTO imagen(id_estadisticas,url,tamano) VALUES('%s','%s','%s')"%(id_estadisticas,url,tamano)
		return self.consultaGenerica(query) 
	def agregarProceso(self,id_pendientes,id_estadisticas,url,tamano,hora_unix):
		query="INSERT INTO proceso(id_pendientes,id_estadisticas,url,tamano,hora_unix) VALUES('%s','%s','%s','%s','%s')"%(id_pendientes,id_estadisticas,url,tamano,hora_unix)
		return self.consultaGenerica(query)
	def agregarEstadisticas(self,minimo,maximo,promedio,varianza,rms,desviacion):
		query="INSERT INTO estadisticas(minimo,maximo,promedio,varianza,rms,desviacion) VALUES('%s','%s','%s','%s','%s','%s')"%(minimo,maximo,promedio,varianza,rms,desviacion)
		return self.consultaGenerica(query)

	def obtenerPendientes(self):
		query="SELECT id_pendientes, id_imagen FROM pendientes WHERE estatus='abierto'"
		return self.consultaGenerica(query)
	def establecerCerradoPendientes(self,id_pendientes):
		query="UPDATE pendientes SET estatus='cerrado' WHERE id_pendientes='%s'"%(id_pendientes)
		return self.consultaGenerica(query)
	def establecerProcesoPendientes(self,id_pendientes):
		query="UPDATE pendientes SET estatus='proceso' WHERE id_pendientes='%s'"%(id_pendientes)
		return self.consultaGenerica(query)
	def obtenerRegistroImagen(self,id_imagen):
		query="SELECT url FROM imagen WHERE id_imagen='%s'"%(id_imagen)
		return self.consultaGenerica(query)
	def reducirEstadisticas(self,id_estadisticas,porcentaje):
		query="UPDATE estadisticas SET promedio=promedio*%s, varianza=varianza*%s,rms=rms*%s,desviacion=desviacion*%s WHERE id_estadisticas=%s"%(porcentaje,porcentaje,porcentaje,porcentaje,id_estadisticas)
		return self.consultaGenerica(query)


#b=BaseDatos(False)
#b.conectar()
#print b.establecerProcesoPendientes(5)
#print b.agregarCompresion(30,"rlpe",1234, 10,-1, "secundaria")
#print b.agregarImagen(1,"prueba2.extension",1599999)
#print b.agregarProceso(1, 1, "imagen.extension",1356634, 1)

#print b.agregarEstadisticas(1,2, 1.5,3,3,2)

#print b.obtenerPendientes()
#print b.obtenerPendientes()
#for fila in b.obtenerPendientes():
#	print fila

#print b.establecerCerradoPendientes(3)
#print b.obtenerRegistroImagen(2)[0][0]
#for fila in b.obtenerRegistroImagen(2):
#	print fila[0]

#b.reducirEstadisticas(229,0.8)