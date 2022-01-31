import pickle
import numpy as np 

model = pickle.load(open('model.pkl','rb'))
print(model)

inputt = []
para = ['Temprature','Humidity','Moisture']
i = 0
while i<3:
  inputt.append(int(input("Enter Value of "+para[i]+" : ")))
  i=i+1 
# print(inputt)
final=[np.array(inputt)]
b = model.predict_proba(final)
no_disease ='{0:.{1}f}'.format(b[0][2], 2)
blight ='{0:.{1}f}'.format(b[0][0], 2)
mildew ='{0:.{1}f}'.format(b[0][1], 2)
stem_gall ='{0:.{1}f}'.format(b[0][3], 2)
dt  = []
print("Blight : ",float(blight)*100,"%")
print("Mildew : ",float(mildew)*100,"%")
print("Steam Gall : ",float(stem_gall)*100,"%")
print("NO Disease : ",float(no_disease)*100,"%")