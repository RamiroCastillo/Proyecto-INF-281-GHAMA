$(document).ready(function () {
	//saludo();
	$(".causa").mouseenter(function () {
		$(".causa").slideUp(500,function(){
			$(".causaDetalle").slideDown(500);
		});
	});
	$(".causaDetalle").mouseout(function () {
		$(".causaDetalle").slideUp(500, function () {
			$(".causa").slideDown(500);
		});
	});
	$(".consecuencia").mouseenter(function () {
		$(".consecuencia").slideUp(500, function () {
			$(".consecuenciaDetalle").slideDown(500);

		});
	});
	$(".consecuenciaDetalle").mouseout(function () {
		$(".consecuenciaDetalle").slideUp(500, function () {
			$(".consecuencia").slideDown(500);
		});
	});
	$(".clickMovil").click(function () {
		window.location.href="causas.php";
	});
	
	$(window).scroll(function () {
		if ($(window).scrollTop() > 100) {
			$("#navsticky").attr("class", "w-100 navbar sticky-top navbar-expand-lg px-5");
		}
	});
	$(window).scroll(function () {
		if ($(window).scrollTop() <= 100) {
			$("#navsticky").attr("class", "my-nav w-100 navbar navbar-expand-lg px-5");
		}
	});

	function saludo () {
		//alert("entro");
		$.post("./assest/php/mostrar.php", {},
			function (data) {
				$("#mensaje").append(data);
			}
		);
	}

	function testAnim(x) {
		$('.modal .modal-dialog').attr('class', 'modal-dialog  modal-dialog-centered  ' + x + ' animated');
	};
	$('#myModal').on('show.bs.modal', function (e) {
		var anim = "zoomIn";
		testAnim(anim);
	});
	$('#myModal').on('hide.bs.modal', function (e) {
		var anim = "rollOut";
		testAnim(anim);
	});
	$('#myModalEntrar').on('show.bs.modal', function (e) {
		var anim = "zoomIn";
		testAnim(anim);
	});
	$('#myModalEntrar').on('hide.bs.modal', function (e) {
		var anim = "rollOut";
		testAnim(anim);
	});
	$('#menuModal').on('show.bs.modal', function (e) {
		var anim = "zoomIn";
		testAnim(anim);
	});
	$("#menuModal").on('hide.bs.modal', function (e) {
		var anim = "rollOut";
		testAnim(anim);
	});

});