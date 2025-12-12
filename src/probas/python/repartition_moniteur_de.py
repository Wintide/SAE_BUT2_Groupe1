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

query = f"""
    SELECT {attribute}, COUNT(*) 
    FROM monitors 
    WHERE {attribute} IS NOT NULL AND {attribute} <> ''
    GROUP BY {attribute}
    ORDER BY COUNT(*) DESC
"""
cursor.execute(query)
results = cursor.fetchall()
cursor.close()

labels = []
values = []

for row in results:
    labels.append(str(row[0]))
    values.append(row[1])

if len(labels) > 10:
    top_labels = labels[:10]
    top_values = values[:10]
    autres_valeurs = sum(values[10:])
    top_labels.append("Autres")
    top_values.append(autres_valeurs)
    labels = top_labels
    values = top_values

plt.figure(figsize=(10, 10))
plt.pie(values, labels=labels, startangle=90, autopct='%1.1f%%')
plt.title(f"Répartition des moniteurs par '{attribute}'", pad=30) # Pad : Plus d'espace entre titre et graphe pour affichage propre
plt.axis("equal")

plt.savefig('../images/graphe.png')
plt.show()
plt.close()
