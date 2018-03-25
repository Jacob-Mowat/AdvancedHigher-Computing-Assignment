for f in `find . -type f -name "*.php"`; do 
  for t in head tail; do 
    $t -1 $f  |egrep '^[  ]*$' >/dev/null && echo "blank line at the $t of $f"; 
  done; 
done
