import matplotlib.pyplot as plt
import pandas as pd
import mysql.connector
from datetime import date

db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="root",
    database="vines"
)

cursor = db.cursor()

cursor.execute("SELECT AVG(ram_mb) FROM devices")
ram_moy = cursor.fetchone()[0]

cursor.execute("SELECT AVG(disk_gb) FROM devices")
disk_moy = cursor.fetchone()[0]

cursor.execute("SELECT AVG(DATEDIFF(CURDATE(), purchase_date) / 365) FROM devices")
age_moy = cursor.fetchone()[0]

cursor.execute("SELECT COUNT(*) FROM devices")
total_devices = cursor.fetchone()[0]

cursor.execute("SELECT COUNT(*) FROM devices WHERE warranty_end < CURDATE()")
hors_garantie = cursor.fetchone()[0]

pourcent_hors = (hors_garantie / total_devices) * 100 if total_devices > 0 else 0

cursor.execute("""
    SELECT COUNT(*) FROM devices
    WHERE warranty_end BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 3 MONTH)
""")
bientot_hors = cursor.fetchone()[0]

pourcent_bientot = (bientot_hors / total_devices) * 100 if total_devices > 0 else 0

cursor.close()

df = pd.DataFrame({
    'Statistique': [
        'RAM moyenne (MB)',
        'Disque moyen (GB)',
        'Âge moyen (ans)',
        '% Hors garantie',
        '% Bientôt hors garantie (<3 mois)'
    ],
    'Valeur': [
        ram_moy,
        disk_moy,
        age_moy,
        pourcent_hors,
        pourcent_bientot
    ]
})

plt.figure(figsize=(10, 6))
plt.barh(df['Statistique'], df['Valeur'])
plt.title("Statistiques du parc matériel")
plt.xlabel("Valeurs")
plt.tight_layout()

plt.savefig('../images/graphe.png')
plt.show()
plt.close()
