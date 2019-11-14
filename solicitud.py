import requests

url = "http://localhost/lecturas/leer.php"
r = requests.get(url)
temps = r.json()
valores = temps["records"]
for valor in valores:
        print("Temperatura: " + valor ['valor'])
        print("Fecha: " + valor ['fecha'])
        print("Hora: " + valor ['hora'])
