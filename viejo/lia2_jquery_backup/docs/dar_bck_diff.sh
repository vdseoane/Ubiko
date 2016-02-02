#
# (c) copyright 2010 Arno Formella
# formella@ei.uvigo.es, lia.ei.uvigo.es
#

# generate a differential backup
dar -c ${1?}_`date -I`_diff -R ${HOME?} -A ${2?}

