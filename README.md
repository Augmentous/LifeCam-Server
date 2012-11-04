Lifecam-Server app

We made this page to look like http://breefield.com/bm-timelapse/full

This is a basic PHP page that uses jquery and jquery-infinitescroll to display a bunch of files from a folder.
It loads more pictures as you scroll down in group of some predefined quantity.

There are three parameters:
start: This is the image number to start at. 1 is the more recent. Higher numbers are more in the past.
end: This is not the last picture to show, it's the quantity. Yes, I know it's strange.
page: This parameter will show you the Nth set of $end pictures away from $start. Did this because the inifinite scroller requires a page= or some magic.

Possible bugs:
* Dont know what will happen when there are multiple folder
* Not very efficient, as it generates the thumbnails on the fly..but only 1 time, so kindof efficient
* Might be permission issues on the server

Requires: 
PHP-GD2
PHP

Todo (in no best order):
* Invalid input checking
* Commenting
* Adstraction possibilites for larger and better gallaries
* Testing to see how it loads
* Code cleanup from stealing code from breefield
* Live refreshing
* Side-bar style widget for mainpages
* cron-like thumbnail refresh so the client doesn't feel it
* support multiple date styles 
* support pulling images for the scroller from older dates.

Changes:
11-04-2012a:
	Updated to support multiple folders in the root by reversing the sort order
