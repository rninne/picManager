#!/bin/bash

# Produce thumbnails

imdir="$1"
if [[ -n "$imdir" ]] ; then
    cd "$imdir"
fi

largedir=thumbs/large
smalldir=thumbs/small

mkdir -p $largedir
mkdir -p $smalldir

maxjobs=5
n=0

for file in $(find -iname '*.jpg') ; do
    echo "Converting $file"
    convert -resize 800x800 $file $largedir/$file &
    convert -resize 150x150 $file $smalldir/$file &
    # Slight complication to use at most $maxjobs processes at once to speed up
    # the conversion but not overwhelm the machine:
    n=$(($n+1))
    if (($n % $maxjobs == 0)) ; then
        wait
    fi
done
