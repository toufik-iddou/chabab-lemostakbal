#include <WiFi.h>
#include <HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>
#include <stdlib.h>
#define SS_PIN 21   // Define the SDA (SS) pin
#define RST_PIN 22  // Define the RST pin
#define RED 2
#define GREEN 15
#define BUZZER 4
byte readCard[4];

String tagID = "";
long tagIdDecimal = 0;
// Create instances
MFRC522 mfrc522(SS_PIN, RST_PIN);

const char *ssid = "Galaxy M33 5G 94C9";
const char *password = "1234432100";
const char *serverUrl = "http://192.168.21.146/chabab-elmostakbal/controllers/pointing.php";

void setup() {
  Serial.begin(9600);
  SPI.begin();
  mfrc522.PCD_Init();  // MFRC522
  pinMode(RED,OUTPUT);
  pinMode(GREEN,OUTPUT);
  pinMode(BUZZER,OUTPUT);
  Serial.begin(9600);
  // Connect to Wi-Fi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");

}

void loop() {
//Wait until new tag is available
  digitalWrite(RED,HIGH);
  while (getID()) {

    tagIdDecimal = hexStringToDecimal(tagID);
    Serial.println(tagIdDecimal);
  digitalWrite(RED,LOW);
  digitalWrite(GREEN,HIGH);
  tone(BUZZER, 1000); 
  delay(1000);  
  digitalWrite(RED,HIGH);
  digitalWrite(GREEN,LOW);
  digitalWrite(BUZZER,LOW);
  noTone(BUZZER);     
  String postData = "user=" + String(tagIdDecimal);
 
  makePostRequest(postData);
  delay(5000);
 
  }
  

  
}

void makePostRequest(String postData) {
  HTTPClient http;

  // Begin the HTTP request
  http.begin(serverUrl);

  // Set the content type
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  // Make the POST request
  int httpResponseCode = http.POST(postData);

  // Check for a successful response
  if (httpResponseCode > 0) {
    Serial.print("HTTP Response Code: ");
    Serial.println(httpResponseCode);

    String response = http.getString();
    Serial.println("Server response: " + response);
  } else {
    Serial.print("HTTP Request failed. Error code: ");
    Serial.println(httpResponseCode);
  }

  // End the request
  http.end();
}

//Read new tag if available
boolean getID() {

  // Getting ready for Reading PICCs
  if (!mfrc522.PICC_IsNewCardPresent()) {  //If a new PICC placed to RFID reader continue
    return false;
  }
  if (!mfrc522.PICC_ReadCardSerial()) {  //Since a PICC placed get Serial and continue
    return false;
  }
  tagID = "";
  for (uint8_t i = 0; i < 4; i++) {  // The MIFARE PICCs that we use have 4 byte UID
    //readCard[i] = mfrc522.uid.uidByte[i];
    tagID.concat(String(mfrc522.uid.uidByte[i], HEX));  // Adds the 4 bytes in a single String variable
  }
  tagID.toUpperCase();
  mfrc522.PICC_HaltA();  // Stop reading
  return true;
}


long hexStringToDecimal(String hexString) {
  // Convert hex string to decimal
  char *endPtr;  // Pointer to character after the last valid character in the string
  long decimalValue = strtol(hexString.c_str(), &endPtr, 16);

  // Check for conversion errors
  if (*endPtr != '\0') {
    Serial.println("Error: Invalid hexadecimal string");
    return 0;
  }

  return decimalValue;
}