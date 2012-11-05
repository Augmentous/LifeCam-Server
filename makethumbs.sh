#!/bin/bash
if [ -f /tmp/makeconvert ]
then
exit
fi

touch /tmp/makeconvert
dir=/home/jacob/eyefi1
cd $dir
find . -type f | sort -g -r | grep -i -v thumb | grep -i jpg | cut -d"/" -f 2- > cronlist.txt
# find . -type f | sort -g -r | grep -i -v thumb | grep -i jpg | head -n 1000 | cut -d"/" -f 2- > cronlist.txt
# for a in `find . -type f | sort -g -r | grep -i -v thumb | grep -i jpg | head -n 10 | cut -d"/" -f 2-`
for a in `cat cronlist.txt`
do
	if [ ! -d ${dir}_t/`dirname $a` ] 
	then
		echo makeing ${dir}_t/`dirname $a`
		mkdir -p ${dir}_t/`dirname $a` 
	fi
	if [ ! -f ${dir}_t/$a ]
	then
		echo converting ${dir}/$a
		convert -thumbnail 300 ${dir}/$a ${dir}_t/$a
		# mogrify -resize 80x80 -background white -gravity center -extent 80x80 -format jpg -quality 75 -path eyefi1_t/2012-11-04/ eyefi1/2012-11-04/GOPR6794.JPG
		# mogrify -resize 300x225 -background black -gravity center -extent 300x225 -format JPG -quality 50 -path ${dir}_t/`dirname $a` ${dir}/$a
	fi
done
rm /tmp/makeconvert	
