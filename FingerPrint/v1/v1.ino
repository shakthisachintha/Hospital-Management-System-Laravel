#include <Adafruit_Fingerprint.h>
#include "Wire.h"

int buzzerHigh=9;
int buzzerLow=8;

int LEDHigh=10;
int red=6;
int green=12;
int blue=11;

int led(String color,int on){
  if(on==1){
    digitalWrite(LEDHigh,HIGH);
    if(color=="white"){
//      led("blue",1);  
//      led("green",1);
//      led("red",1);
      digitalWrite(red,HIGH);
      digitalWrite(green,HIGH);
      digitalWrite(blue,HIGH);
      
      digitalWrite(green,LOW);
      digitalWrite(blue,LOW);
      digitalWrite(red,LOW);
      
      
    }
    if(color=="red"){
      digitalWrite(red,LOW);
      digitalWrite(green,HIGH);
      digitalWrite(blue,HIGH);
    }
    if(color=="green"){
      digitalWrite(red,HIGH);
      digitalWrite(green,LOW);
      digitalWrite(blue,HIGH); 
    } 
    if(color=="blue"){
      digitalWrite(red,HIGH);
      digitalWrite(green,HIGH);
      digitalWrite(blue,LOW); 
    }
    
  }else if(on==0){
    digitalWrite(LEDHigh,LOW);
  }
}

int beepError(){
  digitalWrite(buzzerLow,LOW);
  digitalWrite(buzzerHigh,HIGH);
  delay(400);
  digitalWrite(buzzerHigh,LOW);
}

int beepSuccess(){
  digitalWrite(buzzerLow,LOW);
  digitalWrite(buzzerHigh,HIGH);
  delay(100);
  digitalWrite(buzzerHigh,LOW);
  delay(55);
  digitalWrite(buzzerHigh,HIGH);
  delay(100);
  digitalWrite(buzzerHigh,LOW);
}

#define DS3231_I2C_ADDRESS 0x68
byte decToBcd(byte val)
{
  return ((val / 10 * 16) + (val % 10));
}

byte bcdToDec(byte val)
{
  return ((val / 16 * 10) + (val % 16));
}

SoftwareSerial mySerial(2, 3);

Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);

  String response;
  
void setup()
{
  pinMode(buzzerHigh,OUTPUT);
  pinMode(buzzerLow,OUTPUT);
  pinMode(LEDHigh,OUTPUT);
  pinMode(11,OUTPUT);
  pinMode(12,OUTPUT);
  pinMode(6,OUTPUT);
  
  Wire.begin();

  led("white",1);
  digitalWrite(1, HIGH);
  digitalWrite(13,HIGH);
  Serial.begin(9600);
  while (!Serial)
  delay(100);
  Serial.println("\n\nAdafruit finger detect test");

  // set the data rate for the sensor serial port
  finger.begin(57600);

  if (finger.verifyPassword())
  {
    Serial.println("Found fingerprint sensor!");
  }
  else
  {
    Serial.println("Did not find fingerprint sensor :(");
    while (1)
    {
      delay(1);
      led("red",1);
    }
  }

  finger.getTemplateCount();
  Serial.print("Sensor contains ");
  Serial.print(finger.templateCount);
  Serial.println(" templates");
  Serial.println("Waiting for valid finger...");
}
int hold=false;
void loop() // run over and over again
{
  if(!hold){
    led("white",1);
  }else{
    led("blue",1);
  }
  int fingerID = getFingerprintIDez();
  if (fingerID > 0)
  {
    led("blue",1);
    beepSuccess();
    Serial.print("FIN | ");
    Serial.print(fingerID);
    Serial.print(" | ");
    displayTime();
    delay(200);
    hold=true;
  }

  delay(50); //don't ned to run this at full speed.
  
  if (Serial.available())
  {
    response = Serial.readString();
    if(response=="200")
    {
      hold=false;
      led("green",1);
      beepSuccess();
      delay(1000);  
    }
    else{
    led("red",1);
    beepError();
    hold=false;
    delay(800);  
    }
    
  }
}

