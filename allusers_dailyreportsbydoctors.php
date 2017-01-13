<?
    if(@$_REQUEST['to_date']!=""){
        $to_date = $_REQUEST['to_date'];   
        $from_date = $_REQUEST['from_date'];   
    }else{
        $from_date = date('Y-m-d',strtotime(date('Y-m-d'). ' - 2 day'));   
        $to_date = date('Y-m-d');   
    }
?>
<div class="container-fluid">

    <div class="row-fluid">
        <div class="span12">
            <div class="box box-color box-bordered">
                <form method="POST" name="startyourday" id="startyourday" style="margin: 0px;" >          

                    <div class="box-title">
                        <h3>
                            <i class="icon-table"></i>Daily Reports List
                        </h3>
                        &nbsp;&nbsp;&nbsp;
                        <select name="medrepId" required >
                        <option value="">Select Medrep/Saleman</option>
                        <?  $selectusers="select * from users where role in (2,4) and active=1 order by id ";
                            $queryusers=mysql_query($selectusers);
                            while($resusers=@mysql_fetch_assoc($queryusers)) {?>
                        <option <?if($_REQUEST['medrepId']==$resusers['id']) echo 'selected';?> value="<?=$resusers['id']?>"><?=$resusers['name']?></option>
                        <?}?>
                        </select>
                        &nbsp;&nbsp;&nbsp;
                        Check By Dates 
                        
                        From Date &nbsp;&nbsp;<input type="text" name="from_date" autocomplete='off' id="from_date" style="margin: -7px;" required placeholder="Date" class="input-medium datepick" value="<?=$from_date?>">&nbsp;&nbsp;
                        
                        To Date &nbsp;&nbsp;<input type="text" name="to_date" autocomplete='off' id="to_date" style="margin: -7px;" required placeholder="Date" class="input-medium datepick" value="<?=$to_date?>">&nbsp;&nbsp;
                        
                        <input type="submit" style=" background: none repeat scroll 0 0 red;" value="Submit" class='btn btn-primary'>

                    </div>
                </form>
                <div class="box-content nopadding"> 
                <div class="row-fluid">
                    <div class="span12">
                    <table class="table table-hover table-nomargin table-bordered " id="0">
                        <thead>
                            <tr>
                                <th>Medrep/Saleman</th>
                                <th>Doctors Visits</th>
                                <th>Pharmacy Visits</th>
                                <th>Others Visits</th>
                                <th>No.Reports</th>
                            </tr>
                        </thead>
                        <?
                            if($_REQUEST['medrepId']!=''){
                            $selectusers="select * from users where role in (2,4) and active=1 and id='".$_REQUEST['medrepId']."' order by id ";
                            }else{
                                exit;
                            $selectusers="select * from users where role in (2,4) and active=1 and id=17 order by id ";
                            }
                            $queryusers=mysql_query($selectusers);
                            while($resusers=@mysql_fetch_assoc($queryusers)) {
                                $total_doctortypecount = 0;
                                $total_pharmacytypecount = 0;
                                $total_otherstypecount = 0;
                                $total_total_reports = 0;
                                
                                $queryvisitDate=mysql_query("select visitDate from reports where reports.medRepId='".$resusers['id']."' and reports.visitDate between '$from_date' and '$to_date'  group by visitDate order by visitDate asc");
                                
                                $countvisitdates = mysql_num_rows($queryvisitDate);
                                
                                $totalreportsarray = array();
                                $allvisitdates = array();

                                
                            while($resvisitDate=@mysql_fetch_assoc($queryvisitDate)) {
                                
                                $visitdate = $resvisitDate['visitDate'];
                                
                                $allvisitdates[] = $visitdate;
                                
                                $total_reports =  $db->select_one("select count(*) from reports where medRepId='".$resusers['id']."' and visitDate='$visitdate' limit 1");
                                $totalreportsarray[] = $total_reports;
                                
                                $doctortypecount =  $db->select_one("select count(*) from reports where medRepId='".$resusers['id']."' and visitDate='$visitdate' and typeId=1 limit 1");         
                                $pharmacytypecount =  $db->select_one("select count(*) from reports where medRepId='".$resusers['id']."' and visitDate='$visitdate' and typeId=3 limit 1");         
                                $otherstypecount =  $db->select_one("select count(*) from reports where medRepId='".$resusers['id']."' and visitDate='$visitdate' and typeId not in(1,3) limit 1");

                                
                                
                                
                                $total_doctortypecount+=$doctortypecount;
                                $total_pharmacytypecount+=$pharmacytypecount;
                                $total_otherstypecount+=$otherstypecount;
                                
                                $total_total_reports+=$total_reports;

                                
                            ?>
                            <tr>
                                <td><?=$resusers['name']; ?> on <?=$visitdate?></td>
                                <td><?=$doctortypecount?></td>
                                <td><?=$pharmacytypecount?></td>
                                <td><?=$otherstypecount?></td>
                                <td><?=$total_reports?></td>
                                
                            </tr>                                                
                            <?}if($countvisitdates>1){?>
                            <tr>
                                <td><?=$resusers['name']; ?> <b>Total:</b></td>
                                <td><?=$total_doctortypecount?> Avg : <?=round($total_doctortypecount/count($allvisitdates))?></td>
                                <td><?=$total_pharmacytypecount?> Avg : <?=round($total_pharmacytypecount/count($allvisitdates))?></td>
                                <td><?=$total_otherstypecount?> Avg : <?=round($total_otherstypecount/count($allvisitdates))?></td>
                                <td><?=$total_total_reports?> Avg : <?=round($total_total_reports/count($allvisitdates))?></td>
                                
                            </tr> 
                            <?}elseif($countvisitdates==0){?>
                            <tr>
                                <td><?=$resusers['name']; ?></td>
                                <td><?=$total_doctortypecount?></td>
                                <td><?=$total_pharmacytypecount?></td>
                                <td><?=$total_otherstypecount?></td>
                                <td><?=$total_total_reports?></td>
                                
                            </tr>
                            <?}}?>
                    </table>   
                </div>
                </div>
                
                <div class="row-fluid">
                    <div class="span12">
                        <div class="box box-color box-bordered">
                            <div class="box-title">
                                <h3>
                                    <i class="icon-bar-chart"></i>
                                    Reports Visists Overview
                                </h3>
                                <div class="actions">
                                    <a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
                                    <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
                                    <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                                <div class="statistic-big">
                                    
                                    <div class="bottom">
                                        <div class="flot medium" id="flot-reports"></div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>

