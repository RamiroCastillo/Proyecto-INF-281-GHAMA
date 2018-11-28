var index = 2;
var nroCausas = $("#nroCausas").val();
var indexP = nroCausas;
        
$(document).ready(function () {
    mostrarResponsables();
    $(".carousel-control-prev").click(function () {
        $("#causaPagPrin").carousel("prev");
        var ids = $("#ids").val();
        console.log(nroCausas);
        console.log(indexP);
        //indexP=index
        if (indexP > 0) {
            console.log(index);
            $.post("mostrarRespon.php", {
                'ids': ids,
                'p': indexP
            }, function (data) {
                $("#slideResponsa").html(data);
            });
            indexP = indexP - 1;

        } else {
            indexP = nroCausas;
            console.log(index);

            $.post("mostrarRespon.php", {
                'ids': ids,
                'p': indexP
            }, function (data) {
                $("#slideResponsa").html(data);
            });
            indexP = indexP - 1;
        }
    });
    $("#next").click(function (e) {
        //var nroCausas = $("#nroCausas").val();
        var ids = $("#ids").val();
        console.log(nroCausas);
        console.log(index);
        if (index <= nroCausas) {
            console.log(index);
            $.post("mostrarRespon.php", {
                'ids': ids,
                'p': index
            }, function (data) {
                $("#slideResponsa").html(data);
            });
            index = index + 1;
            
        } else {
            index = 1;
            console.log(index);
            
            $.post("mostrarRespon.php", {
                'ids': ids,
                'p': index
            }, function (data) {
                $("#slideResponsa").html(data);
            });
            index = index+1;
        }
        indexP = indexP-1;
    })

    $("#prev").click(function (e) {
        //index=index+1;
    })

    function mostrarResponsables() {
       var idCausa = $(".idCausa").val();
       var ids = $("#ids").val();
       console.log(ids);
       
       $.post("mostrarRespon.php", {
                    'ids':ids
                },
            function (data) {
                $("#slideResponsa").html(data);
            });
    }
});