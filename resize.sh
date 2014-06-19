presetspath="captures/"

clear

for file in `find $presetspath -iname "*.jpg" -type f`
do
	echo 
	
	fileId=$(echo $(basename $file .jpg) | sed 's/^0*//')
	size=$(($fileId + 350))
	
	echo $size" px -> "$file
	convert -resize $size"x2000>" $file assets/$(basename $file)
	
done
jpegoptim -pt assets/*.jpg