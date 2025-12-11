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

cursor.execute("""
    SELECT login, SUM(duration_seconds) AS total_duree
    FROM connexions
    GROUP BY login
    ORDER BY total_duree DESC
""")

data = cursor.fetchall()
cursor.close()

df = pd.DataFrame(data, columns=['login', 'duree_totale'])

top10 = df.head(10)

plt.figure(figsize=(10, 6))
plt.barh(top10['login'], top10['duree_totale'])
plt.gca().invert_yaxis()
plt.title("Top 10 utilisateurs par durée de connexion")
plt.xlabel("Durée totale (secondes)")
plt.tight_layout()

plt.savefig('../images/duree_connexions.png')
plt.show()
plt.close()
