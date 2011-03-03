<?PHP
/* ====================
[BEGIN_COT_EXT]
Hooks=index.tags
Tags=index.tpl:{TRAC_MILESTONE},{TRAC_CLOSED_PERCENT},{TRAC_ACTIVE_PERCENT},{TRAC_CLOSED},{TRAC_ACTIVE},{TRAC_TOTAL}
[END_COT_EXT]
==================== */

if (!defined('COT_CODE')) { die('Wrong URL.'); }

//Connects to the trac database and stores the connection for use
$trac_db = new CotDB('mysql:host='.$cfg['mysqlhost_trac'].';dbname='.$cfg['mysqluser_trac'], $cfg['mysqluser_trac'], $cfg['mysqlpassword_trac']);
unset($cfg['mysqlhost_trac'], $cfg['mysqluser_trac'], $cfg['mysqlpassword_trac']);

$milestones = array();
$sql_tickets = $trac_db->query("SELECT * FROM `ticket` as t LEFT JOIN `milestone` as m on m.`name` = t.`milestone` WHERE m.`completed` = 0 ORDER by t.`id`, t.`milestone`, t.`version`");
foreach($sql_tickets->fetchAll() as $fa_tickets)
{
	if(!in_array($fa_tickets['milestone'], $milestones))
		{ $milestones[] = $fa_tickets['milestone']; }
	if($fa_tickets['status'] == "closed")
		{ $tickets[$fa_tickets['milestone']]['closed']++; }
	else { $tickets[$fa_tickets['milestone']]['active']++; }
	$tickets[$fa_tickets['milestone']]['total']++;
}
unset($trac_db);
foreach($milestones as $milestone)
{
	$tickets[$milestone]['closed'] = (!empty($tickets[$milestone]['closed'])) ? $tickets[$milestone]['closed'] : 0;
	$tickets[$milestone]['active'] = (!empty($tickets[$milestone]['active'])) ? $tickets[$milestone]['active'] : 0;
	$t->assign(array(
		"TRAC_MILESTONE" => '<a href="http://'.$cfg['plugin']['tracinfo']['tracurl'].'milestone/'.$milestone.'">'.$milestone.'</a>',
		"TRAC_CLOSED_PERCENT" => floor(($tickets[$milestone]['closed']/$tickets[$milestone]['total'])*100),
		"TRAC_ACTIVE_PERCENT" => floor(($tickets[$milestone]['active']/$tickets[$milestone]['total'])*100),
		"TRAC_CLOSED" => '<a href="http://'.$cfg['plugin']['tracinfo']['tracurl'].'query?status=closed&amp;group=resolution&amp;milestone='.$milestone.'">'.$tickets[$milestone]['closed'].'</a>',
		"TRAC_ACTIVE" => '<a href="http://'.$cfg['plugin']['tracinfo']['tracurl'].'query?status=assigned&amp;status=new&amp;status=accepted&amp;status=reopened&amp;group=status&amp;milestone='.$milestone.'">'.$tickets[$milestone]['active'].'</a>',
		"TRAC_TOTAL" => '<a href="http://'.$cfg['plugin']['tracinfo']['tracurl'].'query?group=status&amp;milestone='.$milestone.'">'.$tickets[$milestone]['total'].'</a>'
			));
	$t->parse("MAIN.TRACINFO.LOOP");
}
$t->parse("MAIN.TRACINFO");

?>