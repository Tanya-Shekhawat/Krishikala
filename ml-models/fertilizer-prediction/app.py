from flask import Flask,redirect,url_for,render_template,request
import numpy as np 
import pickle
# import sklearn
import os

file_path = 'fertilizer_r_final.pkl'

if os.path.isfile(file_path):
    print("File exists")
else:
    print("File does not exist")

model = pickle.load(open('fertilizer_r_final.pkl', 'rb'))


app = Flask(__name__)   

@app.route('/')
def welcome():
    return render_template('index.html')


@app.route('/predict',methods = ["POST"])
def home():
    sy0 = float(request.form['s0'])  # Convert to float
    sy1 = float(request.form['s1'])  # Convert to float
    sy2 = float(request.form['s2'])  # Convert to float
    sy3 = float(request.form['s3'])  # Convert to float
    sy4 = float(request.form['s4'])  # Convert to float
    sy5 = float(request.form['s5'])  # Convert to float
    sy6 = float(request.form['s6'])  # Convert to float
    sy7 = float(request.form['s7'])  # Convert to float
 


    arr = np.array([[sy0,sy1,sy2,sy3,sy4,sy5,sy6,sy7]])
    pred = model.predict(arr)
    return render_template('result.html',data=pred)

if __name__ == '__main__':
    app.run(debug=True,port=3434)