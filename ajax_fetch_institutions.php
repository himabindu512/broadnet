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
    $aColumns = array( 'I.id', 'I.name', 'I.class', 'I.reference', 'IT.name', 'S.name', 'A.name', 'I.Mon_Data', 'I.active' );
    
    /* Indexed column (used for fast and accurate table cardinality) */
    $sIndexColumn = "I.id";
    
    /* DB table to use */
    
    
    $sTable = "institutions I 
    LEFT JOIN Specialties S on (S.id=I.specialityId )
    LEFT JOIN institutions_addresses IA on (IA.instituteId=I.id )
    LEFT JOIN institutionTypes IT on (IT.id=I.typeId )
    LEFT JOIN areas A ON ( A.id = IA.areaId ) 
    
    ";
    
    /* Database connection information */
    /*$gaSql['user']       = "";
    $gaSql['password']   = "";
    $gaSql['db']         = "";
    $gaSql['server']     = "localhost";*/
    
    
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * If you just want to use the basic configuration for DataTables with PHP server-side, there is
     * no need to edit below this line
     */
    
    /* 
     * MySQL connection
     */
    /*$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
        die( 'Could not open connection to server' );
    
    mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
        die( 'Could not select database '. $gaSql['db'] );*/
    
    
    /* 
     * Paging
     */
    $sLimit = "";
    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
    {
        $sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
            mysql_real_escape_string( $_GET['iDisplayLength'] );
    }
    
    
    /*
     * Ordering
     */
     $sGroup = " GROUP BY I.id ";
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
     
     
    $sWhere = " WHERE I.deleted=0 ";
   
    
    if ( @$_GET['sSearch'] != "" )
    {
        if ( is_numeric($_GET['sSearch']) and (@$_GET['sSearch']==0 or @$_GET['sSearch']==1 ))
    {
        $sWhere = " WHERE I.deleted=0 and I.active=".$_GET['sSearch'];
    }else{
        $sWhere = " WHERE I.deleted=0 AND (";
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
            //$sWhere .= Multiple_keywords($aColumns[$i],$_GET['sSearch_'.$i]);
        }
    }

 
    if($_SESSION['role']==4){
        //$sWhere.=" and IA.areaId in (select AreaId from salesmanpharmacies where salesManId=".$_SESSION['CMSuserID'].")";
    }
    if($_SESSION['role']==2){
        //$sWhere.=" and IA.areaId in (select AreaId from medreppharmacies where MedrepId=".$_SESSION['CMSuserID'].")";
    }
    
    /*
     * SQL queries
     * Get data to display
     */
    $sQuery = "
        SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
        FROM   $sTable
        $sWhere
        $sGroup
        $sOrder
        $sLimit
    ";
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
        FROM   $sTable
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
                /* General output */
                /*if($explode[1]=="typeID"){
                $row[] = getPropertyTypeName($aRow[ $explode[1] ]);
                }elseif($explode[1]=="cityID"){
                $row[] = getCityName($aRow[ $explode[1] ]);
                }elseif($explode[1]=="dateadded"){
                $row[] = @date('d/m/Y',strtotime(($aRow[ $explode[1] ])));
                }elseif($explode[1]=="price"){
                $row[] = '$'.$aRow[ $explode[1] ];
                }elseif($explode[1]=="banner"){
                    if($aRow[ $explode[1] ]==1)
                    {
                        $banner_status='<img src=icons/lightbulb.gif /> Showing';
                    }
                    else
                    {
                        $banner_status="<img src='icons/lightbulb_off.gif' /> Not Showing";
                    }
                 $row[] ='<a href="javascript:banner_status(\''.$aRow['id'].'\',\''.$aRow['banner'].'\') " title="banner">'.$banner_status.'</a>';
                }else*/
                if($aColumns[$i]=="IT.name"){
                    $row[] = getValue('name','institutionTypes',getValue('typeId','institutions',$aRow['id']));
                }elseif($aColumns[$i]=="I.name"){
                    $row[] = str_replace(',', ' ',getValue('name','institutions',$aRow['id']));
                }elseif($aColumns[$i]=="S.name"){
                    $row[] = getValue('name','Specialties',getValue('specialityId','institutions',$aRow['id']));
                }elseif($aColumns[$i]=="A.name"){
                    $areaID = $db->select_one("select areaId from institutions_addresses where `default`=1 and instituteId=".$aRow['id']);
                    $parentID = getValue('parent','areas',$areaID);
                    if($parentID==0 or $parentID==""){$parentID=$areaID;}
                    $row[] = getValue('name','areas',$parentID).' / '.getValue('name','areas',$areaID);
                }elseif($aColumns[$i]=="I.Mon_Data"){
                    
                    $monresult="";
                            $Mon_Data = explode(',',$aRow['Mon_Data']);
                if(strlen($Mon_Data[0])>0){$monresult="M ";for($x=0;$x<count($Mon_Data);$x++){$monresult.="".getValue('name','TimeVisit',$Mon_Data[$x]).",";}$monresult.="<br>";}
                            $tuesresult="";
                            $Tues_Data = explode(',',getValue('Tues_Data','institutions',$aRow['id']));
                if(strlen($Tues_Data[0])>0){$tuesresult="T ";for($x=0;$x<count($Tues_Data);$x++){$tuesresult.="".getValue('name','TimeVisit',$Tues_Data[$x]).",";}$tuesresult.="<br>";}
                            $wedresult="";
                            $Wed_Data = explode(',',getValue('Wednes_Data','institutions',$aRow['id']));
                if(strlen($Wed_Data[0])>0){$wedresult="W ";for($x=0;$x<count($Wed_Data);$x++){$wedresult.="".getValue('name','TimeVisit',$Wed_Data[$x]).",";}$wedresult.="<br>";}
                            $thuresult="";
                            $Thur_Data = explode(',',getValue('Thurs_Data','institutions',$aRow['id']));
                if(strlen($Thur_Data[0])>0){$thuresult="Th ";for($x=0;$x<count($Thur_Data);$x++){$thuresult.="".getValue('name','TimeVisit',$Thur_Data[$x]).",";}$thuresult.="<br>";}
                            $friresult="";
                            $Fri_Data = explode(',',getValue('Fri_Data','institutions',$aRow['id']));
                if(strlen($Fri_Data[0])>0){$friresult="F ";for($x=0;$x<count($Fri_Data);$x++){$friresult.="".getValue('name','TimeVisit',$Fri_Data[$x]).",";}$friresult.="<br>";}
                    
                    
                 $row[] =   $monresult.$tuesresult.$wedresult.$thuresult.$friresult;
                }
                elseif($explode[1]=="active"){
                   if($aRow['active']==1)
                    {
                        $status="<img src='icons/action_check.gif' />";
                    }
                    else
                    {
                        $status="<img src='icons/action_remove.gif' />";
                    }
                 $maplink='&nbsp;&nbsp;&nbsp;<a href="javascript:open_map(\'update_inst_map.php?id='.$aRow['id'].'\')" title="Map" class="icon-map-marker" ></a>';
                 if($_SESSION['role']!=2 and $_SESSION['role']!=4){
                     $statuslink='<a href="javascript:status('.$aRow['id'].','.$aRow['active'].') " title="status">'.$status.'</a>&nbsp;';
                 $deletelink='&nbsp;<a href="javascript:del('.$aRow['id'].')" title="Delete" ><img src="icons/action_delete.gif" alt="delete" /></a>';
                 }else{
                  $deletelink=$statuslink=""; 
                 }
$row[].=$statuslink.'<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" data-id="'.$aRow['id'].'" data-name="'.$aRow['name'].'"  data-table="institutions" href="#collapse_addedit"><img src="icons/edit.gif" alt="Edit" /></a>'.$deletelink.$maplink;                
                }else{
                $row[] = $aRow[ $explode[1] ];
                }
            }
        }
        $output['aaData'][] = $row;
    }
    
    echo json_encode( $output );
        ?>

                