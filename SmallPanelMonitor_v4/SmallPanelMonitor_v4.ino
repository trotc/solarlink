//v1, created 6/8/13 for Angel Hack

#define ADC_DELAY       10  // ADC delay for high impedence sensors
#define LOG_INTERVAL  60000


#include <b64.h>
#include <HttpClient.h>



#include <SPI.h>
#include <Ethernet.h>           //library for ethernet functions
//#include <HTTPClient.h>             //library for client functions


uint8_t ipaddr[4] = {192,168,1,110};                    // IP-adress of arduino
uint8_t subnet[4] = {255, 255, 255, 0};                   // subnetmask           ( for later DNS implementation)
uint8_t hwaddr[6] = {0xDE,0xAD,0xBE, 0xEF, 0xFE, 0xED}; // mac-adress of arduino
uint8_t serverport = 80;                                  // the port the arduino talks to
char serverName[] = "192.168.1.100";
//char serverName[] = "powerful-wave-3693.herokuapp.com";
 

int counter;
float insertednumber;
bool connected = false;                                   // yes-no variable (boolean) to store if the arduino is connected to the server
int i = 0;                                                // variable to count the sendings to the server 
 


EthernetClient client;                      // make a new instance 


float sensorValue = 0.00;
float voltageValue = 0.000;

int senseV[3];    //storage for sensed values, 4 positions
int finalAve;
int vRef = 4.37;
int minute = 0;
unsigned int m = 0;

/****************
for averaging of analog pins
****************/
int readAnalogPins(int ia, int aveCount) 
{
float aveValue = 0.00;
int aveV[] = { 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 };    
 
    for (uint8_t i = 0; i < aveCount; i++) 
    {
      aveV[i] = 0;  
    }
    for (uint8_t i = 0; i < aveCount; i++) 
    {
      analogRead(ia);
      delay(ADC_DELAY);
      senseV[ia] = analogRead(ia);
      
 //     Serial.println(senseV[ia]);
      
      delay(ADC_DELAY);
      if (i > 0) 
      {
        aveV[i] = senseV[ia] + aveV[i-1];
      }
      else
      {
        aveV[i] = senseV[ia];
      }
      
//      Serial.println(aveV[i]);
      
    } //end for loop
    
 //   Serial.print("Finalvalue:");
 //   Serial.println(aveV[aveCount-1]);
    finalAve = aveV[aveCount-1] / aveCount;
 
    //Serial.println(finalAve);
 
    return finalAve;
}

float vFactor(int i)
// returns the factor depending on the panel voltage
{
float pf = 0.00;
  if (i == 0) //panel voltage
  {
    pf = 2.1;    //panel voltage, Rup = 10k, Rdn = 10k
  }
  else if (i == 1)  //battery voltage 
  {
    pf = 6.1;  //*** 
  }
  else if (i == 2)
  {
    pf = 4.1;  
  }
  else if (i == 3)  //battery current sense
  {
    pf = 4.1;   //**  3.2V/0.78V
  }
  return pf;
}

//------------
// setup
//------------

void setup() 
{
  Serial.begin(9600);
    Serial.println("I2C-to-Ethernet Bridge.");
Serial.println("Initializing Ethernet.");
Ethernet.begin(hwaddr, ipaddr);  
}

void loop()
{
  do 
  {
    m = millis();
  } while (m % LOG_INTERVAL);
  
  minute = m/60000;
  
    Serial.print(minute); Serial.print(",");
//  Serial.print(m); Serial.print(",");
   unsigned int sensorB = readAnalogPins(0, 5);
   Serial.print(sensorB); Serial.print(",");
   Serial.print(readAnalogPins(1, 5)); Serial.print(",");
//   Serial.print(sensorB); Serial.print(",");
   voltageValue = (sensorB * vRef * vFactor(0)) / 1023;
   
   Serial.print(voltageValue, 2); Serial.print(",");
   float Power = voltageValue * voltageValue / 20;
   
   Serial.println(Power, 2);  
   
   
   
     //counter = counter + 1;
   
  Serial.println(counter);
 
 insertdata(Power);
 
 /*
  if(counter % 1 == 0)
  {
 
 
   //insertednumber = (TotalWattHr);
   
   //insertednumber = (MinuteWattHr * 1000);
   
   
   insertednumber = Power;
   
   
   
   //insertednumber = (TotalWattHr * 100);
  
  Serial.println("INSERT");
  Serial.println("--------------------------");
  Serial.println(insertednumber);
insertdata(insertednumber);
counter = 0;

}
else
{
  Serial.println("not today");
}
*/

delay(1000);

   
}




