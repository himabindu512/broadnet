<?php
    require_once ('common.php');

    /*
    * Script:    DataTables server-side script for PHP and MySQL
    * Copyright: 2010 - Allan Jardine
    * License:   GPL v2 or BSD (3-point)
    */

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    * Easy set variables
    */

    /* Array of database columns which should be read and sent back to DataTables. Use a space where
    * you want to insert a non-database field (for example a counter or static image)
    */
    if($_SESSION['role']==1||$_SESSION['role']==5){
        $aColumns = array( 'R.id', 'U.name', 'IT.name', 'I.name', 'R.visitDate', 'R.feedback', 'S.name', 'A.name', 'P.name', 'R.datetimeAdded','R.proceed_options', 'R.tag_lati_long', 'R.active' );
    }else{
        $aColumns = array( 'R.id', 'U.name', 'IT.name', 'I.name', 'R.visitDate', 'R.feedback', 'S.name', 'A.name', 'P.name', 'R.datetimeAdded','R.proceed_options', 'R.active' );
    }
//print_r($aColumns);
    /* Indexed column (used for fast and accurate table cardinality) */
    $sIndexColumn = "R.id";

    /* DB table to use */
    $sTable = "reports R 
    LEFT JOIN users U on (U.id=R.medRepId )
    LEFT JOIN institutions I on (I.id=R.institutionId )
    LEFT JOIN products P on (P.id=R.productId1 )
    LEFT JOIN Specialties S on (S.id=I.specialityId )
    LEFT JOIN institutions_addresses IA on (IA.instituteId=I.id ) and IA.`default`=1
    LEFT JOIN institutionTypes IT on (IT.id=I.typeId )
    LEFT JOIN areas A ON ( A.id = IA.areaId   ) 

    ";

    $sLimit = "";
    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
    {
        $sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
        mysql_real_escape_string( $_GET['iDisplayLength'] );
    }


    /*
    * Ordering
    */
    $sGroup = " GROUP BY R.id ";
    $sOrder = "";
    if ( isset( $_GET['iSortCol_0'] ) )
    {
        $sOrder = "ORDER BY  ";
        for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
        {
            if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
            {
                $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                ".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
            }
        }

        $sOrder = substr_replace( $sOrder, "", -2 );
        if ( $sOrder == "ORDER BY" )
        {
            $sOrder = "";
        }
    }


    /* 
    * Filtering
    * NOTE this does not match the built-in DataTables filtering which does it
    * word by word on any field. It's possible to do here, but concerned about efficiency
    * on very large tables, and MySQL's regex functionality is very limited
    */
    $sWhere = " WHERE R.tag!=1 ";

    if ( @$_GET['sSearch'] != "" )
    {
        $sWhere.= " AND (";
        if (strpos($_GET['sSearch'],"&") !== false) {

            $ampkeys = explode("&", $_GET['sSearch']);
            $amp_highlighted = array();
            foreach ( $ampkeys as $ampkey ){
                $ampkey = trim($ampkey);

                for ( $i=0 ; $i<count($aColumns) ; $i++ )
                {
                    //$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
                    $sWhere .= Multiple_keywords($aColumns[$i],$ampkey)." OR ";
                }
                $sWhere = substr_replace( $sWhere, "", -3 );
                $sWhere .= ') AND (';
            }    

            $sWhere = substr_replace( $sWhere, "", -5 );
            //$sWhere .= ')';
        }else{

            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                //$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
                $sWhere .= Multiple_keywords($aColumns[$i],$_GET['sSearch'])." OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }

    }

    /* Individual column filtering */
    for ( $i=0 ; $i<count($aColumns) ; $i++ )
    {
        if ( @$_GET['bSearchable_'.$i] == "true" && @$_GET['sSearch_'.$i] != '' )
        {
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
            $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
        }
    }
    $areaIDcount =0;

    //if(@$_SESSION['role']==4)$sWhere.=" AND I.typeId!=1  "; 
    if(@$_SESSION['role']==4) {
        $areaIDcount = $db->select_one("select count(id) from salesmanpharmacies where `AreaId`!=0 and salesManId=".$_SESSION['CMSuserID']);
        $userareaIDsquery = "select AreaId from salesmanpharmacies where `AreaId`!=0 and salesManId=".$_SESSION['CMSuserID']; 
    }if(@$_SESSION['role']==2) {
        $areaIDcount = $db->select_one("select count(id) from medreppharmacies where `AreaId`!=0 and MedrepId=".$_SESSION['CMSuserID']);
        $userareaIDsquery = "select AreaId from medreppharmacies where `AreaId`!=0 and MedrepId=".$_SESSION['CMSuserID']; 
    }
    //$userareaIDs = $db->select_one("select areaIds from users where id=".$_SESSION['CMSuserID']);

    if($areaIDcount>0){
        if(@$_SESSION['role']==2 || @$_SESSION['role']==4) $sWhere.=" AND ( IA.areaId in ($userareaIDsquery) and I.id in (select institutionId from reports where medRepId=".$_SESSION['CMSuserID']." ) ) "; 
    }else{    
        if(@$_SESSION['role']==2 || @$_SESSION['role']==4) $sWhere.=" AND R.medRepId=".$_SESSION['CMSuserID']." "; 
    }
    /*if($_SESSION['role']==4){
    $sWhere.=" and IA.areaId in (select AreaId from salesmanpharmacies where salesManId=".$_SESSION['CMSuserID'].") and R.medRepId=".$_SESSION['CMSuserID']."";
    }
    if($_SESSION['role']==2){
    $sWhere.=" and IA.areaId in (select AreaId from medreppharmacies where MedrepId=".$_SESSION['CMSuserID'].") and R.medRepId=".$_SESSION['CMSuserID']."";
    }*/

    /*
    * SQL queries
    * Get data to display
    */
    $_SESSION['adv_reprts_where_query']="";
    $_SESSION['ajax_reprts_where_query']=$sWhere;
    $_SESSION['ajax_reprts_table_query']=$sTable;
    /*if($_SESSION['role']!=2 and $_SESSION['role']!=4) {*/
    $queryColumns = "R.medRepId,R.id,U.name as Uname,IT.name as ITname,I.name as Iname,R.visitDate,R.feedback,S.name as Sname,A.name as Aname,P.name as Pname,R.datetimeAdded,R.proceed_options,R.active,R.tag_lati_long";/*}else{
    $queryColumns = "R.id,IT.name as ITname,I.name as Iname,R.visitDate,R.feedback,S.name as Sname,A.name as Aname,P.name as Pname,R.datetimeAdded,R.proceed_options,R.active";}*/
    $sQuery = "
    SELECT SQL_CALC_FOUND_ROWS $queryColumns
    FROM   $sTable
    $sWhere
    $sGroup
    $sOrder
    $sLimit
    ";
    //echo $sQuery;exit;
    $rResult = mysql_query( $sQuery) or die(mysql_error());

    /* Data set length after filtering */
    $sQuery = "
    SELECT FOUND_ROWS()
    ";
    $rResultFilterTotal = mysql_query( $sQuery ) or die(mysql_error());
    $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
    $iFilteredTotal = $aResultFilterTotal[0];

    /* Total data set length */
    $sQuery = "
    SELECT COUNT(".$sIndexColumn.")
    FROM   $sTable $sWhere

    ";
    $rResultTotal = mysql_query( $sQuery ) or die(mysql_error());
    $aResultTotal = mysql_fetch_array($rResultTotal);
    $iTotal = $aResultTotal[0];


    /*
    * Output
    */
    $output = array(
        "sEcho" => intval(@$_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );

    while ( $aRow = mysql_fetch_array( $rResult ) )
    {
        $row = array();
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            if ( $aColumns[$i] == "version" )
            {
                /* Special output formatting for 'version' column */
                $row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
            }
            else if ( $aColumns[$i] != ' ' )
            {

                $explode = explode('.',$aColumns[$i]);
                //echo $explode[1];
                //$aColumns[$i]=$explode[1];

                if($aColumns[$i]=="IT.name"){
                    $row[] =   $aRow["ITname"];
                }elseif($aColumns[$i]=="I.name"){
                    $row[] =   str_replace(',', ' ',$aRow["Iname"]);
                }elseif($aColumns[$i]=="S.name"){
                    $row[] =   $aRow["Sname"];
                }elseif($aColumns[$i]=="A.name"){
                    $instituteId = getValue('institutionId','reports',$aRow['id']);
                    $areaID = $db->select_one("select areaId from institutions_addresses where `default`=1 and instituteId=".$instituteId);
                    $parentID = getValue('parent','areas',$areaID);
                    if($parentID==0 or $parentID==""){$parentID=$areaID;}
                    $row[] = getValue('name','areas',$parentID).' / '.getValue('name','areas',$areaID);
                }elseif($aColumns[$i]=="P.name"){
                    $row[] =   $aRow["Pname"];
                }elseif($aColumns[$i]=="U.name"){
                    $row[] =   $aRow["Uname"];
                }elseif($aColumns[$i]=="R.feedback"){
                    $row[] =   stripslashes(substr($aRow['feedback'],0,20)).'...';
                }elseif($aColumns[$i]=="R.tag_lati_long"){
                    if($aRow['tag_lati_long']!=''){
                        $row[] =   '<a href="javascript:open_map(\'report_tag_inst_map.php?id='.$aRow['id'].'\')" title="View">Yes</a>';
                    }else{
                        $row[]='No';
                    }
                }
                elseif($explode[1]=="active"){
                    if($_SESSION['role']==2 or $_SESSION['role']==4) {

                        if($aRow['medRepId']==$_SESSION['CMSuserID']) {

                            $row[] ='                
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" data-id="'.$aRow['id'].'" data-name="'.$aRow['id'].'"  data-table="reports" href="#collapse_addedit"><img src="icons/edit.gif" alt="Edit" /></a>&nbsp;
                            <a class="colorbox-image cboxElement" href="includes/reports_view.php?edit='.$aRow['id'].'" title="View"><i class="icon-search"></i></a>                  
                            ';       
                        }else{


                            $row[] ='<a class="colorbox-image cboxElement" href="includes/reports_view.php?edit='.$aRow['id'].'" title="View"><i class="icon-search"></i></a>';         
                        }

                    }else{
                        $row[] ='                
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" data-id="'.$aRow['id'].'" data-name="'.$aRow['id'].'"  data-table="reports" href="#collapse_addedit"><img src="icons/edit.gif" alt="Edit" /></a>&nbsp;
                        <a href="javascript:del(\''.$aRow['id'].'\')" title="Delete" ><img src="icons/action_delete.gif" alt="delete" /></a>&nbsp;
                        <a class="colorbox-image cboxElement" href="includes/reports_view.php?edit='.$aRow['id'].'" title="View"><i class="icon-search"></i></a>                  
                        ';
                    }
                }else{
                    $row[] = $aRow[ $explode[1] ];
                }
            }
        }
        $output['aaData'][] = $row;
    }

    echo json_encode( $output );
?>

                