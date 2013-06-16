

    <p class="block-subtitle"><?=$poll[0]["q_title"];?></p>
	
	<div class="polling-result"> 
		<? 
		$totalVotes = 0;
		foreach($poll as $q)
			$totalVotes += $q["option_votes"];
			
		foreach($poll as $q){
			$percent = round($q["option_votes"] / $totalVotes * 100,1);
			printf("<p>%s</p>
					<div class='polling-bg'>
						<div class='polling-line' style='width:%s;'></div>
						<div class='polling-percents'>%s</div>
					</div><br/>",$q["option_title"],$percent."%",$percent."%");
		}
		echo "<p>Всего голосов: {$totalVotes}</p>";
		?>
		<script type="text/javascript">decorateList('poll-answers');</script>
	</div>
				

