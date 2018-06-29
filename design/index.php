<?php
require_once "stimulsoft/helper.php";
?>
<!DOCTYPE html>

<html>
<head>
	<title>Report.mrt - Designer</title>
	<link rel="stylesheet" type="text/css" href="css/stimulsoft.viewer.office2013.whiteblue.css">
	<link rel="stylesheet" type="text/css" href="css/stimulsoft.designer.office2013.whiteblue.css">
	<script type="text/javascript" src="scripts/stimulsoft.reports.js"></script>
	<script type="text/javascript" src="scripts/stimulsoft.viewer.js"></script>
	<script type="text/javascript" src="scripts/stimulsoft.designer.js"></script>

	<?php
		$options = StiHelper::createOptions();
		$options->handler = "handler.php";
		$options->timeout = 30;
		StiHelper::initialize($options);
	?>
	<script type="text/javascript">
		var report = new Stimulsoft.Report.StiReport();
		report.loadFile("reports/Report.mrt");

		var options = new Stimulsoft.Designer.StiDesignerOptions();
		var designer = new Stimulsoft.Designer.StiDesigner(options, "StiDesigner", false);

		designer.onBeginProcessData = function (args, callback) {
			<?php StiHelper::createHandler(); ?>
		}

		designer.onSaveReport = function (args) {
			<?php StiHelper::createHandler(); ?>
		}

		designer.report = report;
		designer.renderHtml("designerContent");
	</script>
</head>
<body>
	<div id="designerContent"></div>
</body>
</html>