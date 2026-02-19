import pandas as pd
import matplotlib.pyplot as plt
import mysql.connector
from datetime import datetime

db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="root",
    database="vines"
)
cursor = db.cursor()

cursor.execute("""
           SELECT warranty_end
           FROM devices
""")
result = cursor.fetchall()

cursor.close()

df_dispositifs = pd.DataFrame(result, columns=['fin_garantie'])

ajd = datetime.today()

df_dispositifs['jours_restant'] = (pd.to_datetime(df_dispositifs['fin_garantie']) - ajd).dt.days

def categorie_garantie(jours):
    if jours <= 365:
        return 'Dans 1 an'
    elif jours <= 730:
        return 'Dans 2 ans'
    else:
        return 'Plus de 2 ans'

df_dispositifs['categorie_garantie'] = df_dispositifs['jours_restant'].apply(categorie_garantie)

compter_garantie = df_dispositifs['categorie_garantie'].value_counts()

plt.figure(figsize=(8, 8))
plt.style.use('tableau-colorblind10')

plt.pie(compter_garantie, labels=compter_garantie.index, autopct='%1.1f%%', startangle=90)
plt.title("Proximité à la date de fin de garantie des unités centrales")
plt.axis('equal')

plt.savefig('../images/graphe.png')

plt.show()
plt.close()

