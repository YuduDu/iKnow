cd ~/Google\ Drive/iKnow/DBbackup
Now=$(date +”%d-%m-%Y--%H:%M:%S”)
File=iKnow-$Now.sql
mysqldump -h gene.rnet.missouri.edu -u iKnow_team -piknowteam  iKnow > $File
