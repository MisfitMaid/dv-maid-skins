$7z = "C:\Program Files\7-Zip\7z"

rm dv-maid-skins-cars.zip
rm dv-maid-skins-locos.zip

php createReleaseJson.php

cd Cars
& $7z a -tzip ../dv-maid-skins-cars.zip *.json */*.png */*.json */*.xml

cd ../Locos
& $7z a -tzip ../dv-maid-skins-locos.zip *.json */*.png */*.json */*.xml

cd ..