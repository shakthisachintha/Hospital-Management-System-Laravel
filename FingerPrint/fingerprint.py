import serial
import requests
import json

SERIAL_PORT = 'COM14'
# be sure to set this to the same rate used on the Arduino
SERIAL_RATE = 9600

ser = serial.Serial(SERIAL_PORT, SERIAL_RATE)
while True:
    # using ser.readline() assumes each line contains a single reading
    # sent using Serial.println() on the Arduino
    reading = ser.readline().decode('utf-8')
    # reading is a string...do whatever you want from here
    print(reading)
    parts = reading.split(" | ")
    if(parts[0] == "FIN"):
        print(f"Finger Print Found User ID {parts[1]} On {parts[2]}")
        # api-endpoint
        URL = "http://localhost:8000/attendance"

        # defining a params dict for the parameters to be sent to the API
        PARAMS = {'time': parts[2],'finger':parts[1]}

        # sending get request and saving the response as response object
        r = requests.get(url=URL, params=PARAMS)

        # extracting data in json format
        response=json.loads(r.text)
        print(r.text)
        if (response['status']==200):
            ser.write("200".encode())
            print(response['status'])
            print(response['name'])
        else:
            ser.write("500".encode())
