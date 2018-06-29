<?php
require_once "stimulsoft/helper.php";

// Please configure the security level as you required.
// By default is to allow any requests from any domains.
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Engaged-Auth-Token");

$handler = new StiHandler();
$handler->registerErrorHandlers();

$handler->onBeginProcessData = function ($args) {
	return StiResult::success();
};

$handler->onSaveReport = function ($args) {
	$result = file_put_contents("reports/{$args->fileName}.mrt", $args->reportJson);
	if ($result === false) return StiResult::error("Error while saving!");
	return StiResult::success("The report is saved.");
};

$handler->process();