uint8_t getFingerprintID()
{
  uint8_t p = finger.getImage();
  switch (p)
  {
  case FINGERPRINT_OK:
    Serial.println("Image taken");
    break;
  case FINGERPRINT_NOFINGER:
    Serial.println("No finger detected");
    return p;
  case FINGERPRINT_PACKETRECIEVEERR:
    Serial.println("Communication error");
    return p;
  case FINGERPRINT_IMAGEFAIL:
    Serial.println("Imaging error");
    return p;
  default:
    Serial.println("Unknown error");
    return p;
  }

  // OK success!

  p = finger.image2Tz();
  switch (p)
  {
  case FINGERPRINT_OK:
    Serial.println("Image converted");
    break;
  case FINGERPRINT_IMAGEMESS:
    Serial.println("Image too messy");
    return p;
  case FINGERPRINT_PACKETRECIEVEERR:
    Serial.println("Communication error");
    return p;
  case FINGERPRINT_FEATUREFAIL:
    Serial.println("Could not find fingerprint features");
    return p;
  case FINGERPRINT_INVALIDIMAGE:
    Serial.println("Could not find fingerprint features");
    return p;
  default:
    Serial.println("Unknown error");
    return p;
  }

  // OK converted!
  p = finger.fingerFastSearch();
  if (p == FINGERPRINT_OK)
  {
    Serial.println("Found a print match!");
  }
  else if (p == FINGERPRINT_PACKETRECIEVEERR)
  {
    Serial.println("Communication error");
    return p;
  }
  else if (p == FINGERPRINT_NOTFOUND)
  {
    Serial.println("Did not find a match");
    return p;
  }
  else
  {
    Serial.println("Unknown error");
    return p;
  }

  // found a match!
  Serial.print("Found ID #");
  Serial.print(finger.fingerID);
  Serial.print(" with confidence of ");
  Serial.println(finger.confidence);

  return finger.fingerID;
}

// returns -1 if failed, otherwise returns ID #
int getFingerprintIDez()
{
  uint8_t p = finger.getImage();
  if (p != FINGERPRINT_OK)
    return -1;

  p = finger.image2Tz();
  if (p != FINGERPRINT_OK)
    return -1;

  p = finger.fingerFastSearch();
  if (p != FINGERPRINT_OK)
    return -1;
  return finger.fingerID;
}

// Timer Functions
void setDS3231time(byte second, byte minute, byte hour, byte dayOfWeek, byte dayOfMonth, byte month, byte year)
{
  Wire.beginTransmission(DS3231_I2C_ADDRESS);
  Wire.write(0);                    // set next input to start at the seconds register
  Wire.write(decToBcd(second));     // set seconds
  Wire.write(decToBcd(minute));     // set minutes
  Wire.write(decToBcd(hour));       // set hours
  Wire.write(decToBcd(dayOfWeek));  // set day of week (1=Sunday, 7=Saturday)
  Wire.write(decToBcd(dayOfMonth)); // set date (1 to 31)
  Wire.write(decToBcd(month));      // set month
  Wire.write(decToBcd(year));       // set year (0 to 99)
  Wire.endTransmission();
}

void readDS3231time(byte *second, byte *minute, byte *hour, byte *dayOfWeek, byte *dayOfMonth, byte *month, byte *year)
{
  Wire.beginTransmission(DS3231_I2C_ADDRESS);
  Wire.write(0); // set DS3231 register pointer to 00h
  Wire.endTransmission();
  Wire.requestFrom(DS3231_I2C_ADDRESS, 7);
  // request seven bytes of data from DS3231 starting from register 00h
  *second = bcdToDec(Wire.read() & 0x7f);
  *minute = bcdToDec(Wire.read());
  *hour = bcdToDec(Wire.read() & 0x3f);
  *dayOfWeek = bcdToDec(Wire.read());
  *dayOfMonth = bcdToDec(Wire.read());
  *month = bcdToDec(Wire.read());
  *year = bcdToDec(Wire.read());
}

void displayTime()
{
  byte second, minute, hour, dayOfWeek, dayOfMonth, month, year;
  readDS3231time(&second, &minute, &hour, &dayOfWeek, &dayOfMonth, &month,
                 &year);

  Serial.print("20");
  Serial.print(year, DEC);
  Serial.print("-");
  Serial.print(month, DEC);
  Serial.print("-");
  Serial.print(dayOfMonth, DEC);

  // send it to the serial monitor
  Serial.print(" ");
  Serial.print(hour, DEC);
  // convert the byte variable to a decimal number when displayed
  Serial.print(":");
  if (minute < 10)
  {
    Serial.print("0");
  }
  Serial.print(minute, DEC);
  Serial.print(":");
  if (second < 10)
  {
    Serial.print("0");
  }
  Serial.print(second, DEC);
  Serial.print(" ");

  Serial.println("");
}
