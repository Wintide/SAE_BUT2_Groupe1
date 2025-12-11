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

cursor.execute("SELECT COUNT(*) FROM devices")
nb_uc = cursor.fetchone()[0]

cursor.execute("SELECT COUNT(*) FROM moniteurs")
nb_moniteurs = cursor.fetchone()[0]

cursor.close()

df = pd.DataFrame({
    'type': ['Unités centrales', 'Moniteurs'],
    'nombre': [nb_uc, nb_moniteurs]
})

plt.figure(figsize=(8, 8))
plt.pie(df['nombre'], labels=df['type'], startangle=90)
plt.title("Répartition des machines entre UC et moniteurs")
plt.axis('equal')

plt.savefig('../images/graphe.png')
plt.show()
plt.close()
