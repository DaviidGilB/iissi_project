<footer>
	<p class="pie">
		&copy; IISSI 2017/18 - <span id=reloj></span>
		<script>
		function startTime(){
		today=new Date();
		h=today.getHours();
		m=today.getMinutes();
		s=today.getSeconds();
		m=checkTime(m);
		s=checkTime(s);
		document.getElementById('reloj').innerHTML=h+":"+m+":"+s;
		t=setTimeout('startTime()',500);}
		function checkTime(i){
			if (i<10)
			{i="0" + i;}
			return i;}
		window.onload=function(){startTime();}
		</script>
		<?php if(!isset($_SESSION['login_trabajadores'])) { ?>
			<a href="login_trabajadores.php">Acceso empresa</a> 
		<?php } else { ?>
			<a href="logout_trabajadores.php">Desconectar</a>
			<a href="editar_productos.php">Editar productos</a>
		<?php } ?>
	</p>    
</footer>