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

cursor.execute("SELECT MAX(duration_seconds) FROM connexions")
max_value = cursor.fetchone()[0]

intervalles = []
debut = 0
while debut < max_value:
    fin = debut + 1000
    intervalles.append((debut, fin))
    debut = fin

counts = []
for start, end in intervalles:
    cursor.execute("SELECT COUNT(*) FROM users WHERE duration_seconds >= " + debut + " AND duration_seconds < " + fin)
    counts.append(cursor.fetchone()[0])

cursor.close()

labels = []
for el in intervalles:
    labels.append(el[0] + " - " + el[1] + "s")

df = pd.DataFrame({
    'categorie': labels,
    'nombre': counts
})

plt.figure(figsize=(9, 9))
plt.pie(df['nombre'], labels=df['categorie'], startangle=90)
plt.title("Répartition des durées de connexions par tranches de 1000 secondes")
plt.axis('equal')

plt.savefig('../images/graphe.png')

plt.show()
plt.close()



