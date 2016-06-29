# -*- encoding: utf-8 -*-
'''
  
  Created on: 2016
  Author: Mizael Martinez
  
'''
from base_datos import *
import threading
from time import sleep
import time
from Controlador import * 

def main():
    t = Test()
    t.go()
    try:
        join_threads(t.threads)
    except KeyboardInterrupt:
        print "\nKeyboardInterrupt catched."

class Test(object):
    def __init__(self):
        self.running = True
        self.threads = []
        self.contador=0
        self.bd=BaseDatos(True)
    def procesarPendiente(self,pendiente):
    	id_pendiente=pendiente[0]
    	id_imagen=pendiente[1]
    	c=Controlador_Compresion()
    	c.prepararCompresion(id_pendiente,id_imagen)
    def foo(self):
        while(self.running):
        	pendientes=self.bd.obtenerPendientes()
        	print pendientes,
        	print len(pendientes)
        	if pendientes != 0:
        		for pendiente in pendientes:
        			hora=str(time.time())
        			hilo = threading.Thread(target=self.procesarPendiente,name=hora,args=(pendiente,))
        			hilo.daemon=True
        			hilo.start()
        			self.threads.append(hilo)
        	sleep(1)

    def get_user_input(self):
        while True:
            x = raw_input("Enter 'e' for exit: ")
            if x.lower() == 'e':
               self.running = False
               break

    def go(self):
		hora=str(time.time())
		hilo = threading.Thread(target=self.foo,name=hora)
		hilo.daemon = True
		hilo.start()
		self.threads.append(hilo)


def join_threads(threads):
    for t in threads:
        while t.isAlive():
            t.join(5)


if __name__ == "__main__":
    main()