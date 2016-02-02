#
# (c) copyright 2010 Arno Formella
# formella@ei.uvigo.es, lia.ei.uvigo.es
#

# generate full backup
dar -c ${1?}_`date -I`_full -R ${HOME?}
# generate catalog
dar -C ${1?}_`date -I`_ctlg -A ${1?}_`date -I`_full


