<?php

function getInfoJson(string $module, string $version): string {
	$x = [];
	$x["Id"] = sprintf("dv-maid-skins-%s", mb_strtolower($module));
	$x["DisplayName"] = sprintf("Lace Transport Livery (%s)", $module);
	$x["Version"] = $version;
	$x["Author"] = "MisfitMaid";
	$x["ManagerVersion"] = "0.27.3";
	$x["Requirements"] = ["SkinManagerMod"];
	$x["HomePage"] = "https://github.com/MisfitMaid/dv-maid-skins";
	$x["Repository"] = sprintf("https://raw.githubusercontent.com/MisfitMaid/dv-maid-skins/mistress/%s/repository.json", $module);
	return json_encode($x, JSON_PRETTY_PRINT);
}

function addVersion(string $module, string $version): void {
	$info = json_decode(file_get_contents(sprintf("%s/repository.json", $module)), true);
	
	// check if there's already this version in the array
	foreach ($info["Releases"] as $release) {
		if ($release["Version"] == $version) return;
	}
	
	$x = [];
	$x["Id"] = sprintf("dv-maid-skins-%s", mb_strtolower($module));
	$x["Version"] = $version;
	$x["DownloadUrl"] = sprintf("https://github.com/MisfitMaid/dv-maid-skins/releases/download/v%s/dv-maid-skins-%s.zip", $version, mb_strtolower($module));
	$info["Releases"][] = $x;
	file_put_contents(sprintf("%s/repository.json", $module), json_encode($info, JSON_PRETTY_PRINT));
}

$version = trim(file_get_contents("CURRENT_VERSION"));

foreach (["Cars", "Locos"] as $mod) {
	file_put_contents(sprintf("%s/Info.json", $mod), getInfoJson($mod, $version));
	addVersion($mod, $version);
}