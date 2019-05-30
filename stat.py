# -*- coding: utf-8 -*-
"""
Created on Wed Apr 10 22:01:49 2019

@author: piyus
"""
import statistics
import pandas as pd
import sys
def main():
    
    program_name = sys.argv[0]
    arguments = sys.argv[1:]
    count = len(arguments)
    X=[]
    for x in sys.argv:
        X.append(x)
        
    ob=stat(X[1],X[2])
    mean = ob.mean()
    print(mean," ")
    mode = ob.mode()
    print(mode," ")
    median = ob.median()
    print(median," ")

class stat:
    def __init__(self,file,x):
        self.x = x
        self.file = file
        type(self.x)
           
    def mean(self):
        data = pd.read_csv(self.file)
        x = data[self.x]
        return statistics.mean(x) 
    def mode(self):
        data = pd.read_csv(self.file)
        x = data[self.x]
        return statistics.mode(x)
    def median(self):
        data = pd.read_csv(self.file)
        x = data[self.x]
        return statistics.median(x)
    def variance(self):
        data = pd.read_csv(self.file)
        x = data[self.x]
        return statistics.variance(x)
if __name__=="__main__":
    main()    
    
    