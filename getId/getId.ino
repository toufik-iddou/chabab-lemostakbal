#include <SPI.h>
#include <MFRC522.h>
#include <stdlib.h>

#define RST_PIN 9
#define SS_PIN 10

byte readCard[4];


String tagID = "";
// char idList=["",""]
long tagIdDecimal = 0;

// Create instances
MFRC522 mfrc522(SS_PIN, RST_PIN);


void setup() {
  // Initiating
  SPI.begin();         // SPI bus
  mfrc522.PCD_Init();  // MFRC522
  // pinMode(RED, OUTPUT);
  // pinMode(GREEN, OUTPUT);
  Serial.begin(9600);
}

void loop() {

  //Wait until new tag is available
  while (getID()) {
    // Serial.println(tagID);
    tagIdDecimal = hexStringToDecimal(tagID);
    Serial.println(tagIdDecimal);
  }
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
