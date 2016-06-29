#!/usr/bin/python
# -*- encoding: utf-8 -*-
'''
  
  Created on: 2016
  Author: Mizael Martinez
'''
import sys
sys.path.append("controller")
sys.path.append("object")
sys.path.append("model")
from Controlador_Principal import *

def main():
	controlador=Controlador_Principal()
	try:
		controlador.iniciar()
		controlador.cron()
	except KeyboardInterrupt: 
		print "KeyboardInterrupt [Interrupcion manual]"

if __name__ == '__main__':
	main()
