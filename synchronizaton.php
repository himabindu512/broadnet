<?php
include 'config.php';
$checkConnect = $dbServer -> is_connected();
if(!$checkConnect){?>
<h2 align="center">Please Check Internet connection</h2>	
<?php }else{?>
<style>
#myProgress {
	    padding-right: 20px;
    padding-left: 20px;
  position: relative;
  width: 100%;
  height: 30px;
  background-color: #FFF;
  
}

#myBar {
  
  position: absolute;
  height: 100%;
  background-color: #4CAF50;
}
</style>
<div class="test">
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">

			<div style="text-align: center;">
				<h2>Synchronization</h2>
			</div>
			<? 
			$checkErrors = $dbMGSync -> _showError();
			if( $checkErrors ){
				echo $checkErrors;
				die('');
			}  ?>
		
		<?php if( $localTables && count( $localTables ) > 0 ){
				foreach( $localTables as $localTable ){?>
						<table border="1" style="width: 100%;" class="table table-hover table-nomargin table-striped">
							<tr>
								<th style="width: 50%;">Local</th>
								<th style="width: 50%;">Server</th>
							</tr>
							<tr>
							<?php
										
										$localTableNextId = $dbMGSync -> _getLocalTableLastPrimaryId( $localTable );
										$localTableLastId = $dbMGSync -> _getLocalTableLastId( $localTable );
										$localRecordsCount = $dbMGSync -> _getLocalTotalRecordsCount( $localTable );
										$localColumns = $dbMGSync -> _getLocalTableColumns( $localTable );
										$localTableRows = $dbMGSync -> _getLocalTableResults( $localTable );
										
										$serverTableNexttId = $dbServer -> _getServerTableLastPrimaryId( $localTable );
										$serverTableLastId = $dbServer -> _getServerTableLastId( $localTable );
										$ServerRecordsCount = $dbServer -> _getServerTotalRecordsCount( $localTable );
										$serverColumns = $dbServer -> _getServerTableColumns( $localTable );
										$serverTableRows = $dbServer -> _getServerTableResults( $localTable );
										//$serverTableRows = (array) $serverTableRows1;
										
										$localMissIds = array_column( $localTableRows , 'code' );
										$serverMissIds = array_column( $serverTableRows , 'code' );
										
										//$localMissIds = array_diff( $serverTableIds , $localTableIds );
										//$serverMissIds = array_diff( $localTableIds , $serverTableIds );
										
										for( $i=1;$i<=2;$i++ ){
											
											echo '<td>';
											if( $i == 1 ){ ?>
												
												<div><b> Table Name : </b><?= $localTable; ?></div>
												<div><b> Next Auto Increment Key : </b><?= $localTableNextId; ?></div>
												<div><b> Last Item Id : </b><?= $localTableLastId; ?></div>
												<div><b> Total Records : </b><?= $localRecordsCount; ?></div>
												<div><b> Columns : </b><?= implode( ',', $localColumns ); ?></div>
												
												<div><b> Missing Codes : </b><?= implode(',', $localMissIds ); ?></div>
												
											<? }else if( $i == 2 ){ ?>
												
												<div><b> Table Name : </b><?= $localTable; ?></div>
												<div><b> Next Auto Increment Key : </b><?= $serverTableNexttId; ?></div>
												<div><b> Last Item Id : </b><?= $serverTableLastId; ?></div>
												<div><b> Total Records : </b><?= $ServerRecordsCount; ?></div>
												<div><b> Columns : </b><?= implode( ',', $serverColumns ); ?></div>
												
												<div><b> Missing Codes : </b><?= implode(',', $serverMissIds ); ?></div>
											<? } ?>
										</td>
										<?
										}
									?>
							</tr>
						</table>
									<?php 
						}
					} ?>
		
			<br><br><br>
			<table >
				<tr>
					<td colspan="2">
						<input type="submit" class="btn btn-primary syncButton" rel="submit" value="Submit"/>
					</td>
				</tr>
			</table>
			<?php }?>
		</div>
	</div>
</div>
</div>
<script>
$(document).ready(function(){
	$('body').on('click','.syncButton',function(){
		var action = $(this).attr('rel');
		var elem = document.getElementById("myBar");   
		var width = 1;
		var id = setInterval(frame, 10);

		function frame() {
			if (width >= 100) {
			  clearInterval(id);
			} else {
			  width++; 
			  elem.style.width = width + '%'; 
			}
		}
		$.ajax({
			url: 'ajax/synchronization.php',
			type: 'POST',
			data: '',
			success: function (data){
				//console.log( data );
				if( data.trim() == 'fail' ){
					alert("Something Went Wrong ....!");
				//location.reload();
				}else{
					$(".test").html(data);
				}
			},
			cache: false,
			contentType: false,
			processData: false
		});
		return false;
		
	});
});
</script>