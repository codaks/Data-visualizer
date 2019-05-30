# -*- coding: utf-8 -*-
"""
Created on Thu Apr  4 10:00:47 2019

@author: piyus
"""
import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import sys
def totuple(a):
    try:
        return tuple(totuple(i) for i in a)
    except TypeError:
        return a

def main():
    file="cereal_breakfast.csv"
    dataset=pd.read_csv("cereal_breakfast.csv")
    program_name = sys.argv[0]
    arguments = sys.argv[1:]
    count = len(arguments)
    X=[]
    for x in sys.argv:
        X.append(x)
     
    ob=Barplot(X[1],X[2],X[3])
  
    if X[4]=='bar':
        ob.bar()
    elif X[4]=='scatplot':
        ob.scatplot()
    elif X[4]=='plot':
        ob.plot()
    elif X[4]=='stackbar':   
        ob.stackbar()
    elif X[4]=='stackplot':   
        ob.stackplot()
    elif X[4]=='barh':   
        ob.barh()    
class Barplot:
    def __init__(self,file,x,y):
        self.x = x
        self.y = y
        self.file = file
        type(self.x)
        type(self.y)
    def plot(self):
        data = pd.read_csv(self.file)
        x = data[self.x]
        y = data[self.y]
        fig, ax = plt.subplots()
        y_pos = np.arange(len(x))
        ax.plot(x,y)
        plt.xlabel(self.x)
        plt.ylabel(self.y)
        plt.xticks(y_pos, x, rotation=90)
        plt.xlabel(self.x)
        plt.ylabel(self.y)
        ax.grid(True)
        plt.show() 
    def bar(self):
        data = pd.read_csv(self.file)
        fig = plt.figure()
        height = data[self.y]
        bars = data[self.x]
        plt.xlabel(self.x)
        plt.ylabel(self.y)
        y_pos = np.arange(len(bars))
        plt.bar(y_pos, height)
        plt.xticks(y_pos, bars, rotation=90)
        plt.subplots_adjust(bottom=0.4, top=0.99)
        fig.set_size_inches(18, 10.5)
        plt.show()
    def scatplot(self):
         data = pd.read_csv(self.file)
         bars = data[self.x]
         height = data[self.y]
         fig = plt.figure()
         plt.scatter(bars,height,alpha=0.5)
         plt.xlabel(self.x, rotation=90)
         plt.ylabel(self.y)
         plt.grid(True)
         plt.xlabel(self.x)
         plt.ylabel(self.y)
         plt.xticks(y_pos, bars, rotation=90)
         fig.set_size_inches(18, 10.5)
         fig.savefig('C:/xampp/htdocs/Mini/n.png')
    def stackbar(self):
         width = 0.35       
         data = pd.read_csv(self.file)
         x = data[self.x]
         y = data[self.y]
         x=np.array(x)
         y=np.array(y)
         plt.xlabel(self.x)
         plt.ylabel(self.y)
         N=len(x)
         fig = plt.figure()
         ind = np.arange(N) 
         x=totuple(x)
         y=totuple(y)
         p1=plt.bar(ind, x, width)
         p2=plt.bar(ind,y, width,bottom=x)
         plt.legend((p1[0], p2[0]), (self.x,self.y))
         fig.savefig('C:/xampp/htdocs/Mini/n.png')
    def stackplot(self):
         data = pd.read_csv(self.file)
         x = data[self.x]
         y = data[self.y]
         x=np.array(x)
         plt.xlabel(self.x)
         plt.ylabel(self.y)
         y=np.array(y)
         y = np.vstack([x,y])
         fig, ax = plt.subplots()
         ax.stackplot(x, y)
         plt.show()
    def barh(self):
         data = pd.read_csv(self.file)
         height = data[self.x]
         bars = data[self.y]
         plt.xlabel(self.x)
         plt.ylabel(self.y)
         y_pos = np.arange(len(bars))
         plt.barh(y_pos, height)
         plt.yticks(y_pos, bars)
         plt.show()


if __name__ =="__main__":
     main()
     
     
     
     

     
     
     
     

     
     
     
     
     
     
     
     
     
     
     
     
     
     