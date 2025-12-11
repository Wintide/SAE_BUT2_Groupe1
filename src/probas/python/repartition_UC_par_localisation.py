import pandas as pd
import matplotlib.pyplot as plt
import mysql.connector

db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="root",
    database="vines"
)

cursor = db.cursor()
cursor.execute("""
    SELECT location, COUNT(*) AS compteur
    FROM devices
    GROUP BY location
""")
result = cursor.fetchall()

cursor.close()

df = pd.DataFrame(result, columns=['location', 'compteur'])

plt.figure(figsize=(8, 8))
plt.pie(df['compteur'], labels=df['location'], startangle=90)
plt.title("Répartition des unités centrales par localisation")
plt.axis('equal')

plt.savefig('../../images/graphe.png')

plt.show()
plt.close()
