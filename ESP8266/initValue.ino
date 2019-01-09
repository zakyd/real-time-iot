
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

#include "DHT.h"
#define DHTPIN 2
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);
 
 
void setup () {
 
  Serial.begin(9600);
//  WiFi.begin("Bos Es", "Suyanto14045:*");
  WiFi.begin("Zaky D.", "blaszczykowski");
 
  while (WiFi.status() != WL_CONNECTED) {
 
    delay(1000);
    Serial.print("Connecting..");
 
  }
  
  dht.begin();
 
}
 
void loop() {
  
  float h = dht.readHumidity();
  float t = dht.readTemperature();
 
  if (WiFi.status() == WL_CONNECTED) { //Check WiFi connection status
 
    HTTPClient http;  //Declare an object of class HTTPClient
    String url = "http://192.168.43.77:8000/add-value?temperature="+String(t)+"&humidity="+String(h);
//    String url = "http://172.30.37.197:8000/add-value?temperature="+String(t)+"&humidity="+String(h);
//    Serial.println("url");
    Serial.println(url);   
    http.begin(url);  //Specify request destination
    int httpCode = http.GET();                                                                  //Send the request
 
    if (httpCode > 0) { //Check the returning code
 
      String payload = http.getString();   //Get the request response payload
      Serial.println(payload);                     //Print the response payload
 
    }
 
    http.end();   //Close connection
 
  }
  
  Serial.print("Humidity: ");
  Serial.print(h);
  Serial.print("\n");
  Serial.print("Temperature: ");
  Serial.print(t);
  Serial.print(" *C ");
  Serial.print("\n==================\n");
  delay(2000);    //Send a request every 10 seconds
 
}
