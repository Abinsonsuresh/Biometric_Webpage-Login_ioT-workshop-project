import mysql.connector
import serial
mydb = mysql.connector.connect(host='localhost',user = 'root',database = 'biometric')
print (mydb.connection_id)
cur = mydb.cursor()


pin = serial.Serial('COM8', 9600)

# a = []
flag = 0
data = ""
while True:
    value = pin.read().decode('ascii')

    if value == '*':
        flag = 1
    elif value == '#':
        
        flag = 0
        print(data)
        sql = "INSERT INTO login (rfid) VALUES (%s)" % (str (data))
        # b1 = (data)
        cur.execute(sql)
        mydb.commit()
        data = ""
        
    if flag == 1:
        if value != '*' and value != '#':
            data+=value   
