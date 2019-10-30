#bibliotecas necessarias

import paho.mqtt.client as mqtt
import time
import mysql.connector

#conexao com o banco

mydb = mysql.connector.connect(
    host="127.0.0.1",
    user="root",
    passwd="",
    database="sistemamonitoramento"
)
print(mydb)
print("conectado!")

def on_message(client, userdata, message):


#enviando dados ao banco

    mycursor = mydb.cursor()
    sql = "INSERT INTO SENSORES (SENSORESSENSOR, SENSORESVLR) values (%s,%s);"
    sensor = message.topic.split('/')[1]
    valor = float(message.payload.decode("utf-8"))

#local onde recebe os dados
    print("\nTOPICO: "+message.topic)
    print("VALOR: ",str(message.payload.decode("utf-8")))

    if valor is not None:
        dados = (sensor, message.payload.decode("utf-8"))

        mycursor.execute(sql, dados)
        mydb.commit()

    # if message.topic == 'sensor/temperatura':
    #     temp = message.payload.decode("utf-8")
    # elif message.topic == 'sensor/umidade':
    #     umi = message.payload.decode("utf-8")
    # elif message.topic == 'sensor/pressao':
    #     pre = message.payload.decode("utf-8")

    print("\n")

#conectando com o broker (mosquitto)

broker_address="192.168.1.102"
print("\nCriando nova instancia...\n")
client = mqtt.Client("JP")
client.on_message=on_message
print("Tentando conectar com o servidor...")
client.connect(broker_address)


#dando subscribe no topico para pegar os dados

print("entrando no topico:","sensor/temperatura")
client.subscribe("sensor/temperatura")

print("entrando no topico:","sensor/umidade")
client.subscribe("sensor/umidade")

print("entrando no topico:","sensor/pressao")
client.subscribe("sensor/pressao")

print("Publishing message to topic","sensor/temperatura")
client.publish("sensor/temperatura")

print("Publishing message to topic","sensor/umidade")
client.publish("sensor/umidade")

print("Publishing message to topic","sensor/pressao")
client.publish("sensor/pressao")


client.loop_forever()
