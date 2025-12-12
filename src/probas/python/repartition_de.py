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
plt.pie(values, labels=labels, autopct='%1.1f%%', startangle=90)
plt.title(f"Répartition des UC par '{attribute}'", pad=30) # pad : Plus d'espace entre titre et graphe pour affichage propre
plt.axis("equal")
plt.subplots_adjust(top=1.50)

plt.savefig('../images/graphe.png')

plt.show()
plt.close()





