from flask import Flask, request, jsonify, render_template
import numpy as np
from keras.models import load_model
from keras.preprocessing.image import ImageDataGenerator, img_to_array, load_img
from keras.applications.vgg19 import VGG19, preprocess_input, decode_predictions
import os
import uuid
import requests
import json
import base64
from precautions import precautions_for_disease

url = "https://plant.id/api/v3/health_assessment"




model = load_model('best_model.h5')

label_to_plant = {
    0: ('Apple', 'Apple Scab'),
    1: ('Apple', 'Black Rot'),
    2: ('Apple', 'Apple Rust'),
    3: ('Apple', 'Healthy'),
    4: ('Blueberry', 'Healthy'),
    5: ('Cherry', 'Powdery Mildew'),
    6: ('Cherry', 'Healthy'),
    7: ('Corn (maize)', 'Gray Leaf Spot'),
    8: ('Corn (maize)', 'Common Rust'),
    9: ('Corn (maize)', 'Leaf Blight'),
    10: ('Corn (maize)', 'Healthy'),
    11: ('Grape', 'Black Rot'),
    12: ('Grape', 'Black_Measles'),
    13: ('Grape', 'Leaf Blight'),
    14: ('Grape', 'Healthy'),
    15: ('Orange', 'Citrus greening'),
    16: ('Peach', 'Bacterial Spot'),
    17: ('Peach', 'Healthy'),
    18: ('Pepper Bell', 'Bacterial Spot'),
    19: ('Pepper Bell', 'Healthy'),
    20: ('Potato', 'Early Blight'),
    21: ('Potato', 'Late Blight'),
    22: ('Potato', 'Healthy'),
    23: ('Raspberry', 'Healthy'),
    24: ('Rice', 'Bacterial leaf blight'),
    25: ('Rice', 'Brown Spot'),
    26: ('Rice', 'Healthy'),
    27: ('Rice', 'Leaf Smut'),
    28: ('Soybean', 'Healthy'),
    29: ('Squash', 'Powdery Mildew'),
    30: ('Strawberry', 'Leaf Scorch'),
    31: ('Strawberry', 'Healthy'),
    32: ('Tomato', 'Bacterial Spot'),
    33: ('Tomato', 'Early Blight'),
    34: ('Tomato', 'Late Blight'),
    35: ('Tomato', 'Leaf Mold'),
    36: ('Tomato', 'Septoria Leaf Spot'),
    37: ('Tomato', 'Spider Mites'),
    38: ('Tomato', 'Target Spot'),
    39: ('Tomato', 'Yellow Leaf Curl Virus'),
    40: ('Tomato', 'Mosaic virus'),
    41: ('Tomato', 'Healthy'),
    42: ('Wheat', 'Healthy'),
    43: ('Wheat', 'Septoria Leaf Spot'),
    44: ('Wheat', 'Stripe Rust')
}

app = Flask(__name__)

def predictions(path):
    base64_string = ""
    with open(f"{path}", 'rb') as image_file:
        base64_bytes = base64.b64encode(image_file.read())
        base64_string = base64_bytes.decode()

    payload = json.dumps({
    "images": [f"{base64_string}"],
    "latitude": 49.207,
    "longitude": 16.608,
    "similar_images": True
    })
    headers = {
    'Api-Key': 'x9sNnVR17wN4JWnpP16uvVSXEofVJj4FCKPKiLztDRyh25mlto',
    'Content-Type': 'application/json'
    }

    response = requests.request("POST", url, headers=headers, data=payload)

    ans = json.loads(response.text)['result']['is_plant']['binary']
    
    if ans == False:
        return None
    img = load_img(path, target_size = (256, 256))
    i = img_to_array(img)
    im = preprocess_input(i)
    img = np.expand_dims(im, axis = 0)
    return np.argmax(model.predict(img))


@app.route("/", methods = ["GET", "POST"])
def upload_file(): 
    if request.method == "POST":
        # Get the uploaded image file
        uploaded_file = request.files["image"]
        if uploaded_file.filename != "":

            unique_filename = str(uuid.uuid4()) + os.path.splitext(uploaded_file.filename)[1]

            image_path = os.path.join("static", unique_filename)

            uploaded_file.save(image_path)
            uploaded_image = unique_filename

            pred = predictions(image_path)
            if pred is None:
                return render_template("predictions.html", crop_type=None, disease=None, uploaded_image = uploaded_image)
            crop_type_prediction, disease_prediction = label_to_plant[pred][0], label_to_plant[pred][1]
            if disease_prediction == "Healthy":
                return render_template("predictions.html", crop_type=crop_type_prediction, disease=disease_prediction, uploaded_image = uploaded_image, precautions = None)
            return render_template("predictions.html", crop_type=crop_type_prediction, disease=disease_prediction, uploaded_image = uploaded_image, precautions = precautions_for_disease[(crop_type_prediction, disease_prediction)])
    return render_template("disease.html")

if __name__ == '__main__':
    app.run(debug=True,port="1212")