void checkout(float insertednumber)
{
  
}



void insertdata(float insertednumber)
{
  if(!connected)   
  {                                         // if "not" connected print: not connected

  if(client.connect(serverName,80))
  {                                    // if connected, set variable connected to "true" and
  connected = true;
 
  {
 
  Serial.println("Sending to Server: ");                    // all the "Serial.print" is for debugging and to show other people what arduino does
  
  
  
  char tmp[10];
  dtostrf(insertednumber,1,2,tmp);
  String insertoutdata = tmp;
  
  /*
  client.print("GET /dropbox/PHP/solar/index.php/solarlinker/timetoinsert/userid/1/key1/07df98755d5cafc1d52a67ff71f3fc29/key2/df4ddf644dc79a7c20150614ba6ee8f2/generated/" + insertoutdata + "/consumed/" + insertoutdata);            // send this to apache on server to call "
  Serial.print("GET /dropbox/PHP/solar/index.php/solarlinker/timetoinsert/userid/1/key1/07df98755d5cafc1d52a67ff71f3fc29/key2/df4ddf644dc79a7c20150614ba6ee8f2/generated/" + insertoutdata + "/consumed/" + insertoutdata);
  */
  
  /*
  client.print("GET /solar/index.php/solarlinker/timetoinsert/userid/1/key1/07df98755d5cafc1d52a67ff71f3fc29/key2/df4ddf644dc79a7c20150614ba6ee8f2/generated/" + insertoutdata + "/consumed/" + insertoutdata);            // send this to apache on server to call "
  Serial.print("GET /solar/index.php/solarlinker/timetoinsert/userid/1/key1/07df98755d5cafc1d52a67ff71f3fc29/key2/df4ddf644dc79a7c20150614ba6ee8f2/generated/" + insertoutdata + "/consumed/" + insertoutdata);
  */
  
  
  /*
  client.print("GET /hack/index.php/solarlinker/timetoinsert/userid/1/generated/" + insertoutdata + "/consumed/" + insertoutdata);            // send this to apache on server to call "
  Serial.print("GET /hack/index.php/solarlinker/timetoinsert/userid/1/generated/" + insertoutdata + "/consumed/" + insertoutdata);
  */
  
  
  /*  
  client.print("GET /hack/index.php/solarinsert/insert/userid/1/gen/5/con/5/");            // send this to apache on server to call "
  Serial.print("GET /hack/index.php/solarinsert/insert/userid/1/gen/5/con/5/");
  */
  
  
  client.print("GET /Dropbox/PHP/hack/index.php/solarinsert/insert/userid/1/gen/" + insertoutdata + "/con/0/");            // send this to apache on server to call "
  Serial.print("GET /Dropbox/PHP/hack/index.php/solarinsert/insert/userid/1/gen/" + insertoutdata + "/con/0/");
  
  
  
  
  client.println(" HTTP/1.1");                  //
  Serial.println(" HTTP/1.1");                  //
  client.println("Host: powerful-wave-3693.herokuapp.com");    //
  Serial.println("Host: powerful-wave-3693.herokuapp.com");    //
  client.println("User-Agent: arduino-ethernet");        // ethernet related stuff
  Serial.println("User-Agent: arduino-ethernet");        //
  client.println("Accept: text/html");          //
  Serial.println("Accept: text/html");          //
  client.println("Connection: close");        //
  
  
                                         //  "connected" to false
 
  client.println();                             //
  Serial.println();
  //delay(5000);                                            // send the temperature every 10 minutes 599500 + 500 milliseconds (down below)
  
  
   client.stop();                                                 //  stop the connection and set         
  connected = false; 


}
}
  else
  {
  Serial.println("Cannot connect to Server");               //  else block if the server connection fails (debugging)
  }
}
}

