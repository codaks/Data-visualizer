import matplotlib.pyplot as plt
import pandas as pd
import numpy as np
import sys
   
   
class Linear:
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
        plt.xlabel(self.x)
        plt.ylabel(self.y)
        bars = data[self.x]
        y_pos = np.arange(len(bars))
        plt.plot(y_pos, height)
        plt.xticks(y_pos, bars, rotation=90)
        plt.subplots_adjust(bottom=0.4, top=0.99)
        fig.set_size_inches(18.5, 10.5)
        fig.savefig('C:/xampp/htdocs/Mini/n.png')
        

if __name__ =="__main__":
    Lin = Linear(sys.argv[1],sys.argv[2],sys.argv[3])
    Lin.plot()