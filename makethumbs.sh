#!/bin/bash
if [ -f /tmp/makeconvert ]
then
exit
fi

touch /tmp/makeconvert
maindir=/data/uploads
for b in jacob joyce zrg colin
do
for c in `ls $maindir/$b/`
do
dir=$maindir/$b/$c
cd $dir
echo $dir is an images folder
find . -type f | sort -g -r | grep -i -v thumb | grep -i jpg | cut -d"/" -f 2- > cronlist.txt
# find . -type f | sort -g -r | grep -i -v thumb | grep -i jpg | head -n 1000 | cut -d"/" -f 2- > cronlist.txt
# for a in `find . -type f | sort -g -r | grep -i -v thumb | grep -i jpg | head -n 10 | cut -d"/" -f 2-`
for a in `cat cronlist.txt`
do
	if [ ! -d ${maindir}_t/$b/$c/`dirname $a` ] 
	then
		echo makeing ${maindir}_t/$b/$c/`dirname $a`
		echo mkdir -p ${maindir}_t/$b/$c/`dirname $a`
		mkdir -p ${maindir}_t/$b/$c/`dirname $a`
	fi
	if [ ! -f ${maindir}_t/$b/$c/$a ]
	then
		echo converting ${maindir}/$b/$c/$a
		echo convert -thumbnail 300 ${maindir}/$b/$c/$a ${maindir}_t/$b/$c/$a
		convert -thumbnail 300 ${maindir}/$b/$c/$a ${maindir}_t/$b/$c/$a
		# mogrify -resize 80x80 -background white -gravity center -extent 80x80 -format jpg -quality 75 -path eyefi1_t/2012-11-04/ eyefi1/2012-11-04/GOPR6794.JPG
		# mogrify -resize 300x225 -background black -gravity center -extent 300x225 -format JPG -quality 50 -path ${dir}_t/`dirname $a` ${dir}/$a
	fi
done
done
done
rm /tmp/makeconvert	
