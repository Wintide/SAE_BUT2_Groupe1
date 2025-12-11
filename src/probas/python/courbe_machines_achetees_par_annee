
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
    SELECT YEAR(purchase_date) AS annee, COUNT(*) AS compteur
    FROM devices
    GROUP BY YEAR(purchase_date)
    ORDER BY annee
""")
result = cursor.fetchall()

cursor.close()

df = pd.DataFrame(result, columns=['annee', 'compteur'])

plt.figure(figsize=(10, 6))
plt.plot(df['annee'], df['compteur'], marker='o')
plt.title("Nombre d'unités centrales achetées par année")
plt.xlabel("Année")
plt.ylabel("Nombre")
plt.xticks(rotation=45)
plt.grid(True)
plt.tight_layout()

plt.savefig('../images/graphe.png')

plt.show()
plt.close()
