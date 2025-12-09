import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="root",
  database="vines"
)

mycursor = mydb.cursor()
mycursor.execute("SELECT * FROM users")
myresult = mycursor.fetchall()

for x in myresult:
    print(x)
