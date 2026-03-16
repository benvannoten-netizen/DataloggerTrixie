#!/usr/bin/python3

#  Jan Moeskops - 22 september 2019
#  MatplotlibTest2 : test toegang tot de database
#   indien 4 keer per uur temperatuur gelogd wordt,
#   dan zijn er 96 meetresultaten per dag
#   toon de laatste dag,  zet foto in /var/www/html als sudo
#  probleem: Matplotlib chooses Xwindows backend by default.
#   You need to set matplotlib to not use the Xwindows backend.
#  oplossing: https://stackoverflow.com/questions/37604289/tkinter-tclerror-no-display-name-and-no-display-environment-variable

# matplotlib pyplot module

import os
import matplotlib as mpl
if os.environ.get('DISPLAY','') == '':
    print('no display found. Using non-interactive Agg backend')
    mpl.use('Agg')
import matplotlib.pyplot as plt


import mysql.connector
import time
import shutil

# Zoek datum vandaag
vandaag=time.strftime("%d-%m-%Y, %H:%M")
# vandaag=time.strftime("%Y-%m-%d")
print(vandaag)

# connect to MySQL database
conn = mysql.connector.connect(host="localhost", user="logger", passwd="paswoord", db="temperatures")

# prepare a cursor
cur = conn.cursor()

# Haal ALLE temperatuur data op - geen limiet
query_temp = """
SELECT dateandtime,temperature FROM temperaturedata
ORDER BY dateandtime ASC;
"""
cur.execute(query_temp)
data_temp = cur.fetchall()
dateandtime_temp, temperature = zip(*data_temp)

# Haal ALLE vochtigheid data op - geen limiet
query_hum = """
SELECT dateandtime,humidity FROM temperaturedata
ORDER BY dateandtime ASC;
"""
cur.execute(query_hum)
data_hum = cur.fetchall()
dateandtime_hum, humidity = zip(*data_hum)

# close cursor and connection
cur.close()
conn.close()

# Maak figuur met twee y-assen
fig, ax1 = plt.subplots()

# Plot temperatuur (blauw) op linker y-as
ax1.set_xlabel("Time of Day")
ax1.set_ylabel("graden Celsius", color='blue')
ax1.plot(dateandtime_temp, temperature, color='blue', label='Temperatuur')
ax1.tick_params(axis='y', labelcolor='blue')

# Maak tweede y-as voor vochtigheid
ax2 = ax1.twinx()
ax2.set_ylabel("Rel. Vochtigheid (%)", color='red')
ax2.plot(dateandtime_hum, humidity, color='red', label='Vochtigheid')
ax2.tick_params(axis='y', labelcolor='red')

# set title
plt.title("Temperatuur & Vochtigheid All Time " + "Raspi21 " + vandaag)
#plt.xticks(rotation='45', fontsize='7')
fig.set_size_inches(9,6)
ax1.grid(True)

# Voeg legenda toe
lines1, labels1 = ax1.get_legend_handles_labels()
lines2, labels2 = ax2.get_legend_handles_labels()
ax1.legend(lines1 + lines2, labels1 + labels2, loc='upper left')

plt.draw()

# plt.show()
plt.savefig('/var/www/html/Raspi21AllTimeTempVocht.png', dpi=100)
