import matplotlib.pyplot as plt
import pandas as pd
import mysql.connector

db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="root",
    database="vines"
)

cursor = db.cursor()
cursor.execute("SELECT duration_seconds FROM connexions")

res = cursor.fetchall()

durations = []
for row in res:
    durations.append(row[0])

cursor.close()

df = pd.DataFrame({'duration_seconds': durations})

plt.figure(figsize=(8, 6))
plt.style.use('tableau-colorblind10')

plt.boxplot(df['duration_seconds'], vert=True)
plt.title("Boxplot des durées de connexions")
plt.ylabel("Durée (en secondes)")

plt.savefig('../images/graphe.png')

plt.show()
plt.close()



