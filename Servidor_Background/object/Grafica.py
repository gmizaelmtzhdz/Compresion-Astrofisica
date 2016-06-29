#!/usr/bin/env python
#-*- coding:utf-8 -*-
'''
  
  Created on: 2016
  Author: Mizael Martinez
  
'''
import sys
from PyQt4 import QtGui
import numpy as np
import pylab
import matplotlib.cm as cm
import Image
import sys
import os.path
from pgmagick import Image as Image_PG
import time
#/home/mizael/Descargas/grises08andromeda--a3.jpg
def main():
	if len(sys.argv)==5:
		original=""
		jpeg_2000=""
		jpeg_ls=""
		rlpe=""
		if os.path.isfile(sys.argv[1]):
			original=sys.argv[1]

		if os.path.isfile(sys.argv[2]):
			jpeg_2000=sys.argv[2]
			
		if os.path.isfile(sys.argv[3]):
			jpeg_ls=sys.argv[3]

		if os.path.isfile(sys.argv[4]):
			rlpe=sys.argv[4]
		print "RLPE[NODE]: ",rlpe

		#path = '/opt/lampp/htdocs/Compresion/Servidor_Interaccion/assets/uploads/files/bienvenida1.JPG'
		#path = '/opt/lampp/htdocs/Compresion/Servidor_Interaccion/assets/uploads/files/jpeg_ls_grisesbienvenida1463729790_1463729791.jls'
		#path = '/opt/lampp/htdocs/Compresion/Servidor_Interaccion/assets/uploads/files/jpeg_2000_grisesgalaxiaenana11463719452_1463719452.jp2'

		
		app = QtGui.QApplication(sys.argv)

		window = QtGui.QMainWindow()
		window.setWindowTitle("Visualizador de Imagenes Comprimidas")
		window.setGeometry(0, 0, 1200, 500)
		

		pic_original_texto = QtGui.QLabel(window)
		pic_original_texto.setGeometry(0, 20, 650,10)
		pic_original_texto.setText("ORIGINAL")

		pic_original = QtGui.QLabel(window)
		pic_original.setGeometry(0, 20, 650,230)
		pixmap_original = QtGui.QPixmap(original)
		pixmap_original = pixmap_original.scaledToHeight(200)
		pic_original.setPixmap(pixmap_original)





		pic_jpeg_2000_texto = QtGui.QLabel(window)
		pic_jpeg_2000_texto.setGeometry(650, 20, 650,10)
		pic_jpeg_2000_texto.setText("JPEG-2000")

		pic_jpeg_2000 = QtGui.QLabel(window)
		pic_jpeg_2000.setGeometry(650, 20, 650,230)
		pixmap_jpeg_2000 = QtGui.QPixmap(jpeg_2000)
		pixmap_jpeg_2000 = pixmap_jpeg_2000.scaledToHeight(200)
		pic_jpeg_2000.setPixmap(pixmap_jpeg_2000)







		pic_jpeg_ls_texto = QtGui.QLabel(window)
		pic_jpeg_ls_texto.setGeometry(0, 250, 650,10)
		pic_jpeg_ls_texto.setText("JPEG-LS")

		pic_jpeg_ls = QtGui.QLabel(window)
		pic_jpeg_ls.setGeometry(0, 250+20, 650,230)
		pixmap_jpeg_ls = QtGui.QPixmap(jpeg_ls)
		pixmap_jpeg_ls = pixmap_jpeg_ls.scaledToHeight(200)
		pic_jpeg_ls.setPixmap(pixmap_jpeg_ls)






		pic_rlpe_texto = QtGui.QLabel(window)
		pic_rlpe_texto.setGeometry(650, 250, 650,10)
		pic_rlpe_texto.setText("RLPE")

		pic_rlpe = QtGui.QLabel(window)
		pic_rlpe.setGeometry(650, 250+20, 650,230)
		pixmap_rlpe = QtGui.QPixmap(rlpe)
		pixmap_rlpe= pixmap_rlpe.scaledToHeight(200)
		pic_rlpe.setPixmap(pixmap_rlpe)
		
		window.show()
		sys.exit(app.exec_()) 

if __name__ == "__main__":
	main()
