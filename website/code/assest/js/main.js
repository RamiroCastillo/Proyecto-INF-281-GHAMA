$(document).ready(function () {
	$("#nav-video-tab").click(function () {
		$("#nav-video-tab").removeClass("btnResBlank");
		$("#nav-video-tab").addClass("btnRes");
		$("#nav-imagen-tab").removeClass("btnRes");
		$("#nav-imagen-tab").addClass("btnResBlank");
	});
	$("#nav-imagen-tab").click(function () {
		$("#nav-video-tab").removeClass("btnRes");
		$("#nav-video-tab").addClass("btnResBlank");
		$("#nav-imagen-tab").removeClass("btnResBlank");
		$("#nav-imagen-tab").addClass("btnRes");
	});
	$("#btnmas").click(function () {
		$("#Vermas").slideDown(500, function () {
			$("#btnmas").css("display", "none");
		});
	});
	$("#btnmasMovil").click(function () {
		$(".VermasMovil").slideDown(500, function () {
			$("#btnmasMovil").css("display", "none");
		});
	});

	$("#responsables").click(function () {
		$("#slideResponsa").slideDown(500);
	});
	$(".causa").mouseenter(function () {
		$(".causa").slideUp(500, function () {
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
		window.location.href = "causas.php";
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

	function testAnim(x) {
		$('.modal .modal-dialog').attr('class', 'modal-dialog  modal-dialog-centered  ' + x + ' animated');
	};

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