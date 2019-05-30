import matplotlib.pyplot as plt
import pandas as pd
import numpy as np
import sys
   
   
class Scatter:
    def __init__(self,file,x,y):
        self.x = x
        self.y = y
        self.file = file
        
    def printv(self):
        print(self.x," ",self.y," ",self.file)
        
    def plot(self):
        data = pd.read_csv(self.file)
        fig = plt.figure()
        height = data[self.y]
        bars = data[self.x]
        plt.xlabel(self.x)
        plt.ylabel(self.y)
        y_pos = np.arange(len(bars))
        plt.plot(y_pos, height,'ro')
        plt.xticks(y_pos, bars, rotation=90)
        plt.subplots_adjust(bottom=0.4, top=0.99)
        fig.set_size_inches(18.5, 10.5)
        fig.savefig('C:/xampp/htdocs/Mini/n.png')
        

if __name__ =="__main__":
    sct = Scatter(sys.argv[1],sys.argv[2],sys.argv[3])
    sct.plot()