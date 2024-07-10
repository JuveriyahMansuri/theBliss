<?php

// Global variable for table object
$view4 = NULL;

//
// Table class for view4
//
class crview4 extends crTableBase {
	var $ShowGroupHeaderAsRow = FALSE;
	var $ShowCompactSummaryFooter = TRUE;
	var $user_id;
	var $user_name;
	var $email_address;
	var $mobile;
	var $addr;
	var $area_name;
	var $city_name;
	var $user_type;

	//
	// Table class constructor
	//
	function __construct() {
		global $ReportLanguage, $gsLanguage;
		$this->TableVar = 'view4';
		$this->TableName = 'view4';
		$this->TableType = 'VIEW';
		$this->DBID = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0;

		// user_id
		$this->user_id = new crField('view4', 'view4', 'x_user_id', 'user_id', '`user_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->user_id->Sortable = TRUE; // Allow sort
		$this->user_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['user_id'] = &$this->user_id;
		$this->user_id->DateFilter = "";
		$this->user_id->SqlSelect = "";
		$this->user_id->SqlOrderBy = "";

		// user_name
		$this->user_name = new crField('view4', 'view4', 'x_user_name', 'user_name', '`user_name`', 200, EWR_DATATYPE_STRING, -1);
		$this->user_name->Sortable = TRUE; // Allow sort
		$this->fields['user_name'] = &$this->user_name;
		$this->user_name->DateFilter = "";
		$this->user_name->SqlSelect = "";
		$this->user_name->SqlOrderBy = "";

		// email_address
		$this->email_address = new crField('view4', 'view4', 'x_email_address', 'email_address', '`email_address`', 200, EWR_DATATYPE_STRING, -1);
		$this->email_address->Sortable = TRUE; // Allow sort
		$this->fields['email_address'] = &$this->email_address;
		$this->email_address->DateFilter = "";
		$this->email_address->SqlSelect = "";
		$this->email_address->SqlOrderBy = "";

		// mobile
		$this->mobile = new crField('view4', 'view4', 'x_mobile', 'mobile', '`mobile`', 20, EWR_DATATYPE_NUMBER, -1);
		$this->mobile->Sortable = TRUE; // Allow sort
		$this->mobile->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['mobile'] = &$this->mobile;
		$this->mobile->DateFilter = "";
		$this->mobile->SqlSelect = "";
		$this->mobile->SqlOrderBy = "";

		// addr
		$this->addr = new crField('view4', 'view4', 'x_addr', 'addr', '`addr`', 200, EWR_DATATYPE_STRING, -1);
		$this->addr->Sortable = TRUE; // Allow sort
		$this->fields['addr'] = &$this->addr;
		$this->addr->DateFilter = "";
		$this->addr->SqlSelect = "";
		$this->addr->SqlOrderBy = "";

		// area_name
		$this->area_name = new crField('view4', 'view4', 'x_area_name', 'area_name', '`area_name`', 200, EWR_DATATYPE_STRING, -1);
		$this->area_name->Sortable = TRUE; // Allow sort
		$this->fields['area_name'] = &$this->area_name;
		$this->area_name->DateFilter = "";
		$this->area_name->SqlSelect = "SELECT DISTINCT `area_name`, `area_name` AS `DispFld` FROM " . $this->getSqlFrom();
		$this->area_name->SqlOrderBy = "`area_name`";

		// city_name
		$this->city_name = new crField('view4', 'view4', 'x_city_name', 'city_name', '`city_name`', 200, EWR_DATATYPE_STRING, -1);
		$this->city_name->Sortable = TRUE; // Allow sort
		$this->fields['city_name'] = &$this->city_name;
		$this->city_name->DateFilter = "";
		$this->city_name->SqlSelect = "SELECT DISTINCT `city_name`, `city_name` AS `DispFld` FROM " . $this->getSqlFrom();
		$this->city_name->SqlOrderBy = "`city_name`";

		// user_type
		$this->user_type = new crField('view4', 'view4', 'x_user_type', 'user_type', '`user_type`', 200, EWR_DATATYPE_STRING, -1);
		$this->user_type->Sortable = TRUE; // Allow sort
		$this->fields['user_type'] = &$this->user_type;
		$this->user_type->DateFilter = "";
		$this->user_type->SqlSelect = "SELECT DISTINCT `user_type`, `user_type` AS `DispFld` FROM " . $this->getSqlFrom();
		$this->user_type->SqlOrderBy = "`user_type`";
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ofld->GroupingFieldId == 0)
				$this->setDetailOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			if ($ofld->GroupingFieldId == 0) $ofld->setSort("");
		}
	}

	// Get Sort SQL
	function SortSql() {
		$sDtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = array();
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				$fldsql = $fld->FldExpression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->FldGroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->FldGroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sSortSql = "";
		foreach ($argrps as $grp) {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $grp;
		}
		if ($sDtlSortSql <> "") {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $sDtlSortSql;
		}
		return $sSortSql;
	}

	// Table level SQL
	// From

	var $_SqlFrom = "";

	function getSqlFrom() {
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`view4`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}

	// Select
	var $_SqlSelect = "";

	function getSqlSelect() {
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}

	// Where
	var $_SqlWhere = "";

	function getSqlWhere() {
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}

	// Group By
	var $_SqlGroupBy = "";

	function getSqlGroupBy() {
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}

	// Having
	var $_SqlHaving = "";

	function getSqlHaving() {
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}

	// Order By
	var $_SqlOrderBy = "";

	function getSqlOrderBy() {
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Select Aggregate
	var $_SqlSelectAgg = "";

	function getSqlSelectAgg() {
		return ($this->_SqlSelectAgg <> "") ? $this->_SqlSelectAgg : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelectAgg() { // For backward compatibility
		return $this->getSqlSelectAgg();
	}

	function setSqlSelectAgg($v) {
		$this->_SqlSelectAgg = $v;
	}

	// Aggregate Prefix
	var $_SqlAggPfx = "";

	function getSqlAggPfx() {
		return ($this->_SqlAggPfx <> "") ? $this->_SqlAggPfx : "";
	}

	function SqlAggPfx() { // For backward compatibility
		return $this->getSqlAggPfx();
	}

	function setSqlAggPfx($v) {
		$this->_SqlAggPfx = $v;
	}

	// Aggregate Suffix
	var $_SqlAggSfx = "";

	function getSqlAggSfx() {
		return ($this->_SqlAggSfx <> "") ? $this->_SqlAggSfx : "";
	}

	function SqlAggSfx() { // For backward compatibility
		return $this->getSqlAggSfx();
	}

	function setSqlAggSfx($v) {
		$this->_SqlAggSfx = $v;
	}

	// Select Count
	var $_SqlSelectCount = "";

	function getSqlSelectCount() {
		return ($this->_SqlSelectCount <> "") ? $this->_SqlSelectCount : "SELECT COUNT(*) FROM " . $this->getSqlFrom();
	}

	function SqlSelectCount() { // For backward compatibility
		return $this->getSqlSelectCount();
	}

	function setSqlSelectCount($v) {
		$this->_SqlSelectCount = $v;
	}

	// Sort URL
	function SortUrl(&$fld) {
		return "";
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld) {
		global $gsLanguage;
		switch ($fld->FldVar) {
		case "x_area_name":
			$sSqlWrk = "";
		$sSqlWrk = "SELECT DISTINCT `area_name`, `area_name` AS `DispFld`, '' AS `DispFld2`, '' AS `DispFld3`, '' AS `DispFld4` FROM `view4`";
		$sWhereWrk = "{filter}";
		$this->area_name->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "DB", "f0" => '`area_name` = {filter_value}', "t0" => "200", "fn0" => "", "dlm" => ewr_Encrypt($fld->FldDelimiter), "f1" => '`city_name` = {filter_value}', "t1" => "200", "fn1" => "");
			$sSqlWrk = "";
		$this->Lookup_Selecting($this->area_name, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `area_name` ASC";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_city_name":
			$sSqlWrk = "";
		$sSqlWrk = "SELECT DISTINCT `city_name`, `city_name` AS `DispFld`, '' AS `DispFld2`, '' AS `DispFld3`, '' AS `DispFld4` FROM `view4`";
		$sWhereWrk = "";
		$this->city_name->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "DB", "f0" => '`city_name` = {filter_value}', "t0" => "200", "fn0" => "", "dlm" => ewr_Encrypt($fld->FldDelimiter));
			$sSqlWrk = "";
		$this->Lookup_Selecting($this->city_name, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `city_name` ASC";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_user_type":
			$sSqlWrk = "";
		$sSqlWrk = "SELECT DISTINCT `user_type`, `user_type` AS `DispFld`, '' AS `DispFld2`, '' AS `DispFld3`, '' AS `DispFld4` FROM `view4`";
		$sWhereWrk = "";
		$this->user_type->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "DB", "f0" => '`user_type` = {filter_value}', "t0" => "200", "fn0" => "", "dlm" => ewr_Encrypt($fld->FldDelimiter));
			$sSqlWrk = "";
		$this->Lookup_Selecting($this->user_type, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `user_type` ASC";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld) {
		global $gsLanguage;
		switch ($fld->FldVar) {
		}
	}

	// Table level events
	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["style"] = "xxx";

	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // With function, or
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//ewr_UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->FldName == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->FldName == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->FldName == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->FldName == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}
}
?>
