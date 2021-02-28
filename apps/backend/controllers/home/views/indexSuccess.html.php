<?php if(count($this->conts) >= 1):  ?>
<!-- Two Cols -->
<div id="DashboardIndex" class="two-cols">
	
	<?php $i=1; 
	
		$total = count($this->conts);
		$perCol = ceil($total/2);
		
		$arr = array_chunk($this->conts, $perCol, true);
		$lastIndex = null;
		foreach($arr as $cont):
			foreach($cont as $contName => $item): 
				foreach($item as $lnk):
	?>
		
		<?php $this->insertWidget($contName, "index", $lnk); ?>
		
		
		<!-- Gals not Published -->
		<!--<div id="notPublishedGals" class="box">
			<h3>Galerias não publicadas</h3>
			<div>
				<table>
					<tbody>
						<tr>
							<td><a href="#">Nascer do espírito</a></td>
							<td class="rightTxt"><a href="#">25/03/2013 04:50</a></td>
						</tr>
						<tr>
							<td><a href="#">Nascer do espírito</a></td>
							<td class="rightTxt"><a href="#">25/03/2013 04:50</a></td>
						</tr>
						<tr>
							<td><a href="#">Nascer do espírito</a></td>
							<td class="rightTxt"><a href="#">25/03/2013 04:50</a></td>
						</tr>
						<tr>
							<td><a href="#">Nascer do espírito</a></td>
							<td class="rightTxt"><a href="#">25/03/2013 04:50</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>-->
		<!-- /Gals not Published -->
		
		
	
	<?php endforeach; endforeach; $i++; endforeach; ?>
	<!-- Col 2 
	<div class="col-2">
		<div class="box">
			<h3><a href="#" class="bot alignRight">Ver todos</a> Comentários esperando moderação</h3>
			<div>
				<ul class="commentsApprovalTools listItens">
					<li>
						<h4><a href="#">Carne fraca, espírito forte</a></h4>
						<h5><a href="#">Carleide Lima - Sobradinho - DF</a></h5>
						<p><a href="#">Que maravilha! Mto obrigada! A sensação de bem-estar nos distância do ESPÍRITO.</a></p>
						<ul class="commentsButtons">
							<li><a href="#" title="Editar" class="btnsAdmin">Editar</a></li>
							<li><a href="#" class="btnsAdmin" title="Remover">Remover</a></li>
							<li><a href="#" class="btnsAdmin" title="Aprovar">Aprovar</a></li>
						</ul>
					</li>
					<li>
						<h4><a href="#">Carne fraca, espírito forte</a></h4>
						<h5><a href="#">Carleide Lima - Sobradinho - DF</a></h5>
						<p><a href="#">Que maravilha! Mto obrigada! A sensação de bem-estar nos distância do ESPÍRITO.</a></p>
						<ul class="commentsButtons">
							<li><a href="#" title="Editar" class="btnsAdmin">Editar</a></li>
							<li><a href="#" class="btnsAdmin" title="Remover">Remover</a></li>
							<li><a href="#" class="btnsAdmin" title="Aprovar">Aprovar</a></li>
						</ul>
					</li>
					<li>
						<h4><a href="#">Carne fraca, espírito forte</a></h4>
						<h5><a href="#">Carleide Lima - Sobradinho - DF</a></h5>
						<p><a href="#">Que maravilha! Mto obrigada! A sensação de bem-estar nos distância do ESPÍRITO.</a></p>
						<ul class="commentsButtons">
							<li><a href="#" title="Editar" class="btnsAdmin">Editar</a></li>
							<li><a href="#" class="btnsAdmin" title="Remover">Remover</a></li>
							<li><a href="#" class="btnsAdmin" title="Aprovar">Aprovar</a></li>
						</ul>
					</li>
					<li>
						<h4><a href="#">Carne fraca, espírito forte</a></h4>
						<h5><a href="#">Carleide Lima - Sobradinho - DF</a></h5>
						<p><a href="#">Que maravilha! Mto obrigada! A sensação de bem-estar nos distância do ESPÍRITO.</a></p>
						<ul class="commentsButtons">
							<li><a href="#" title="Editar" class="btnsAdmin">Editar</a></li>
							<li><a href="#" class="btnsAdmin" title="Remover">Remover</a></li>
							<li><a href="#" class="btnsAdmin" title="Aprovar">Aprovar</a></li>
						</ul>
					</li>
					<li>
						<h4><a href="#">Carne fraca, espírito forte</a></h4>
						<h5><a href="#">Carleide Lima - Sobradinho - DF</a></h5>
						<p><a href="#">Que maravilha! Mto obrigada! A sensação de bem-estar nos distância do ESPÍRITO.</a></p>
						<ul class="commentsButtons">
							<li><a href="#" title="Editar" class="btnsAdmin">Editar</a></li>
							<li><a href="#" class="btnsAdmin" title="Remover">Remover</a></li>
							<li><a href="#" class="btnsAdmin" title="Aprovar">Aprovar</a></li>
						</ul>
					</li>
					<li>
						<h4><a href="#">Carne fraca, espírito forte</a></h4>
						<h5><a href="#">Carleide Lima - Sobradinho - DF</a></h5>
						<p><a href="#">Que maravilha! Mto obrigada! A sensação de bem-estar nos distância do ESPÍRITO.</a></p>
						<ul class="commentsButtons">
							<li><a href="#" title="Editar" class="btnsAdmin">Editar</a></li>
							<li><a href="#" class="btnsAdmin" title="Remover">Remover</a></li>
							<li><a href="#" class="btnsAdmin" title="Aprovar">Aprovar</a></li>
						</ul>
					</li>
				</ul>
				<p class="centerTxt"><a href="#" class="bot">Carregar mais</a></p>
			</div>
		</div>
	</div>
	 /Col 2 -->
</div>
<!-- /Two Cols -->

<?php endif; ?>