</div>

<script>
if($("#flot-reports").length > 0){
    
    <?foreach($allvisitdates as $key=>$date){
        $data[] = "[".strtotime($date)."000, $totalreportsarray[$key]]";
    }
    $max = max(array_map('strtotime', $allvisitdates))+ (1 * 24 * 60 * 60);
    $maxYYY = date('Y', $max);
    $maxMMM = date('m', $max)-1;
    $maxDDD = date('d', $max);
    
    $maxdate = "$maxYYY ,$maxMMM ,$maxDDD";
    
    $min = min(array_map('strtotime', $allvisitdates))- (1 * 24 * 60 * 60);
    $minYYY = date('Y', $min);
    $minMMM = date('m', $min)-1;
    $minDDD = date('d', $min);
    
    $mindate = "$minYYY ,$minMMM ,$minDDD";
    
    ?>
        
    var data = [<?=implode(',',$data)?>];

    $.plot($("#flot-reports"), [{ 
        label: "Visits", 
        data: data,
        color: "#3a8ce5"
    }], {
        xaxis: {
            min: (new Date(<?=$mindate?>)).getTime(),
            max: (new Date(<?=$maxdate?>)).getTime(),
            mode: "time",
            tickSize: [2, "day"],
            timeformat: "%d-%m",
        },
        series: {
            lines: {
                show: true, 
                fill: true
            },
            points: {
                show: true,
            }
        },
        grid: { hoverable: true, clickable: true },
        legend: {
            show: false
        }
    });

    $("#flot-reports").bind("plothover", function (event, pos, item) {
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;

                $("#tooltip").remove();
                var y = item.datapoint[1].toFixed();

                showTooltip(item.pageX, item.pageY,
                            item.series.label + " = " + y);
            }
        }
        else {
            $("#tooltip").remove();
            previousPoint = null;            
        }
    });

}

</script>