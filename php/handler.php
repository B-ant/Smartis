<?php
	function getExchangeRate($from, $to) {
		$request_url='http://www.cbr.ru/scripts/XML_dynamic.asp';
		$query['VAL_NM_RQ']='R01235';

		$from=strtotime($from);
		$to=strtotime($to);

		if (!$to or !$from) $result['errors'][]='Неверный формат даты!';
		if ($to and $from and $from>$to) $result['errors'][]='Конечная дата не может быть больше начальной!';

		if (!$errors) {
		  $query['date_req1']=date('d/m/Y', $from);
		  $query['date_req2']=date('d/m/Y', $to);
		}

		$link=$request_url.'?'.http_build_query($query);
		$xml=simplexml_load_string(file_get_contents($link));

		foreach  ($xml->Record as $day) {
		  $result['data'][strval($day->attributes()->Date)]=str_replace(',', '.', strval($day->Value));
		}

		return $result;
	}

	$exchangeRateData=getExchangeRate($_POST['from'], $_POST["to"]);
?>

<?php if ($exchangeRateData['errors']): ?>
  <div class="errors">
    <p>Ошибка в запросе:</p>
    <p><?= implode('<br>', $exchangeRateData['errors']) ?></p>
  </div>
<?php endif; ?>

<?php if ($exchangeRateData['data']): ?>
	<script type="text/javascript">
		Highcharts.chart('result', {

		  title: {
			  text: 'Динамика курса Доллара США к рублю'
		  },

		  subtitle: {
			  text: 'Период: с <?=$_POST['from']?> по <?=$_POST['to']?>'
		  },

		  yAxis: {
			  title: {
				  text: 'Рубли'
			  }
		  },

		  xAxis: {
			  categories: ["<?= implode('", "', array_keys($exchangeRateData['data'])) ?>"],
			  title: {
				  text: 'Дата'
			  }
		  },

		  legend: false,

		  series: [{
			  name: '&#8381;',
			  data: [<?= implode(', ', $exchangeRateData['data']) ?>]			  
		  }],


		});
	</script>
<?php endif; ?>