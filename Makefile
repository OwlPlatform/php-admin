confdir := "/usr/share/grail"\;
bindir  := "/usr/bin/grail"\;
webdir  := "/var/www/htdocs"\;

#Set the directories in the php scripts and then copy them to the web directory
install:
	for file in grail.php runprogram.php choose_config.php arguments.php; do sed -i 's|\$$bindir = .*$$|\$$bindir = $(bindir)|' $$file; done
	for file in grail.php runprogram.php choose_config.php arguments.php; do sed -i 's|\$$confdir = .*$$|\$$confdir = $(confdir)|' $$file; done
	for file in grail.php runprogram.php choose_config.php arguments.php; do sed -i 's|\$$webdir = .*$$|\$$webdir = $(webdir)|' $$file; done
	if [ -d $(confdir) ]; then echo "$(confdir) already exists"; else mkdir $(confdir); fi
	if [ -d $(bindir) ]; then echo "$(bindir) already exists"; else mkdir $(bindir); fi
	if [ -d $(webdir) ]; then echo "$(webdir) already exists"; else mkdir $(webdir); fi
	cp grail.php $(webdir)
	cp runprogram.php $(webdir)
	cp choose_config.php $(webdir)
	cp grail.css $(webdir)

uninstall:
	echo "Delete the files in $(confdir), $(bindir), and $(webdir manually) to remove the system"
	#if [ -d $(confdir) ]; then rm -r $(confdir); fi
	#if [ -d $(bindir) ]; then rm -r $(bindir); fi
