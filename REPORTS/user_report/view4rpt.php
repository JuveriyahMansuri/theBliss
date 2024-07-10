<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start();
?>
<?php include_once "phprptinc/ewrcfg10.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "phprptinc/ewmysql.php") ?>
<?php include_once "phprptinc/ewrfn10.php" ?>
<?php include_once "phprptinc/ewrusrfn10.php" ?>
<?php include_once "view4rptinfo.php" ?>
<?php

//
// Page class
//

$view4_rpt = NULL; // Initialize page object first

class crview4_rpt extends crview4 {

	// Page ID
	var $PageID = 'rpt';

	// Project ID
	var $ProjectID = "{e076bf17-72b6-42b0-900b-e8c36042bfb6}";

	// Page object name
	var $PageObjName = 'view4_rpt';

	// Page name
	function PageName() {
		return ewr_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewr_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Export URLs
	var $ExportPrintUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportPdfUrl;
	var $ReportTableClass;
	var $ReportTableStyle = "";

	// Custom export
	var $ExportPrintCustom = FALSE;
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Message
	function getMessage() {
		return @$_SESSION[EWR_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EWR_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EWR_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EWR_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_WARNING_MESSAGE], $v);
	}

		// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EWR_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EWR_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EWR_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EWR_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog ewDisplayTable\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") // Header exists, display
			echo $sHeader;
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") // Fotoer exists, display
			echo $sFooter;
	}

	// Validate page request
	function IsPageRequest() {
		if ($this->UseTokenInUrl) {
			if (ewr_IsHttpPost())
				return ($this->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $CheckToken = EWR_CHECK_TOKEN;
	var $CheckTokenFn = "ewr_CheckToken";
	var $CreateTokenFn = "ewr_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ewr_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EWR_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EWR_TOKEN_NAME]);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (view4)
		if (!isset($GLOBALS["view4"])) {
			$GLOBALS["view4"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["view4"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";

		// Page ID
		if (!defined("EWR_PAGE_ID"))
			define("EWR_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWR_TABLE_NAME"))
			define("EWR_TABLE_NAME", 'view4', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new crTimer();

		// Open connection
		if (!isset($conn)) $conn = ewr_Connect($this->DBID);

		// Export options
		$this->ExportOptions = new crListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Search options
		$this->SearchOptions = new crListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Filter options
		$this->FilterOptions = new crListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption fview4rpt";

		// Generate report options
		$this->GenerateOptions = new crListOptions();
		$this->GenerateOptions->Tag = "div";
		$this->GenerateOptions->TagClassName = "ewGenerateOption";
	}

	//
	// Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $gsEmailContentType, $ReportLanguage, $Security;
		global $gsCustomExport;

		// Get export parameters
		if (@$_GET["export"] <> "")
			$this->Export = strtolower($_GET["export"]);
		elseif (@$_POST["export"] <> "")
			$this->Export = strtolower($_POST["export"]);
		$gsExport = $this->Export; // Get export parameter, used in header
		$gsExportFile = $this->TableVar; // Get export file, used in header
		$gsEmailContentType = @$_POST["contenttype"]; // Get email content type

		// Setup placeholder
		// Setup export options

		$this->SetupExportOptions();
		global $gbOldSkipHeaderFooter, $gbSkipHeaderFooter;
		$gbOldSkipHeaderFooter = $gbSkipHeaderFooter;
		$gbSkipHeaderFooter = TRUE;

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $ReportLanguage->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Security, $ReportLanguage, $ReportOptions;
		$exportid = session_id();
		$ReportTypes = array();

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("PrinterFriendly", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("PrinterFriendly", TRUE)) . "\" href=\"" . $this->ExportPrintUrl . "\">" . $ReportLanguage->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = FALSE;
		$ReportTypes["print"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormPrint") : "";

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToExcel", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToExcel", TRUE)) . "\" href=\"" . $this->ExportExcelUrl . "\">" . $ReportLanguage->Phrase("ExportToExcel") . "</a>";
		$item->Visible = FALSE;
		$ReportTypes["excel"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormExcel") : "";

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToWord", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToWord", TRUE)) . "\" href=\"" . $this->ExportWordUrl . "\">" . $ReportLanguage->Phrase("ExportToWord") . "</a>";

		//$item->Visible = FALSE;
		$item->Visible = FALSE;
		$ReportTypes["word"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormWord") : "";

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" href=\"" . $this->ExportPdfUrl . "\">" . $ReportLanguage->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Uncomment codes below to show export to Pdf link
//		$item->Visible = TRUE;

		$ReportTypes["pdf"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormPdf") : "";

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = $this->PageUrl() . "export=email";
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToEmail", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToEmail", TRUE)) . "\" id=\"emf_view4\" href=\"javascript:void(0);\" onclick=\"ewr_EmailDialogShow({lnk:'emf_view4',hdr:ewLanguage.Phrase('ExportToEmail'),url:'$url',exportid:'$exportid',el:this});\">" . $ReportLanguage->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;
		$ReportTypes["email"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormEmail") : "";
		$ReportOptions["ReportTypes"] = $ReportTypes;

		// Drop down button for export
		$this->ExportOptions->UseDropDownButton = FALSE;
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = $this->ExportOptions->UseDropDownButton;
		$this->ExportOptions->DropDownButtonPhrase = $ReportLanguage->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fview4rpt\" href=\"#\">" . $ReportLanguage->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fview4rpt\" href=\"#\">" . $ReportLanguage->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton; // v8
		$this->FilterOptions->DropDownButtonPhrase = $ReportLanguage->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Set up options (extended)
		$this->SetupExportOptionsExt();

		// Hide options for export
		if ($this->Export <> "") {
			$this->ExportOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
		}

		// Set up table class
		if ($this->Export == "word" || $this->Export == "excel" || $this->Export == "pdf")
			$this->ReportTableClass = "ewTable";
		else
			$this->ReportTableClass = "table ewTable";
	}

	// Set up search options
	function SetupSearchOptions() {
		global $ReportLanguage;

		// Filter panel button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = $this->FilterApplied ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $ReportLanguage->Phrase("SearchBtn", TRUE) . "\" data-caption=\"" . $ReportLanguage->Phrase("SearchBtn", TRUE) . "\" data-toggle=\"button\" data-form=\"fview4rpt\">" . $ReportLanguage->Phrase("SearchBtn") . "</button>";
		$item->Visible = TRUE;

		// Reset filter
		$item = &$this->SearchOptions->Add("resetfilter");
		$item->Body = "<button type=\"button\" class=\"btn btn-default\" title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ResetAllFilter", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ResetAllFilter", TRUE)) . "\" onclick=\"location='" . ewr_CurrentPage() . "?cmd=reset'\">" . $ReportLanguage->Phrase("ResetAllFilter") . "</button>";
		$item->Visible = TRUE && $this->FilterApplied;

		// Button group for reset filter
		$this->SearchOptions->UseButtonGroup = TRUE;

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->Export <> "")
			$this->SearchOptions->HideAllOptions();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $ReportLanguage, $EWR_EXPORT, $gsExportFile;
		global $gbOldSkipHeaderFooter, $gbSkipHeaderFooter;
		$gbSkipHeaderFooter = $gbOldSkipHeaderFooter;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		if ($this->Export <> "" && array_key_exists($this->Export, $EWR_EXPORT)) {
			$sContent = ob_get_contents();
			if (ob_get_length())
				ob_end_clean();

			// Remove all <div data-tagid="..." id="orig..." class="hide">...</div> (for customviewtag export, except "googlemaps")
			if (preg_match_all('/<div\s+data-tagid=[\'"]([\s\S]*?)[\'"]\s+id=[\'"]orig([\s\S]*?)[\'"]\s+class\s*=\s*[\'"]hide[\'"]>([\s\S]*?)<\/div\s*>/i', $sContent, $divmatches, PREG_SET_ORDER)) {
				foreach ($divmatches as $divmatch) {
					if ($divmatch[1] <> "googlemaps")
						$sContent = str_replace($divmatch[0], '', $sContent);
				}
			}
			$fn = $EWR_EXPORT[$this->Export];
			if ($this->Export == "email") { // Email
				if (@$this->GenOptions["reporttype"] == "email") {
					$saveResponse = $this->$fn($sContent, $this->GenOptions);
					$this->WriteGenResponse($saveResponse);
				} else {
					echo $this->$fn($sContent, array());
				}
				$url = ""; // Avoid redirect
			} else {
				$saveToFile = $this->$fn($sContent, $this->GenOptions);
				if (@$this->GenOptions["reporttype"] <> "") {
					$saveUrl = ($saveToFile <> "") ? ewr_ConvertFullUrl($saveToFile) : $ReportLanguage->Phrase("GenerateSuccess");
					$this->WriteGenResponse($saveUrl);
					$url = ""; // Avoid redirect
				}
			}
		}

		 // Close connection
		ewr_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EWR_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
	}

	// Initialize common variables
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $FilterOptions; // Filter options

	// Paging variables
	var $RecIndex = 0; // Record index
	var $RecCount = 0; // Record count
	var $StartGrp = 0; // Start group
	var $StopGrp = 0; // Stop group
	var $TotalGrps = 0; // Total groups
	var $GrpCount = 0; // Group count
	var $GrpCounter = array(); // Group counter
	var $DisplayGrps = 3; // Groups per page
	var $GrpRange = 10;
	var $Sort = "";
	var $Filter = "";
	var $PageFirstGroupFilter = "";
	var $UserIDFilter = "";
	var $DrillDown = FALSE;
	var $DrillDownInPanel = FALSE;
	var $DrillDownList = "";

	// Clear field for ext filter
	var $ClearExtFilter = "";
	var $PopupName = "";
	var $PopupValue = "";
	var $FilterApplied;
	var $SearchCommand = FALSE;
	var $ShowHeader;
	var $GrpColumnCount = 0;
	var $SubGrpColumnCount = 0;
	var $DtlColumnCount = 0;
	var $Cnt, $Col, $Val, $Smry, $Mn, $Mx, $GrandCnt, $GrandSmry, $GrandMn, $GrandMx;
	var $TotCount;
	var $GrandSummarySetup = FALSE;
	var $GrpIdx;
	var $DetailRows = array();

	//
	// Page main
	//
	function Page_Main() {
		global $rs;
		global $rsgrp;
		global $Security;
		global $gsFormError;
		global $gbDrillDownInPanel;
		global $ReportBreadcrumb;
		global $ReportLanguage;

		// Set field visibility for detail fields
		$this->user_id->SetVisibility();
		$this->user_name->SetVisibility();
		$this->email_address->SetVisibility();
		$this->mobile->SetVisibility();
		$this->addr->SetVisibility();
		$this->area_name->SetVisibility();
		$this->city_name->SetVisibility();
		$this->user_type->SetVisibility();

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 9;
		$nGrps = 1;
		$this->Val = &ewr_InitArray($nDtls, 0);
		$this->Cnt = &ewr_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = &ewr_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = &ewr_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = &ewr_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandCnt = &ewr_InitArray($nDtls, 0);
		$this->GrandSmry = &ewr_InitArray($nDtls, 0);
		$this->GrandMn = &ewr_InitArray($nDtls, NULL);
		$this->GrandMx = &ewr_InitArray($nDtls, NULL);

		// Set up array if accumulation required: array(Accum, SkipNullOrZero)
		$this->Col = array(array(FALSE, FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE));

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();
		$this->area_name->SelectionList = "";
		$this->area_name->DefaultSelectionList = "";
		$this->area_name->ValueList = "";
		$this->city_name->SelectionList = "";
		$this->city_name->DefaultSelectionList = "";
		$this->city_name->ValueList = "";
		$this->user_type->SelectionList = "";
		$this->user_type->DefaultSelectionList = "";
		$this->user_type->ValueList = "";

		// Check if search command
		$this->SearchCommand = (@$_GET["cmd"] == "search");

		// Load default filter values
		$this->LoadDefaultFilters();

		// Load custom filters
		$this->Page_FilterLoad();

		// Set up popup filter
		$this->SetupPopup();

		// Load group db values if necessary
		$this->LoadGroupDbValues();

		// Handle Ajax popup
		$this->ProcessAjaxPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Restore filter list
		$this->RestoreFilterList();

		// Build extended filter
		$sExtendedFilter = $this->GetExtendedFilter();
		ewr_AddFilter($this->Filter, $sExtendedFilter);

		// Build popup filter
		$sPopupFilter = $this->GetPopupFilter();

		//ewr_SetDebugMsg("popup filter: " . $sPopupFilter);
		ewr_AddFilter($this->Filter, $sPopupFilter);

		// Check if filter applied
		$this->FilterApplied = $this->CheckFilter();

		// Call Page Selecting event
		$this->Page_Selecting($this->Filter);

		// Search options
		$this->SetupSearchOptions();

		// Get sort
		$this->Sort = $this->GetSort($this->GenOptions);

		// Get total count
		$sSql = ewr_BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0 || $this->DrillDown) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowHeader = TRUE;

		// Set up start position if not export all
		if ($this->ExportAll && $this->Export <> "")
			$this->DisplayGrps = $this->TotalGrps;
		else
			$this->SetUpStartGroup($this->GenOptions);

		// Set no record found message
		if ($this->TotalGrps == 0) {
				if ($this->Filter == "0=101") {
					$this->setWarningMessage($ReportLanguage->Phrase("EnterSearchCriteria"));
				} else {
					$this->setWarningMessage($ReportLanguage->Phrase("NoRecord"));
				}
		}

		// Hide export options if export
		if ($this->Export <> "")
			$this->ExportOptions->HideAllOptions();

		// Hide search/filter options if export/drilldown
		if ($this->Export <> "" || $this->DrillDown) {
			$this->SearchOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
			$this->GenerateOptions->HideAllOptions();
		}

		// Get current page records
		$rs = $this->GetRs($sSql, $this->StartGrp, $this->DisplayGrps);
		$this->SetupFieldCount();
	}

	// Accummulate summary
	function AccumulateSummary() {
		$cntx = count($this->Smry);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				if ($this->Col[$iy][0]) { // Accumulate required
					$valwrk = $this->Val[$iy];
					if (is_null($valwrk)) {
						if (!$this->Col[$iy][1])
							$this->Cnt[$ix][$iy]++;
					} else {
						$accum = (!$this->Col[$iy][1] || !is_numeric($valwrk) || $valwrk <> 0);
						if ($accum) {
							$this->Cnt[$ix][$iy]++;
							if (is_numeric($valwrk)) {
								$this->Smry[$ix][$iy] += $valwrk;
								if (is_null($this->Mn[$ix][$iy])) {
									$this->Mn[$ix][$iy] = $valwrk;
									$this->Mx[$ix][$iy] = $valwrk;
								} else {
									if ($this->Mn[$ix][$iy] > $valwrk) $this->Mn[$ix][$iy] = $valwrk;
									if ($this->Mx[$ix][$iy] < $valwrk) $this->Mx[$ix][$iy] = $valwrk;
								}
							}
						}
					}
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0]++;
		}
	}

	// Reset level summary
	function ResetLevelSummary($lvl) {

		// Clear summary values
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy] = 0;
				if ($this->Col[$iy][0]) {
					$this->Smry[$ix][$iy] = 0;
					$this->Mn[$ix][$iy] = NULL;
					$this->Mx[$ix][$iy] = NULL;
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0] = 0;
		}

		// Reset record count
		$this->RecCount = 0;
	}

	// Accummulate grand summary
	function AccumulateGrandSummary() {
		$this->TotCount++;
		$cntgs = count($this->GrandSmry);
		for ($iy = 1; $iy < $cntgs; $iy++) {
			if ($this->Col[$iy][0]) {
				$valwrk = $this->Val[$iy];
				if (is_null($valwrk) || !is_numeric($valwrk)) {
					if (!$this->Col[$iy][1])
						$this->GrandCnt[$iy]++;
				} else {
					if (!$this->Col[$iy][1] || $valwrk <> 0) {
						$this->GrandCnt[$iy]++;
						$this->GrandSmry[$iy] += $valwrk;
						if (is_null($this->GrandMn[$iy])) {
							$this->GrandMn[$iy] = $valwrk;
							$this->GrandMx[$iy] = $valwrk;
						} else {
							if ($this->GrandMn[$iy] > $valwrk) $this->GrandMn[$iy] = $valwrk;
							if ($this->GrandMx[$iy] < $valwrk) $this->GrandMx[$iy] = $valwrk;
						}
					}
				}
			}
		}
	}

	// Get count
	function GetCnt($sql) {
		$conn = &$this->Connection();
		$rscnt = $conn->Execute($sql);
		$cnt = ($rscnt) ? $rscnt->RecordCount() : 0;
		if ($rscnt) $rscnt->Close();
		return $cnt;
	}

	// Get recordset
	function GetRs($wrksql, $start, $grps) {
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EWR_ERROR_FN"];
		$rswrk = $conn->SelectLimit($wrksql, $grps, $start - 1);
		$conn->raiseErrorFn = '';
		return $rswrk;
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row
			$rs->MoveFirst(); // Move first
				$this->FirstRowData = array();
				$this->FirstRowData['user_id'] = ewr_Conv($rs->fields('user_id'), 3);
				$this->FirstRowData['user_name'] = ewr_Conv($rs->fields('user_name'), 200);
				$this->FirstRowData['email_address'] = ewr_Conv($rs->fields('email_address'), 200);
				$this->FirstRowData['mobile'] = ewr_Conv($rs->fields('mobile'), 20);
				$this->FirstRowData['addr'] = ewr_Conv($rs->fields('addr'), 200);
				$this->FirstRowData['area_name'] = ewr_Conv($rs->fields('area_name'), 200);
				$this->FirstRowData['city_name'] = ewr_Conv($rs->fields('city_name'), 200);
				$this->FirstRowData['user_type'] = ewr_Conv($rs->fields('user_type'), 200);
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$this->user_id->setDbValue($rs->fields('user_id'));
			$this->user_name->setDbValue($rs->fields('user_name'));
			$this->email_address->setDbValue($rs->fields('email_address'));
			$this->mobile->setDbValue($rs->fields('mobile'));
			$this->addr->setDbValue($rs->fields('addr'));
			$this->area_name->setDbValue($rs->fields('area_name'));
			$this->city_name->setDbValue($rs->fields('city_name'));
			$this->user_type->setDbValue($rs->fields('user_type'));
			$this->Val[1] = $this->user_id->CurrentValue;
			$this->Val[2] = $this->user_name->CurrentValue;
			$this->Val[3] = $this->email_address->CurrentValue;
			$this->Val[4] = $this->mobile->CurrentValue;
			$this->Val[5] = $this->addr->CurrentValue;
			$this->Val[6] = $this->area_name->CurrentValue;
			$this->Val[7] = $this->city_name->CurrentValue;
			$this->Val[8] = $this->user_type->CurrentValue;
		} else {
			$this->user_id->setDbValue("");
			$this->user_name->setDbValue("");
			$this->email_address->setDbValue("");
			$this->mobile->setDbValue("");
			$this->addr->setDbValue("");
			$this->area_name->setDbValue("");
			$this->city_name->setDbValue("");
			$this->user_type->setDbValue("");
		}
	}

	// Set up starting group
	function SetUpStartGroup($options = array()) {

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;
		$startGrp = (@$options["start"] <> "") ? $options["start"] : @$_GET[EWR_TABLE_START_GROUP];
		$pageNo = (@$options["pageno"] <> "") ? $options["pageno"] : @$_GET["pageno"];

		// Check for a 'start' parameter
		if ($startGrp != "") {
			$this->StartGrp = $startGrp;
			$this->setStartGroup($this->StartGrp);
		} elseif ($pageNo != "") {
			$nPageNo = $pageNo;
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$this->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $this->getStartGroup();
			}
		} else {
			$this->StartGrp = $this->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$this->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$this->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$this->setStartGroup($this->StartGrp);
		}
	}

	// Load group db values if necessary
	function LoadGroupDbValues() {
		$conn = &$this->Connection();
	}

	// Process Ajax popup
	function ProcessAjaxPopup() {
		global $ReportLanguage;
		$conn = &$this->Connection();
		$fld = NULL;
		if (@$_GET["popup"] <> "") {
			$popupname = $_GET["popup"];

			// Check popup name
			// Build distinct values for area_name

			if ($popupname == 'view4_area_name') {
				$bNullValue = FALSE;
				$bEmptyValue = FALSE;
				$sFilter = $this->Filter;

				// Call Page Filtering event
				$this->Page_Filtering($this->area_name, $sFilter, "popup");
				$sSql = ewr_BuildReportSql($this->area_name->SqlSelect, $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->area_name->SqlOrderBy, $sFilter, "");
				$rswrk = $conn->Execute($sSql);
				while ($rswrk && !$rswrk->EOF) {
					$this->area_name->setDbValue($rswrk->fields[0]);
					$this->area_name->ViewValue = @$rswrk->fields[1];
					if (is_null($this->area_name->CurrentValue)) {
						$bNullValue = TRUE;
					} elseif ($this->area_name->CurrentValue == "") {
						$bEmptyValue = TRUE;
					} else {
						ewr_SetupDistinctValues($this->area_name->ValueList, $this->area_name->CurrentValue, $this->area_name->ViewValue, FALSE, $this->area_name->FldDelimiter);
					}
					$rswrk->MoveNext();
				}
				if ($rswrk)
					$rswrk->Close();
				if ($bEmptyValue)
					ewr_SetupDistinctValues($this->area_name->ValueList, EWR_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
				if ($bNullValue)
					ewr_SetupDistinctValues($this->area_name->ValueList, EWR_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);
				$fld = &$this->area_name;
			}

			// Build distinct values for city_name
			if ($popupname == 'view4_city_name') {
				$bNullValue = FALSE;
				$bEmptyValue = FALSE;
				$sFilter = $this->Filter;

				// Call Page Filtering event
				$this->Page_Filtering($this->city_name, $sFilter, "popup");
				$sSql = ewr_BuildReportSql($this->city_name->SqlSelect, $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->city_name->SqlOrderBy, $sFilter, "");
				$rswrk = $conn->Execute($sSql);
				while ($rswrk && !$rswrk->EOF) {
					$this->city_name->setDbValue($rswrk->fields[0]);
					$this->city_name->ViewValue = @$rswrk->fields[1];
					if (is_null($this->city_name->CurrentValue)) {
						$bNullValue = TRUE;
					} elseif ($this->city_name->CurrentValue == "") {
						$bEmptyValue = TRUE;
					} else {
						ewr_SetupDistinctValues($this->city_name->ValueList, $this->city_name->CurrentValue, $this->city_name->ViewValue, FALSE, $this->city_name->FldDelimiter);
					}
					$rswrk->MoveNext();
				}
				if ($rswrk)
					$rswrk->Close();
				if ($bEmptyValue)
					ewr_SetupDistinctValues($this->city_name->ValueList, EWR_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
				if ($bNullValue)
					ewr_SetupDistinctValues($this->city_name->ValueList, EWR_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);
				$fld = &$this->city_name;
			}

			// Build distinct values for user_type
			if ($popupname == 'view4_user_type') {
				$bNullValue = FALSE;
				$bEmptyValue = FALSE;
				$sFilter = $this->Filter;

				// Call Page Filtering event
				$this->Page_Filtering($this->user_type, $sFilter, "popup");
				$sSql = ewr_BuildReportSql($this->user_type->SqlSelect, $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->user_type->SqlOrderBy, $sFilter, "");
				$rswrk = $conn->Execute($sSql);
				while ($rswrk && !$rswrk->EOF) {
					$this->user_type->setDbValue($rswrk->fields[0]);
					$this->user_type->ViewValue = @$rswrk->fields[1];
					if (is_null($this->user_type->CurrentValue)) {
						$bNullValue = TRUE;
					} elseif ($this->user_type->CurrentValue == "") {
						$bEmptyValue = TRUE;
					} else {
						ewr_SetupDistinctValues($this->user_type->ValueList, $this->user_type->CurrentValue, $this->user_type->ViewValue, FALSE, $this->user_type->FldDelimiter);
					}
					$rswrk->MoveNext();
				}
				if ($rswrk)
					$rswrk->Close();
				if ($bEmptyValue)
					ewr_SetupDistinctValues($this->user_type->ValueList, EWR_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
				if ($bNullValue)
					ewr_SetupDistinctValues($this->user_type->ValueList, EWR_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);
				$fld = &$this->user_type;
			}

			// Output data as Json
			if (!is_null($fld)) {
				$jsdb = ewr_GetJsDb($fld, $fld->FldType);
				if (ob_get_length())
					ob_end_clean();
				echo $jsdb;
				exit();
			}
		}
	}

	// Set up popup
	function SetupPopup() {
		global $ReportLanguage;
		$conn = &$this->Connection();
		if ($this->DrillDown)
			return;

		// Process post back form
		if (ewr_IsHttpPost()) {
			$sName = @$_POST["popup"]; // Get popup form name
			if ($sName <> "") {
				$cntValues = (is_array(@$_POST["sel_$sName"])) ? count($_POST["sel_$sName"]) : 0;
				if ($cntValues > 0) {
					$arValues = ewr_StripSlashes($_POST["sel_$sName"]);
					if (trim($arValues[0]) == "") // Select all
						$arValues = EWR_INIT_VALUE;
					$this->PopupName = $sName;
					if (ewr_IsAdvancedFilterValue($arValues) || $arValues == EWR_INIT_VALUE)
						$this->PopupValue = $arValues;
					if (!ewr_MatchedArray($arValues, $_SESSION["sel_$sName"])) {
						if ($this->HasSessionFilterValues($sName))
							$this->ClearExtFilter = $sName; // Clear extended filter for this field
					}
					$_SESSION["sel_$sName"] = $arValues;
					$_SESSION["rf_$sName"] = ewr_StripSlashes(@$_POST["rf_$sName"]);
					$_SESSION["rt_$sName"] = ewr_StripSlashes(@$_POST["rt_$sName"]);
					$this->ResetPager();
				}
			}

		// Get 'reset' command
		} elseif (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];
			if (strtolower($sCmd) == "reset") {
				$this->ClearSessionSelection('area_name');
				$this->ClearSessionSelection('city_name');
				$this->ClearSessionSelection('user_type');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get area_name selected values

		if (is_array(@$_SESSION["sel_view4_area_name"])) {
			$this->LoadSelectionFromSession('area_name');
		} elseif (@$_SESSION["sel_view4_area_name"] == EWR_INIT_VALUE) { // Select all
			$this->area_name->SelectionList = "";
		}

		// Get city_name selected values
		if (is_array(@$_SESSION["sel_view4_city_name"])) {
			$this->LoadSelectionFromSession('city_name');
		} elseif (@$_SESSION["sel_view4_city_name"] == EWR_INIT_VALUE) { // Select all
			$this->city_name->SelectionList = "";
		}

		// Get user_type selected values
		if (is_array(@$_SESSION["sel_view4_user_type"])) {
			$this->LoadSelectionFromSession('user_type');
		} elseif (@$_SESSION["sel_view4_user_type"] == EWR_INIT_VALUE) { // Select all
			$this->user_type->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		$this->StartGrp = 1;
		$this->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		$sWrk = @$_GET[EWR_TABLE_GROUP_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayGrps = intval($sWrk);
			} else {
				if (strtoupper($sWrk) == "ALL") { // Display all groups
					$this->DisplayGrps = -1;
				} else {
					$this->DisplayGrps = 3; // Non-numeric, load default
				}
			}
			$this->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$this->setStartGroup($this->StartGrp);
		} else {
			if ($this->getGroupPerPage() <> "") {
				$this->DisplayGrps = $this->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	// Render row
	function RenderRow() {
		global $rs, $Security, $ReportLanguage;
		$conn = &$this->Connection();
		if (!$this->GrandSummarySetup) { // Get Grand total
			$bGotCount = FALSE;
			$bGotSummary = FALSE;

			// Get total count from sql directly
			$sSql = ewr_BuildReportSql($this->getSqlSelectCount(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
				$bGotCount = TRUE;
			} else {
				$this->TotCount = 0;
			}
		$bGotSummary = TRUE;

			// Accumulate grand summary from detail records
			if (!$bGotCount || !$bGotSummary) {
				$sSql = ewr_BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
				$rs = $conn->Execute($sSql);
				if ($rs) {
					$this->GetRow(1);
					while (!$rs->EOF) {
						$this->AccumulateGrandSummary();
						$this->GetRow(2);
					}
					$rs->Close();
				}
			}
			$this->GrandSummarySetup = TRUE; // No need to set up again
		}

		// Call Row_Rendering event
		$this->Row_Rendering();

		//
		// Render view codes
		//

		if ($this->RowType == EWR_ROWTYPE_TOTAL && !($this->RowTotalType == EWR_ROWTOTAL_GROUP && $this->RowTotalSubType == EWR_ROWTOTAL_HEADER)) { // Summary row
			ewr_PrependClass($this->RowAttrs["class"], ($this->RowTotalType == EWR_ROWTOTAL_PAGE || $this->RowTotalType == EWR_ROWTOTAL_GRAND) ? "ewRptGrpAggregate" : "ewRptGrpSummary" . $this->RowGroupLevel); // Set up row class

			// user_id
			$this->user_id->HrefValue = "";

			// user_name
			$this->user_name->HrefValue = "";

			// email_address
			$this->email_address->HrefValue = "";

			// mobile
			$this->mobile->HrefValue = "";

			// addr
			$this->addr->HrefValue = "";

			// area_name
			$this->area_name->HrefValue = "";

			// city_name
			$this->city_name->HrefValue = "";

			// user_type
			$this->user_type->HrefValue = "";
		} else {
			if ($this->RowTotalType == EWR_ROWTOTAL_GROUP && $this->RowTotalSubType == EWR_ROWTOTAL_HEADER) {
			} else {
			}

			// user_id
			$this->user_id->ViewValue = $this->user_id->CurrentValue;
			$this->user_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// user_name
			$this->user_name->ViewValue = $this->user_name->CurrentValue;
			$this->user_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// email_address
			$this->email_address->ViewValue = $this->email_address->CurrentValue;
			$this->email_address->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// mobile
			$this->mobile->ViewValue = $this->mobile->CurrentValue;
			$this->mobile->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// addr
			$this->addr->ViewValue = $this->addr->CurrentValue;
			$this->addr->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// area_name
			$this->area_name->ViewValue = $this->area_name->CurrentValue;
			$this->area_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// city_name
			$this->city_name->ViewValue = $this->city_name->CurrentValue;
			$this->city_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// user_type
			$this->user_type->ViewValue = $this->user_type->CurrentValue;
			$this->user_type->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// user_id
			$this->user_id->HrefValue = "";

			// user_name
			$this->user_name->HrefValue = "";

			// email_address
			$this->email_address->HrefValue = "";

			// mobile
			$this->mobile->HrefValue = "";

			// addr
			$this->addr->HrefValue = "";

			// area_name
			$this->area_name->HrefValue = "";

			// city_name
			$this->city_name->HrefValue = "";

			// user_type
			$this->user_type->HrefValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == EWR_ROWTYPE_TOTAL) { // Summary row
		} else {

			// user_id
			$CurrentValue = $this->user_id->CurrentValue;
			$ViewValue = &$this->user_id->ViewValue;
			$ViewAttrs = &$this->user_id->ViewAttrs;
			$CellAttrs = &$this->user_id->CellAttrs;
			$HrefValue = &$this->user_id->HrefValue;
			$LinkAttrs = &$this->user_id->LinkAttrs;
			$this->Cell_Rendered($this->user_id, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// user_name
			$CurrentValue = $this->user_name->CurrentValue;
			$ViewValue = &$this->user_name->ViewValue;
			$ViewAttrs = &$this->user_name->ViewAttrs;
			$CellAttrs = &$this->user_name->CellAttrs;
			$HrefValue = &$this->user_name->HrefValue;
			$LinkAttrs = &$this->user_name->LinkAttrs;
			$this->Cell_Rendered($this->user_name, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// email_address
			$CurrentValue = $this->email_address->CurrentValue;
			$ViewValue = &$this->email_address->ViewValue;
			$ViewAttrs = &$this->email_address->ViewAttrs;
			$CellAttrs = &$this->email_address->CellAttrs;
			$HrefValue = &$this->email_address->HrefValue;
			$LinkAttrs = &$this->email_address->LinkAttrs;
			$this->Cell_Rendered($this->email_address, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// mobile
			$CurrentValue = $this->mobile->CurrentValue;
			$ViewValue = &$this->mobile->ViewValue;
			$ViewAttrs = &$this->mobile->ViewAttrs;
			$CellAttrs = &$this->mobile->CellAttrs;
			$HrefValue = &$this->mobile->HrefValue;
			$LinkAttrs = &$this->mobile->LinkAttrs;
			$this->Cell_Rendered($this->mobile, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// addr
			$CurrentValue = $this->addr->CurrentValue;
			$ViewValue = &$this->addr->ViewValue;
			$ViewAttrs = &$this->addr->ViewAttrs;
			$CellAttrs = &$this->addr->CellAttrs;
			$HrefValue = &$this->addr->HrefValue;
			$LinkAttrs = &$this->addr->LinkAttrs;
			$this->Cell_Rendered($this->addr, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// area_name
			$CurrentValue = $this->area_name->CurrentValue;
			$ViewValue = &$this->area_name->ViewValue;
			$ViewAttrs = &$this->area_name->ViewAttrs;
			$CellAttrs = &$this->area_name->CellAttrs;
			$HrefValue = &$this->area_name->HrefValue;
			$LinkAttrs = &$this->area_name->LinkAttrs;
			$this->Cell_Rendered($this->area_name, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// city_name
			$CurrentValue = $this->city_name->CurrentValue;
			$ViewValue = &$this->city_name->ViewValue;
			$ViewAttrs = &$this->city_name->ViewAttrs;
			$CellAttrs = &$this->city_name->CellAttrs;
			$HrefValue = &$this->city_name->HrefValue;
			$LinkAttrs = &$this->city_name->LinkAttrs;
			$this->Cell_Rendered($this->city_name, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// user_type
			$CurrentValue = $this->user_type->CurrentValue;
			$ViewValue = &$this->user_type->ViewValue;
			$ViewAttrs = &$this->user_type->ViewAttrs;
			$CellAttrs = &$this->user_type->CellAttrs;
			$HrefValue = &$this->user_type->HrefValue;
			$LinkAttrs = &$this->user_type->LinkAttrs;
			$this->Cell_Rendered($this->user_type, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);
		}

		// Call Row_Rendered event
		$this->Row_Rendered();
		$this->SetupFieldCount();
	}

	// Setup field count
	function SetupFieldCount() {
		$this->GrpColumnCount = 0;
		$this->SubGrpColumnCount = 0;
		$this->DtlColumnCount = 0;
		if ($this->user_id->Visible) $this->DtlColumnCount += 1;
		if ($this->user_name->Visible) $this->DtlColumnCount += 1;
		if ($this->email_address->Visible) $this->DtlColumnCount += 1;
		if ($this->mobile->Visible) $this->DtlColumnCount += 1;
		if ($this->addr->Visible) $this->DtlColumnCount += 1;
		if ($this->area_name->Visible) $this->DtlColumnCount += 1;
		if ($this->city_name->Visible) $this->DtlColumnCount += 1;
		if ($this->user_type->Visible) $this->DtlColumnCount += 1;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $ReportBreadcrumb;
		$ReportBreadcrumb = new crBreadcrumb();
		$url = substr(ewr_CurrentUrl(), strrpos(ewr_CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$ReportBreadcrumb->Add("rpt", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	function SetupExportOptionsExt() {
		global $ReportLanguage, $ReportOptions;
		$ReportTypes = $ReportOptions["ReportTypes"];
		$item =& $this->ExportOptions->GetItem("pdf");
		$item->Visible = TRUE;
		if ($item->Visible)
			$ReportTypes["pdf"] = $ReportLanguage->Phrase("ReportFormPdf");
		$exportid = session_id();
		$url = $this->ExportPdfUrl;
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" href=\"javascript:void(0);\" onclick=\"ewr_ExportCharts(this, '" . $url . "', '" . $exportid . "');\">" . $ReportLanguage->Phrase("ExportToPDF") . "</a>";
		$ReportOptions["ReportTypes"] = $ReportTypes;
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $gsFormError;
		$sFilter = "";
		if ($this->DrillDown)
			return "";
		$bPostBack = ewr_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

			// Set/clear dropdown for field area_name
			if ($this->PopupName == 'view4_area_name' && $this->PopupValue <> "") {
				if ($this->PopupValue == EWR_INIT_VALUE)
					$this->area_name->DropDownValue = EWR_ALL_VALUE;
				else
					$this->area_name->DropDownValue = $this->PopupValue;
				$bRestoreSession = FALSE; // Do not restore
			} elseif ($this->ClearExtFilter == 'view4_area_name') {
				$this->SetSessionDropDownValue(EWR_INIT_VALUE, '', 'area_name');
			}

			// Set/clear dropdown for field city_name
			if ($this->PopupName == 'view4_city_name' && $this->PopupValue <> "") {
				if ($this->PopupValue == EWR_INIT_VALUE)
					$this->city_name->DropDownValue = EWR_ALL_VALUE;
				else
					$this->city_name->DropDownValue = $this->PopupValue;
				$bRestoreSession = FALSE; // Do not restore
			} elseif ($this->ClearExtFilter == 'view4_city_name') {
				$this->SetSessionDropDownValue(EWR_INIT_VALUE, '', 'city_name');
			}

			// Set/clear dropdown for field user_type
			if ($this->PopupName == 'view4_user_type' && $this->PopupValue <> "") {
				if ($this->PopupValue == EWR_INIT_VALUE)
					$this->user_type->DropDownValue = EWR_ALL_VALUE;
				else
					$this->user_type->DropDownValue = $this->PopupValue;
				$bRestoreSession = FALSE; // Do not restore
			} elseif ($this->ClearExtFilter == 'view4_user_type') {
				$this->SetSessionDropDownValue(EWR_INIT_VALUE, '', 'user_type');
			}

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			$this->SetSessionDropDownValue($this->area_name->DropDownValue, $this->area_name->SearchOperator, 'area_name'); // Field area_name
			$this->SetSessionDropDownValue($this->city_name->DropDownValue, $this->city_name->SearchOperator, 'city_name'); // Field city_name
			$this->SetSessionDropDownValue($this->user_type->DropDownValue, $this->user_type->SearchOperator, 'user_type'); // Field user_type

			//$bSetupFilter = TRUE; // No need to set up, just use default
		} else {
			$bRestoreSession = !$this->SearchCommand;

			// Field area_name
			if ($this->GetDropDownValue($this->area_name)) {
				$bSetupFilter = TRUE;
			} elseif ($this->area_name->DropDownValue <> EWR_INIT_VALUE && !isset($_SESSION['sv_view4_area_name'])) {
				$bSetupFilter = TRUE;
			}

			// Field city_name
			if ($this->GetDropDownValue($this->city_name)) {
				$bSetupFilter = TRUE;
			} elseif ($this->city_name->DropDownValue <> EWR_INIT_VALUE && !isset($_SESSION['sv_view4_city_name'])) {
				$bSetupFilter = TRUE;
			}

			// Field user_type
			if ($this->GetDropDownValue($this->user_type)) {
				$bSetupFilter = TRUE;
			} elseif ($this->user_type->DropDownValue <> EWR_INIT_VALUE && !isset($_SESSION['sv_view4_user_type'])) {
				$bSetupFilter = TRUE;
			}
			if (!$this->ValidateForm()) {
				$this->setFailureMessage($gsFormError);
				return $sFilter;
			}
		}

		// Restore session
		if ($bRestoreSession) {
			$this->GetSessionDropDownValue($this->area_name); // Field area_name
			$this->GetSessionDropDownValue($this->city_name); // Field city_name
			$this->GetSessionDropDownValue($this->user_type); // Field user_type
		}

		// Call page filter validated event
		$this->Page_FilterValidated();

		// Build SQL
		$this->BuildDropDownFilter($this->area_name, $sFilter, $this->area_name->SearchOperator, FALSE, TRUE); // Field area_name
		$this->BuildDropDownFilter($this->city_name, $sFilter, $this->city_name->SearchOperator, FALSE, TRUE); // Field city_name
		$this->BuildDropDownFilter($this->user_type, $sFilter, $this->user_type->SearchOperator, FALSE, TRUE); // Field user_type

		// Save parms to session
		$this->SetSessionDropDownValue($this->area_name->DropDownValue, $this->area_name->SearchOperator, 'area_name'); // Field area_name
		$this->SetSessionDropDownValue($this->city_name->DropDownValue, $this->city_name->SearchOperator, 'city_name'); // Field city_name
		$this->SetSessionDropDownValue($this->user_type->DropDownValue, $this->user_type->SearchOperator, 'user_type'); // Field user_type

		// Setup filter
		if ($bSetupFilter) {

			// Field area_name
			$sWrk = "";
			$this->BuildDropDownFilter($this->area_name, $sWrk, $this->area_name->SearchOperator);
			ewr_LoadSelectionFromFilter($this->area_name, $sWrk, $this->area_name->SelectionList, $this->area_name->DropDownValue);
			$_SESSION['sel_view4_area_name'] = ($this->area_name->SelectionList == "") ? EWR_INIT_VALUE : $this->area_name->SelectionList;

			// Field city_name
			$sWrk = "";
			$this->BuildDropDownFilter($this->city_name, $sWrk, $this->city_name->SearchOperator);
			ewr_LoadSelectionFromFilter($this->city_name, $sWrk, $this->city_name->SelectionList, $this->city_name->DropDownValue);
			$_SESSION['sel_view4_city_name'] = ($this->city_name->SelectionList == "") ? EWR_INIT_VALUE : $this->city_name->SelectionList;

			// Field user_type
			$sWrk = "";
			$this->BuildDropDownFilter($this->user_type, $sWrk, $this->user_type->SearchOperator);
			ewr_LoadSelectionFromFilter($this->user_type, $sWrk, $this->user_type->SelectionList, $this->user_type->DropDownValue);
			$_SESSION['sel_view4_user_type'] = ($this->user_type->SelectionList == "") ? EWR_INIT_VALUE : $this->user_type->SelectionList;
		}

		// Field area_name
		ewr_LoadDropDownList($this->area_name->DropDownList, $this->area_name->DropDownValue);

		// Field city_name
		ewr_LoadDropDownList($this->city_name->DropDownList, $this->city_name->DropDownValue);

		// Field user_type
		ewr_LoadDropDownList($this->user_type->DropDownList, $this->user_type->DropDownValue);
		return $sFilter;
	}

	// Build dropdown filter
	function BuildDropDownFilter(&$fld, &$FilterClause, $FldOpr, $Default = FALSE, $SaveFilter = FALSE) {
		$FldVal = ($Default) ? $fld->DefaultDropDownValue : $fld->DropDownValue;
		$sSql = "";
		if (is_array($FldVal)) {
			foreach ($FldVal as $val) {
				$sWrk = $this->GetDropDownFilter($fld, $val, $FldOpr);

				// Call Page Filtering event
				if (substr($val, 0, 2) <> "@@") $this->Page_Filtering($fld, $sWrk, "dropdown", $FldOpr, $val);
				if ($sWrk <> "") {
					if ($sSql <> "")
						$sSql .= " OR " . $sWrk;
					else
						$sSql = $sWrk;
				}
			}
		} else {
			$sSql = $this->GetDropDownFilter($fld, $FldVal, $FldOpr);

			// Call Page Filtering event
			if (substr($FldVal, 0, 2) <> "@@") $this->Page_Filtering($fld, $sSql, "dropdown", $FldOpr, $FldVal);
		}
		if ($sSql <> "") {
			ewr_AddFilter($FilterClause, $sSql);
			if ($SaveFilter) $fld->CurrentFilter = $sSql;
		}
	}

	function GetDropDownFilter(&$fld, $FldVal, $FldOpr) {
		$FldName = $fld->FldName;
		$FldExpression = $fld->FldExpression;
		$FldDataType = $fld->FldDataType;
		$FldDelimiter = $fld->FldDelimiter;
		$FldVal = strval($FldVal);
		if ($FldOpr == "") $FldOpr = "=";
		$sWrk = "";
		if (ewr_SameStr($FldVal, EWR_NULL_VALUE)) {
			$sWrk = $FldExpression . " IS NULL";
		} elseif (ewr_SameStr($FldVal, EWR_NOT_NULL_VALUE)) {
			$sWrk = $FldExpression . " IS NOT NULL";
		} elseif (ewr_SameStr($FldVal, EWR_EMPTY_VALUE)) {
			$sWrk = $FldExpression . " = ''";
		} elseif (ewr_SameStr($FldVal, EWR_ALL_VALUE)) {
			$sWrk = "1 = 1";
		} else {
			if (substr($FldVal, 0, 2) == "@@") {
				$sWrk = $this->GetCustomFilter($fld, $FldVal, $this->DBID);
			} elseif ($FldDelimiter <> "" && trim($FldVal) <> "" && ($FldDataType == EWR_DATATYPE_STRING || $FldDataType == EWR_DATATYPE_MEMO)) {
				$sWrk = ewr_GetMultiSearchSql($FldExpression, trim($FldVal), $this->DBID);
			} else {
				if ($FldVal <> "" && $FldVal <> EWR_INIT_VALUE) {
					if ($FldDataType == EWR_DATATYPE_DATE && $FldOpr <> "") {
						$sWrk = ewr_DateFilterString($FldExpression, $FldOpr, $FldVal, $FldDataType, $this->DBID);
					} else {
						$sWrk = ewr_FilterString($FldOpr, $FldVal, $FldDataType, $this->DBID);
						if ($sWrk <> "") $sWrk = $FldExpression . $sWrk;
					}
				}
			}
		}
		return $sWrk;
	}

	// Get custom filter
	function GetCustomFilter(&$fld, $FldVal, $dbid = 0) {
		$sWrk = "";
		if (is_array($fld->AdvancedFilters)) {
			foreach ($fld->AdvancedFilters as $filter) {
				if ($filter->ID == $FldVal && $filter->Enabled) {
					$sFld = $fld->FldExpression;
					$sFn = $filter->FunctionName;
					$wrkid = (substr($filter->ID,0,2) == "@@") ? substr($filter->ID,2) : $filter->ID;
					if ($sFn <> "")
						$sWrk = $sFn($sFld, $dbid);
					else
						$sWrk = "";
					$this->Page_Filtering($fld, $sWrk, "custom", $wrkid);
					break;
				}
			}
		}
		return $sWrk;
	}

	// Build extended filter
	function BuildExtendedFilter(&$fld, &$FilterClause, $Default = FALSE, $SaveFilter = FALSE) {
		$sWrk = ewr_GetExtendedFilter($fld, $Default, $this->DBID);
		if (!$Default)
			$this->Page_Filtering($fld, $sWrk, "extended", $fld->SearchOperator, $fld->SearchValue, $fld->SearchCondition, $fld->SearchOperator2, $fld->SearchValue2);
		if ($sWrk <> "") {
			ewr_AddFilter($FilterClause, $sWrk);
			if ($SaveFilter) $fld->CurrentFilter = $sWrk;
		}
	}

	// Get drop down value from querystring
	function GetDropDownValue(&$fld) {
		$parm = substr($fld->FldVar, 2);
		if (ewr_IsHttpPost())
			return FALSE; // Skip post back
		if (isset($_GET["so_$parm"]))
			$fld->SearchOperator = ewr_StripSlashes(@$_GET["so_$parm"]);
		if (isset($_GET["sv_$parm"])) {
			$fld->DropDownValue = ewr_StripSlashes(@$_GET["sv_$parm"]);
			return TRUE;
		}
		return FALSE;
	}

	// Get filter values from querystring
	function GetFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		if (ewr_IsHttpPost())
			return; // Skip post back
		$got = FALSE;
		if (isset($_GET["sv_$parm"])) {
			$fld->SearchValue = ewr_StripSlashes(@$_GET["sv_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["so_$parm"])) {
			$fld->SearchOperator = ewr_StripSlashes(@$_GET["so_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["sc_$parm"])) {
			$fld->SearchCondition = ewr_StripSlashes(@$_GET["sc_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["sv2_$parm"])) {
			$fld->SearchValue2 = ewr_StripSlashes(@$_GET["sv2_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["so2_$parm"])) {
			$fld->SearchOperator2 = ewr_StripSlashes($_GET["so2_$parm"]);
			$got = TRUE;
		}
		return $got;
	}

	// Set default ext filter
	function SetDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2) {
		$fld->DefaultSearchValue = $sv1; // Default ext filter value 1
		$fld->DefaultSearchValue2 = $sv2; // Default ext filter value 2 (if operator 2 is enabled)
		$fld->DefaultSearchOperator = $so1; // Default search operator 1
		$fld->DefaultSearchOperator2 = $so2; // Default search operator 2 (if operator 2 is enabled)
		$fld->DefaultSearchCondition = $sc; // Default search condition (if operator 2 is enabled)
	}

	// Apply default ext filter
	function ApplyDefaultExtFilter(&$fld) {
		$fld->SearchValue = $fld->DefaultSearchValue;
		$fld->SearchValue2 = $fld->DefaultSearchValue2;
		$fld->SearchOperator = $fld->DefaultSearchOperator;
		$fld->SearchOperator2 = $fld->DefaultSearchOperator2;
		$fld->SearchCondition = $fld->DefaultSearchCondition;
	}

	// Check if Text Filter applied
	function TextFilterApplied(&$fld) {
		return (strval($fld->SearchValue) <> strval($fld->DefaultSearchValue) ||
			strval($fld->SearchValue2) <> strval($fld->DefaultSearchValue2) ||
			(strval($fld->SearchValue) <> "" &&
				strval($fld->SearchOperator) <> strval($fld->DefaultSearchOperator)) ||
			(strval($fld->SearchValue2) <> "" &&
				strval($fld->SearchOperator2) <> strval($fld->DefaultSearchOperator2)) ||
			strval($fld->SearchCondition) <> strval($fld->DefaultSearchCondition));
	}

	// Check if Non-Text Filter applied
	function NonTextFilterApplied(&$fld) {
		if (is_array($fld->DropDownValue)) {
			if (is_array($fld->DefaultDropDownValue)) {
				if (count($fld->DefaultDropDownValue) <> count($fld->DropDownValue))
					return TRUE;
				else
					return (count(array_diff($fld->DefaultDropDownValue, $fld->DropDownValue)) <> 0);
			} else {
				return TRUE;
			}
		} else {
			if (is_array($fld->DefaultDropDownValue))
				return TRUE;
			else
				$v1 = strval($fld->DefaultDropDownValue);
			if ($v1 == EWR_INIT_VALUE)
				$v1 = "";
			$v2 = strval($fld->DropDownValue);
			if ($v2 == EWR_INIT_VALUE || $v2 == EWR_ALL_VALUE)
				$v2 = "";
			return ($v1 <> $v2);
		}
	}

	// Get dropdown value from session
	function GetSessionDropDownValue(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->DropDownValue, 'sv_view4_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so_view4_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv_view4_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so_view4_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_view4_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_view4_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_view4_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (array_key_exists($sn, $_SESSION))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $so, $parm) {
		$_SESSION['sv_view4_' . $parm] = $sv;
		$_SESSION['so_view4_' . $parm] = $so;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv_view4_' . $parm] = $sv1;
		$_SESSION['so_view4_' . $parm] = $so1;
		$_SESSION['sc_view4_' . $parm] = $sc;
		$_SESSION['sv2_view4_' . $parm] = $sv2;
		$_SESSION['so2_view4_' . $parm] = $so2;
	}

	// Check if has Session filter values
	function HasSessionFilterValues($parm) {
		return ((@$_SESSION['sv_' . $parm] <> "" && @$_SESSION['sv_' . $parm] <> EWR_INIT_VALUE) ||
			(@$_SESSION['sv_' . $parm] <> "" && @$_SESSION['sv_' . $parm] <> EWR_INIT_VALUE) ||
			(@$_SESSION['sv2_' . $parm] <> "" && @$_SESSION['sv2_' . $parm] <> EWR_INIT_VALUE));
	}

	// Dropdown filter exist
	function DropDownFilterExist(&$fld, $FldOpr) {
		$sWrk = "";
		$this->BuildDropDownFilter($fld, $sWrk, $FldOpr);
		return ($sWrk <> "");
	}

	// Extended filter exist
	function ExtendedFilterExist(&$fld) {
		$sExtWrk = "";
		$this->BuildExtendedFilter($fld, $sExtWrk);
		return ($sExtWrk <> "");
	}

	// Validate form
	function ValidateForm() {
		global $ReportLanguage, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWR_SERVER_VALIDATE)
			return ($gsFormError == "");

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<p>&nbsp;</p>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Clear selection stored in session
	function ClearSessionSelection($parm) {
		$_SESSION["sel_view4_$parm"] = "";
		$_SESSION["rf_view4_$parm"] = "";
		$_SESSION["rt_view4_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		$fld = &$this->FieldByParm($parm);
		$fld->SelectionList = @$_SESSION["sel_view4_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_view4_$parm"];
		$fld->RangeTo = @$_SESSION["rt_view4_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		/**
		* Set up default values for non Text filters
		*/

		// Field area_name
		$this->area_name->DefaultDropDownValue = EWR_INIT_VALUE;
		if (!$this->SearchCommand) $this->area_name->DropDownValue = $this->area_name->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($this->area_name, $sWrk, $this->area_name->SearchOperator, TRUE);
		ewr_LoadSelectionFromFilter($this->area_name, $sWrk, $this->area_name->DefaultSelectionList);
		if (!$this->SearchCommand) $this->area_name->SelectionList = $this->area_name->DefaultSelectionList;

		// Field city_name
		$this->city_name->DefaultDropDownValue = EWR_INIT_VALUE;
		if (!$this->SearchCommand) $this->city_name->DropDownValue = $this->city_name->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($this->city_name, $sWrk, $this->city_name->SearchOperator, TRUE);
		ewr_LoadSelectionFromFilter($this->city_name, $sWrk, $this->city_name->DefaultSelectionList);
		if (!$this->SearchCommand) $this->city_name->SelectionList = $this->city_name->DefaultSelectionList;

		// Field user_type
		$this->user_type->DefaultDropDownValue = EWR_INIT_VALUE;
		if (!$this->SearchCommand) $this->user_type->DropDownValue = $this->user_type->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($this->user_type, $sWrk, $this->user_type->SearchOperator, TRUE);
		ewr_LoadSelectionFromFilter($this->user_type, $sWrk, $this->user_type->DefaultSelectionList);
		if (!$this->SearchCommand) $this->user_type->SelectionList = $this->user_type->DefaultSelectionList;
		/**
		* Set up default values for extended filters
		* function SetDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2)
		* Parameters:
		* $fld - Field object
		* $so1 - Default search operator 1
		* $sv1 - Default ext filter value 1
		* $sc - Default search condition (if operator 2 is enabled)
		* $so2 - Default search operator 2 (if operator 2 is enabled)
		* $sv2 - Default ext filter value 2 (if operator 2 is enabled)
		*/
		/**
		* Set up default values for popup filters
		*/

		// Field area_name
		// $this->area_name->DefaultSelectionList = array("val1", "val2");
		// Field city_name
		// $this->city_name->DefaultSelectionList = array("val1", "val2");
		// Field user_type
		// $this->user_type->DefaultSelectionList = array("val1", "val2");

	}

	// Check if filter applied
	function CheckFilter() {

		// Check area_name extended filter
		if ($this->NonTextFilterApplied($this->area_name))
			return TRUE;

		// Check area_name popup filter
		if (!ewr_MatchedArray($this->area_name->DefaultSelectionList, $this->area_name->SelectionList))
			return TRUE;

		// Check city_name extended filter
		if ($this->NonTextFilterApplied($this->city_name))
			return TRUE;

		// Check city_name popup filter
		if (!ewr_MatchedArray($this->city_name->DefaultSelectionList, $this->city_name->SelectionList))
			return TRUE;

		// Check user_type extended filter
		if ($this->NonTextFilterApplied($this->user_type))
			return TRUE;

		// Check user_type popup filter
		if (!ewr_MatchedArray($this->user_type->DefaultSelectionList, $this->user_type->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList($showDate = FALSE) {
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field area_name
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($this->area_name, $sExtWrk, $this->area_name->SearchOperator);
		if (is_array($this->area_name->SelectionList))
			$sWrk = ewr_JoinArray($this->area_name->SelectionList, ", ", EWR_DATATYPE_STRING, 0, $this->DBID);
		$sFilter = "";
		if ($sExtWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sExtWrk</span>";
		elseif ($sWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sWrk</span>";
		if ($sFilter <> "")
			$sFilterList .= "<div><span class=\"ewFilterCaption\">" . $this->area_name->FldCaption() . "</span>" . $sFilter . "</div>";

		// Field city_name
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($this->city_name, $sExtWrk, $this->city_name->SearchOperator);
		if (is_array($this->city_name->SelectionList))
			$sWrk = ewr_JoinArray($this->city_name->SelectionList, ", ", EWR_DATATYPE_STRING, 0, $this->DBID);
		$sFilter = "";
		if ($sExtWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sExtWrk</span>";
		elseif ($sWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sWrk</span>";
		if ($sFilter <> "")
			$sFilterList .= "<div><span class=\"ewFilterCaption\">" . $this->city_name->FldCaption() . "</span>" . $sFilter . "</div>";

		// Field user_type
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($this->user_type, $sExtWrk, $this->user_type->SearchOperator);
		if (is_array($this->user_type->SelectionList))
			$sWrk = ewr_JoinArray($this->user_type->SelectionList, ", ", EWR_DATATYPE_STRING, 0, $this->DBID);
		$sFilter = "";
		if ($sExtWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sExtWrk</span>";
		elseif ($sWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sWrk</span>";
		if ($sFilter <> "")
			$sFilterList .= "<div><span class=\"ewFilterCaption\">" . $this->user_type->FldCaption() . "</span>" . $sFilter . "</div>";
		$divstyle = "";
		$divdataclass = "";

		// Show Filters
		if ($sFilterList <> "" || $showDate) {
			$sMessage = "<div" . $divstyle . $divdataclass . "><div id=\"ewrFilterList\" class=\"alert alert-info ewDisplayTable\">";
			if ($showDate)
				$sMessage .= "<div id=\"ewrCurrentDate\">" . $ReportLanguage->Phrase("ReportGeneratedDate") . ewr_FormatDateTime(date("Y-m-d H:i:s"), 1) . "</div>";
			if ($sFilterList <> "")
				$sMessage .= "<div id=\"ewrCurrentFilters\">" . $ReportLanguage->Phrase("CurrentFilters") . "</div>" . $sFilterList;
			$sMessage .= "</div></div>";
			$this->Message_Showing($sMessage, "");
			echo $sMessage;
		}
	}

	// Get list of filters
	function GetFilterList() {

		// Initialize
		$sFilterList = "";

		// Field area_name
		$sWrk = "";
		$sWrk = ($this->area_name->DropDownValue <> EWR_INIT_VALUE) ? $this->area_name->DropDownValue : "";
		if (is_array($sWrk))
			$sWrk = implode("||", $sWrk);
		if ($sWrk <> "")
			$sWrk = "\"sv_area_name\":\"" . ewr_JsEncode2($sWrk) . "\"";
		if ($sWrk == "") {
			$sWrk = ($this->area_name->SelectionList <> EWR_INIT_VALUE) ? $this->area_name->SelectionList : "";
			if (is_array($sWrk))
				$sWrk = implode("||", $sWrk);
			if ($sWrk <> "")
				$sWrk = "\"sel_area_name\":\"" . ewr_JsEncode2($sWrk) . "\"";
		}
		if ($sWrk <> "") {
			if ($sFilterList <> "") $sFilterList .= ",";
			$sFilterList .= $sWrk;
		}

		// Field city_name
		$sWrk = "";
		$sWrk = ($this->city_name->DropDownValue <> EWR_INIT_VALUE) ? $this->city_name->DropDownValue : "";
		if (is_array($sWrk))
			$sWrk = implode("||", $sWrk);
		if ($sWrk <> "")
			$sWrk = "\"sv_city_name\":\"" . ewr_JsEncode2($sWrk) . "\"";
		if ($sWrk == "") {
			$sWrk = ($this->city_name->SelectionList <> EWR_INIT_VALUE) ? $this->city_name->SelectionList : "";
			if (is_array($sWrk))
				$sWrk = implode("||", $sWrk);
			if ($sWrk <> "")
				$sWrk = "\"sel_city_name\":\"" . ewr_JsEncode2($sWrk) . "\"";
		}
		if ($sWrk <> "") {
			if ($sFilterList <> "") $sFilterList .= ",";
			$sFilterList .= $sWrk;
		}

		// Field user_type
		$sWrk = "";
		$sWrk = ($this->user_type->DropDownValue <> EWR_INIT_VALUE) ? $this->user_type->DropDownValue : "";
		if (is_array($sWrk))
			$sWrk = implode("||", $sWrk);
		if ($sWrk <> "")
			$sWrk = "\"sv_user_type\":\"" . ewr_JsEncode2($sWrk) . "\"";
		if ($sWrk == "") {
			$sWrk = ($this->user_type->SelectionList <> EWR_INIT_VALUE) ? $this->user_type->SelectionList : "";
			if (is_array($sWrk))
				$sWrk = implode("||", $sWrk);
			if ($sWrk <> "")
				$sWrk = "\"sel_user_type\":\"" . ewr_JsEncode2($sWrk) . "\"";
		}
		if ($sWrk <> "") {
			if ($sFilterList <> "") $sFilterList .= ",";
			$sFilterList .= $sWrk;
		}

		// Return filter list in json
		if ($sFilterList <> "")
			return "{" . $sFilterList . "}";
		else
			return "null";
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(ewr_StripSlashes(@$_POST["filter"]), TRUE);
		return $this->SetupFilterList($filter);
	}

	// Setup list of filters
	function SetupFilterList($filter) {
		if (!is_array($filter))
			return FALSE;

		// Field area_name
		$bRestoreFilter = FALSE;
		if (array_key_exists("sv_area_name", $filter)) {
			$sWrk = $filter["sv_area_name"];
			if (strpos($sWrk, "||") !== FALSE)
				$sWrk = explode("||", $sWrk);
			$this->SetSessionDropDownValue($sWrk, @$filter["so_area_name"], "area_name");
			$bRestoreFilter = TRUE;
		}
		if (array_key_exists("sel_area_name", $filter)) {
			$sWrk = $filter["sel_area_name"];
			$sWrk = explode("||", $sWrk);
			$this->area_name->SelectionList = $sWrk;
			$_SESSION["sel_view4_area_name"] = $sWrk;
			$this->SetSessionDropDownValue(EWR_INIT_VALUE, "", "area_name"); // Clear drop down
			$bRestoreFilter = TRUE;
		}
		if (!$bRestoreFilter) { // Clear filter
			$this->SetSessionDropDownValue(EWR_INIT_VALUE, "", "area_name");
			$this->area_name->SelectionList = "";
			$_SESSION["sel_view4_area_name"] = "";
		}

		// Field city_name
		$bRestoreFilter = FALSE;
		if (array_key_exists("sv_city_name", $filter)) {
			$sWrk = $filter["sv_city_name"];
			if (strpos($sWrk, "||") !== FALSE)
				$sWrk = explode("||", $sWrk);
			$this->SetSessionDropDownValue($sWrk, @$filter["so_city_name"], "city_name");
			$bRestoreFilter = TRUE;
		}
		if (array_key_exists("sel_city_name", $filter)) {
			$sWrk = $filter["sel_city_name"];
			$sWrk = explode("||", $sWrk);
			$this->city_name->SelectionList = $sWrk;
			$_SESSION["sel_view4_city_name"] = $sWrk;
			$this->SetSessionDropDownValue(EWR_INIT_VALUE, "", "city_name"); // Clear drop down
			$bRestoreFilter = TRUE;
		}
		if (!$bRestoreFilter) { // Clear filter
			$this->SetSessionDropDownValue(EWR_INIT_VALUE, "", "city_name");
			$this->city_name->SelectionList = "";
			$_SESSION["sel_view4_city_name"] = "";
		}

		// Field user_type
		$bRestoreFilter = FALSE;
		if (array_key_exists("sv_user_type", $filter)) {
			$sWrk = $filter["sv_user_type"];
			if (strpos($sWrk, "||") !== FALSE)
				$sWrk = explode("||", $sWrk);
			$this->SetSessionDropDownValue($sWrk, @$filter["so_user_type"], "user_type");
			$bRestoreFilter = TRUE;
		}
		if (array_key_exists("sel_user_type", $filter)) {
			$sWrk = $filter["sel_user_type"];
			$sWrk = explode("||", $sWrk);
			$this->user_type->SelectionList = $sWrk;
			$_SESSION["sel_view4_user_type"] = $sWrk;
			$this->SetSessionDropDownValue(EWR_INIT_VALUE, "", "user_type"); // Clear drop down
			$bRestoreFilter = TRUE;
		}
		if (!$bRestoreFilter) { // Clear filter
			$this->SetSessionDropDownValue(EWR_INIT_VALUE, "", "user_type");
			$this->user_type->SelectionList = "";
			$_SESSION["sel_view4_user_type"] = "";
		}
		return TRUE;
	}

	// Return popup filter
	function GetPopupFilter() {
		$sWrk = "";
		if ($this->DrillDown)
			return "";
		if (!$this->DropDownFilterExist($this->area_name, $this->area_name->SearchOperator)) {
			if (is_array($this->area_name->SelectionList)) {
				$sFilter = ewr_FilterSQL($this->area_name, "`area_name`", EWR_DATATYPE_STRING, $this->DBID);

				// Call Page Filtering event
				$this->Page_Filtering($this->area_name, $sFilter, "popup");
				$this->area_name->CurrentFilter = $sFilter;
				ewr_AddFilter($sWrk, $sFilter);
			}
		}
		if (!$this->DropDownFilterExist($this->city_name, $this->city_name->SearchOperator)) {
			if (is_array($this->city_name->SelectionList)) {
				$sFilter = ewr_FilterSQL($this->city_name, "`city_name`", EWR_DATATYPE_STRING, $this->DBID);

				// Call Page Filtering event
				$this->Page_Filtering($this->city_name, $sFilter, "popup");
				$this->city_name->CurrentFilter = $sFilter;
				ewr_AddFilter($sWrk, $sFilter);
			}
		}
		if (!$this->DropDownFilterExist($this->user_type, $this->user_type->SearchOperator)) {
			if (is_array($this->user_type->SelectionList)) {
				$sFilter = ewr_FilterSQL($this->user_type, "`user_type`", EWR_DATATYPE_STRING, $this->DBID);

				// Call Page Filtering event
				$this->Page_Filtering($this->user_type, $sFilter, "popup");
				$this->user_type->CurrentFilter = $sFilter;
				ewr_AddFilter($sWrk, $sFilter);
			}
		}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWR_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort($options = array()) {
		if ($this->DrillDown)
			return "";
		$bResetSort = @$options["resetsort"] == "1" || @$_GET["cmd"] == "resetsort";
		$orderBy = (@$options["order"] <> "") ? @$options["order"] : ewr_StripSlashes(@$_GET["order"]);
		$orderType = (@$options["ordertype"] <> "") ? @$options["ordertype"] : ewr_StripSlashes(@$_GET["ordertype"]);

		// Check for a resetsort command
		if ($bResetSort) {
			$this->setOrderBy("");
			$this->setStartGroup(1);
			$this->user_id->setSort("");
			$this->user_name->setSort("");
			$this->email_address->setSort("");
			$this->mobile->setSort("");
			$this->addr->setSort("");
			$this->area_name->setSort("");
			$this->city_name->setSort("");
			$this->user_type->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy <> "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$sSortSql = $this->SortSql();
			$this->setOrderBy($sSortSql);
			$this->setStartGroup(1);
		}
		return $this->getOrderBy();
	}

	// Export PDF
	function ExportPdf($html, $options = array()) {
		global $gsExportFile;
		@ini_set("memory_limit", EWR_PDF_MEMORY_LIMIT);
		set_time_limit(EWR_PDF_TIME_LIMIT);
		if (EWR_DEBUG_ENABLED) // Add debug message
			$html = str_replace("</body>", ewr_DebugMsg() . "</body>", $html);
		$dompdf = new \Dompdf\Dompdf(array("pdf_backend" => "Cpdf"));
		$doc = new DOMDocument();
		@$doc->loadHTML('<?xml encoding="uft-8">' . ewr_ConvertToUtf8($html)); // Convert to utf-8
		$spans = $doc->getElementsByTagName("span");
		foreach ($spans as $span) {
			if ($span->getAttribute("class") == "ewFilterCaption")
				$span->parentNode->insertBefore($doc->createElement("span", ":&nbsp;"), $span->nextSibling);
		}
		$html = $doc->saveHTML();
		$html = ewr_ConvertFromUtf8($html);
		$dompdf->load_html($html);
		$dompdf->set_paper("a4", "portrait");
		$dompdf->render();
		$folder = @$options["folder"];
		$fileName = @$options["filename"];
		$responseType = @$options["responsetype"];
		$saveToFile = "";
		if ($folder <> "" && $fileName <> "" && ($responseType == "json" || $responseType == "file" && EWR_REPORT_SAVE_OUTPUT_ON_SERVER)) {
			ewr_SaveFile(ewr_PathCombine(ewr_AppRoot(), $folder, TRUE), $fileName, $dompdf->output());
			$saveToFile = ewr_UploadPathEx(FALSE, $folder) . $fileName;
		}
		if ($saveToFile == "" || $responseType == "file") {
			$sExportFile = strtolower(substr($gsExportFile, -4)) == ".pdf" ? $gsExportFile : $gsExportFile . ".pdf";
			$dompdf->stream($sExportFile, array("Attachment" => 1)); // 0 to open in browser, 1 to download
		}
		ewr_DeleteTmpImages($html);
		return $saveToFile;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ewr_Header(FALSE) ?>
<?php

// Create page object
if (!isset($view4_rpt)) $view4_rpt = new crview4_rpt();
if (isset($Page)) $OldPage = $Page;
$Page = &$view4_rpt;

// Page init
$Page->Page_Init();

// Page main
$Page->Page_Main();

// Global Page Rendering event (in ewrusrfn*.php)
Page_Rendering();

// Page Rendering event
$Page->Page_Render();
?>
<?php include_once "phprptinc/header.php" ?>
<?php if ($Page->Export == "") { ?>
<script type="text/javascript">

// Create page object
var view4_rpt = new ewr_Page("view4_rpt");

// Page properties
view4_rpt.PageID = "rpt"; // Page ID
var EWR_PAGE_ID = view4_rpt.PageID;

// Extend page with Chart_Rendering function
view4_rpt.Chart_Rendering = 
 function(chart, chartid) { // DO NOT CHANGE THIS LINE!

 	//alert(chartid);
 }

// Extend page with Chart_Rendered function
view4_rpt.Chart_Rendered = 
 function(chart, chartid) { // DO NOT CHANGE THIS LINE!

 	//alert(chartid);
 }
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<script type="text/javascript">

// Form object
var CurrentForm = fview4rpt = new ewr_Form("fview4rpt");

// Validate method
fview4rpt.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate method
fview4rpt.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }
<?php if (EWR_CLIENT_VALIDATE) { ?>
fview4rpt.ValidateRequired = true; // Uses JavaScript validation
<?php } else { ?>
fview4rpt.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Use Ajax
fview4rpt.Lists["sv_area_name"] = {"LinkField":"sv_area_name","Ajax":true,"DisplayFields":["sv_area_name","","",""],"ParentFields":["sv_city_name"],"FilterFields":["sv_city_name"],"Options":[],"Template":""};
fview4rpt.Lists["sv_city_name"] = {"LinkField":"sv_city_name","Ajax":true,"DisplayFields":["sv_city_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[],"Template":""};
fview4rpt.Lists["sv_user_type"] = {"LinkField":"sv_user_type","Ajax":true,"DisplayFields":["sv_user_type","","",""],"ParentFields":[],"FilterFields":[],"Options":[],"Template":""};
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($Page->Export == "") { ?>
<!-- container (begin) -->
<div id="ewContainer" class="ewContainer">
<!-- top container (begin) -->
<div id="ewTop" class="ewTop">
<a id="top"></a>
<?php } ?>
<?php if (@$Page->GenOptions["showfilter"] == "1") { ?>
<?php $Page->ShowFilterList(TRUE) ?>
<?php } ?>
<!-- top slot -->
<div class="ewToolbar">
<?php if ($Page->Export == "" && (!$Page->DrillDown || !$Page->DrillDownInPanel)) { ?>
<?php if ($ReportBreadcrumb) $ReportBreadcrumb->Render(); ?>
<?php } ?>
<?php
if (!$Page->DrillDownInPanel) {
	$Page->ExportOptions->Render("body");
	$Page->SearchOptions->Render("body");
	$Page->FilterOptions->Render("body");
	$Page->GenerateOptions->Render("body");
}
?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<?php echo $ReportLanguage->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php $Page->ShowPageHeader(); ?>
<?php $Page->ShowMessage(); ?>
<?php if ($Page->Export == "") { ?>
</div>
<!-- top container (end) -->
	<!-- left container (begin) -->
	<div id="ewLeft" class="ewLeft">
<?php } ?>
	<!-- Left slot -->
<?php if ($Page->Export == "") { ?>
	</div>
	<!-- left container (end) -->
	<!-- center container - report (begin) -->
	<div id="ewCenter" class="ewCenter">
<?php } ?>
	<!-- center slot -->
<!-- summary report starts -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="report_summary">
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<!-- Search form (begin) -->
<form name="fview4rpt" id="fview4rpt" class="form-inline ewForm ewExtFilterForm" action="<?php echo ewr_CurrentPage() ?>">
<?php $SearchPanelClass = ($Page->Filter <> "") ? " in" : " in"; ?>
<div id="fview4rpt_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<div id="r_1" class="ewRow">
<div id="c_area_name" class="ewCell form-group">
	<label for="sv_area_name" class="ewSearchCaption ewLabel"><?php echo $Page->area_name->FldCaption() ?></label>
	<span class="ewSearchField">
<?php ewr_PrependClass($Page->area_name->EditAttrs["class"], "form-control"); ?>
<select data-table="view4" data-field="x_area_name" data-value-separator="<?php echo ewr_HtmlEncode(is_array($Page->area_name->DisplayValueSeparator) ? json_encode($Page->area_name->DisplayValueSeparator) : $Page->area_name->DisplayValueSeparator) ?>" id="sv_area_name" name="sv_area_name"<?php echo $Page->area_name->EditAttributes() ?>>
<option value=""><?php echo $ReportLanguage->Phrase("PleaseSelect") ?></option>
<?php
	$cntf = is_array($Page->area_name->AdvancedFilters) ? count($Page->area_name->AdvancedFilters) : 0;
	$cntd = is_array($Page->area_name->DropDownList) ? count($Page->area_name->DropDownList) : 0;
	$totcnt = $cntf + $cntd;
	$wrkcnt = 0;
	if ($cntf > 0) {
		foreach ($Page->area_name->AdvancedFilters as $filter) {
			if ($filter->Enabled) {
				$selwrk = ewr_MatchedFilterValue($Page->area_name->DropDownValue, $filter->ID) ? " selected" : "";
?>
<option value="<?php echo $filter->ID ?>"<?php echo $selwrk ?>><?php echo $filter->Name ?></option>
<?php
				$wrkcnt += 1;
			}
		}
	}
	for ($i = 0; $i < $cntd; $i++) {
		$selwrk = " selected";
?>
<option value="<?php echo $Page->area_name->DropDownList[$i] ?>"<?php echo $selwrk ?>><?php echo ewr_DropDownDisplayValue($Page->area_name->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}
?>
</select>
<input type="hidden" name="s_sv_area_name" id="s_sv_area_name" value="<?php echo $Page->area_name->LookupFilterQuery() ?>"></span>
</div>
</div>
<div id="r_2" class="ewRow">
<div id="c_city_name" class="ewCell form-group">
	<label for="sv_city_name" class="ewSearchCaption ewLabel"><?php echo $Page->city_name->FldCaption() ?></label>
	<span class="ewSearchField">
<?php $Page->city_name->EditAttrs["onchange"] = "ewr_UpdateOpt.call(this, ['sv_area_name']); " . @$Page->city_name->EditAttrs["onchange"]; ?>
<?php ewr_PrependClass($Page->city_name->EditAttrs["class"], "form-control"); ?>
<select data-table="view4" data-field="x_city_name" data-value-separator="<?php echo ewr_HtmlEncode(is_array($Page->city_name->DisplayValueSeparator) ? json_encode($Page->city_name->DisplayValueSeparator) : $Page->city_name->DisplayValueSeparator) ?>" id="sv_city_name" name="sv_city_name"<?php echo $Page->city_name->EditAttributes() ?>>
<option value=""><?php echo $ReportLanguage->Phrase("PleaseSelect") ?></option>
<?php
	$cntf = is_array($Page->city_name->AdvancedFilters) ? count($Page->city_name->AdvancedFilters) : 0;
	$cntd = is_array($Page->city_name->DropDownList) ? count($Page->city_name->DropDownList) : 0;
	$totcnt = $cntf + $cntd;
	$wrkcnt = 0;
	if ($cntf > 0) {
		foreach ($Page->city_name->AdvancedFilters as $filter) {
			if ($filter->Enabled) {
				$selwrk = ewr_MatchedFilterValue($Page->city_name->DropDownValue, $filter->ID) ? " selected" : "";
?>
<option value="<?php echo $filter->ID ?>"<?php echo $selwrk ?>><?php echo $filter->Name ?></option>
<?php
				$wrkcnt += 1;
			}
		}
	}
	for ($i = 0; $i < $cntd; $i++) {
		$selwrk = " selected";
?>
<option value="<?php echo $Page->city_name->DropDownList[$i] ?>"<?php echo $selwrk ?>><?php echo ewr_DropDownDisplayValue($Page->city_name->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}
?>
</select>
<input type="hidden" name="s_sv_city_name" id="s_sv_city_name" value="<?php echo $Page->city_name->LookupFilterQuery() ?>"></span>
</div>
</div>
<div id="r_3" class="ewRow">
<div id="c_user_type" class="ewCell form-group">
	<label for="sv_user_type" class="ewSearchCaption ewLabel"><?php echo $Page->user_type->FldCaption() ?></label>
	<span class="ewSearchField">
<?php ewr_PrependClass($Page->user_type->EditAttrs["class"], "form-control"); ?>
<select data-table="view4" data-field="x_user_type" data-value-separator="<?php echo ewr_HtmlEncode(is_array($Page->user_type->DisplayValueSeparator) ? json_encode($Page->user_type->DisplayValueSeparator) : $Page->user_type->DisplayValueSeparator) ?>" id="sv_user_type" name="sv_user_type"<?php echo $Page->user_type->EditAttributes() ?>>
<option value=""><?php echo $ReportLanguage->Phrase("PleaseSelect") ?></option>
<?php
	$cntf = is_array($Page->user_type->AdvancedFilters) ? count($Page->user_type->AdvancedFilters) : 0;
	$cntd = is_array($Page->user_type->DropDownList) ? count($Page->user_type->DropDownList) : 0;
	$totcnt = $cntf + $cntd;
	$wrkcnt = 0;
	if ($cntf > 0) {
		foreach ($Page->user_type->AdvancedFilters as $filter) {
			if ($filter->Enabled) {
				$selwrk = ewr_MatchedFilterValue($Page->user_type->DropDownValue, $filter->ID) ? " selected" : "";
?>
<option value="<?php echo $filter->ID ?>"<?php echo $selwrk ?>><?php echo $filter->Name ?></option>
<?php
				$wrkcnt += 1;
			}
		}
	}
	for ($i = 0; $i < $cntd; $i++) {
		$selwrk = " selected";
?>
<option value="<?php echo $Page->user_type->DropDownList[$i] ?>"<?php echo $selwrk ?>><?php echo ewr_DropDownDisplayValue($Page->user_type->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}
?>
</select>
<input type="hidden" name="s_sv_user_type" id="s_sv_user_type" value="<?php echo $Page->user_type->LookupFilterQuery() ?>"></span>
</div>
</div>
<div class="ewRow"><input type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-primary" value="<?php echo $ReportLanguage->Phrase("Search") ?>">
<input type="reset" name="btnreset" id="btnreset" class="btn hide" value="<?php echo $ReportLanguage->Phrase("Reset") ?>"></div>
</div>
</form>
<script type="text/javascript">
fview4rpt.Init();
fview4rpt.FilterList = <?php echo $Page->GetFilterList() ?>;
</script>
<!-- Search form (end) -->
<?php } ?>
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->ShowFilterList() ?>
<?php } ?>
<?php

// Set the last group to display if not export all
if ($Page->ExportAll && $Page->Export <> "") {
	$Page->StopGrp = $Page->TotalGrps;
} else {
	$Page->StopGrp = $Page->StartGrp + $Page->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Page->StopGrp) > intval($Page->TotalGrps))
	$Page->StopGrp = $Page->TotalGrps;
$Page->RecCount = 0;
$Page->RecIndex = 0;

// Get first row
if ($Page->TotalGrps > 0) {
	$Page->GetRow(1);
	$Page->GrpCount = 1;
}
$Page->GrpIdx = ewr_InitArray(2, -1);
$Page->GrpIdx[0] = -1;
$Page->GrpIdx[1] = $Page->StopGrp - $Page->StartGrp + 1;
while ($rs && !$rs->EOF && $Page->GrpCount <= $Page->DisplayGrps || $Page->ShowHeader) {

	// Show dummy header for custom template
	// Show header

	if ($Page->ShowHeader) {
?>
<?php if ($Page->Export <> "pdf") { ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="panel panel-default ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div class="<?php if (ewr_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($Page->user_id->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="user_id"><div class="view4_user_id"><span class="ewTableHeaderCaption"><?php echo $Page->user_id->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="user_id">
<?php if ($Page->SortUrl($Page->user_id) == "") { ?>
		<div class="ewTableHeaderBtn view4_user_id">
			<span class="ewTableHeaderCaption"><?php echo $Page->user_id->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer view4_user_id" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->user_id) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->user_id->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->user_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->user_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->user_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="user_name"><div class="view4_user_name"><span class="ewTableHeaderCaption"><?php echo $Page->user_name->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="user_name">
<?php if ($Page->SortUrl($Page->user_name) == "") { ?>
		<div class="ewTableHeaderBtn view4_user_name">
			<span class="ewTableHeaderCaption"><?php echo $Page->user_name->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer view4_user_name" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->user_name) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->user_name->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->user_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->user_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->email_address->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="email_address"><div class="view4_email_address"><span class="ewTableHeaderCaption"><?php echo $Page->email_address->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="email_address">
<?php if ($Page->SortUrl($Page->email_address) == "") { ?>
		<div class="ewTableHeaderBtn view4_email_address">
			<span class="ewTableHeaderCaption"><?php echo $Page->email_address->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer view4_email_address" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->email_address) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->email_address->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->email_address->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->email_address->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->mobile->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="mobile"><div class="view4_mobile"><span class="ewTableHeaderCaption"><?php echo $Page->mobile->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="mobile">
<?php if ($Page->SortUrl($Page->mobile) == "") { ?>
		<div class="ewTableHeaderBtn view4_mobile">
			<span class="ewTableHeaderCaption"><?php echo $Page->mobile->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer view4_mobile" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->mobile) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->mobile->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->mobile->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->mobile->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->addr->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="addr"><div class="view4_addr"><span class="ewTableHeaderCaption"><?php echo $Page->addr->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="addr">
<?php if ($Page->SortUrl($Page->addr) == "") { ?>
		<div class="ewTableHeaderBtn view4_addr">
			<span class="ewTableHeaderCaption"><?php echo $Page->addr->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer view4_addr" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->addr) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->addr->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->addr->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->addr->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->area_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="area_name"><div class="view4_area_name"><span class="ewTableHeaderCaption"><?php echo $Page->area_name->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="area_name">
<?php if ($Page->SortUrl($Page->area_name) == "") { ?>
		<div class="ewTableHeaderBtn view4_area_name">
			<span class="ewTableHeaderCaption"><?php echo $Page->area_name->FldCaption() ?></span>
			<a class="ewTableHeaderPopup" title="<?php echo $ReportLanguage->Phrase("Filter"); ?>" onclick="ewr_ShowPopup.call(this, event, 'view4_area_name', false, '<?php echo $Page->area_name->RangeFrom; ?>', '<?php echo $Page->area_name->RangeTo; ?>');" id="x_area_name<?php echo $Page->Cnt[0][0]; ?>"><span class="icon-filter"></span></a>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer view4_area_name" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->area_name) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->area_name->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->area_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->area_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
			<a class="ewTableHeaderPopup" title="<?php echo $ReportLanguage->Phrase("Filter"); ?>" onclick="ewr_ShowPopup.call(this, event, 'view4_area_name', false, '<?php echo $Page->area_name->RangeFrom; ?>', '<?php echo $Page->area_name->RangeTo; ?>');" id="x_area_name<?php echo $Page->Cnt[0][0]; ?>"><span class="icon-filter"></span></a>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->city_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="city_name"><div class="view4_city_name"><span class="ewTableHeaderCaption"><?php echo $Page->city_name->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="city_name">
<?php if ($Page->SortUrl($Page->city_name) == "") { ?>
		<div class="ewTableHeaderBtn view4_city_name">
			<span class="ewTableHeaderCaption"><?php echo $Page->city_name->FldCaption() ?></span>
			<a class="ewTableHeaderPopup" title="<?php echo $ReportLanguage->Phrase("Filter"); ?>" onclick="ewr_ShowPopup.call(this, event, 'view4_city_name', false, '<?php echo $Page->city_name->RangeFrom; ?>', '<?php echo $Page->city_name->RangeTo; ?>');" id="x_city_name<?php echo $Page->Cnt[0][0]; ?>"><span class="icon-filter"></span></a>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer view4_city_name" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->city_name) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->city_name->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->city_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->city_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
			<a class="ewTableHeaderPopup" title="<?php echo $ReportLanguage->Phrase("Filter"); ?>" onclick="ewr_ShowPopup.call(this, event, 'view4_city_name', false, '<?php echo $Page->city_name->RangeFrom; ?>', '<?php echo $Page->city_name->RangeTo; ?>');" id="x_city_name<?php echo $Page->Cnt[0][0]; ?>"><span class="icon-filter"></span></a>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->user_type->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="user_type"><div class="view4_user_type"><span class="ewTableHeaderCaption"><?php echo $Page->user_type->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="user_type">
<?php if ($Page->SortUrl($Page->user_type) == "") { ?>
		<div class="ewTableHeaderBtn view4_user_type">
			<span class="ewTableHeaderCaption"><?php echo $Page->user_type->FldCaption() ?></span>
			<a class="ewTableHeaderPopup" title="<?php echo $ReportLanguage->Phrase("Filter"); ?>" onclick="ewr_ShowPopup.call(this, event, 'view4_user_type', false, '<?php echo $Page->user_type->RangeFrom; ?>', '<?php echo $Page->user_type->RangeTo; ?>');" id="x_user_type<?php echo $Page->Cnt[0][0]; ?>"><span class="icon-filter"></span></a>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer view4_user_type" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->user_type) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->user_type->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->user_type->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->user_type->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
			<a class="ewTableHeaderPopup" title="<?php echo $ReportLanguage->Phrase("Filter"); ?>" onclick="ewr_ShowPopup.call(this, event, 'view4_user_type', false, '<?php echo $Page->user_type->RangeFrom; ?>', '<?php echo $Page->user_type->RangeTo; ?>');" id="x_user_type<?php echo $Page->Cnt[0][0]; ?>"><span class="icon-filter"></span></a>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Page->TotalGrps == 0) break; // Show header only
		$Page->ShowHeader = FALSE;
	}
	$Page->RecCount++;
	$Page->RecIndex++;
?>
<?php

		// Render detail row
		$Page->ResetAttrs();
		$Page->RowType = EWR_ROWTYPE_DETAIL;
		$Page->RenderRow();
?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->user_id->Visible) { ?>
		<td data-field="user_id"<?php echo $Page->user_id->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_view4_user_id"<?php echo $Page->user_id->ViewAttributes() ?>><?php echo $Page->user_id->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->user_name->Visible) { ?>
		<td data-field="user_name"<?php echo $Page->user_name->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_view4_user_name"<?php echo $Page->user_name->ViewAttributes() ?>><?php echo $Page->user_name->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->email_address->Visible) { ?>
		<td data-field="email_address"<?php echo $Page->email_address->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_view4_email_address"<?php echo $Page->email_address->ViewAttributes() ?>><?php echo $Page->email_address->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->mobile->Visible) { ?>
		<td data-field="mobile"<?php echo $Page->mobile->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_view4_mobile"<?php echo $Page->mobile->ViewAttributes() ?>><?php echo $Page->mobile->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->addr->Visible) { ?>
		<td data-field="addr"<?php echo $Page->addr->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_view4_addr"<?php echo $Page->addr->ViewAttributes() ?>><?php echo $Page->addr->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->area_name->Visible) { ?>
		<td data-field="area_name"<?php echo $Page->area_name->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_view4_area_name"<?php echo $Page->area_name->ViewAttributes() ?>><?php echo $Page->area_name->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->city_name->Visible) { ?>
		<td data-field="city_name"<?php echo $Page->city_name->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_view4_city_name"<?php echo $Page->city_name->ViewAttributes() ?>><?php echo $Page->city_name->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->user_type->Visible) { ?>
		<td data-field="user_type"<?php echo $Page->user_type->CellAttributes() ?>>
<span data-class="tpx<?php echo $Page->RecCount ?>_<?php echo $Page->RecCount ?>_view4_user_type"<?php echo $Page->user_type->ViewAttributes() ?>><?php echo $Page->user_type->ListViewValue() ?></span></td>
<?php } ?>
	</tr>
<?php

		// Accumulate page summary
		$Page->AccumulateSummary();

		// Get next record
		$Page->GetRow(2);
	$Page->GrpCount++;
} // End while
?>
<?php if ($Page->TotalGrps > 0) { ?>
</tbody>
<tfoot>
	</tfoot>
<?php } elseif (!$Page->ShowHeader && TRUE) { // No header displayed ?>
<?php if ($Page->Export <> "pdf") { ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="panel panel-default ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div class="<?php if (ewr_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGrps > 0 || TRUE) { // Show footer ?>
</table>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGrps > 0)) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php include "view4rptpager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<!-- Summary Report Ends -->
<?php if ($Page->Export == "") { ?>
	</div>
	<!-- center container - report (end) -->
	<!-- right container (begin) -->
	<div id="ewRight" class="ewRight">
<?php } ?>
	<!-- Right slot -->
<?php if ($Page->Export == "") { ?>
	</div>
	<!-- right container (end) -->
<div class="clearfix"></div>
<!-- bottom container (begin) -->
<div id="ewBottom" class="ewBottom">
<?php } ?>
	<!-- Bottom slot -->
<?php if ($Page->Export == "") { ?>
	</div>
<!-- Bottom Container (End) -->
</div>
<!-- Table Container (End) -->
<?php } ?>
<?php $Page->ShowPageFooter(); ?>
<?php if (EWR_DEBUG_ENABLED) echo ewr_DebugMsg(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "phprptinc/footer.php" ?>
<?php
$Page->Page_Terminate();
if (isset($OldPage)) $Page = $OldPage;
?>
