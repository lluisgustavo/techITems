
<?php
require $_SERVER['DOCUMENT_ROOT'] . '\techitems\vendor\autoload.php'; 

/**
 * TODO(developer): Replace this variable with your Google Analytics 4
 *   property ID before running the sample.
 */
$property_id = '280922262';

// Using a default constructor instructs the client to use the credentials
// specified in GOOGLE_APPLICATION_CREDENTIALS environment variable.
$client = new BetaAnalyticsDataClient();  

// Make an API call.
$cityActiveUsers = $client->runReport([
    'property' => 'properties/' . $property_id,
    'dateRanges' => [
        new DateRange([
            'start_date' => '30daysAgo',
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'city',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'activeUsers',
        ]
    )
    ]
]);

$deviceActiveUsers = $client->runReport([
    'property' => 'properties/' . $property_id,
    'dateRanges' => [
        new DateRange([
            'start_date' => '30daysAgo',
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'deviceCategory',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'activeUsers',
        ]
    )
    ]
]);

$originActiveUsers = $client->runReport([
    'property' => 'properties/' . $property_id,
    'dateRanges' => [
        new DateRange([
            'start_date' => '30daysAgo',
            'end_date' => 'today',
        ]),
    ],
    'dimensions' => [new Dimension(
        [
            'name' => 'sessionSource',
        ]
    ),
    ],
    'metrics' => [new Metric(
        [
            'name' => 'activeUsers',
        ]
    )
    ]
]);


	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data);
?>      

	<div class="row mt">
		<div class="col-md-12">
			<div class="content-panel">
				<h1>Contagem de dados de 30 dias</h1>  
				<div class="row">
					<div class="col-md-4">
						<div class="table-responsive">
							<table class="table table-striped table-responsive table-advance table-hover">     					
								<hr>
								<thead>
									<tr> 
										<th><i class="fas fa-street-view"></i> Cidade </th>  
										<th><i class="fas fa-eye"></i> Usuários Ativos </th>  
									</tr>
								</thead>
								<tbody id="table-body">
									<?php  
										foreach ($cityActiveUsers->getRows() as $row) { 
											echo '<tr>
													<td>' . $row->getDimensionValues()[0]->getValue() . '</td>
													<td>' . $row->getMetricValues()[0]->getValue() . '</td>
												</tr>';
										}
									?>
								</tbody>
							</table>
						</div> 
					</div>
					<div class="col-md-4">
						<div class="table-responsive">
							<table class="table table-striped table-responsive table-advance table-hover">     					
								<hr>
								<thead>
									<tr> 
										<th><i class="fas fa-street-view"></i> Tipo de Dispositivo </th>  
										<th><i class="fas fa-eye"></i> Usuários Ativos </th>  
									</tr>
								</thead>
								<tbody id="table-body">
									<?php  
										foreach ($deviceActiveUsers->getRows() as $row) { 
											echo '<tr>
													<td>' . ($row->getDimensionValues()[0]->getValue() == 'desktop' ? 'Desktop' : ($row->getDimensionValues()[0]->getValue() == 'nmobile' ? 'Dispositivo Móvel' : $row->getDimensionValues()[0]->getValue()))  . '</td>
													<td>' . $row->getMetricValues()[0]->getValue() . '</td>
												</tr>';
										}
									?>
								</tbody>
							</table>
						</div> 
					</div>
					<div class="col-md-4">
						<div class="table-responsive">
							<table class="table table-striped table-responsive table-advance table-hover">     					
								<hr>
								<thead>
									<tr> 
										<th><i class="fas fa-street-view"></i>Origem</th>  
										<th><i class="fas fa-eye"></i> Usuários Ativos </th>  
									</tr>
								</thead>
								<tbody id="table-body">
									<?php  
										foreach ($originActiveUsers->getRows() as $row) { 
											echo '<tr>
													<td>' . ($row->getDimensionValues()[0]->getValue() == '(direct)' ? 'Link direto' : ($row->getDimensionValues()[0]->getValue() == '(not set)' ? 'Indefinido' : $row->getDimensionValues()[0]->getValue())) . '</td>
													<td>' . $row->getMetricValues()[0]->getValue() . '</td>
												</tr>';
										}
									?>
								</tbody>
							</table>
						</div> 
					</div>
				</div> 
			</div>  
		</div>
	</div> <!-- /row -->

<script type="text/javascript">       
	function hideModal(){ 
		const edit_modal = document.querySelector('#add-new-stock-movement');
		const modal = bootstrap.Modal.getInstance(edit_modal);    
		modal.hide();
	} 
 
	function collectData(element){  
		var productMovementInput = document.querySelector('#produto-pedido'); 
		var movementStockInput = document.querySelector('#movement-stock'); 
		var obsInput = document.querySelector('#obs-stock'); 
 
		var productMovement = productMovementInput.value.trim();
		var movementStock = movementStockInput.value.trim();
		var obs = obsInput.value.trim();
		 
		sendData({ 
			product_id: productMovement,
			movement: movementStock,
			obs: obs,
			data_type: 'add-movement'
		});
	} 

	function sendData(data = {}){
		var ajax = new XMLHttpRequest();

		ajax.addEventListener('readystatechange', function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				handleResult(ajax.responseText);
			}
		});

		ajax.open("POST","<?=ROOT?>ajaxstock", true);
		ajax.send(JSON.stringify(data));
	}

	function handleResult(result){
		if(result != ""){      
			//console.log(result);
			var obj = JSON.parse(result);
			if(typeof(obj.data_type) != 'undefined'){
				if(obj.data_type == "add-new"){
					if(obj.message_type == 'info'){
						alert(obj.message); 
					
						var table_body_movement = document.querySelector("#table-body-movement");
						var table_body_stock = document.querySelector("#table-body-stock");
						table_body_movement.innerHTML = obj.data-movement;
						table_body_movement.innerHTML = obj.data-stock;
						hideModal();
					} else {
						alert(obj.message);
					}   
				}
			}
		}
	}  
</script>

<?php
	$this->view("admin/footer", $data);
?>