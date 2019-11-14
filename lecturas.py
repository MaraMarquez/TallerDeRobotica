import requests
URL = "http://localhost/lecturas/leer.php"
r = requests.get(URL)
valores = r.json()
lecturas = valores["records"]
for lectura in lecturas:
    print(lectura['valor'])

URL = "http://localhost/lecturas/crear.php"
data = {'valor': '50', 
        'fecha':'2019-11-14', 
        'hora': '11:00:00'} 
r = requests.post(url = URL, data = data) 
print(r.text)