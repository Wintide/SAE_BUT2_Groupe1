import matplotlib.pyplot as plt
import pandas as pd
import mysql.connector
import sys

attribute = sys.argv[1]

db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="root",
    database="vines"
)

cursor = db.cursor()

query = "SELECT " + attribute + ", COUNT(*) FROM devices GROUP BY " + attribute
cursor.execute(query)
results = cursor.fetchall()
cursor.close()

labels = []
values = []

for row in results:
    labels.append(str(row[0]))
    values.append(row[1])

plt.figure(figsize=(9, 9))
plt.pie(values, labels=labels, autopct='%1.0f%%', startangle=90)
plt.axis("equal")

plt.savefig('../images/graphe.png')

plt.show()
plt.close()

