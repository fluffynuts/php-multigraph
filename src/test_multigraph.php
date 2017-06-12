<html>
<?php
include_once("multigraph.php");
include_once("eqn_multigraph.php");
function dump_array($arr)
{
  print("!");
  foreach ($arr as $k => $v)
    print("$k :: ".$v."<br>");
}
function getbool($name, $default)
{
  if (array_key_exists($name, $_GET))
  {
    switch ($_GET[$name])
    {
      case "1":
      case "yes":
      case "true":
        return true;
      default:
        return false;
    }
  }
  else
    return $default;
}
?>
<head>
<title>Multigraph test page</title>
</head>
<body>
<?php
	$gwidth = 650;
	$gheight = 450;

  $pie = getbool("pie", true);
  $hbar = getbool("hbar", true);
  $bar = getbool("bar", true);
  $line = getbool("line", true);
  $dot = getbool("dot", true);

  if ($pie)
  {
// pie demo
	$g = new Multigraph(array(
		"title" => "MMMM PIE!",
		"type"	=> "pie",
		"width" => $gwidth,
		"height"=> $gheight,
	));
	$data = array(
		"dogs"	=> 13,
		"cats"	=> 5,
		"lemurs" => 20,
		"budgies" => 10,
	);
	$g->add_series($data);
	print("<a href=\"".$g->createurl()."&debug=1\"><img src=\""
		.$g->createurl()."\" title=\"click to see debug output\"></a><br>");
  }

	$types = array("dot", "line", "bar", "hbar");
  foreach ($types as $type) {
    if (!${$type})
      continue;
		if ($type == "line") {
			$sq = 1;
			$squarified = " (squarified)";
		} else {
			$squarified = "";
			$sq = 0;
		}
		$g = new Multigraph(array(
			"title"		=>	"$type graph".$squarified,
			"x_title"	=>	"Foo",
			"y_title"	=>	"Bar",
			"type"		=>	$type,
			"width"		=>  $gwidth,
			"height"	=>	$gheight,
			"square"	=>	$sq,
		));
		// 45 degree line
		for ($i = -5; $i < 10; $i++) {
			$s45[$i] = $i;
		}
		// 60 degree line
		for ($i = -5; $i < 10; $i++) {
			$s60[$i] = 2 * $i;
		}
		
		$g->add_series($s45, "Y = X");
		$g->add_series($s60, "Y = 2X");
		print("<a href=\"".$g->createurl()."&debug=1\"><img src=\""
			.$g->createurl()."\" title=\"click to see debug output\"></a><br>");
	}
	
?>
</body>
</html>
