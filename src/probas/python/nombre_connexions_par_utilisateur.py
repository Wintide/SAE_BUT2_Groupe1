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

cursor.execute("SELECT login, COUNT(*) AS connexions FROM users GROUP BY login")
result = cursor.fetchall()

cursor.close()

df = pd.DataFrame(result, columns=['login', 'connexions'])

plt.figure(figsize=(10, 6))
plt.bar(df['login'], df['connexions'])
plt.title("Nombre de connexions par utilisateur")
plt.xlabel("Utilisateur")
plt.ylabel("Connexions")
plt.xticks(rotation=45)

plt.tight_layout()

plt.savefig('../images/graphe.png')

plt.show()
plt.close()
