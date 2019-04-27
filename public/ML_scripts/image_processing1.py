from sightengine.client import SightengineClient
# import json

#weapons, drugs & alcohol detection
client = SightengineClient("780030986", "SOME_KEY")
output1 = client.check('wad').set_file('')
print(output1)

#nudity detection
client = SightengineClient("780030986", "SOME_KEY")
output2 = client.check('nudity').set_file('/Users/aditya/Alcohol.jpg')
print(output2)

weapon = output1['weapon']
print(weapon)
alcohol = output1['alcohol']
print(alcohol)
drugs = output1['drugs']
print(drugs)

nudes_raw = output2['nudity']['raw']
nudes_partial = output2['nudity']['partial']
nudes_safe = output2['nudity']['safe']
print(nudes_raw)
print(nudes_partial)
print(nudes_safe)

#calculate score based on the VALUES
img_score = (weapon + alcohol + drugs) * 1000 + nudes_raw * 1000 + nudes_partial * 500
print(img_score)




# client = SightengineClient("780030986", "Lq2ziDKPJUFqeRZcePQy")
# output = client.check('celebrities').set_file('/Users/aditya/shah.jpg')
# print(output)
