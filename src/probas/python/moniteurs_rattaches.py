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

cursor.execute("SELECT COUNT(*) FROM monitors WHERE attached_to IS NOT NULL AND attached_to <> ''")
nb_rattaches = cursor.fetchone()[0]

cursor.execute("SELECT COUNT(*) FROM monitors WHERE attached_to IS NULL OR attached_to = ''")
nb_non = cursor.fetchone()[0]

cursor.close()

df = pd.DataFrame({
    'Etat': ['Rattachés', 'Non rattachés'],
    'Nombre': [nb_rattaches, nb_non]
})

plt.figure(figsize=(8, 8))
plt.pie(df['Nombre'], labels=df['Etat'], autopct='%1.1f%%', startangle=90)
plt.axis('equal')

plt.savefig('../images/graphe.png')
plt.show()
plt.close()
